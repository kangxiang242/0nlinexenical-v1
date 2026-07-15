(function (window, document) {
    'use strict';
    var tracker = window.XenicalTracker;
    if (!tracker) return;
    var page = tracker.page || {};
    var target = document.querySelector('.news-content, .page-body, iframe#external-frame');
    if (!target) return;
    var marks = {25: false, 50: false, 75: false, 100: false};
    var meta = page.article_id ? {article_id: page.article_id} : {cms_uri: location.pathname};
    tracker.track('content_enter', 'content.enter', meta);
    function progress() {
        var rect = target.getBoundingClientRect();
        var total = Math.max(1, target.scrollHeight || rect.height || document.documentElement.scrollHeight);
        var passed = Math.max(0, window.innerHeight - rect.top);
        var percent = Math.min(100, Math.round(passed / total * 100));
        Object.keys(marks).forEach(function (mark) {
            if (!marks[mark] && percent >= Number(mark)) {
                marks[mark] = true;
                tracker.track('read_progress', 'content.read.' + mark, Object.assign({percent: Number(mark)}, meta), {beacon: true});
            }
        });
    }
    window.addEventListener('scroll', progress, {passive: true});
    progress();
})(window, document);
