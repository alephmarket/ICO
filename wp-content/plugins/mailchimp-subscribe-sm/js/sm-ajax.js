(function($){
    $(document).ready(function() {

        
    
        function ssm_modal(){
            $('.sm_modal').fadeIn();
        }

        if ($.cookie('ssm_subscribed') !== 'true') {
            var delay = $('.smwrapper').attr('data-delay');
            setTimeout(ssm_modal, delay);
        }

        

        $('.sm_close').click(function(){
            $('.sm_modal').fadeOut();
        });


        if ($.cookie('ssm_subscribed')) {
            $('.sm_modal').css('display','none');
            //var success_text = jQuery('#response').text();
            //$('.smform').html(success_text);
        }


    var OSName = "Unknown";
    if (window.navigator.userAgent.indexOf("Windows NT 10.0") != -1) OSName="Windows 10";
    if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) OSName="Windows 8";
    if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1) OSName="Windows 7";
    if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1) OSName="Windows Vista";
    if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1) OSName="Windows XP";
    if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1) OSName="Windows 2000";
    if (window.navigator.userAgent.indexOf("Mac")!=-1) OSName="Mac/iOS";
    if (window.navigator.userAgent.indexOf("X11")!=-1) OSName="UNIX";
    if (window.navigator.userAgent.indexOf("Linux")!=-1) OSName="Linux";

    $('.smform').append('<input type="hidden" name="sm_browser" value="'+bowser.name+'" >');
    $('.smform').append('<input type="hidden" name="sm_OS" value="'+OSName+'" >');

    var success_text = $('#response').text();
    $('.smform').on('submit',function(){

        // Add text 'loading...' right after clicking on the submit button. 
         
        var form = $(this);

        var sub_url = $('.ssm_sub_url').val();
        var result = " ";
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(result){
                if (result == 'success'){
                    $(form).html(success_text);
                    //$('#response').show('slow');  
                    $('.sm_modal').slideUp();
                    $.cookie('ssm_subscribed', 'true', { expires: 30, path: '/' });
                } else if(result == 'run_url'){
                    window.location.assign(sub_url);
                } else if(result == 'Subscriber Already Exists') {
                    $('#response').text('Subscriber Already Exists');
                    $('#response').show('slow');
                    if (sub_url !== " ") {
                        window.location.assign(sub_url);
                    }
                    $.cookie('ssm_subscribed', 'true', { expires: 30, path: '/' });
                    $('.sm_modal').slideUp();
                } else if(result == 'Invalid Input') {
                    $('#response').text('Input invalid.');
                    $('#response').show('slow');
                } else if(result == 'Invalid API Key Or List Name') {
                    $('#response').text('Invalid API Key Or List Name');
                    $('#response').show('slow');
                } else {
                    $('#response').text('Unknown Error Occurred');
                    $('#response').show();
                }
            }
        });
         
        // Prevents default submission of the form after clicking on the submit button. 
        return false;   
    });


});

})(jQuery);