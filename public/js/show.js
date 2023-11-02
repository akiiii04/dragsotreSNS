$(function() {
    const button = $("#toggle-button");
    const height = $("#parent");

    button.click(function() {
        height.slideToggle(function() {
            const isVisible = height.is(":visible");
            if (isVisible) {
                button.text("元の投稿を非表示");
            } else {
                button.text("元の投稿を表示");
            }
        });
    });
});

setTimeout(function() {
    $(".flash_message")
        .fadeOut(5000)
        .queue(function() {
            this.remove();
        });
}, 1000);