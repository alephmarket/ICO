<?php

function ideothemo_uniqid_param_settings_field($settings, $value)
{
    $dependency = '';
    if (!$value) $value = 'page-section-' . ideothemo_shortcode_uid();
    return '<div class="ideo_param_block">' . '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="text" value="' . $value . '" ' . $dependency . ' readonly/>' . '</div>';
}

vc_add_shortcode_param('uniqid_param', 'ideothemo_uniqid_param_settings_field');

function ideothemo_choose_icon_settings_field($settings, $value)
{
    $icon_class = array(
        'fa fa-glass',
        'fa fa-music',
        'fa fa-search',
        'fa fa-envelope-o',
        'fa fa-heart',
        'fa fa-star',
        'fa fa-star-o',
        'fa fa-user',
        'fa fa-film',
        'fa fa-th-large',
        'fa fa-th',
        'fa fa-th-list',
        'fa fa-check',
        'fa fa-remove',
        'fa fa-close',
        'fa fa-times',
        'fa fa-search-plus',
        'fa fa-search-minus',
        'fa fa-power-off',
        'fa fa-signal',
        'fa fa-gear',
        'fa fa-cog',
        'fa fa-trash-o',
        'fa fa-home',
        'fa fa-file-o',
        'fa fa-clock-o',
        'fa fa-road',
        'fa fa-download',
        'fa fa-arrow-circle-o-down',
        'fa fa-arrow-circle-o-up',
        'fa fa-inbox',
        'fa fa-play-circle-o',
        'fa fa-rotate-right',
        'fa fa-repeat',
        'fa fa-refresh',
        'fa fa-list-alt',
        'fa fa-lock',
        'fa fa-flag',
        'fa fa-headphones',
        'fa fa-volume-off',
        'fa fa-volume-down',
        'fa fa-volume-up',
        'fa fa-qrcode',
        'fa fa-barcode',
        'fa fa-tag',
        'fa fa-tags',
        'fa fa-book',
        'fa fa-bookmark',
        'fa fa-print',
        'fa fa-camera',
        'fa fa-font',
        'fa fa-bold',
        'fa fa-italic',
        'fa fa-text-height',
        'fa fa-text-width',
        'fa fa-align-left',
        'fa fa-align-center',
        'fa fa-align-right',
        'fa fa-align-justify',
        'fa fa-list',
        'fa fa-dedent',
        'fa fa-outdent',
        'fa fa-indent',
        'fa fa-video-camera',
        'fa fa-photo',
        'fa fa-image',
        'fa fa-picture-o',
        'fa fa-pencil',
        'fa fa-map-marker',
        'fa fa-adjust',
        'fa fa-tint',
        'fa fa-edit',
        'fa fa-pencil-square-o',
        'fa fa-share-square-o',
        'fa fa-check-square-o',
        'fa fa-arrows',
        'fa fa-step-backward',
        'fa fa-fast-backward',
        'fa fa-backward',
        'fa fa-play',
        'fa fa-pause',
        'fa fa-stop',
        'fa fa-forward',
        'fa fa-fast-forward',
        'fa fa-step-forward',
        'fa fa-eject',
        'fa fa-chevron-left',
        'fa fa-chevron-right',
        'fa fa-plus-circle',
        'fa fa-minus-circle',
        'fa fa-times-circle',
        'fa fa-check-circle',
        'fa fa-question-circle',
        'fa fa-info-circle',
        'fa fa-crosshairs',
        'fa fa-times-circle-o',
        'fa fa-check-circle-o',
        'fa fa-ban',
        'fa fa-arrow-left',
        'fa fa-arrow-right',
        'fa fa-arrow-up',
        'fa fa-arrow-down',
        'fa fa-mail-forward',
        'fa fa-share',
        'fa fa-expand',
        'fa fa-compress',
        'fa fa-plus',
        'fa fa-minus',
        'fa fa-asterisk',
        'fa fa-exclamation-circle',
        'fa fa-gift',
        'fa fa-leaf',
        'fa fa-fire',
        'fa fa-eye',
        'fa fa-eye-slash',
        'fa fa-warning',
        'fa fa-exclamation-triangle',
        'fa fa-plane',
        'fa fa-calendar',
        'fa fa-random',
        'fa fa-comment',
        'fa fa-magnet',
        'fa fa-chevron-up',
        'fa fa-chevron-down',
        'fa fa-retweet',
        'fa fa-shopping-cart',
        'fa fa-folder',
        'fa fa-folder-open',
        'fa fa-arrows-v',
        'fa fa-arrows-h',
        'fa fa-bar-chart-o',
        'fa fa-bar-chart',
        'fa fa-twitter-square',
        'fa fa-facebook-square',
        'fa fa-camera-retro',
        'fa fa-key',
        'fa fa-gears',
        'fa fa-cogs',
        'fa fa-comments',
        'fa fa-thumbs-o-up',
        'fa fa-thumbs-o-down',
        'fa fa-star-half',
        'fa fa-heart-o',
        'fa fa-sign-out',
        'fa fa-linkedin-square',
        'fa fa-thumb-tack',
        'fa fa-external-link',
        'fa fa-sign-in',
        'fa fa-trophy',
        'fa fa-github-square',
        'fa fa-upload',
        'fa fa-lemon-o',
        'fa fa-phone',
        'fa fa-square-o',
        'fa fa-bookmark-o',
        'fa fa-phone-square',
        'fa fa-twitter',
        'fa fa-facebook-f',
        'fa fa-facebook',
        'fa fa-github',
        'fa fa-unlock',
        'fa fa-credit-card',
        'fa fa-rss',
        'fa fa-hdd-o',
        'fa fa-bullhorn',
        'fa fa-bell',
        'fa fa-certificate',
        'fa fa-hand-o-right',
        'fa fa-hand-o-left',
        'fa fa-hand-o-up',
        'fa fa-hand-o-down',
        'fa fa-arrow-circle-left',
        'fa fa-arrow-circle-right',
        'fa fa-arrow-circle-up',
        'fa fa-arrow-circle-down',
        'fa fa-globe',
        'fa fa-wrench',
        'fa fa-tasks',
        'fa fa-filter',
        'fa fa-briefcase',
        'fa fa-arrows-alt',
        'fa fa-group',
        'fa fa-users',
        'fa fa-chain',
        'fa fa-link',
        'fa fa-cloud',
        'fa fa-flask',
        'fa fa-cut',
        'fa fa-scissors',
        'fa fa-copy',
        'fa fa-files-o',
        'fa fa-paperclip',
        'fa fa-save',
        'fa fa-floppy-o',
        'fa fa-square',
        'fa fa-navicon',
        'fa fa-reorder',
        'fa fa-bars',
        'fa fa-list-ul',
        'fa fa-list-ol',
        'fa fa-strikethrough',
        'fa fa-underline',
        'fa fa-table',
        'fa fa-magic',
        'fa fa-truck',
        'fa fa-pinterest',
        'fa fa-pinterest-square',
        'fa fa-google-plus-square',
        'fa fa-google-plus',
        'fa fa-money',
        'fa fa-caret-down',
        'fa fa-caret-up',
        'fa fa-caret-left',
        'fa fa-caret-right',
        'fa fa-columns',
        'fa fa-unsorted',
        'fa fa-sort',
        'fa fa-sort-down',
        'fa fa-sort-desc',
        'fa fa-sort-up',
        'fa fa-sort-asc',
        'fa fa-envelope',
        'fa fa-linkedin',
        'fa fa-rotate-left',
        'fa fa-undo',
        'fa fa-legal',
        'fa fa-gavel',
        'fa fa-dashboard',
        'fa fa-tachometer',
        'fa fa-comment-o',
        'fa fa-comments-o',
        'fa fa-flash',
        'fa fa-bolt',
        'fa fa-sitemap',
        'fa fa-umbrella',
        'fa fa-paste',
        'fa fa-clipboard',
        'fa fa-lightbulb-o',
        'fa fa-exchange',
        'fa fa-cloud-download',
        'fa fa-cloud-upload',
        'fa fa-user-md',
        'fa fa-stethoscope',
        'fa fa-suitcase',
        'fa fa-bell-o',
        'fa fa-coffee',
        'fa fa-cutlery',
        'fa fa-file-text-o',
        'fa fa-building-o',
        'fa fa-hospital-o',
        'fa fa-ambulance',
        'fa fa-medkit',
        'fa fa-fighter-jet',
        'fa fa-beer',
        'fa fa-h-square',
        'fa fa-plus-square',
        'fa fa-angle-double-left',
        'fa fa-angle-double-right',
        'fa fa-angle-double-up',
        'fa fa-angle-double-down',
        'fa fa-angle-left',
        'fa fa-angle-right',
        'fa fa-angle-up',
        'fa fa-angle-down',
        'fa fa-desktop',
        'fa fa-laptop',
        'fa fa-tablet',
        'fa fa-mobile-phone',
        'fa fa-mobile',
        'fa fa-circle-o',
        'fa fa-quote-left',
        'fa fa-quote-right',
        'fa fa-spinner',
        'fa fa-circle',
        'fa fa-mail-reply',
        'fa fa-reply',
        'fa fa-github-alt',
        'fa fa-folder-o',
        'fa fa-folder-open-o',
        'fa fa-smile-o',
        'fa fa-frown-o',
        'fa fa-meh-o',
        'fa fa-gamepad',
        'fa fa-keyboard-o',
        'fa fa-flag-o',
        'fa fa-flag-checkered',
        'fa fa-terminal',
        'fa fa-code',
        'fa fa-mail-reply-all',
        'fa fa-reply-all',
        'fa fa-star-half-empty',
        'fa fa-star-half-full',
        'fa fa-star-half-o',
        'fa fa-location-arrow',
        'fa fa-crop',
        'fa fa-code-fork',
        'fa fa-unlink',
        'fa fa-chain-broken',
        'fa fa-question',
        'fa fa-info',
        'fa fa-exclamation',
        'fa fa-superscript',
        'fa fa-subscript',
        'fa fa-eraser',
        'fa fa-puzzle-piece',
        'fa fa-microphone',
        'fa fa-microphone-slash',
        'fa fa-shield',
        'fa fa-calendar-o',
        'fa fa-fire-extinguisher',
        'fa fa-rocket',
        'fa fa-maxcdn',
        'fa fa-chevron-circle-left',
        'fa fa-chevron-circle-right',
        'fa fa-chevron-circle-up',
        'fa fa-chevron-circle-down',
        'fa fa-html5',
        'fa fa-css3',
        'fa fa-anchor',
        'fa fa-unlock-alt',
        'fa fa-bullseye',
        'fa fa-ellipsis-h',
        'fa fa-ellipsis-v',
        'fa fa-rss-square',
        'fa fa-play-circle',
        'fa fa-ticket',
        'fa fa-minus-square',
        'fa fa-minus-square-o',
        'fa fa-level-up',
        'fa fa-level-down',
        'fa fa-check-square',
        'fa fa-pencil-square',
        'fa fa-external-link-square',
        'fa fa-share-square',
        'fa fa-compass',
        'fa fa-toggle-down',
        'fa fa-caret-square-o-down',
        'fa fa-toggle-up',
        'fa fa-caret-square-o-up',
        'fa fa-toggle-right',
        'fa fa-caret-square-o-right',
        'fa fa-euro',
        'fa fa-eur',
        'fa fa-gbp',
        'fa fa-dollar',
        'fa fa-usd',
        'fa fa-rupee',
        'fa fa-inr',
        'fa fa-cny',
        'fa fa-rmb',
        'fa fa-yen',
        'fa fa-jpy',
        'fa fa-ruble',
        'fa fa-rouble',
        'fa fa-rub',
        'fa fa-won',
        'fa fa-krw',
        'fa fa-bitcoin',
        'fa fa-btc',
        'fa fa-file',
        'fa fa-file-text',
        'fa fa-sort-alpha-asc',
        'fa fa-sort-alpha-desc',
        'fa fa-sort-amount-asc',
        'fa fa-sort-amount-desc',
        'fa fa-sort-numeric-asc',
        'fa fa-sort-numeric-desc',
        'fa fa-thumbs-up',
        'fa fa-thumbs-down',
        'fa fa-youtube-square',
        'fa fa-youtube',
        'fa fa-xing',
        'fa fa-xing-square',
        'fa fa-youtube-play',
        'fa fa-dropbox',
        'fa fa-stack-overflow',
        'fa fa-instagram',
        'fa fa-flickr',
        'fa fa-adn',
        'fa fa-bitbucket',
        'fa fa-bitbucket-square',
        'fa fa-tumblr',
        'fa fa-tumblr-square',
        'fa fa-long-arrow-down',
        'fa fa-long-arrow-up',
        'fa fa-long-arrow-left',
        'fa fa-long-arrow-right',
        'fa fa-apple',
        'fa fa-windows',
        'fa fa-android',
        'fa fa-linux',
        'fa fa-dribbble',
        'fa fa-skype',
        'fa fa-foursquare',
        'fa fa-trello',
        'fa fa-female',
        'fa fa-male',
        'fa fa-gittip',
        'fa fa-gratipay',
        'fa fa-sun-o',
        'fa fa-moon-o',
        'fa fa-archive',
        'fa fa-bug',
        'fa fa-vk',
        'fa fa-weibo',
        'fa fa-renren',
        'fa fa-pagelines',
        'fa fa-stack-exchange',
        'fa fa-arrow-circle-o-right',
        'fa fa-arrow-circle-o-left',
        'fa fa-toggle-left',
        'fa fa-caret-square-o-left',
        'fa fa-dot-circle-o',
        'fa fa-wheelchair',
        'fa fa-vimeo-square',
        'fa fa-turkish-lira',
        'fa fa-try',
        'fa fa-plus-square-o',
        'fa fa-space-shuttle',
        'fa fa-slack',
        'fa fa-envelope-square',
        'fa fa-wordpress',
        'fa fa-openid',
        'fa fa-institution',
        'fa fa-bank',
        'fa fa-university',
        'fa fa-mortar-board',
        'fa fa-graduation-cap',
        'fa fa-yahoo',
        'fa fa-google',
        'fa fa-reddit',
        'fa fa-reddit-square',
        'fa fa-stumbleupon-circle',
        'fa fa-stumbleupon',
        'fa fa-delicious',
        'fa fa-digg',
        'fa fa-pied-piper',
        'fa fa-pied-piper-alt',
        'fa fa-drupal',
        'fa fa-joomla',
        'fa fa-language',
        'fa fa-fax',
        'fa fa-building',
        'fa fa-child',
        'fa fa-paw',
        'fa fa-spoon',
        'fa fa-cube',
        'fa fa-cubes',
        'fa fa-behance',
        'fa fa-behance-square',
        'fa fa-steam',
        'fa fa-steam-square',
        'fa fa-recycle',
        'fa fa-automobile',
        'fa fa-car',
        'fa fa-cab',
        'fa fa-taxi',
        'fa fa-tree',
        'fa fa-spotify',
        'fa fa-deviantart',
        'fa fa-soundcloud',
        'fa fa-database',
        'fa fa-file-pdf-o',
        'fa fa-file-word-o',
        'fa fa-file-excel-o',
        'fa fa-file-powerpoint-o',
        'fa fa-file-photo-o',
        'fa fa-file-picture-o',
        'fa fa-file-image-o',
        'fa fa-file-zip-o',
        'fa fa-file-archive-o',
        'fa fa-file-sound-o',
        'fa fa-file-audio-o',
        'fa fa-file-movie-o',
        'fa fa-file-video-o',
        'fa fa-file-code-o',
        'fa fa-vine',
        'fa fa-codepen',
        'fa fa-jsfiddle',
        'fa fa-life-bouy',
        'fa fa-life-buoy',
        'fa fa-life-saver',
        'fa fa-support',
        'fa fa-life-ring',
        'fa fa-circle-o-notch',
        'fa fa-ra',
        'fa fa-rebel',
        'fa fa-ge',
        'fa fa-empire',
        'fa fa-git-square',
        'fa fa-git',
        'fa fa-hacker-news',
        'fa fa-tencent-weibo',
        'fa fa-qq',
        'fa fa-wechat',
        'fa fa-weixin',
        'fa fa-send',
        'fa fa-paper-plane',
        'fa fa-send-o',
        'fa fa-paper-plane-o',
        'fa fa-history',
        'fa fa-genderless',
        'fa fa-circle-thin',
        'fa fa-header',
        'fa fa-paragraph',
        'fa fa-sliders',
        'fa fa-share-alt',
        'fa fa-share-alt-square',
        'fa fa-bomb',
        'fa fa-soccer-ball-o',
        'fa fa-futbol-o',
        'fa fa-tty',
        'fa fa-binoculars',
        'fa fa-plug',
        'fa fa-slideshare',
        'fa fa-twitch',
        'fa fa-yelp',
        'fa fa-newspaper-o',
        'fa fa-wifi',
        'fa fa-calculator',
        'fa fa-paypal',
        'fa fa-google-wallet',
        'fa fa-cc-visa',
        'fa fa-cc-mastercard',
        'fa fa-cc-discover',
        'fa fa-cc-amex',
        'fa fa-cc-paypal',
        'fa fa-cc-stripe',
        'fa fa-bell-slash',
        'fa fa-bell-slash-o',
        'fa fa-trash',
        'fa fa-copyright',
        'fa fa-at',
        'fa fa-eyedropper',
        'fa fa-paint-brush',
        'fa fa-birthday-cake',
        'fa fa-area-chart',
        'fa fa-pie-chart',
        'fa fa-line-chart',
        'fa fa-lastfm',
        'fa fa-lastfm-square',
        'fa fa-toggle-off',
        'fa fa-toggle-on',
        'fa fa-bicycle',
        'fa fa-bus',
        'fa fa-ioxhost',
        'fa fa-angellist',
        'fa fa-cc',
        'fa fa-shekel',
        'fa fa-sheqel',
        'fa fa-ils',
        'fa fa-meanpath',
        'fa fa-buysellads',
        'fa fa-connectdevelop',
        'fa fa-dashcube',
        'fa fa-forumbee',
        'fa fa-leanpub',
        'fa fa-sellsy',
        'fa fa-shirtsinbulk',
        'fa fa-simplybuilt',
        'fa fa-skyatlas',
        'fa fa-cart-plus',
        'fa fa-cart-arrow-down',
        'fa fa-diamond',
        'fa fa-ship',
        'fa fa-user-secret',
        'fa fa-motorcycle',
        'fa fa-street-view',
        'fa fa-heartbeat',
        'fa fa-venus',
        'fa fa-mars',
        'fa fa-mercury',
        'fa fa-transgender',
        'fa fa-transgender-alt',
        'fa fa-venus-double',
        'fa fa-mars-double',
        'fa fa-venus-mars',
        'fa fa-mars-stroke',
        'fa fa-mars-stroke-v',
        'fa fa-mars-stroke-h',
        'fa fa-neuter',
        'fa fa-facebook-official',
        'fa fa-pinterest-p',
        'fa fa-whatsapp',
        'fa fa-server',
        'fa fa-user-plus',
        'fa fa-user-times',
        'fa fa-hotel',
        'fa fa-bed',
        'fa fa-viacoin',
        'fa fa-train',
        'fa fa-subway',
        'fa fa-medium',
        'id id-Alerts_1',
        'id id-Alerts_2',
        'id id-Alerts_3',
        'id id-Alerts_4',
        'id id-Arrows_01',
        'id id-Arrows_02',
        'id id-Arrows_03',
        'id id-Arrows_04',
        'id id-Arrows_05',
        'id id-Arrows_06',
        'id id-Arrows_07',
        'id id-Arrows_08',
        'id id-Arrows_09',
        'id id-Arrows_10',
        'id id-Arrows_11',
        'id id-Arrows_12',
        'id id-Arrows_13',
        'id id-Arrows_14',
        'id id-Arrows_15',
        'id id-Arrows_16',
        'id id-Arrows_17',
        'id id-Arrows_18',
        'id id-Arrows_19',
        'id id-Arrows_20',
        'id id-Arrows_21',
        'id id-Arrows_22',
        'id id-Arrows_23',
        'id id-Arrows_24',
        'id id-Arrows_25',
        'id id-Arrows_26',
        'id id-Arrows_27',
        'id id-Arrows_28',
        'id id-Arrows_29',
        'id id-Arrows_30',
        'id id-Arrows_31',
        'id id-Arrows_32',
        'id id-Arrows_33',
        'id id-Arrows_34',
        'id id-Arrows_35',
        'id id-Arrows_36',
        'id id-Arrows_37',
        'id id-Arrows_38',
        'id id-Arrows_39',
        'id id-Arrows_40',
        'id id-Arrows_41',
        'id id-Arrows_42',
        'id id-Arrows_43',
        'id id-Arrows_44',
        'id id-Arrows_45',
        'id id-Arrows_46',
        'id id-Arrows_47',
        'id id-Arrows_48',
        'id id-Arrows_49',
        'id id-Arrows_50',
        'id id-Arrows_51',
        'id id-Arrows_52',
        'id id-Arrows_53',
        'id id-Arrows_54',
        'id id-Audio_01',
        'id id-Audio_02',
        'id id-Audio_03',
        'id id-Audio_04',
        'id id-Audio_05',
        'id id-Audio_06',
        'id id-Audio_07',
        'id id-Audio_08',
        'id id-Audio_09',
        'id id-Audio_10',
        'id id-Audio_11',
        'id id-Audio_12',
        'id id-Audio_13',
        'id id-Audio_14',
        'id id-Audio_15',
        'id id-Audio_16',
        'id id-Audio_17',
        'id id-Audio_18',
        'id id-Audio_19',
        'id id-Audio_20',
        'id id-Audio_21',
        'id id-Audio_22',
        'id id-Audio_23',
        'id id-Audio_24',
        'id id-Audio_25',
        'id id-Bookmark_1',
        'id id-Bookmark_2',
        'id id-Bookmark_3',
        'id id-Bookmark_4',
        'id id-Business_01',
        'id id-Business_02',
        'id id-Business_03',
        'id id-Business_04',
        'id id-Business_05',
        'id id-Business_06',
        'id id-Business_07',
        'id id-Business_08',
        'id id-Business_09',
        'id id-Business_10',
        'id id-Business_11',
        'id id-Business_12',
        'id id-Business_13',
        'id id-Business_14',
        'id id-Business_15',
        'id id-Business_16',
        'id id-Business_17',
        'id id-Business_18',
        'id id-Business_19',
        'id id-Business_20',
        'id id-categories',
        'id id-Clothes_01',
        'id id-Clothes_02',
        'id id-Clothes_03',
        'id id-Clothes_04',
        'id id-Clothes_05',
        'id id-Clothes_06',
        'id id-Clothes_07',
        'id id-Clothes_08',
        'id id-Clothes_09',
        'id id-Clothes_10',
        'id id-Clothes_11',
        'id id-Clothes_12',
        'id id-Clothes_13',
        'id id-Clothes_14',
        'id id-Clothes_15',
        'id id-Clothes_16',
        'id id-cursors_01',
        'id id-cursors_02',
        'id id-cursors_03',
        'id id-cursors_04',
        'id id-cursors_05',
        'id id-cursors_06',
        'id id-cursors_07',
        'id id-cursors_08',
        'id id-cursors_09',
        'id id-Design_01',
        'id id-Design_02',
        'id id-Design_03',
        'id id-Design_04',
        'id id-Design_05',
        'id id-Design_06',
        'id id-down',
        'id id-Edition_01',
        'id id-Edition_02',
        'id id-Edition_03',
        'id id-Edition_04',
        'id id-Edition_05',
        'id id-Edition_06',
        'id id-Edition_07',
        'id id-Edition_08',
        'id id-Edition_09',
        'id id-Edition_10',
        'id id-Edition_11',
        'id id-Edition_12',
        'id id-email_01',
        'id id-email_02',
        'id id-email_03',
        'id id-email_04',
        'id id-email_05',
        'id id-email_06',
        'id id-email_07',
        'id id-email_08',
        'id id-email_09',
        'id id-email_10',
        'id id-email_11',
        'id id-email_12',
        'id id-email_13',
        'id id-email_14',
        'id id-email_15',
        'id id-email_16',
        'id id-email_17',
        'id id-email_18',
        'id id-email_19',
        'id id-email_20',
        'id id-email_21',
        'id id-email_22',
        'id id-email_23',
        'id id-email_24',
        'id id-email_25',
        'id id-email_26',
        'id id-files_01',
        'id id-files_02',
        'id id-files_03',
        'id id-files_04',
        'id id-files_05',
        'id id-files_06',
        'id id-files_07',
        'id id-files_08',
        'id id-files_09',
        'id id-files_10',
        'id id-files_11',
        'id id-files_12',
        'id id-files_13',
        'id id-files_14',
        'id id-files_15',
        'id id-files_16',
        'id id-files_17',
        'id id-files_18',
        'id id-files_19',
        'id id-files_20',
        'id id-files_21',
        'id id-files_22',
        'id id-files_23',
        'id id-folders_01',
        'id id-folders_02',
        'id id-folders_03',
        'id id-folders_04',
        'id id-folders_05',
        'id id-folders_06',
        'id id-folders_07',
        'id id-folders_08',
        'id id-folders_09',
        'id id-folders_10',
        'id id-food_01',
        'id id-food_02',
        'id id-food_03',
        'id id-food_04',
        'id id-food_05',
        'id id-food_06',
        'id id-food_07',
        'id id-food_08',
        'id id-food_09',
        'id id-food_10',
        'id id-food_11',
        'id id-food_12',
        'id id-food_13',
        'id id-food_14',
        'id id-food_15',
        'id id-food_16',
        'id id-food_17',
        'id id-food_18',
        'id id-food_19',
        'id id-food_20',
        'id id-food_21',
        'id id-food_22',
        'id id-food_23',
        'id id-food_24',
        'id id-food_25',
        'id id-food_26',
        'id id-food_27',
        'id id-food_28',
        'id id-food_29',
        'id id-formats_01',
        'id id-formats_02',
        'id id-formats_03',
        'id id-formats_04',
        'id id-formats_05',
        'id id-formats_06',
        'id id-formats_07',
        'id id-formats_08',
        'id id-formats_09',
        'id id-formats_10',
        'id id-formats_11',
        'id id-formats_12',
        'id id-formats_13',
        'id id-formats_14',
        'id id-formats_15',
        'id id-formats_16',
        'id id-formats_17',
        'id id-formats_18',
        'id id-formats_19',
        'id id-formats_20',
        'id id-gestures_01',
        'id id-gestures_02',
        'id id-gestures_03',
        'id id-gestures_04',
        'id id-gestures_05',
        'id id-gestures_06',
        'id id-gestures_07',
        'id id-gestures_08',
        'id id-gestures_09',
        'id id-gestures_10',
        'id id-gestures_11',
        'id id-gestures_12',
        'id id-gestures_13',
        'id id-gestures_14',
        'id id-gestures_15',
        'id id-gestures_16',
        'id id-gestures_17',
        'id id-gestures_18',
        'id id-gestures_19',
        'id id-gestures_20',
        'id id-gestures_21',
        'id id-gestures_22',
        'id id-gestures_23',
        'id id-gestures_24',
        'id id-gestures_25',
        'id id-gestures_26',
        'id id-gestures_27',
        'id id-gestures_28',
        'id id-gestures_29',
        'id id-gestures_30',
        'id id-gestures_31',
        'id id-gestures_32',
        'id id-gestures_33',
        'id id-gestures_34',
        'id id-Hardware_01',
        'id id-Hardware_02',
        'id id-Hardware_03',
        'id id-Hardware_04',
        'id id-Hardware_05',
        'id id-Hardware_06',
        'id id-Hardware_07',
        'id id-Hardware_08',
        'id id-Hardware_09',
        'id id-Hardware_10',
        'id id-Hardware_11',
        'id id-Hardware_12',
        'id id-Hardware_13',
        'id id-Hardware_14',
        'id id-Hardware_15',
        'id id-Hardware_16',
        'id id-hierarchy_01',
        'id id-hierarchy_02',
        'id id-hierarchy_03',
        'id id-hierarchy_04',
        'id id-hierarchy_05',
        'id id-hierarchy_06',
        'id id-hierarchy_07',
        'id id-hierarchy_08',
        'id id-hierarchy_09',
        'id id-hierarchy_10',
        'id id-Home-category',
        'id id-interface_01',
        'id id-interface_02',
        'id id-interface_03',
        'id id-interface_04',
        'id id-interface_05',
        'id id-interface_06',
        'id id-interface_07',
        'id id-interface_08',
        'id id-interface_09',
        'id id-interface_10',
        'id id-interface_11',
        'id id-interface_12',
        'id id-interface_13',
        'id id-interface_14',
        'id id-interface_15',
        'id id-interface_16',
        'id id-interface_17',
        'id id-interface_18',
        'id id-interface_19',
        'id id-interface_20',
        'id id-interface_21',
        'id id-interface_22',
        'id id-interface_23',
        'id id-interface_24',
        'id id-interface_25',
        'id id-interface_26',
        'id id-interface_27',
        'id id-interface_28',
        'id id-interface_29',
        'id id-interface_30',
        'id id-interface_31',
        'id id-interface_32',
        'id id-interface_33',
        'id id-interface_34',
        'id id-interface_35',
        'id id-interface_36',
        'id id-left',
        'id id-leisure_01',
        'id id-leisure_02',
        'id id-leisure_03',
        'id id-leisure_04',
        'id id-leisure_05',
        'id id-leisure_06',
        'id id-leisure_07',
        'id id-leisure_08',
        'id id-leisure_09',
        'id id-leisure_10',
        'id id-leisure_11',
        'id id-leisure_12',
        'id id-leisure_13',
        'id id-leisure_14',
        'id id-leisure_15',
        'id id-leisure_16',
        'id id-leisure_17',
        'id id-leisure_18',
        'id id-leisure_19',
        'id id-leisure_20',
        'id id-leisure_21',
        'id id-leisure_22',
        'id id-leisure_23',
        'id id-leisure_24',
        'id id-location_01',
        'id id-location_02',
        'id id-location_03',
        'id id-location_04',
        'id id-location_05',
        'id id-location_06',
        'id id-location_07',
        'id id-location_08',
        'id id-location_09',
        'id id-location_10',
        'id id-location_11',
        'id id-location_12',
        'id id-location_13',
        'id id-medical_01',
        'id id-medical_02',
        'id id-medical_03',
        'id id-medical_04',
        'id id-medical_05',
        'id id-medical_06',
        'id id-medical_07',
        'id id-medical_08',
        'id id-medical_09',
        'id id-medical_10',
        'id id-medical_11',
        'id id-medical_12',
        'id id-medical_13',
        'id id-medical_14',
        'id id-medical_15',
        'id id-medical_16',
        'id id-medical_17',
        'id id-medical_18',
        'id id-medical_19',
        'id id-medical_20',
        'id id-medical_21',
        'id id-medical_22',
        'id id-medical_23',
        'id id-medical_24',
        'id id-medical_25',
        'id id-medical_26',
        'id id-medical_27',
        'id id-nature_01',
        'id id-nature_02',
        'id id-nature_03',
        'id id-nature_04',
        'id id-nature_05',
        'id id-nature_06',
        'id id-nature_07',
        'id id-nature_08',
        'id id-nature_09',
        'id id-nature_10',
        'id id-nature_11',
        'id id-nature_12',
        'id id-nature_13',
        'id id-nature_14',
        'id id-nature_15',
        'id id-nature_16',
        'id id-nature_17',
        'id id-nature_18',
        'id id-nature_19',
        'id id-nature_20',
        'id id-nature_21',
        'id id-nature_22',
        'id id-network_01',
        'id id-network_02',
        'id id-network_03',
        'id id-network_04',
        'id id-network_05',
        'id id-network_06',
        'id id-network_07',
        'id id-network_08',
        'id id-network_09',
        'id id-network_10',
        'id id-network_11',
        'id id-network_12',
        'id id-number_eight',
        'id id-number_five',
        'id id-number_four',
        'id id-number_nine',
        'id id-number_one',
        'id id-number_seven',
        'id id-number_six',
        'id id-number_three',
        'id id-number_two',
        'id id-number_zero',
        'id id-phone_01',
        'id id-phone_02',
        'id id-phone_03',
        'id id-phone_04',
        'id id-phone_05',
        'id id-phone_06',
        'id id-phone_07',
        'id id-phone_08',
        'id id-phone_09',
        'id id-phone_10',
        'id id-phone_11',
        'id id-phone_12',
        'id id-phone_13',
        'id id-phone_14',
        'id id-phone_15',
        'id id-phone_16',
        'id id-phone_17',
        'id id-phone_18',
        'id id-phone_19',
        'id id-photo_01',
        'id id-photo_02',
        'id id-photo_03',
        'id id-photo_04',
        'id id-photo_05',
        'id id-photo_06',
        'id id-photo_07',
        'id id-photo_08',
        'id id-photo_09',
        'id id-photo_10',
        'id id-photo_11',
        'id id-photo_12',
        'id id-photo_13',
        'id id-photo_14',
        'id id-photo_15',
        'id id-photo_16',
        'id id-places_01',
        'id id-places_02',
        'id id-places_03',
        'id id-places_04',
        'id id-places_05',
        'id id-places_06',
        'id id-places_07',
        'id id-right',
        'id id-server_01',
        'id id-server_02',
        'id id-server_03',
        'id id-settings_01',
        'id id-settings_02',
        'id id-settings_03',
        'id id-settings_04',
        'id id-settings_05',
        'id id-settings_06',
        'id id-settings_07',
        'id id-settings_08',
        'id id-settings_09',
        'id id-settings_10',
        'id id-shopping_01',
        'id id-shopping_02',
        'id id-shopping_03',
        'id id-shopping_04',
        'id id-shopping_05',
        'id id-shopping_06',
        'id id-shopping_07',
        'id id-shopping_08',
        'id id-shopping_09',
        'id id-shopping_10',
        'id id-shopping_11',
        'id id-shopping_12',
        'id id-shopping_13',
        'id id-shopping_14',
        'id id-shopping_15',
        'id id-shopping_16',
        'id id-shopping_17',
        'id id-shopping_18',
        'id id-shopping_19',
        'id id-shopping_20',
        'id id-shopping_21',
        'id id-shopping_22',
        'id id-shopping_23',
        'id id-shopping_24',
        'id id-shopping_25',
        'id id-shopping_26',
        'id id-shopping_27',
        'id id-shopping_28',
        'id id-shopping_29',
        'id id-shopping_30',
        'id id-shopping_31',
        'id id-shopping_32',
        'id id-shopping_33',
        'id id-time_01',
        'id id-time_02',
        'id id-time_03',
        'id id-time_04',
        'id id-time_05',
        'id id-time_06',
        'id id-time_07',
        'id id-time_08',
        'id id-time_09',
        'id id-time_10',
        'id id-time_11',
        'id id-time_12',
        'id id-time_13',
        'id id-time_14',
        'id id-time_15',
        'id id-time_16',
        'id id-time_17',
        'id id-time_18',
        'id id-time_19',
        'id id-time_20',
        'id id-transfers_01',
        'id id-transfers_02',
        'id id-transfers_03',
        'id id-transfers_04',
        'id id-transfers_05',
        'id id-transfers_06',
        'id id-transfers_07',
        'id id-transfers_08',
        'id id-transfers_09',
        'id id-transfers_10',
        'id id-transfers_11',
        'id id-transfers_12',
        'id id-transfers_13',
        'id id-transfers_14',
        'id id-transfers_15',
        'id id-transfers_16',
        'id id-transfers_17',
        'id id-transfers_18',
        'id id-transfers_19',
        'id id-transfers_20',
        'id id-transfers_21',
        'id id-transfers_22',
        'id id-transfers_23',
        'id id-transfers_24',
        'id id-transportation_01',
        'id id-transportation_02',
        'id id-transportation_03',
        'id id-transportation_04',
        'id id-transportation_05',
        'id id-transportation_06',
        'id id-transportation_07',
        'id id-transportation_08',
        'id id-transportation_09',
        'id id-transportation_10',
        'id id-transportation_11',
        'id id-transportation_12',
        'id id-transportation_13',
        'id id-transportation_14',
        'id id-transportation_15',
        'id id-transportation_16',
        'id id-transportation_17',
        'id id-transportation_18',
        'id id-up',
        'id id-users_01',
        'id id-users_02',
        'id id-users_03',
        'id id-users_04',
        'id id-users_05',
        'id id-users_06',
        'id id-users_07',
        'id id-users_08',
        'id id-users_09',
        'id id-users_10',
        'id id-users_11',
        'id id-users_12',
        'id id-users_13',
        'id id-users_14',
        'id id-users_15',
        'id id-users_16',
        'id id-video_01',
        'id id-video_02',
        'id id-video_03',
        'id id-video_04',
        'id id-video_05',
        'id id-video_06',
        'id id-video_07',
        'id id-video_08',
        'id id-video_09',
        'id id-video_10',
        'id id-video_11',
        'id id-video_12',
        'id id-video_13',
        'id id-video_14',
        'id id-weather_01',
        'id id-weather_02',
        'id id-weather_03',
        'id id-weather_04',
        'id id-weather_05',
        'id id-weather_06',
        'id id-weather_07',
        'id id-weather_08',
        'id id-weather_09',
        'id id-weather_10',
        'id id-weather_11',
        'id id-weather_12',
        'id id-weather_13',
        'id id-weather_14',
        'id id-weather_15',
        'id id-weather_16',
        'id id-weather_17',
        'id id-weather_18',
        'id id-weather_19',

    );
    $output = '<div class="ideo-icon-choose-wrap">';
    $output .= '<input class="icon-search" type="text" placeholder="' . __('search icon', 'ideo-themo') . '" />';
    $output .= '<div class="ideo-icon-choose">';
    $output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="' . $value . '" /> ';
    foreach ($icon_class as $icon) {
        $output .= '<span class="' . $icon . ' ' . ($icon == $value ? 'active' : '') . '" data-icon="' . $icon . '"></span>';
    }

    $output .= '</div>';
    $output .= '</div>';

    return $output;
}

