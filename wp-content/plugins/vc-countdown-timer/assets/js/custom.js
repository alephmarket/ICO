jQuery.noConflict();

jQuery(document).ready(function ($) {

    // Countdown js
    if ($('#countdown_dashboard').length) {

        var day = $('.days_dash').data('day');
        var month = $('.hours_dash').data('month');
        var year = $('.minutes_dash').data('year');

        $('#countdown_dashboard').countDown({
            targetDate: {
                'day': day,
                'month': month,
                'year': year,
                'hour': 0,
                'min': 0,
                'sec': 0
            },
        });

        var digitColor = $('.event-countdown .digit').data('digit-color');
        if (digitColor) {
            $('.event-countdown .digit').css('color', function () {
                return digitColor;
            });
        }

        var borderColor = $('.event-countdown .time-number').data('border-color');
        $('.event-countdown .time-number').css('border-color', function () {
            return borderColor;
        });
    }

});
