var _ideo = _ideo || {};

(function ($, ideo) {
    'use strict';

    $('#post-formats-select input[type="radio"]').on('change', function () {

        if ($(this).val()) {
            $('.post-format-content').removeClass('active');
            $('.post-format-content.' + $(this).val()).addClass('active');
        }

    });

    if (isWidgetPage()) {
        $('#widgets-right').append('' +
        '<form action="admin-ajax.php?action=addSidebar" method="post" class="sidebar-add-container js--sidebar-add">' +
        '<h3>' + _ideo_translations.customWidgetArea + '</h3>' +
        '<div class="row">' +
        '<div class="left">' +
        '<input type="text" value="" placeholder="' + _ideo_translations.widgetAreaPlaceholder + '" name="name" class="js--sidebar-name" required="required" />' +
        '</div>' +
        '<div class="right">' +
        '<input type="submit" name="add-sidebar" value="' + _ideo_translations.addWidgetButtonText + '" />' +
        '</div>' +
        '</div>' +
        '</form>');

        loadCustomSidebars();
    }

    $('body').on('click', '.js--delete-widget', function () {

        var sidebar_id = $(this).data('id');
        var widget_container = $('.widgets-sortables#' + sidebar_id).parent('.widgets-holder-wrap');

        widget_container.addClass('closed');

        if (confirm(_ideo_translations.removeSidebarConfirm)) {

            $.ajax({
                type: "POST",
                url: 'admin-ajax.php',
                dataType: "json",
                data: {
                    'action': 'deleteSidebar',
                    'sidebar_id': sidebar_id
                },
                timeout: 600000,
                xhrFields: {
                    withCredentials: true
                },

                success: function (data) {

                    if (data.success) {
                        widget_container.remove();
                    }
                    else {
                        alert(data.data.info);
                    }
                }
            });
        }

        return false;
    });

    /**
     * Add new sidebar
     */
    $('body').on('submit', '.js--sidebar-add', function () {

        var form = $(this);

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            dataType: "json",
            data: form.serialize(),
            timeout: 600000,
            xhrFields: {
                withCredentials: true
            },

            beforeSend: function () {

            },

            success: function (data) {

                if (data.success) {
                    location.reload(true);
                }
                else {
                    alert(data.data.info);
                }
            }
        });

        return false;
    });

    /**
     * Check if current page is widget management page
     *
     * @returns {boolean}
     */

    function isWidgetPage() {
        return $('body.widgets-php #widgets-right').length > 0;
    }

    /**
     * Load all custom sidebars and add delete button
     */

    function loadCustomSidebars() {

        $.ajax({
            type: "POST",
            url: 'admin-ajax.php',
            dataType: "json",
            data: {
                'action': 'loadRegisteredSidebars'
            },
            timeout: 600000,
            xhrFields: {
                withCredentials: true
            },

            success: function (data) {

                var sidebars = data.data;

                for (var i in sidebars) {
                    addRemoveButton(i);
                }
            }
        });
    }

    function addRemoveButton(item) {
        $('.widgets-sortables#' + item).find('.sidebar-name h2').append('<a href="0" data-id="' + item + '" class="ideo-delete-widget js--delete-widget"><i class="fa fa-close"></i></a>');
    }

    $('.sortable').sortable({
        out : function( event, ui ){
            var item = ui.item;
            var container = item.parent();
            var input = $('#'+item.attr('for'));
            var children = container.children();

            input.val('');
            children.each(function(){
                input.val(input.val() + $(this).data('id') + ',');
            });
        }
    });

    $.fn.ImageButton = function () {
        return this.each(function () {

            var file_frame;

            $(this).on('click', function (event) {
                event.preventDefault();

                var button = $(this);
                var images_container = $(this).data('images_container');
                var images_ids = $(this).data('images_ids');
                var type = button.data('type') || 'id';

                // If the media frame already exists, reopen it.
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                // Create the media frame.
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: $(this).data('uploader_title') || "Title",
                    button: {
                        text: $(this).data('uploader_button_text') || "Select photos"
                    },
                    multiple: $(this).data('multiple') || false  // Set to true to allow multiple files to be selected
                });

                // When an image is selected, run a callback.
                file_frame.on('select', function () {
                    var input = $('#' + images_ids);

                    $('#' + images_container).html('');
                    input.val('');

                    var selection = file_frame.state().get('selection');
                    selection.map(function (attachment) {
                        attachment = attachment.toJSON();

                        if (attachment.url.length) {
                            if ($('#' + images_container).length) {
                                $('#' + images_container).append('<img for="' + images_ids + '" data-id="' + attachment.id + '" src="' + attachment.sizes.thumbnail.url + '">');
                            }

                            if($(button).data('multiple')){
                                input.val(input.val() + attachment[type] + ',');
                            }
                            else{
                                input.val(attachment[type]);
                            }
                        }
                    });
                });


                file_frame.on('open', function () {
                    var selection = file_frame.state().get('selection');

                    var selected = $('#' + images_ids).val().split(','); // the id of the image
                    if (selected.length) {
                        for (var i in selected) {
                            if (selected[i].length > 0) {
                                selection.add(wp.media.attachment(selected[i]));
                            }
                        }
                    }
                });

                file_frame.open();
            });
        });
    };

    $('.test_button, #gallery_image_btn, #video_button, #audio_button, .wp-media').ImageButton();
    
    /* PAGE OPTIONS */
    
    $.fn.ideoTabs = function() {
        return this.each( function() {
            var $this = $(this),
                $content = $this.next();
            
            $this.find('a').on('click', function(e) {
                e.preventDefault();
                
                $this.find('a').removeClass('active');
                $(this).addClass('active');
                
                $content.find('.tab-content').removeClass('active');
                $($(this).attr('href')).addClass('active');
                
                
            })
            
        });        
    };
    $('.ideo-tabs-bar').ideoTabs();
    
    $.fn.ideoAccordions = function() {
        return this.each( function() {
            var $this = $(this);
   
            $this.find('.ideo-accordions-title').on('click', function(e) {
                e.preventDefault();

                $(this).closest('.ideo-accordions-section').toggleClass('active');

            });
            
        });        
    };
    $('.ideo-accordions').ideoAccordions();
    
    
    
    $.fn.ideoButtonSet = function() {
        return this.each( function() {
            var $this = $(this);            
            $this.buttonset();
        });        
    };
  
    
    $.fn.ideoSlider = function() {
        return this.each( function() {
            var $this = $(this),
                $input = $this.find('input');            
            
            var slider = $( "<div class='slider'></div>" ).insertBefore( $input ).slider({ 
                  min: $input.data('min'),
                  max: $input.data('max'),
                  step: $input.data('step'),
                  value: $input.val(),
                  slide: function( event, ui ) {
                    $input.val(ui.value);
                  }
            });
            $input.keyup(function() {
                slider.slider( "value", this.value );
            });
           
            
        });        
    };
    
    
    $('.ideo-slider').ideoSlider();
    
    $( ".ideo-selectmenu > select" ).selectmenu();
    $.fn.ideoSwitcher = function() {
        return this.each( function() {
            var $this = $(this),
                $input = $this.find('input'),
                $label = $this.find('label'),         
                valueOn = $label.data('value-on'),
                valueOff = $label.data('value-off');
            
            if(valueOn == $input.val()){
                $label.addClass('active');
            }
            
            $label.on('click', function(e){
                e.preventDefault();
                
                if($label.hasClass('active')){
                    $label.removeClass('active');
                    $input.val(valueOff);
                }else{
                    $label.addClass('active');
                    $input.val(valueOn);
                }
                $input.trigger('change');
                
            });
                       
        });        
    };
    $( ".ideo-switcher" ).ideoSwitcher();
    
    $( ".ideo-colorpicker > input" ).wpColorPicker({
        change: function(event, ui) {
            $(this).closest('.ideo-accordions-section').trigger('ideo.change.height');
        }
    });
    
    
    
    $.fn.ideoAttachImage = function() {
        return this.each( function() {
            var $this = $(this),
                $input = $this.find('input'),
                $button = $this.find('a');            
            
            
            $button.on('click', function(e) {
                e.preventDefault();
                wp.media.editor.send.attachment = function (props, attachment) {                    
                    $input.val(attachment.url);
                }
                wp.media.editor.open(this);
            });
           
            
        });        
    };
    $('.ideo-attach-image').ideoAttachImage();
    
    $('.js--portfolio-add-item').button();
    $('.js--portfolio-remove-item').button();

    function showHideParameterDeleteButton(){
        var $container = $('.js--portfolio-parameters-cont');
        if ($container.children().length > 1)
            $('.js--portfolio-remove-item').show();
        else
            $('.js--portfolio-remove-item').hide();
    };

    $.fn.addPortfolioParameter = function() {
        var $container = $('.js--portfolio-parameters-cont');
        var $item = $('li', $container).first().clone();
        $item.find('input').val('');
        $container.append($item);
        showHideParameterDeleteButton();
    };

    $('body').on('click', '.js--portfolio-add-item', $.fn.addPortfolioParameter);
    
    $.fn.removePortfolioParameter = function(e) {
        $(e.currentTarget).parent().remove();
        showHideParameterDeleteButton();
    };

    showHideParameterDeleteButton();
    
    $('body').on('click', '.js--portfolio-remove-item', $.fn.removePortfolioParameter);


    $.fn.isParameterHiddenByOther = function(currentId){
        var hiddenBy = $(this).data('hiddenBy');

        if (!hiddenBy || hiddenBy.length == 0)
            return false;

        if (hiddenBy.length > 1)
            return true;

        return hiddenBy[0] != name;
    };

    $.fn.addParameterHiddenBy = function(name){
        var hiddenBy = $(this).data('hiddenBy');

        if (!hiddenBy)
            hiddenBy = [];

        if (hiddenBy.indexOf(name) < 0)
            hiddenBy.push(name);

        $(this).data('hiddenBy', hiddenBy);
    };

    $.fn.removeParameterHiddenBy = function(name){
        var hiddenBy = $(this).data('hiddenBy');

        if (!hiddenBy)
            return;

        var index = hiddenBy.indexOf(name);

        if (index >= 0)
            hiddenBy.splice(index, 1);

        $(this).data('hiddenBy', hiddenBy);
    };

    $.fn.showParameterBy = function(name){
        $(this).removeParameterHiddenBy(name);

        if (!$(this).isParameterHiddenByOther(name))
            $(this).closest('.vc_shortcode-param').slideDown('fast').addClass('dependencies');
    };
    
    $.fn.hideParameterBy = function(name){
        $(this).addParameterHiddenBy(name);
        $(this).closest('.vc_shortcode-param').slideUp('fast').addClass('is-dependent').removeClass('dependencies');
    };

})(jQuery, _ideo);