vc_add_shortcode_param('ideo_choose_icon', 'ideothemo_choose_icon_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_choose_icon' . IDEOTHEMO_JS_MODE);

function ideothemo_buttons_param_settings_field($settings, $value)
{
    $dependencies = '';
    if (isset($settings['dependencies'])) {
        $dependencies = htmlentities(json_encode($settings['dependencies']));
    }

    if (!isset($value)) {
        $value = $settings['std'];
    }

    $output = '';
    $output .= '<div class="ideo-buttons-group"><select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '" data-dependencies="' . $dependencies . '">';
    foreach ($settings['value'] as $label => $val) {
        $selected = '';
        if ((string)$val === (string)$value) {
            $selected = ' selected="selected"';
        }

        $output .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . htmlspecialchars($label) . '</option>';
    }

    $output .= '</select>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_buttons', 'ideothemo_buttons_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_buttons' . IDEOTHEMO_JS_MODE);

function ideothemo_dropdown_param_settings_field($settings, $value)
{
    $dependencies = '';
    if (isset($settings['dependencies'])) {
        $dependencies = htmlentities(json_encode($settings['dependencies']));
    }

    $colors = '';
    if (isset($settings['colors'])) {
        $colors = ' data-colors="' . htmlentities(json_encode($settings['colors'])) . '"';
    }

    $output = '';
    $output .= '<div class="ideo-dropdown-group"><select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '" data-dependencies="' . $dependencies . '" ' . $colors . '>';
    if (is_array($settings['value']))
        foreach ($settings['value'] as $label => $val) {
            $selected = '';
            if ((string)$val === (string)$value || (!$value && isset($settings['std']) && $settings['std'] === (string)$val)) {
                $selected = ' selected="selected"';
            }

            $output .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . htmlspecialchars($label) . '</option>';
        }

    $output .= '</select>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_dropdown', 'ideothemo_dropdown_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_dropdown' . IDEOTHEMO_JS_MODE);

