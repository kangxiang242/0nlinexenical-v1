(function (window, document) {
    'use strict';
    var tracker = window.XenicalTracker;
    if (!tracker) return;
    document.addEventListener('toggle', function (event) {
        var item = event.target;
        if (!item || !item.matches('details.faq-item')) return;
        tracker.track('faq_toggle', 'home.faq_toggle', {section_label: item.querySelector('.faq-question') ? item.querySelector('.faq-question').textContent.trim().slice(0, 60) : 'faq', status: item.open ? 'open' : 'close'});
    }, true);
    document.addEventListener('click', function (event) {
        var btn = event.target.closest('.evaluate-form .count');
        if (!btn) return;
        tracker.track('calc_start', 'calc.bmi.start', {calc_type: 'bmi'});
        window.setTimeout(function () { tracker.track('calc_complete', 'calc.bmi.complete', {calc_type: 'bmi'}); }, 300);
    }, true);
})(window, document);
