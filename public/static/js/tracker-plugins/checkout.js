(function (window, document) {
    'use strict';
    var tracker = window.XenicalTracker;
    if (!tracker) return;
    var productId = (tracker.page || {}).goods_id || '';
    var touched = {};
    function safeField(field) { return ['name', 'phone', 'email', 'city', 'county', 'street', 'address', 'remarks', 'delivery_time', 'order_type', 'store_id', 'captcha_code', 'content', 'type'].indexOf(field) !== -1; }
    function trackField(field, action, extra) {
        if (!safeField(field)) return;
        touched[field] = true;
        tracker.setLastField(field);
        tracker.track('form_interaction', 'checkout.field.' + field + '.' + action, Object.assign({field: field, action: action, product_id: productId}, extra || {}));
    }
    tracker.track('conversion', 'begin_checkout', {product_id: productId});
    document.addEventListener('focusin', function (event) { var field = event.target && event.target.name; if (field) trackField(field, 'focus'); });
    document.addEventListener('blur', function (event) { var field = event.target && event.target.name; if (field) trackField(field, 'blur', {filled: event.target.value ? '1' : '0'}); }, true);
    document.addEventListener('change', function (event) {
        var target = event.target;
        if (!target || !target.name) return;
        var meta = {changed: '1'};
        if (target.name === 'order_type' && (target.value === '0' || target.value === '1')) {
            meta.value = target.value;
            tracker.track('delivery_type_change', 'checkout.delivery_type_change', {value: target.value, product_id: productId});
        }
        trackField(target.name, 'change', meta);
    });
    document.addEventListener('submit', function (event) {
        if (event.target && event.target.id === 'order-form') {
            tracker.markSubmitClicked();
            tracker.track('form_interaction', 'checkout.submit_click', {action: 'submit', product_id: productId, fields_touched: Object.keys(touched).join(',')}, {beacon: true});
        }
    }, true);
    if (window.jQuery) {
        var map = {'/area/city': 'city', '/area/county': 'county', '/area/road': 'street', '/area/shop': 'shop'};
        jQuery(document).ajaxSuccess(function (_event, _xhr, settings, data) {
            var url = settings && settings.url || '';
            Object.keys(map).forEach(function (path) { if (url.indexOf(path) !== -1) tracker.track('area_load', 'checkout.area_load.' + map[path], {step: map[path], status: 'ok'}); });
            if (url.indexOf('/order') !== -1) {
                var redirect = data && data.redirect || '';
                var match = redirect.match(/check\/([^\/?#]+)/);
                tracker.track('conversion', 'purchase', {order_no: match ? match[1] : '', product_id: productId}, {beacon: true});
            }
            if (url === '' && document.activeElement && document.activeElement.closest && document.activeElement.closest('#check-form')) {
                tracker.track('order_check_submit', 'order_check_submit', {status: data && data.code === 200 ? 'success' : 'fail'});
            }
            if (url === '' && document.activeElement && document.activeElement.closest && document.activeElement.closest('#message-form')) {
                tracker.track('message_submit', 'message_submit', {status: data && data.code === 200 ? 'success' : 'fail'});
            }
        });
        jQuery(document).ajaxError(function (_event, xhr, settings) {
            var url = settings && settings.url || '';
            Object.keys(map).forEach(function (path) { if (url.indexOf(path) !== -1) tracker.track('area_load', 'checkout.area_load.' + map[path], {step: map[path], status: 'fail'}); });
            if (url.indexOf('/order') !== -1) {
                tracker.track('conversion', 'submit_fail', {error_code: xhr && xhr.status || 'error', product_id: productId, last_field: ''}, {beacon: true});
            }
        });
    }
})(window, document);