function ideothemo_multiselect_param_settings_field($settings, $value)
{
    if (!isset($value)) {
        $value = $settings['std'];
    }

    $output = '' . $value . ' ';
    $output .= '<div class="ideo-multiselect-group"><input type="text" class="wpb_vc_param_value ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" name="' . $settings['param_name'] . '" value="' . $value . '"/><select class="dropdown wpb-select"  multiple>';
    foreach ($settings['value'] as $label => $val) {
        $selected = '';
        $values = explode('|', $value);
        if (in_array((string)$val, $values)) {
            $selected = ' selected="selected"';
        }

        $output .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . htmlspecialchars($label) . '</option>';
    }

    $output .= '</select>';
    $output .= '</div>';
    return $output;
}

//vc_add_shortcode_param('ideo_multiselect', 'ideo_multiselect_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_multiselect' . IDEOTHEMO_JS_MODE);

function ideothemo_slider_param_settings_field($settings, $value)
{
    if (!isset($value)) {
        $value = $settings['std'];
    }

    if (isset($settings['step'])) {
        $step = $settings['step'];
    } else {
        $step = 1;
    }

    $output = '';
    $output .= '<div class="ideo-slider-group">';
    $output .= '<input type="number" min="' . $settings['min'] . '" max="' . $settings['max'] . '" step="' . $step . '" class="wpb_vc_param_value" name="' . $settings['param_name'] . '" value="' . $value . '" />';
    $output .= '<div data-min="' . $settings['min'] . '" data-max="' . $settings['max'] . '" data-step="' . $step . '" data-value="' . $value . '" class="slider ' . $settings['param_name'] . ' ' . $settings['type'] . '"></div>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_slider', 'ideothemo_slider_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_slider' . IDEOTHEMO_JS_MODE);

