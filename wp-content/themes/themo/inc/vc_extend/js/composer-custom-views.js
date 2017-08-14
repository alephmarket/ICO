(function ($) {
    "use strict";
    
    var Shortcodes = vc.shortcodes;


    vc.shortcode_view.prototype.changeShortcodeParamsImport = function (model) {
        var params = model.get('params'),
            settings = vc.map[model.get('shortcode')],
            inverted_value;
        if (_.isArray(settings.params)) {
            _.each(settings.params, function (p) {
                var name = p.param_name,
                    value = params[name],
                    $wrapper = this.$el.find('> .wpb_element_wrapper, > .vc_element-wrapper'),
                    label_value = value,
                    $admin_label = $wrapper.children('.admin_label_' + name);
                if (_.isObject(vc.atts[p.type]) && _.isFunction(vc.atts[p.type].render)) {
                    value = vc.atts[p.type].render.call(this, p, value);
                }
                if ($wrapper.children('.' + p.param_name).is('input,textarea,select')) {
                    $wrapper.children('[name=' + p.param_name + ']').val(value);
                } else if ($wrapper.children('.' + p.param_name).is('iframe')) {
                    $wrapper.children('[name=' + p.param_name + ']').attr('src', value);
                } else if ($wrapper.children('.' + p.param_name).is('img')) {
                    var $img = $wrapper.children('[name=' + p.param_name + ']');
                    if (value && value.match(/^\d+$/)) {
                        $.ajax({
                            type: 'POST',
                            url: window.ajaxurl,
                            data: {
                                action: 'wpb_single_image_src',
                                content: value,
                                size: 'thumbnail'
                            },
                            dataType: 'html',
                            context: this
                        }).done(function (url) {
                            $img.attr('src', url);
                        });
                    } else if (value) {
                        $img.attr('src', value);
                    }
                } else {
                    $wrapper.children('[name=' + p.param_name + ']').html(value ? value : '');
                }
                if ($admin_label.length) {
                    if (value === '' || _.isUndefined(value)) {
                        $admin_label.hide().addClass('hidden-label');
                    } else {
                        if (_.isObject(p.value) && !_.isArray(p.value) && p.type == 'checkbox') {
                            inverted_value = _.invert(p.value);
                            label_value = _.map(value.split(/[\s]*\,[\s]*/), function (val) {
                                return _.isString(inverted_value[val]) ? inverted_value[val] : val;
                            }).join(', ');
                        } else if (_.isObject(p.value) && !_.isArray(p.value)) {
                            inverted_value = _.invert(p.value);
                            label_value = _.isString(inverted_value[value]) ? inverted_value[value] : value;
                        }
                        $admin_label.html('<label>' + $admin_label.find('label').text() + '</label>: ' + label_value);
                        $admin_label.show().removeClass('hidden-label');
                    }
                }
            }, this);
        }
        var view = vc.app.views[this.model.get('parent_id')];
        if (this.model.get('parent_id') !== false && _.isObject(view)) {
            view.checkIsEmpty();
        }

        if (params.el_import && params.el_import != '') {
            try {
                var importParams = JSON.parse(params.el_import);
                if (typeof importParams === 'object') {
                    params = importParams;
                }
            } catch (e) {
            }
        }

        params.el_import = null;
        model.set({
            params: params
        });
        model.save();
    };
    vc.shortcode_view.prototype.cloneModel = function (model, parent_id, save_order) {
        var shortcodes_to_resort = [],
            new_params = model.get('params'),
            new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
            model_clone = Shortcodes.create({
                shortcode: model.get('shortcode'),
                id: window.vc_guid(),
                parent_id: parent_id,
                order: new_order,
                cloned: true,
                cloned_from: model.toJSON(),
                params: _.extend({}, new_params)
            });

        _.each(Shortcodes.where({
            parent_id: model.id
        }), function (shortcode) {
            this.cloneModel(shortcode, model_clone.get('id'), true);
        }, this);


        var params = model_clone.get('params');
        if (model_clone.get('cloned') === false) {
            params.el_uid = params.el_uid || model_clone.id;
        } else {
            params.el_uid = model_clone.id;
        }
        params.el_uid = params.el_uid.replace('-', '');

        if (model.get('shortcode') === 'vc_tab') _.extend(params, {
            tab_id: +new Date() + '-' + Math.floor(Math.random() * 11)
        });

        model_clone.get({
            'params': params
        });
        model_clone.save();


        return model_clone;
    };


    window.VcPageSectionView = window.VcRowView;

    window.VcPageSectionView.prototype.buildDesignHelpers = function () {
        var css = this.model.getParam('css'),
            el_background = this.model.getParam('el_background'),
            el_background_color = this.model.getParam('el_background_color'),
            el_rwd_lg = this.model.getParam('el_rwd_lg'),
            el_rwd_md = this.model.getParam('el_rwd_md'),
            el_rwd_sm = this.model.getParam('el_rwd_sm'),
            el_rwd_xs = this.model.getParam('el_rwd_xs'),
            el_visabillity = this.model.getParam('el_visabillity'),
            $column_toggle = this.$el.find('> .vc_controls .column_toggle'),
            image, color, $image, $color,
            shortcode = this.model.get('shortcode')
            ;
        this.$el.find('> .vc_controls .vc_row_color').remove();
        this.$el.find('> .vc_controls .vc_row_image').remove();
        this.$el.find('> .vc_controls .column_background').remove();
        this.$el.find('> .vc_controls .column_visabillity').remove();
        var matches = css.match(/background\-image:\s*url\(([^\)]+)\)/)
        if (matches && !_.isUndefined(matches[1])) {
            image = matches[1];
        }
        var matches = css.match(/background\-color:\s*([^\s\;]+)\b/)
        if (matches && !_.isUndefined(matches[1])) {
            color = matches[1];
        }
        var matches = css.match(/background:\s*([^\s]+)\b\s*url\(([^\)]+)\)/)
        if (matches && !_.isUndefined(matches[1])) {
            color = matches[1];
            image = matches[2];
        }
        if (image) {
            $('<span class="vc_row_image" style="background-image: url(' + image + ');" title="' + i18nLocale.row_background_image + '"></span>')
                .insertAfter($column_toggle);
        }
        if (color) {
            $('<span class="vc_row_color" style="background-color: ' + color + '" title="' + i18nLocale.row_background_color + '"></span>')
                .insertAfter($column_toggle);
        }
        if (el_background) {
            var el_background_icon = '';
            if (el_background == 'color') {
                el_background_icon = '<i style="color:' + el_background_color + '" class="fa fa-stop"></i>';

            }
            if (el_background == 'image') {
                el_background_icon = '<i class="fa fa-image"></i>';
            }
            if (el_background == 'video') {
                el_background_icon = '<i class="fa fa-video-camera"></i>';
            }
            $('<span class="vc_control column_background" title="Background type ' + el_background + '">' + el_background_icon + '<span/>')
                .insertAfter($column_toggle);
        }
        if (shortcode == 'vc_row') {
            $('<span class="vc_control column_visabillity ' + el_rwd_lg + '" title="Visabillity Large devices displaying (1200px and up)"><i class="size-lg"></i><span/>')
                .insertAfter($column_toggle);
            $('<span class="vc_control column_visabillity ' + el_rwd_md + '" title="Visabillity Medium devices displaying (992-1199px)"><i class="size-md"></i><span/>')
                .insertAfter($column_toggle);
            $('<span class="vc_control column_visabillity ' + el_rwd_sm + '" title="Visabillity Small devices displaying (768-991px)"><i class="size-sm"></i><span/>')
                .insertAfter($column_toggle);
            $('<span class="vc_control column_visabillity ' + el_rwd_xs + '" title="Visabillity Extra small devices displaying (less than 768px)"><i class="size-xs"></i><span/>')
                .insertAfter($column_toggle);
        }       
    };

    window.VcButtonView = vc.shortcode_view.extend();

    window.VcColumnTextView = vc.shortcode_view.extend();

    window.VcColumnTextStyledView = vc.shortcode_view.extend();

    window.VcCallToActionView = vc.shortcode_view.extend();

    window.VcIconBoxView = vc.shortcode_view.extend();

    window.VcProgressBarView = vc.shortcode_view.extend();

    window.VcTextSeparatorView = vc.shortcode_view.extend();

    window.VcTextSeparatorIconView = vc.shortcode_view.extend();

    window.VcTabsView.prototype.cloneModel = function (model, parent_id, save_order) {
        var shortcodes_to_resort = [],
            new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
            model_clone,
            new_params = _.extend({}, model.get('params'));

        new_params.el_uid = window.vc_guid().replace('-', '');


        if (model.get('shortcode') === 'vc_tab') _.extend(new_params, {
            tab_id: +new Date() + '-' + this.$tabs.find('[data-element-type=vc_tab]').length + '-' + Math.floor(Math.random() * 11)
        });
        model_clone = Shortcodes.create({
            shortcode: model.get('shortcode'),
            id: vc_guid(),
            parent_id: parent_id,
            order: new_order,
            cloned: (model.get('shortcode') !== 'vc_tab'),
            cloned_from: model.toJSON(),
            params: new_params
        });
        _.each(Shortcodes.where({
            parent_id: model.id
        }), function (shortcode) {
            this.cloneModel(shortcode, model_clone.get('id'), true);
        }, this);
        return model_clone;
    };


    window.VcAccordionView = vc.shortcode_view.extend({
        adding_new_tab: false,
        events: {
            'click .add_tab': 'addTab',
            'click > .vc_controls .column_delete, > .vc_controls .vc_control-btn-delete': 'deleteShortcode',
            'click > .vc_controls .column_edit, > .vc_controls .vc_control-btn-edit': 'editElement',
            'click > .vc_controls .column_clone,> .vc_controls .vc_control-btn-clone': 'clone'
        },
        render: function () {
            window.VcAccordionView.__super__.render.call(this);
            this.$content.sortable({
                axis: "y",
                handle: "h3",
                stop: function (event, ui) {
                    // IE doesn't register the blur when sorting
                    // so trigger focusout handlers to remove .ui-state-focus
                    ui.item.prev().triggerHandler("focusout");
                    $(this).find('> .wpb_sortable').each(function () {
                        var shortcode = $(this).data('model');
                        shortcode.save({
                            'order': $(this).index()
                        }); // Optimize
                    });
                }
            });
            return this;
        },
        changeShortcodeParams: function (model) {
            window.VcAccordionView.__super__.changeShortcodeParams.call(this, model);
            var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            if (this.$content.hasClass('ui-accordion')) {
                this.$content.accordion("option", "collapsible", collapsible);
            }
        },
        changedContent: function (view) {
            if (this.$content.hasClass('ui-accordion')) this.$content.accordion('destroy');
            var collapsible = _.isString(this.model.get('params').collapsible) && this.model.get('params').collapsible === 'yes' ? true : false;
            this.$content.accordion({
                header: "h3",
                navigation: false,
                autoHeight: true,
                heightStyle: "content",
                collapsible: collapsible,
                active: this.adding_new_tab === false && view.model.get('cloned') !== true ? 0 : view.$el.index()
            });
            this.adding_new_tab = false;
        },
        addTab: function (e) {
            this.adding_new_tab = true;
            e.preventDefault();
            vc.shortcodes.create({
                shortcode: 'vc_accordion_tab',
                params: {
                    title: window.i18nLocale.section
                },
                parent_id: this.model.id
            });
        },
        _loadDefaults: function () {
            window.VcAccordionView.__super__._loadDefaults.call(this);
        }
    });

    window.VcAccordionTabView = window.VcColumnView.extend({
        events: {
            'click > .vc_controls .column_delete,.wpb_vc_accordion_tab > .vc_controls .vc_control-btn-delete': 'deleteShortcode',
            'click > .vc_controls .column_add,.wpb_vc_accordion_tab >  .vc_controls .vc_control-btn-prepend': 'addElement',
            'click > .vc_controls .column_edit,.wpb_vc_accordion_tab >  .vc_controls .vc_control-btn-edit': 'editElement',
            'click > .vc_controls .column_clone,.wpb_vc_accordion_tab > .vc_controls .vc_control-btn-clone': 'clone',
            'click > [data-element_type] > .wpb_element_wrapper > .vc_empty-container': 'addToEmpty'
        },
        setContent: function () {
            this.$content = this.$el.find('> [data-element_type] > .wpb_element_wrapper > .vc_container_for_children');
        },
        changeShortcodeParams: function (model) {
            var params = model.get('params');
            window.VcAccordionTabView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params) && _.isString(params.title)) {
                this.$el.find('> h3 .tab-label').text(params.title);
            }
        },
        setEmpty: function () {
            $('> [data-element_type]', this.$el).addClass('vc_empty-column');
            this.$content.addClass('vc_empty-container');
        },
        unsetEmpty: function () {
            $('> [data-element_type]', this.$el).removeClass('vc_empty-column');
            this.$content.removeClass('vc_empty-container');
        }
    });

    window.VcPieChartView = vc.shortcode_view.extend();
    window.VcCounterView = vc.shortcode_view.extend();
    window.VcMessageboxView = vc.shortcode_view.extend();


    window.VcTestimonialsSliderView = vc.shortcode_view.extend({
        new_tab_adding: false,
        events: {
            'click .add_tab': 'addTab',
            'click > .vc_controls .vc_control-btn-delete': 'deleteShortcode',
            'click > .vc_controls .vc_control-btn-edit': 'editElement',
            'click > .vc_controls .vc_control-btn-clone': 'clone'
        },
        initialize: function (params) {
            window.VcTestimonialsSliderView.__super__.initialize.call(this, params);
            _.bindAll(this, 'stopSorting');
        },
        render: function () {
            window.VcTestimonialsSliderView.__super__.render.call(this);
            this.$tabs = this.$el.find('.wpb_tabs_holder');
            this.createAddTabButton();
            return this;
        },
        ready: function (e) {
            window.VcTestimonialsSliderView.__super__.ready.call(this, e);
        },
        createAddTabButton: function () {
            var new_tab_button_id = (+new Date() + '-' + Math.floor(Math.random() * 11));
            this.$tabs.append('<div id="new-tab-' + new_tab_button_id + '" class="new_element_button"></div>');
            this.$add_button = $('<li class="add_tab_block"><a href="#new-tab-' + new_tab_button_id + '" class="add_tab" title="' + window.i18nLocale.add_tab + '"></a></li>').appendTo(this.$tabs.find(".tabs_controls"));
        },
        addTab: function (e) {
            e.preventDefault();
            this.new_tab_adding = true;
            var tab_title = 'Testimonial',
                tabs_count = this.$tabs.find('[data-element_type=ideo_testimonial_item]').length,
                tab_id = (+new Date() + '-' + tabs_count + '-' + Math.floor(Math.random() * 11));
            vc.shortcodes.create({
                shortcode: 'ideo_testimonial_item',
                params: {
                    title: tab_title,
                    tab_id: tab_id
                },
                parent_id: this.model.id
            });
            return false;
        },
        stopSorting: function (event, ui) {
            var shortcode;
            this.$tabs.find('ul.tabs_controls li:not(.add_tab_block)').each(function (index) {
                var href = $(this).find('a').attr('href').replace("#", "");
                // $('#' + href).appendTo(this.$tabs);
                shortcode = vc.shortcodes.get($('[id=' + $(this).attr('aria-controls') + ']').data('model-id'));
                vc.storage.lock();
                shortcode.save({
                    'order': $(this).index()
                }); // Optimize
            });
            shortcode.save();
        },
        changedContent: function (view) {
            var params = view.model.get('params');
            if (!this.$tabs.hasClass('ui-tabs')) {
                this.$tabs.tabs({
                    select: function (event, ui) {
                        if ($(ui.tab).hasClass('add_tab')) {
                            return false;
                        }
                        return true;
                    }
                });
                this.$tabs.find(".ui-tabs-nav").prependTo(this.$tabs);
                this.$tabs.find(".ui-tabs-nav").sortable({
                    axis: (this.$tabs.closest('[data-element_type]').data('element_type') == 'vc_tour' ? 'y' : 'x'),
                    update: this.stopSorting,
                    items: "> li:not(.add_tab_block)"
                });
            }
            if (view.model.get('cloned') === true) {
                var cloned_from = view.model.get('cloned_from'),
                    $tab_controls = $('.tabs_controls > .add_tab_block', this.$content),
                    $new_tab = $("<li><a href='#tab-" + params.tab_id + "'>" + params.title + "</a></li>").insertBefore($tab_controls);
                this.$tabs.tabs('refresh');
                this.$tabs.tabs("option", 'active', $new_tab.index());
            } else {
                $("<li><a href='#tab-" + params.tab_id + "'>" + params.title + "</a></li>")
                    .insertBefore(this.$add_button);
                this.$tabs.tabs('refresh');
                this.$tabs.tabs("option", "active", this.new_tab_adding ? $('.ui-tabs-nav li', this.$content).length - 2 : 0);

            }
            this.new_tab_adding = false;
        },
        cloneModel: function (model, parent_id, save_order) {
            var shortcodes_to_resort = [],
                new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
                model_clone,
                new_params = _.extend({}, model.get('params'));
            if (model.get('shortcode') === 'ideo_testimonial_item') _.extend(new_params, {
                tab_id: +new Date() + '-' + this.$tabs.find('[data-element-type=ideo_testimonial_item]').length + '-' + Math.floor(Math.random() * 11)
            });
            model_clone = Shortcodes.create({
                shortcode: model.get('shortcode'),
                id: vc_guid(),
                parent_id: parent_id,
                order: new_order,
                cloned: (model.get('shortcode') === 'ideo_testimonial_item' ? false : true),
                cloned_from: model.toJSON(),
                params: new_params
            });
            _.each(Shortcodes.where({
                parent_id: model.id
            }), function (shortcode) {
                this.cloneModel(shortcode, model_clone.get('id'), true);
            }, this);

            var params = model_clone.get('params');
            if (model_clone.get('cloned') === false) {
                params.el_uid = params.el_uid || model_clone.id;
            } else {
                params.el_uid = model_clone.id;
            }
            params.el_uid = params.el_uid.replace('-', '');

            model_clone.get({
                'params': params
            });
            model_clone.save();
            return model_clone;
        }
    });

    window.VcTestimonialItemView = window.VcColumnView.extend({
        events: {
            'click > .vc_controls .vc_control-btn-delete': 'deleteShortcode',
            'click > .vc_controls .vc_control-btn-prepend': 'addElement',
            'click > .vc_controls .vc_control-btn-edit': 'editElement',
            'click > .vc_controls .vc_control-btn-clone': 'clone',
            'click > .wpb_element_wrapper > .vc_empty-container': 'addToEmpty'
        },
        render: function () {
            var params = this.model.get('params');
            window.VcTabView.__super__.render.call(this);
            if (!params.tab_id) {
                params.tab_id = (+new Date() + '-' + Math.floor(Math.random() * 11));
                this.model.save('params', params);
            }
            this.id = 'tab-' + params.tab_id;
            this.$el.attr('id', this.id);
            return this;
        },
        ready: function (e) {
            window.VcTabView.__super__.ready.call(this, e);
            this.$tabs = this.$el.closest('.wpb_tabs_holder');
            var params = this.model.get('params');
            return this;
        },
        changeShortcodeParams: function (model) {
            var params = model.get('params');
            window.VcTabView.__super__.changeShortcodeParams.call(this, model);
            if (_.isObject(params) && _.isString(params.title) && _.isString(params.tab_id)) {
                $('.ui-tabs-nav [href="#tab-' + params.tab_id + '"]').text(params.title);
            }
        },
        deleteShortcode: function (e) {
            _.isObject(e) && e.preventDefault();
            var answer = confirm(window.i18nLocale.press_ok_to_delete_section),
                parent_id = this.model.get('parent_id');
            if (answer !== true) return false;
            this.model.destroy();
            if (!vc.shortcodes.where({
                    parent_id: parent_id
                }).length) {
                vc.shortcodes.get(parent_id).destroy();
                return false;
            }
            var params = this.model.get('params'),
                current_tab_index = $('[href="#tab-' + params.tab_id + '"]', this.$tabs).parent().index();
            $('[href="#tab-' + params.tab_id + '"]').parent().remove();
            var tab_length = this.$tabs.find('.ui-tabs-nav li:not(.add_tab_block)').length;
            if (tab_length > 0) {
                this.$tabs.tabs('refresh');
            }
            if (current_tab_index < tab_length) {
                this.$tabs.tabs("option", "active", current_tab_index);
            } else if (tab_length > 0) {
                this.$tabs.tabs("option", "active", tab_length - 1);
            }

        },
        cloneModel: function (model, parent_id, save_order) {
            var shortcodes_to_resort = [],
                new_order = _.isBoolean(save_order) && save_order === true ? model.get('order') : parseFloat(model.get('order')) + vc.clone_index,
                new_params = _.extend({}, model.get('params'));
            if (model.get('shortcode') === 'ideo_testimonial_item') _.extend(new_params, {
                tab_id: +new Date() + '-' + this.$tabs.find('[data-element_type=ideo_testimonial_item]').length + '-' + Math.floor(Math.random() * 11)
            });
            var model_clone = Shortcodes.create({
                shortcode: model.get('shortcode'),
                parent_id: parent_id,
                order: new_order,
                cloned: true,
                cloned_from: model.toJSON(),
                params: new_params
            });
            _.each(Shortcodes.where({
                parent_id: model.id
            }), function (shortcode) {
                this.cloneModel(shortcode, model_clone.id, true);
            }, this);
            return model_clone;
        }
    });


    window.VcSingleImageView = vc.shortcode_view.extend();
    window.VcIconsView = vc.shortcode_view.extend();
    window.VcGoogleMapView = vc.shortcode_view.extend();
    window.VcWowTitleView = vc.shortcode_view.extend();
    // window.VcWowTitleView.prototype.buildDesignHelpers = function () {
    // };
    window.VcCF7View = vc.shortcode_view.extend();
    window.VcPricingTableView = vc.shortcode_view.extend();
    window.VcTeamBoxView = vc.shortcode_view.extend();
    window.VcImageBoxView = vc.shortcode_view.extend();
    window.VcBlogView = vc.shortcode_view.extend();
    window.VcCustomListView = vc.shortcode_view.extend();

})(window.jQuery);