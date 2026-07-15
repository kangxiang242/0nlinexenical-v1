(function (window, document) {
    'use strict';
    var tracker = window.XenicalTracker;
    if (!tracker) return;
    var productId = (tracker.page || {}).goods_id || '';
    var buy = document.querySelector('.checkout-btn, .checkout.go-btn');
    if (!buy || !('IntersectionObserver' in window)) return;
    var seen = false;
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!seen && entry.intersectionRatio > 0) {
                seen = true;
                tracker.track('sticky_buy_view', 'product.buy_view', {product_id: productId});
            }
        });
    }, {threshold: [0, 0.1]});
    observer.observe(buy);
})(window, document);