function ideothemo_switcher_param_settings_field($settings, $value)
{
    $dependencies = '';
    if (isset($settings['dependencies'])) {
        $dependencies = htmlentities(json_encode($settings['dependencies']));
    }

    if (!isset($value)) {
        $value = $settings['std'];
    }

    $output = '';
    $output .= '<div class="ideo-switcher-group">';
    $output .= '<input type="text" class="wpb_vc_param_value ' . $settings['param_name'] . '" name="' . $settings['param_name'] . '"  data-dependencies="' . $dependencies . '"  value="' . $value . '" data-on="' . $settings['on'] . '" data-off="' . $settings['off'] . '" />';
    $output .= '<div class="ideo-switcher"><span class="ideo-switcher-thumb"></span><span class="ideo-switcher-text">Off</span></div>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_switcher', 'ideothemo_switcher_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_switcher' . IDEOTHEMO_JS_MODE);

function ideothemo_get_cat_tree($parent, $categories)
{
    $result = array();
    foreach ($categories as $category) {
        if ($parent == $category->category_parent) {
            $category->children = ideothemo_get_cat_tree($category->cat_ID, $categories);
            $result[] = $category;
        }
    }

    return $result;
}

function ideothemo_select_cat_tree($categories, $value, $level = 0)
{
    $result = '';
    foreach ($categories as $category) {
        $selected = '';
        if (is_array($value) && in_array($category->cat_ID, $value)) {
            $selected = 'selected="selected"';
        }

        $result .= '<option class="' . $category->cat_ID . '" value="' . $category->cat_ID . '" ' . $selected . '>' . str_repeat('&nbsp;&nbsp;', $level) . $category->cat_name . '</option>';
        if (isset($category->children) && count($category->children)) {
            $result .= ideothemo_select_cat_tree($category->children, $value, $level + 2);
        }
    }

    return $result;
}

