$(function () {
    $("[data-observer]").click(function () {
        var explain = $(this).attr('data-observer');
        var uri = location.pathname;
        var referrer = document.referrer;
        var event = 'click';
        $.ajax({
            type: "POST",
            url: "/observer/store",
            data: {explain:explain, uri:uri, event:event, referrer:referrer},
            dataType: "text",
            success: function(){
            }
        });
    });

})
