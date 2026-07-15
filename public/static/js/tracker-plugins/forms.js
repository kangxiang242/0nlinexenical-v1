(function (window, document) {
    'use strict';

    var tracker = window.XenicalTracker;
    if (!tracker) return;

    var page = tracker.page || {};
    var formSelector = page.page_type === 'order_check' ? '#check-form' : '#message-form';
    var eventName = page.page_type === 'order_check' ? 'order_check_submit' : 'message_submit';
    var submitSeen = false;

    document.addEventListener('focusin', function (event) {
        var field = event.target && event.target.name;
        if (!field || !event.target.closest(formSelector)) return;
        tracker.setLastField(field);
        tracker.track('form_interaction', eventName + '.field.' + field + '.focus', {field: field, action: 'focus'});
    });

    document.addEventListener('blur', function (event) {
        var field = event.target && event.target.name;
        if (!field || !event.target.closest(formSelector)) return;
        tracker.track('form_interaction', eventName + '.field.' + field + '.blur', {field: field, action: 'blur', filled: event.target.value ? '1' : '0'});
    }, true);

    document.addEventListener('submit', function (event) {
        if (!event.target || !event.target.matches(formSelector)) return;
        submitSeen = true;
        tracker.track(eventName, eventName, {status: 'submit'}, {beacon: true});
    }, true);

    if (window.jQuery) {
        jQuery(document).ajaxSuccess(function (_event, _xhr, settings, data) {
            if (!submitSeen && (!settings || settings.url !== '')) return;
            tracker.track(eventName, eventName, {status: data && data.code === 200 ? 'success' : 'fail'});
            submitSeen = false;
        });
        jQuery(document).ajaxError(function (_event, xhr, settings) {
            if (!submitSeen && (!settings || settings.url !== '')) return;
            tracker.track(eventName, eventName, {status: 'fail', error_code: xhr && xhr.status || 'error'}, {beacon: true});
            submitSeen = false;
        });
    }
})(window, document);