function ideothemo_categories_param_settings_field($settings, $value)
{
    $categories = get_categories(array(
        'type' => 'post',
        'hide_empty' => 0,
        'taxonomy' => (isset($settings['taxonomy']) ? $settings['taxonomy'] : 'category')
    ));

    $categories = ideothemo_get_cat_tree(0, $categories);

    $output = '';
    $output .= '
        <div class="loop-categories">
        <input type="text" class="wpb_vc_param_value" name="' . $settings['param_name'] . '" value="' . $value . '"/>
        <select data-placeholder="' . __('Choose', 'ideo-themo') . '" multiple class="dropdown wpb-input wpb-select chosen-select">
    ';
    if (!empty($value)) {
        $value = explode(',', $value);
    }

    $output .= ideothemo_select_cat_tree($categories, $value);

    $output .= '
        </select>
        </div>
    ';
    return $output;
}

vc_add_shortcode_param('ideo_categories', 'ideothemo_categories_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_category' . IDEOTHEMO_JS_MODE);

function ideothemo_team_list_param_settings_field($settings, $value)
{
    $items = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'team'
    ));

    $output = '';
    $output .= '<select data-placeholder="' . __('Choose', 'ideo-themo') . '" name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

    $output .= '<option value="" >' . __('select member', 'ideo-themo') . '</option>';

    foreach ($items as $item) {
        $selected = '';
        if ($value == $item->ID) {
            $selected = 'selected="selected"';
        }

        $output .= '<option class="' . $item->ID . '" value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
    }

    $output .= '</select>';

    wp_reset_postdata();
    wp_reset_query();

    return $output;
}

