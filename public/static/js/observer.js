(function (window, document) {
    'use strict';

    if (window.XenicalTracker) return;

    document.addEventListener('click', function (event) {
        var el = event.target.closest('[data-observer]');
        if (!el || !navigator.sendBeacon) return;
        var body = new URLSearchParams();
        body.append('event_type', 'click');
        body.append('event_name', el.getAttribute('data-observer') || 'legacy.click');
        body.append('event', 'click');
        body.append('explain', el.getAttribute('data-observer') || '');
        body.append('label', el.getAttribute('data-observer') || '');
        body.append('uri', location.pathname);
        body.append('page', location.pathname);
        body.append('referer', document.referrer || '');
        body.append('metadata', JSON.stringify({href: el.getAttribute('href') || '', element: el.tagName.toLowerCase()}));
        navigator.sendBeacon('/observer/store', body);
    }, true);
})(window, document);
