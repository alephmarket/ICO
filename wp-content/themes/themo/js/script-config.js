window.ideoconfig = window.ideoconfig || {};

if (typeof Object.assign != 'function') {
    (function () {
        Object.assign = function (target) {
            'use strict';
            if (target === undefined || target === null) {
                throw new TypeError('Cannot convert undefined or null to object');
            }

            var output = Object(target);
            for (var index = 1; index < arguments.length; index++) {
                var source = arguments[index];
                if (source !== undefined && source !== null) {
                    for (var nextKey in source) {
                        if (source.hasOwnProperty(nextKey)) {
                            output[nextKey] = source[nextKey];
                        }
                    }
                }
            }
            return output;
        };
    })();
}

(function (config) {
    "use strict";

    var api = {};
    api.version = '1.0.0';

    api.set = function (prop, value) {
        config[prop] = value;
    };
    api.get = function (prop) {
        return config[prop] || null;
    };


    config = Object.assign(config, api);
})(ideoconfig);