vc_add_shortcode_param('ideo_team_list', 'ideothemo_team_list_param_settings_field');

function ideothemo_items_param_settings_field($settings, $value)
{
    $items = get_posts(array(
        'posts_per_page' => -1,
        'post_type' => (isset($settings['post_type']) ? $settings['post_type'] : 'post')
    ));

    $output = '';
    $output .= '
        <div class="loop-items">
        <input type="text" class="wpb_vc_param_value" name="' . $settings['param_name'] . '" value="' . $value . '"/>
        <select data-placeholder="' . __('Choose', 'ideo-themo') . '" multiple class="dropdown wpb-input wpb-select chosen-select" name="' . $settings['param_name'] . '">
    ';
    if (!empty($value)) {
        $value = explode(',', $value);
    }

    foreach ($items as $item) {
        $selected = '';
        if (is_array($value) && in_array($item->ID, $value)) {
            $selected = 'selected="selected"';
        }

        $output .= '<option class="' . $item->ID . '" value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
    }

    $output .= '
        </select>
        </div>
    ';
    return $output;
}

vc_add_shortcode_param('ideo_items', 'ideothemo_items_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_item' . IDEOTHEMO_JS_MODE);


function ideothemo_id_param_settings_field($settings, $value)
{
    $dependency = '';

    if (!$value) $value = str_replace('-', '', ideothemo_shortcode_uid());
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';

    $output = '<div class="ideo_param_block"><input type="text" name="' . $param_name . '" class="wpb_vc_param_value wpb-textinput ' . $param_name . ' ' . $settings['type'] . '_field" value="' . $value . '" ' . $dependency . ' readonly/></div>';
    return $output;
}

