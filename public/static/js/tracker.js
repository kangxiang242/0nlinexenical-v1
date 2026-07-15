(function (window, document) {
    'use strict';

    var config = window.__TRACKING_CONFIG__ || {};
    var page = window.__TRACKING_PAGE__ || {};
    var enabled = config.enabled !== false;
    var endpoint = config.endpoint || '/observer/store';
    var startTime = Date.now();
    var maxScroll = 0;
    var scrollMarks = {25: false, 50: false, 75: false, 100: false};
    var seenSections = [];
    var currentSection = '';
    var lastField = '';
    var submitClicked = false;
    var pageExited = false;

    function nowSeconds() {
        return Math.max(0, Math.round((Date.now() - startTime) / 1000));
    }

    function uuid() {
        if (window.crypto && crypto.randomUUID) return crypto.randomUUID();
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0;
            var v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    function getStored(key, storage) {
        try {
            var val = storage.getItem(key);
            if (!val) {
                val = uuid();
                storage.setItem(key, val);
            }
            return val;
        } catch (e) {
            return uuid();
        }
    }

    var visitorId = getStored('xenical_visitor_id', window.localStorage || {});
    var sessionId = getStored('xenical_session_id', window.sessionStorage || {});
    var pageViewId = uuid();

    function safeMetadata(metadata) {
        var allowed = ['field', 'action', 'product_id', 'href', 'element', 'error_code', 'depth_percent', 'milestone', 'duration_sec', 'duration_seconds', 'visibility_ratio_peak', 'section_label', 'order_no', 'calc_type', 'slide_index', 'percent', 'engagement_type', 'blocks_seen', 'last_section_id', 'duration_before_click_sec', 'max_scroll_before_click_percent', 'checkout_duration_sec', 'checkout_outcome', 'last_field', 'fields_touched', 'submit_clicked', 'status', 'step', 'filled', 'changed', 'value', 'exit_type', 'next_uri', 'cms_uri', 'article_id'];
        var result = {};
        metadata = metadata || {};
        allowed.forEach(function (key) {
            if (metadata[key] !== undefined && metadata[key] !== null && metadata[key] !== '') result[key] = metadata[key];
        });
        return result;
    }

    function setUtm() {
        var params = new URLSearchParams(location.search);
        ['utm_source', 'utm_medium', 'utm_campaign'].forEach(function (key) {
            var value = params.get(key);
            if (value) {
                try { sessionStorage.setItem('xenical_' + key, value); } catch (e) {}
            }
        });
    }

    function getUtm(key) {
        try { return sessionStorage.getItem('xenical_' + key) || ''; } catch (e) { return ''; }
    }

    function payload(eventType, eventName, metadata, extra) {
        extra = extra || {};
        var label = extra.label || extra.explain || '';
        var section = extra.section || (metadata && metadata.section) || currentSection || '';
        return {
            event_type: eventType,
            event_name: eventName,
            event: eventType === 'click' ? 'click' : eventName,
            explain: label,
            label: label,
            page: location.pathname,
            uri: location.pathname,
            section: section,
            device: config.device || (window.innerWidth <= 768 ? 'mobile' : 'web'),
            session_id: sessionId,
            visitor_id: visitorId,
            page_view_id: pageViewId,
            page_type: page.page_type || 'cms',
            referer: document.referrer || '',
            utm_source: getUtm('utm_source'),
            utm_medium: getUtm('utm_medium'),
            utm_campaign: getUtm('utm_campaign'),
            metadata: JSON.stringify(safeMetadata(metadata))
        };
    }

    function send(data, useBeacon) {
        if (!enabled || !endpoint) return;
        var body = new URLSearchParams();
        Object.keys(data).forEach(function (key) {
            if (data[key] !== undefined && data[key] !== null) body.append(key, data[key]);
        });
        if (useBeacon && navigator.sendBeacon) {
            navigator.sendBeacon(endpoint, body);
            return;
        }
        fetch(endpoint, {method: 'POST', body: body, credentials: 'same-origin', keepalive: !!useBeacon, headers: {'X-Requested-With': 'XMLHttpRequest'}}).catch(function () {});
    }

    function track(eventType, eventName, metadata, extra) {
        send(payload(eventType, eventName, metadata || {}, extra || {}), extra && extra.beacon);
    }

    function elementName(el) {
        if (!el) return 'unknown';
        return el.getAttribute('data-track-name') || el.getAttribute('data-observer') || (el.className && String(el.className).split(/\s+/).filter(Boolean).slice(0, 2).join('.')) || el.tagName.toLowerCase();
    }

    function trackClick(el) {
        if (!el) return;
        var href = el.getAttribute('href') || '';
        var sectionEl = el.closest('[data-track-section]');
        var section = el.getAttribute('data-track-section') || (sectionEl && sectionEl.getAttribute('data-track-section')) || currentSection;
        track('click', elementName(el), {
            href: href,
            element: el.tagName.toLowerCase(),
            duration_before_click_sec: nowSeconds(),
            max_scroll_before_click_percent: maxScroll,
            blocks_seen: seenSections.slice(-12).join(','),
            last_section_id: currentSection
        }, {explain: el.getAttribute('data-observer') || '', section: section, beacon: !!href});
    }

    function updateScroll() {
        var doc = document.documentElement;
        var scrollable = Math.max(1, doc.scrollHeight - window.innerHeight);
        var percent = Math.min(100, Math.round((window.scrollY || doc.scrollTop || 0) / scrollable * 100));
        maxScroll = Math.max(maxScroll, percent);
        Object.keys(scrollMarks).forEach(function (mark) {
            if (!scrollMarks[mark] && percent >= Number(mark)) {
                scrollMarks[mark] = true;
                track('scroll_depth', 'scroll.' + mark, {depth_percent: Number(mark), milestone: Number(mark)}, {beacon: true});
            }
        });
    }

    function engagementType() {
        var duration = nowSeconds();
        if (duration < 3 && maxScroll < 10) return 'bounce';
        if (duration < 8 && maxScroll < 50) return 'quick_navigate';
        if (maxScroll >= 90) return 'deep_read';
        if (maxScroll >= 50 || duration >= 60) return 'read';
        return 'skim';
    }

    function sectionId(el, index) {
        var explicit = el.getAttribute('data-track-section');
        if (explicit) return explicit;
        var cls = (el.className && String(el.className).split(/\s+/).filter(Boolean)[0]) || el.tagName.toLowerCase();
        return (page.page_type || 'page') + '.' + cls + '.' + index;
    }

    function bindSections() {
        if (!('IntersectionObserver' in window)) return;
        var elements = Array.prototype.slice.call(document.querySelectorAll('[data-track-section-view], main > section, .banner-section'));
        var states = new WeakMap();
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                var state = states.get(entry.target);
                if (!state) return;
                state.peak = Math.max(state.peak, entry.intersectionRatio || 0);
                if (entry.intersectionRatio >= 0.35) {
                    currentSection = state.id;
                    if (seenSections.indexOf(state.id) === -1) {
                        seenSections.push(state.id);
                        track('section_view', state.id, {section_label: state.label}, {section: state.id});
                    }
                    if (!state.visibleSince) state.visibleSince = Date.now();
                } else if (state.visibleSince) {
                    track('section_dwell', state.id, {section_label: state.label, duration_sec: Math.max(1, Math.round((Date.now() - state.visibleSince) / 1000)), visibility_ratio_peak: Number(state.peak.toFixed(2))}, {section: state.id, beacon: true});
                    state.visibleSince = 0;
                    state.peak = 0;
                }
            });
        }, {threshold: [0, 0.35, 0.75, 1]});
        elements.forEach(function (el, index) {
            var id = sectionId(el, index + 1);
            states.set(el, {id: id, label: el.getAttribute('data-track-section-label') || el.getAttribute('aria-label') || id, visibleSince: 0, peak: 0});
            observer.observe(el);
        });
        window.addEventListener('pagehide', function () {
            elements.forEach(function (el) {
                var state = states.get(el);
                if (state && state.visibleSince) {
                    track('section_dwell', state.id, {section_label: state.label, duration_sec: Math.max(1, Math.round((Date.now() - state.visibleSince) / 1000)), visibility_ratio_peak: Number(state.peak.toFixed(2))}, {section: state.id, beacon: true});
                    state.visibleSince = 0;
                }
            });
        });
    }

    function pageExit(type) {
        if (pageExited) return;
        pageExited = true;
        track('page_exit', 'page.exit', {duration_seconds: nowSeconds(), max_scroll_percent: maxScroll, exit_type: type || 'pagehide', engagement_type: engagementType(), blocks_seen: seenSections.slice(-20).join(','), last_section_id: currentSection, checkout_outcome: page.page_type === 'checkout' ? (submitClicked ? 'submitted' : 'abandoned') : '', checkout_duration_sec: page.page_type === 'checkout' ? nowSeconds() : '', last_field: lastField, submit_clicked: submitClicked ? '1' : ''}, {beacon: true});
    }

    function loadPlugin(name) {
        if (!name) return;
        var src = '/static/js/tracker-plugins/' + name + '.js';
        if (config.assetVersion) src += '?ver=' + encodeURIComponent(config.assetVersion);
        var script = document.createElement('script');
        script.src = src;
        script.defer = true;
        document.head.appendChild(script);
    }

    function boot() {
        if (!enabled) return;
        setUtm();
        updateScroll();
        track('page_view', 'page.view', {duration_seconds: 0});
        bindSections();
        document.addEventListener('click', function (event) {
            var el = event.target.closest('[data-observer], [data-track-name]');
            if (el) trackClick(el);
        }, true);
        document.addEventListener('focusin', function (event) {
            var field = event.target && event.target.name;
            if (field) lastField = field;
        });
        window.addEventListener('scroll', updateScroll, {passive: true});
        window.addEventListener('pagehide', function () { pageExit('pagehide'); });
        var map = {checkout: 'checkout', news_detail: 'reading', cms: 'reading', home: 'home', product_detail: 'product', bmi: 'calc', bmr: 'calc', body_fat: 'calc', message: 'forms', order_check: 'forms'};
        loadPlugin(map[page.page_type]);
    }

    window.XenicalTracker = {
        track: track,
        click: trackClick,
        page: page,
        config: config,
        markSubmitClicked: function () { submitClicked = true; },
        setLastField: function (field) { lastField = field || lastField; },
        getState: function () { return {visitor_id: visitorId, session_id: sessionId, page_view_id: pageViewId, max_scroll: maxScroll}; }
    };

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
    else boot();
})(window, document);
