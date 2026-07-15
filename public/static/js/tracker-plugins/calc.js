(function (window, document) {
    'use strict';
    var tracker = window.XenicalTracker;
    if (!tracker) return;
    var calcType = (tracker.page || {}).calc_type || (tracker.page || {}).page_type || 'calc';
    document.addEventListener('click', function (event) {
        var btn = event.target.closest('.evaluate-form .count, .bmi .count, .bmr-wrapper .count, .fat-wrapper .count');
        if (!btn) return;
        tracker.track('calc_start', 'calc.' + calcType + '.start', {calc_type: calcType});
        window.setTimeout(function () { tracker.track('calc_complete', 'calc.' + calcType + '.complete', {calc_type: calcType}); }, 300);
    }, true);
    document.addEventListener('click', function (event) {
        var link = event.target.closest('a[href*="checkout/"]');
        if (!link) return;
        var match = link.getAttribute('href').match(/checkout\/(\d+)/);
        tracker.track('calc_recommend_click', 'calc.' + calcType + '.recommend_click', {calc_type: calcType, product_id: match ? match[1] : ''}, {beacon: true});
    }, true);
})(window, document);
