(function ($) {
    'use strict';
    $(function () {
        /* ========================================================================
         * DOM-based Routing
         * Based on http://goo.gl/EUTi53 by Paul Irish
         *
         * Only fires on body classes that match. If a body class contains a dash,
         * replace the dash with an underscore when adding it to the object below.
         *
         * .noConflict()
         * The routing is enclosed within an anonymous function so that you can
         * always reference jQuery with $, even when in .noConflict() mode.
         * ========================================================================
         */
        var Utm_Switcher, Utm_UTIL;
        Utm_Switcher = {
            common: {
                init: function () {
                    var parsedQuery = Utm_UTIL.queryString();
                    
                    //CF7 Hidden input value replacement
                    if (parsedQuery.utm_source || parsedQuery.utm_medium || parsedQuery.utm_campaign) {
                        if (parsedQuery.utm_source) {
                            document.cookie = 'utmfieldsource=' + parsedQuery.utm_source;
                        }
                        if (parsedQuery.utm_medium) {
                            document.cookie = 'utmfieldmedium=' + parsedQuery.utm_medium;
                        }
                        if (parsedQuery.utm_campaign) {
                            document.cookie = 'utmfieldcampaign=' + parsedQuery.utm_campaign;
                        }

                        Utm_UTIL.populateFormValues(parsedQuery);
                    } else if (document.cookie.indexOf("utmfieldsource") >= 0 || document.cookie.indexOf("utmfieldmedium") >= 0 || document.cookie.indexOf("utmfieldcampaign") >= 0) {
                        Utm_UTIL.populateFormValues(parsedQuery);
                    }


                    if (!Utm_UTIL.isArray(utm_switchers)) {
                        return false;
                    }
                    
                    //Value replacement based on utm_source
                    if (('utm_source' in parsedQuery) || ( document.cookie.indexOf("utmfieldsource") >= 0 ) ) {
                        
                       var i,j;
                       for (i = 0; i < utm_switchers.length; ++i) {         
                            var switcher = utm_switchers[i], markup = $(switcher.match_element).html();
                              //Name this loop 
                              switchersSubLoop:
                              for (j = 0; j < switcher.switchers.length; ++j) {
                                
                                if ( (switcher.switchers[j].campaign_source !== parsedQuery.utm_source) && (switcher.switchers[j].campaign_source !== Utm_UTIL.getCookieValue('utmfieldsource')) ) {
                                    continue switchersSubLoop;
                                }
                                if (switcher.switcher_type === 'phone') {
                                    markup = '<a href="tel:' + switcher.switchers[j].replace_value + '" class="phone-number">' + switcher.switchers[j].replace_value + '</a>';
                                    $(switcher.match_element).replaceWith(markup);
                                } else {
                                    markup = switcher.switchers[j].replace_value;
                                    $(switcher.match_element).html(markup);
                                }
                            }
                        }
                    }
                }
            }
        };
        Utm_UTIL = {
            fire: function (func, funcname, args) {
                var namespace;
                namespace = Utm_Switcher;
                funcname = funcname === void 0 ? 'init' : funcname;
                if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                    namespace[func][funcname](args);
                }
            },
            loadEvents: function () {
                Utm_UTIL.fire('common');
                $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                    Utm_UTIL.fire(classnm);
                });
            },
            isArray: function (obj) {
                return (typeof obj !== 'undefined' &&
                        obj && obj.constructor === Array);
            },
            queryString: function(){
                var query_string = {};
                var query = window.location.search.substring(1);
                var vars = query.split("&");
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split("=");
                    // If first entry with this name
                    if (typeof query_string[pair[0]] === "undefined") {
                        query_string[pair[0]] = pair[1];
                        // If second entry with this name
                    } else if (typeof query_string[pair[0]] === "string") {
                        var arr = [query_string[pair[0]], pair[1]];
                        query_string[pair[0]] = arr;
                        // If third or later entry with this name
                    } else {
                        query_string[pair[0]].push(pair[1]);
                    }
                }
                return query_string;  
            },
            getCookieValue: function (a, b) {
                b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
                return b ? b.pop() : '';
            },
            populateFormValues: function (parsedQuery) {
                
                if ((document.cookie.indexOf("utmfieldsource") >= 0 || parsedQuery.utm_source) && document.getElementsByClassName("utm-field-source")[0]) {
                    Utm_UTIL.applyFormValues(document.getElementsByClassName("utm-field-source"), Utm_UTIL.getCookieValue('utmfieldsource'));
                }
                if ((document.cookie.indexOf("utmfieldmedium") >= 0 || parsedQuery.utm_medium) && document.getElementsByClassName("utm-field-medium")[0]) {
                    Utm_UTIL.applyFormValues(document.getElementsByClassName("utm-field-medium"), Utm_UTIL.getCookieValue('utmfieldmedium'));

                }
                if ((document.cookie.indexOf("utmfieldcampaign") >= 0 || parsedQuery.utm_campaign) && document.getElementsByClassName("utm-field-campaign")[0]) {
                    Utm_UTIL.applyFormValues(document.getElementsByClassName("utm-field-campaign"), Utm_UTIL.getCookieValue('utmfieldcampaign'));
                }
            },
            applyFormValues : function(elements, value){
                elements = elements || {};
                for (var i = 0; i < elements.length; i++) {
                    elements[i].value = value;
                }
            }
        };
        $(document).ready(Utm_UTIL.loadEvents);
    });
})(jQuery);
