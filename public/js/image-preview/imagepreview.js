(function($) {
    "use strict";
    $.fn.anarchytip = function(options) {
        var defaults = $.extend({
            xOffset: 10,
            yOffset: 30
        }, options);
        return this.each(function() {
            var a = $(this);
            a.each(function(e) {
                    this.t = this.title,
                        this.title = "";
                    var c = (this.t != "") ? "<br/>" + this.t : "";
                    $("body").append("<p id='preview'><img src='" + this.href + "' alt='Image preview' />" + c + "</p>");
                    $("#preview").css({
                        "top": (e.pageY - defaults.xOffset) + "px",
                        "left": (e.pageX + defaults.yOffset) + "px"
                    }).fadeIn();
                },
                function() {
                    this.title = this.t;
                    $("#preview").remove();
                });
            a.mousemove(function(e) {
                $("#preview")
                    .css("top", (e.pageY - defaults.xOffset) + "px")
                    .css("left", (e.pageX + defaults.yOffset) + "px");
            })
        })
    }
    $('body').on('mousemove', '.preview', function (e) {
        var offset = $(this).offset();
        var imagUrl = $(this).attr('data');
        const img = new Image();
        img.src = imagUrl;
        var xOffset = 80;
        var yOffset = img.height-50;
        console.log(offset.top);
        console.log(offset.left);
        if($('#preview').length)
        {
            $("#preview").css({
                "top": (offset.top - yOffset) + "px",
                "left": (offset.left + xOffset) + "px"
            }).fadeIn();
        }
        else
        {
            this.t = this.title,
            this.title = "";
            var c = (this.t != "") ? "<br/>" + this.t : "";
            $("body").append("<p id='preview'><img src='" + imagUrl + "' alt='Image preview' />" + c + "</p>");
            $("#preview").css({
                "top": (offset.top - yOffset) + "px",
                "left": (offset.left + xOffset) + "px"
            }).fadeIn();
        }
    });
    $('body').on('mouseout', '.preview', function (e) {
        $("#preview").remove();
    });
})(jQuery);
