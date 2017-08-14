(function ($) {
    "use strict";
    
    $(".icon-search").keyup(function () {
        var value = $(this).val(), count = 0;

        $(".icon-list li").each(function () {
            if ($(this).text().search(new RegExp(value, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
                count++;
            }
        });
    });

    $("#icon-dropdown li").click(function () {
        $(this).attr("class", "selected").siblings().removeAttr("class");
        var icon = $(this).attr("data-icon");
        $("#icon-field").val(icon);
        $(".icon-preview").html("<i class=\'icon fa fa-" + icon + "\'></i>");
    });
})(window.jQuery);