vc_add_shortcode_param('ideo_id', 'ideothemo_id_param_settings_field');

function ideothemo_animation_type_param_settings_field($settings, $value)
{
    $output = '';
    $dependencies = '';
    if (isset($settings['dependencies'])) {
        $dependencies = htmlentities(json_encode($settings['dependencies']));
    }

    $output .= '<div class="ideo-animation-type"><select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '" data-dependencies="' . $dependencies . '">';
    foreach ($settings['value'] as $label => $val) {
        $selected = '';
        if ((string)$val === (string)$value) {
            $selected = ' selected="selected"';
        }

        $output .= '<option class="' . $val . '" value="' . $val . '"' . $selected . '>' . htmlspecialchars($label) . '</option>';
    }

    $output .= '</select>';
    $output .= '</div>';
    $output .= '<div class="ideo-animation-type-example"><div class="ideo-animation-type-example-element"></div></div>';
    return $output;
}

vc_add_shortcode_param('ideo_animation_type', 'ideothemo_animation_type_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_animation_type' . IDEOTHEMO_JS_MODE);

function ideothemo_custom_colors_param_settings_field($settings, $value)
{
    $colors = htmlentities(json_encode($settings['colors']));
    $el_colors = htmlentities(json_encode($settings['el_colors']));
    if (isset($settings['el_colors_dependencies'])) {
        $el_colors_dependencies = 'data-el-colors-list="' . htmlentities(json_encode($settings['el_colors_dependencies'])) . '"';
    } else {
        $el_colors_dependencies = '';
    }

    $output = '';
    $output .= '<div class="ideo-custom-colors-group">';
    //$output.= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="text" value="' . htmlentities($value) . '" data-el-colors="' . $el_colors . '" ' . $el_colors_dependencies . '/> ';
    $output .= '<textarea name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field"  data-el-colors="' . $el_colors . '" ' . $el_colors_dependencies . '> ' . htmlentities($value) . ' </textarea>';
    $output .= '<div class="ideo-color-style ' . $settings['param_name'] . '_list"></div>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_custom_colors', 'ideothemo_custom_colors_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_custom_colors' . IDEOTHEMO_JS_MODE);

