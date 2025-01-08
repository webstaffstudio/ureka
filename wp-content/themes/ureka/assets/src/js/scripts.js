import Swiper from 'swiper';
import {Autoplay, Navigation, EffectFade} from 'swiper/modules';

Swiper.use([Autoplay, Navigation, EffectFade]);
"use strict";
(function () {
    // Global variables
    let
        userAgent = navigator.userAgent.toLowerCase(),
        isIE = userAgent.indexOf("msie") !== -1 ? parseInt(userAgent.split("msie")[1], 10) : userAgent.indexOf("trident") !== -1 ? 11 : userAgent.indexOf("edge") !== -1 ? 12 : false;

    // Unsupported browsers
    if (isIE !== false && isIE < 12) {
        console.warn("[Core] detected IE" + isIE + ", load alert");
        var script = document.createElement("script");
        script.src = "./js/support.js";
        document.querySelector("head").appendChild(script);
    }

    let
        $window = $(window),
        $html = $("html"),
        $body = $("body"),
        isDesktop = $html.hasClass("desktop"),
        isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
        isNoviBuilder = false,

        plugins = {
            bootstrapTabs: $('.tabs-custom'),
            rdNavbar: $('.rd-navbar'),
            materialParallax: $('.parallax-container'),
            swiper: $('.swiper-slider'),
            search: $('.rd-search'),
            searchResults: $('.rd-search-results'),
            customToggle: $('[data-custom-toggle]'),
        };

    /**
     * @desc Check the element has been scrolled into the view
     * @param {object} elem - jQuery object
     * @return {boolean}
     */
    function isScrolledIntoView(elem) {
        if (isNoviBuilder) return true;
        return elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height();
    }

    /**
     * @desc Calls a function when element has been scrolled into the view
     * @param {object} element - jQuery object
     * @param {function} func - init function
     */
    function lazyInit(element, func) {
        var scrollHandler = function () {
            if ((!element.hasClass('lazy-loaded') && (isScrolledIntoView(element)))) {
                func.call(element);
                element.addClass('lazy-loaded');
            }
        };

        scrollHandler();
        $window.on('scroll', scrollHandler);
    }

    // Initialize scripts that require a loaded window
    $window.on('load', function () {

        // Material Parallax
        if (plugins.materialParallax.length) {
            if (!isNoviBuilder && !isIE && !isMobile) {
                plugins.materialParallax.parallax();
            } else {
                for (var i = 0; i < plugins.materialParallax.length; i++) {
                    var $parallax = $(plugins.materialParallax[i]);

                    $parallax.addClass('parallax-disabled');
                    $parallax.css({"background-image": 'url(' + $parallax.data("parallax-img") + ')'});
                }
            }
        }
    });

    function parseJSON(str) {
        try {
            if (str) return JSON.parse(str);
            else return {};
        } catch (error) {
            console.warn(error);
            return {};
        }
    }

    // Initialize scripts that require a finished document
    $(function () {
        isNoviBuilder = window.xMode;

        /**
         * @desc Sets slides background images from attribute 'data-slide-bg'
         * @param {object} swiper - swiper instance
         */
        function setBackgrounds(swiper) {
            let swipersBg = swiper.el.querySelectorAll('[data-slide-bg]');

            for (let i = 0; i < swipersBg.length; i++) {
                let swiperBg = swipersBg[i];
                swiperBg.style.backgroundImage = 'url(' + swiperBg.getAttribute('data-slide-bg') + ')';
            }
        }

        /**
         * toggleSwiperCaptionAnimation
         * @description  toggle swiper animations on active slides
         */
        function toggleSwiperCaptionAnimation(swiper) {
            let prevSlide = $(swiper.el[0]),
                nextSlide = $(swiper.slides[swiper.activeIndex]);
            prevSlide
                .find("[data-caption-animate]")
                .each(function () {
                    let $this = $(this);
                    $this
                        .removeClass("animated")
                        .removeClass($this.attr("data-caption-animate"))
                        .addClass("not-animated");
                });

            nextSlide
                .find("[data-caption-animate]")
                .each(function () {
                    let $this = $(this),
                        delay = $this.attr("data-caption-delay");


                    if (!isNoviBuilder) {
                        setTimeout(function () {
                            $this
                                .removeClass("not-animated")
                                .addClass($this.attr("data-caption-animate"))
                                .addClass("animated");
                        }, delay ? parseInt(delay) : 0);
                    } else {
                        $this
                            .removeClass("not-animated")
                    }
                });
        }


        // Additional class on html if mac os.
        if (navigator.platform.match(/(Mac)/i)) {
            $html.addClass("mac-os");
        }

        // Adds some loosing functionality to IE browsers (IE Polyfills)
        if (isIE) {
            if (isIE === 12) $html.addClass("ie-edge");
            if (isIE === 11) $html.addClass("ie-11");
            if (isIE < 10) $html.addClass("lt-ie-10");
            if (isIE < 11) $html.addClass("ie-10");
        }

        // Bootstrap tabs
        if (plugins.bootstrapTabs.length) {
            for (var i = 0; i < plugins.bootstrapTabs.length; i++) {
                var bootstrapTab = $(plugins.bootstrapTabs[i]);

                //If have slick carousel inside tab - resize slick carousel on click
                if (bootstrapTab.find('.slick-slider').length) {
                    bootstrapTab.find('.tabs-custom-list > li > a').on('click', $.proxy(function () {
                        var $this = $(this);
                        var setTimeOutTime = isNoviBuilder ? 1500 : 300;

                        setTimeout(function () {
                            $this.find('.tab-content .tab-pane.active .slick-slider').slick('setPosition');
                        }, setTimeOutTime);
                    }, bootstrapTab));
                }

                plugins.bootstrapTabs[i].querySelectorAll('.nav li a').forEach(function (tab, index) {
                    if (index === 0) {
                        tab.parentElement.classList.remove('active');
                        $(tab).tab('show');
                    }

                    tab.addEventListener('click', function (event) {
                        event.preventDefault();
                        $(this).tab('show');
                    });
                });
            }
        }


        // UI To Top
        if (isDesktop && !isNoviBuilder) {
            $().UItoTop({
                easingType: 'easeOutQuad',
                containerClass: 'ui-to-top fa fa-angle-up'
            });
        }

        // RD Navbar
        if (plugins.rdNavbar.length) {
            var
                navbar = plugins.rdNavbar,
                aliases = {'-': 0, '-sm-': 576, '-md-': 768, '-lg-': 992, '-xl-': 1200, '-xxl-': 1600},
                responsive = {};

            for (var alias in aliases) {
                var link = responsive[aliases[alias]] = {};
                if (navbar.attr('data' + alias + 'layout')) link.layout = navbar.attr('data' + alias + 'layout');
                if (navbar.attr('data' + alias + 'device-layout')) link.deviceLayout = navbar.attr('data' + alias + 'device-layout');
                if (navbar.attr('data' + alias + 'hover-on')) link.focusOnHover = navbar.attr('data' + alias + 'hover-on') === 'true';
                if (navbar.attr('data' + alias + 'auto-height')) link.autoHeight = navbar.attr('data' + alias + 'auto-height') === 'true';
                if (navbar.attr('data' + alias + 'stick-up-offset')) link.stickUpOffset = navbar.attr('data' + alias + 'stick-up-offset');
                if (navbar.attr('data' + alias + 'stick-up')) link.stickUp = navbar.attr('data' + alias + 'stick-up') === 'true';
                if (isNoviBuilder) link.stickUp = false;
                else if (navbar.attr('data' + alias + 'stick-up')) link.stickUp = navbar.attr('data' + alias + 'stick-up') === 'true';
            }

            plugins.rdNavbar.RDNavbar({
                anchorNav: !isNoviBuilder,
                stickUpClone: (plugins.rdNavbar.attr("data-stick-up-clone") && !isNoviBuilder) ? plugins.rdNavbar.attr("data-stick-up-clone") === 'true' : false,
                responsive: responsive,
                callbacks: {
                    onStuck: function () {
                        var navbarSearch = this.$element.find('.rd-search input');

                        if (navbarSearch) {
                            navbarSearch.val('').trigger('propertychange');
                        }
                    },
                    onDropdownOver: function () {
                        return !isNoviBuilder;
                    },
                    onUnstuck: function () {
                        if (this.$clone === null)
                            return;

                        var navbarSearch = this.$clone.find('.rd-search input');

                        if (navbarSearch) {

                            navbarSearch.val('').trigger('propertychange');
                            navbarSearch.trigger('blur');
                        }

                    },
                    onToggleSwitch: function () {
                        setTimeout(function () {
                            document.getElementById('rd-navbar-search-form-input').focus();
                        }, 200);
                    }
                }
            });

            if (plugins.rdNavbar.attr("data-body-class")) {
                document.body.className += ' ' + plugins.rdNavbar.attr("data-body-class");
            }
        }

        // Swiper
        if (plugins.swiper.length) {

            for (let i = 0; i < plugins.swiper.length; i++) {

                let
                    node = plugins.swiper[i],
                    params = parseJSON(node.getAttribute('data-swiper')),
                    defaults = {
                        speed: 1000,
                        loop: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev'
                        },
                        autoplay: false
                    },
                    xMode = {
                        autoplay: false,
                        loop: false,
                        simulateTouch: false
                    };

                params.on = {
                    init: function () {
                        setBackgrounds(this);
                        toggleSwiperCaptionAnimation(this);

                        // Real Previous Index must be set recent
                        this.on('slideChangeTransitionEnd', function () {
                            toggleSwiperCaptionAnimation(this);
                        });
                    }
                };

                new Swiper(node, Util.merge(isNoviBuilder ? [defaults, params, xMode] : [defaults, params]));
            }
        }


        // Custom Toggles
        if (plugins.customToggle.length) {
            for (var i = 0; i < plugins.customToggle.length; i++) {
                var $this = $(plugins.customToggle[i]);

                $this.on('click', $.proxy(function (event) {
                    event.preventDefault();

                    var $ctx = $(this);
                    $($ctx.attr('data-custom-toggle')).add(this).toggleClass('active');
                }, $this));

                if ($this.attr("data-custom-toggle-hide-on-blur") === "true") {
                    $body.on("click", $this, function (e) {
                        if (e.target !== e.data[0]
                            && $(e.data.attr('data-custom-toggle')).find($(e.target)).length
                            && e.data.find($(e.target)).length === 0) {
                            $(e.data.attr('data-custom-toggle')).add(e.data[0]).removeClass('active');
                        }
                    })
                }

                if ($this.attr("data-custom-toggle-disable-on-blur") === "true") {
                    $body.on("click", $this, function (e) {
                        if (e.target !== e.data[0] && $(e.data.attr('data-custom-toggle')).find($(e.target)).length === 0 && e.data.find($(e.target)).length === 0) {
                            $(e.data.attr('data-custom-toggle')).add(e.data[0]).removeClass('active');
                        }
                    })
                }
            }
        }

    });
}());
