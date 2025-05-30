export const Util = {
    inViewport: function (element, cb) {
        var rect = element.getBoundingClientRect(), inView = rect.top < window.innerHeight && rect.bottom > 0;
        if (cb instanceof Function && inView) cb();
        return inView;
    },
    merge: function (sources, options) {
        options = options || {};
        var initial = {};
        for (var s = 0; s < sources.length; s++) {
            var source = sources[s];
            if (!source) continue;
            for (var key in source) {
                if (options.except && !options.except.indexOf(key)) {
                    continue;
                } else if (source[key] instanceof Object && !(source[key] instanceof Node) && !(source[key] instanceof Function)) {
                    initial[key] = Util.merge([initial[key], source[key]], options);
                } else if (options.skipNull && source[key] === null) {
                    continue;
                } else {
                    initial[key] = source[key];
                }
            }
        }
        return initial;
    },
    uId: function (length) {
        var uId = "";
        for (var i = 0; i < length; i++) {
            uId += String.fromCharCode(97 + Math.random() * 25);
        }
        return uId;
    }
};