function ideothemo_title_param_settings_field($settings, $value)
{
    $output = '';
    $output .= '<div class="ideo-title">';
    $output .= '</div>';
    return $output;
}

//vc_add_shortcode_param('ideo_title', 'ideo_title_param_settings_field');

function ideothemo_google_fonts_param_settings_field($settings, $value)
{
    $output = '';
    $output .= '<div class="ideo-google-fonts">';
    $output .= '<input id="google-fonts" name="' . $settings['param_name'] . '" class="wpb_vc_param_value textfield wpb-input wpb-textfield ' . $settings['param_name'] . ' ' . $settings['type'] . '" value="' . $value . '" >';
    $output .= '<select id="font-family"></select>';
    $output .= '<select id="font-weight"></select>';
    $output .= '<select id="font-subsets" multiple size="3"></select>';
    $output .= '<div id="font-preview" style="font-size:32px;padding:30px;border:solid 1px #eaeaea;" contenteditable="true">Lorem ipsum dolor sit amet.</div>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_google_fonts', 'ideothemo_google_fonts_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_google_fonts' . IDEOTHEMO_JS_MODE);


function ideothemo_colorpicker_form_field($settings, $value)
{
    return '<div class="color-group">'
    . '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field vc_color-control colorpicker" type="text" value="' . $value . '" data-alpha="true"/>'
    . '</div>';
}

vc_add_shortcode_param('ideo_colorpicker', 'ideothemo_colorpicker_form_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_colorpicker' . IDEOTHEMO_JS_MODE);

function ideothemo_export_param_settings_field($settings, $value)
{

    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';

    $output = '<div class="ideo_param_block"><textarea  name="' . $param_name . '" readonly></textarea></div>';
    return $output;
}

vc_add_shortcode_param('ideo_export', 'ideothemo_export_param_settings_field');

function ideothemo_import_param_settings_field($settings, $value)
{

    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';

    $output = '<div class="ideo_param_block"><textarea  name="' . $param_name . '" class="wpb_vc_param_value wpb-textinput ' . $param_name . ' ' . $settings['type'] . '_field"></textarea></div>';
    return $output;
}

vc_add_shortcode_param('ideo_import', 'ideothemo_import_param_settings_field');

function ideothemo_info_param_settings_field($settings, $value)
{
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $output = '<div class="ideo_param_block text"> <div class="' . $param_name . ' ' . $settings['type'] . '_field" >' . wp_kses($settings['text'], array('a' => array('href' => array()), 'br' => array())) . '</div></div>';
    return $output;
}

vc_add_shortcode_param('ideo_info', 'ideothemo_info_param_settings_field');

function ideothemo_ideo_google_locations_param_settings_field($settings, $value)
{
    if(!$value){
        $value = "[{'text':'Location address','lat':'8.018146','lng':'98.832133'}]";
    }
    $output .= '<div class="ideo-google-locations" data-json="'.  htmlentities($value) .'"  ng-controller="CtrlLoc">';
    $output .= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'] . ' ' . $settings['type'] . '_field" type="hidden" value="{{locations|json:0|singlequote}}" />';
    
    $output .= '<input type="text" ng-model="s.text" placeholder="'. __('search location','themo'). '" />';
    $output .= '<div class="ideo-google-location" ng-repeat="loc in locations | filter:s track by $index"> 
                        <div class="ideo-google-location-label">
                            '.__('ADDRESS','themo').' <span>{{$index+1}}</span>
                            <button type="button" class="button" ng-click="del(loc)">-</button>
                        </div>
                        <div class="ideo-google-location-field">
                            '. __('TOOLTIP','themo'). ': <input type="text" ng-model="loc.text" />
                        </div>
                        <div class="ideo-google-location-field">
                            <div class="ideo-google-location-input">
                                <span>'. __('LAT','themo'). ':</span> <input type="text" ng-model="loc.lat" />
                            </div> 
                            <div class="ideo-google-location-input">
                                <span>'. __('LNG','themo'). ':</span> <input type="text" ng-model="loc.lng" />
                            </div>
                        </div>                        
                    </div>';
    $output .= '<div class="ideo-google-location-btn"><button type="button button-primary" ng-click="add()" class="button">'. __('Add New','themo'). '+</button></div>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_google_locations', 'ideothemo_ideo_google_locations_param_settings_field', get_template_directory_uri() . '/inc/vc_extend/js/ideo_google_locations' . IDEOTHEMO_JS_MODE);
function ideothemo_ideo_google_locations_centermap_param_settings_field($settings, $value)
{
   
    $value = (int)end(explode(':',$value));

    $output .= '<div class="ideo-google-locations-centermap" data-json="'.  htmlentities($value) .'"  ng-controller="CtrlCenter">'; 
    $output .= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '" ng-options="locations.indexOf(item) as item.text for item in locations" ng-model="selected" ng-init="selected='. (int)$value .'"></select>';
    $output .= '</div>';
    return $output;
}

vc_add_shortcode_param('ideo_google_locations_centermap', 'ideothemo_ideo_google_locations_centermap_param_settings_field');