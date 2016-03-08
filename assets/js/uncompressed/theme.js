/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
(function () {
    var container, button, menu, links, subMenus, i, len;

    container = document.getElementById('site-navigation');
    if (!container) {
        return;
    }

    button = container.getElementsByTagName('button')[0];
    if ('undefined' === typeof button) {
        return;
    }

    menu = container.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function () {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');
    subMenus = menu.getElementsByTagName('ul');

    // Set menu items with submenus to aria-haspopup="true".
    for (i = 0, len = subMenus.length; i < len; i++) {
        subMenus[i].parentNode.setAttribute('aria-haspopup', 'true');
    }

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === self.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === self.tagName.toLowerCase()) {
                if (-1 !== self.className.indexOf('focus')) {
                    self.className = self.className.replace(' focus', '');
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }
})();

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
    var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
        isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
        isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

    if (( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function () {
            var id = location.hash.substring(1),
                element;

            if (!( /^[A-z0-9_-]+$/.test(id) )) {
                return;
            }

            element = document.getElementById(id);

            if (element) {
                if (!( /^(?:a|select|input|button|textarea)$/i.test(element.tagName) )) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();

/* globals jQuery */

(function ($) {
    // Selector to select only not already processed elements
    $.expr[":"].notmdproc = function (obj) {
        if ($(obj).data("mdproc")) {
            return false;
        } else {
            return true;
        }
    };

    function _isChar(evt) {
        if (typeof evt.which == "undefined") {
            return true;
        } else if (typeof evt.which == "number" && evt.which > 0) {
            return (
                !evt.ctrlKey
                && !evt.metaKey
                && !evt.altKey
                && evt.which != 8  // backspace
                && evt.which != 9  // tab
                && evt.which != 13 // enter
                && evt.which != 16 // shift
                && evt.which != 17 // ctrl
                && evt.which != 20 // caps lock
                && evt.which != 27 // escape
            );
        }
        return false;
    }

    function _addFormGroupFocus(element) {
        var $element = $(element);
        if (!$element.prop('disabled')) {  // this is showing as undefined on chrome but works fine on firefox??
            $element.closest(".form-group").addClass("is-focused");
        }
    }

    function _toggleTypeFocus($input) {
        $input.closest('label').hover(function () {
            var $i = $(this).find('input');
            if (!$i.prop('disabled')) { // hack because the _addFormGroupFocus() wasn't identifying the property on chrome
                _addFormGroupFocus($i);     // need to find the input so we can check disablement
            }
        }, function () {
            _removeFormGroupFocus($(this).find('input'));
        });
    }

    function _removeFormGroupFocus(element) {
        $(element).closest(".form-group").removeClass("is-focused"); // remove class from form-group
    }

    $.material = {
        "options": {
            // These options set what will be started by $.material.init()
            "validate": true,
            "input": true,
            "ripples": true,
            "checkbox": true,
            "togglebutton": true,
            "radio": true,
            "arrive": true,
            "autofill": false,

            "withRipples": [
                ".btn:not(.btn-link)",
                ".card-image",
                ".navbar a:not(.withoutripple)",
                ".dropdown-menu a",
                ".nav-tabs a:not(.withoutripple)",
                ".withripple",
                ".pagination li:not(.active):not(.disabled) a:not(.withoutripple)"
            ].join(","),
            "inputElements": "input.form-control, textarea.form-control, select.form-control",
            "checkboxElements": ".checkbox > label > input[type=checkbox]",
            "togglebuttonElements": ".togglebutton > label > input[type=checkbox]",
            "radioElements": ".radio > label > input[type=radio]"
        },
        "checkbox": function (selector) {
            // Add fake-checkbox to material checkboxes
            var $input = $((selector) ? selector : this.options.checkboxElements)
                .filter(":notmdproc")
                .data("mdproc", true)
                .after("<span class='checkbox-material'><span class='check'></span></span>");

            _toggleTypeFocus($input);
        },
        "togglebutton": function (selector) {
            // Add fake-checkbox to material checkboxes
            var $input = $((selector) ? selector : this.options.togglebuttonElements)
                .filter(":notmdproc")
                .data("mdproc", true)
                .after("<span class='toggle'></span>");

            _toggleTypeFocus($input);
        },
        "radio": function (selector) {
            // Add fake-radio to material radios
            var $input = $((selector) ? selector : this.options.radioElements)
                .filter(":notmdproc")
                .data("mdproc", true)
                .after("<span class='circle'></span><span class='check'></span>");

            _toggleTypeFocus($input);
        },
        "input": function (selector) {
            $((selector) ? selector : this.options.inputElements)
                .filter(":notmdproc")
                .data("mdproc", true)
                .each(function () {
                    var $input = $(this);

                    // Requires form-group standard markup (will add it if necessary)
                    var $formGroup = $input.closest(".form-group"); // note that form-group may be grandparent in the case of an input-group
                    if ($formGroup.length === 0) {
                        $input.wrap("<div class='form-group'></div>");
                        $formGroup = $input.closest(".form-group"); // find node after attached (otherwise additional attachments don't work)
                    }

                    // Legacy - Add hint label if using the old shorthand data-hint attribute on the input
                    if ($input.attr("data-hint")) {
                        $input.after("<p class='help-block'>" + $input.attr("data-hint") + "</p>");
                        $input.removeAttr("data-hint");
                    }

                    // Legacy - Change input-sm/lg to form-group-sm/lg instead (preferred standard and simpler css/less variants)
                    var legacySizes = {
                        "input-lg": "form-group-lg",
                        "input-sm": "form-group-sm"
                    };
                    $.each(legacySizes, function (legacySize, standardSize) {
                        if ($input.hasClass(legacySize)) {
                            $input.removeClass(legacySize);
                            $formGroup.addClass(standardSize);
                        }
                    });

                    // Legacy - Add label-floating if using old shorthand <input class="floating-label" placeholder="foo">
                    if ($input.hasClass("floating-label")) {
                        var placeholder = $input.attr("placeholder");
                        $input.attr("placeholder", null).removeClass("floating-label");
                        var id = $input.attr("id");
                        var forAttribute = "";
                        if (id) {
                            forAttribute = "for='" + id + "'";
                        }
                        $formGroup.addClass("label-floating");
                        $input.after("<label " + forAttribute + "class='control-label'>" + placeholder + "</label>");
                    }

                    // Set as empty if is empty (damn I must improve this...)
                    if ($input.val() === null || $input.val() == "undefined" || $input.val() === "") {
                        $formGroup.addClass("is-empty");
                    }

                    // Add at the end of the form-group
                    $formGroup.append("<span class='material-input'></span>");

                    // Support for file input
                    if ($formGroup.find("input[type=file]").length > 0) {
                        $formGroup.addClass("is-fileinput");
                    }
                });
        },
        "attachInputEventHandlers": function () {
            var validate = this.options.validate;

            $(document)
                .on("change", ".checkbox input[type=checkbox]", function () {
                    $(this).blur();
                })
                .on("keydown paste", ".form-control", function (e) {
                    if (_isChar(e)) {
                        $(this).closest(".form-group").removeClass("is-empty");
                    }
                })
                .on("keyup change", ".form-control", function () {
                    var $input = $(this);
                    var $formGroup = $input.closest(".form-group");
                    var isValid = (typeof $input[0].checkValidity === "undefined" || $input[0].checkValidity());

                    if ($input.val() === "") {
                        $formGroup.addClass("is-empty");
                    }
                    else {
                        $formGroup.removeClass("is-empty");
                    }

                    // Validation events do not bubble, so they must be attached directly to the input: http://jsfiddle.net/PEpRM/1/
                    //  Further, even the bind method is being caught, but since we are already calling #checkValidity here, just alter
                    //  the form-group on change.
                    //
                    // NOTE: I'm not sure we should be intervening regarding validation, this seems better as a README and snippet of code.
                    //        BUT, I've left it here for backwards compatibility.
                    if (validate) {
                        if (isValid) {
                            $formGroup.removeClass("has-error");
                        }
                        else {
                            $formGroup.addClass("has-error");
                        }
                    }
                })
                .on("focus", ".form-control, .form-group.is-fileinput", function () {
                    _addFormGroupFocus(this);
                })
                .on("blur", ".form-control, .form-group.is-fileinput", function () {
                    _removeFormGroupFocus(this);
                })
                // make sure empty is added back when there is a programmatic value change.
                //  NOTE: programmatic changing of value using $.val() must trigger the change event i.e. $.val('x').trigger('change')
                .on("change", ".form-group input", function () {
                    var $input = $(this);
                    if ($input.attr("type") == "file") {
                        return;
                    }

                    var $formGroup = $input.closest(".form-group");
                    var value = $input.val();
                    if (value) {
                        $formGroup.removeClass("is-empty");
                    } else {
                        $formGroup.addClass("is-empty");
                    }
                })
                // set the fileinput readonly field with the name of the file
                .on("change", ".form-group.is-fileinput input[type='file']", function () {
                    var $input = $(this);
                    var $formGroup = $input.closest(".form-group");
                    var value = "";
                    $.each(this.files, function (i, file) {
                        value += file.name + ", ";
                    });
                    value = value.substring(0, value.length - 2);
                    if (value) {
                        $formGroup.removeClass("is-empty");
                    } else {
                        $formGroup.addClass("is-empty");
                    }
                    $formGroup.find("input.form-control[readonly]").val(value);
                });
        },
        "ripples": function (selector) {
            $((selector) ? selector : this.options.withRipples).ripples();
        },
        "autofill": function () {
            // This part of code will detect autofill when the page is loading (username and password inputs for example)
            var loading = setInterval(function () {
                $("input[type!=checkbox]").each(function () {
                    var $this = $(this);
                    if ($this.val() && $this.val() !== $this.attr("value")) {
                        $this.trigger("change");
                    }
                });
            }, 100);

            // After 10 seconds we are quite sure all the needed inputs are autofilled then we can stop checking them
            setTimeout(function () {
                clearInterval(loading);
            }, 10000);
        },
        "attachAutofillEventHandlers": function () {
            // Listen on inputs of the focused form (because user can select from the autofill dropdown only when the input has focus)
            var focused;
            $(document)
                .on("focus", "input", function () {
                    var $inputs = $(this).parents("form").find("input").not("[type=file]");
                    focused = setInterval(function () {
                        $inputs.each(function () {
                            var $this = $(this);
                            if ($this.val() !== $this.attr("value")) {
                                $this.trigger("change");
                            }
                        });
                    }, 100);
                })
                .on("blur", ".form-group input", function () {
                    clearInterval(focused);
                });
        },
        "init": function (options) {
            this.options = $.extend({}, this.options, options);
            var $document = $(document);

            if ($.fn.ripples && this.options.ripples) {
                this.ripples();
            }
            if (this.options.input) {
                this.input();
                this.attachInputEventHandlers();
            }
            if (this.options.checkbox) {
                this.checkbox();
            }
            if (this.options.togglebutton) {
                this.togglebutton();
            }
            if (this.options.radio) {
                this.radio();
            }
            if (this.options.autofill) {
                this.autofill();
                this.attachAutofillEventHandlers();
            }

            if (document.arrive && this.options.arrive) {
                if ($.fn.ripples && this.options.ripples) {
                    $document.arrive(this.options.withRipples, function () {
                        $.material.ripples($(this));
                    });
                }
                if (this.options.input) {
                    $document.arrive(this.options.inputElements, function () {
                        $.material.input($(this));
                    });
                }
                if (this.options.checkbox) {
                    $document.arrive(this.options.checkboxElements, function () {
                        $.material.checkbox($(this));
                    });
                }
                if (this.options.radio) {
                    $document.arrive(this.options.radioElements, function () {
                        $.material.radio($(this));
                    });
                }
                if (this.options.togglebutton) {
                    $document.arrive(this.options.togglebuttonElements, function () {
                        $.material.togglebutton($(this));
                    });
                }

            }
        }
    };

})(jQuery);

/* Copyright 2014+, Federico Zivolo, LICENSE at https://github.com/FezVrasta/bootstrap-material-design/blob/master/LICENSE.md */
/* globals jQuery, navigator */

(function ($, window, document, undefined) {

    "use strict";

    /**
     * Define the name of the plugin
     */
    var ripples = "ripples";


    /**
     * Get an instance of the plugin
     */
    var self = null;


    /**
     * Define the defaults of the plugin
     */
    var defaults = {};


    /**
     * Create the main plugin function
     */
    function Ripples(element, options) {
        self = this;

        this.element = $(element);

        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = ripples;

        this.init();
    }


    /**
     * Initialize the plugin
     */
    Ripples.prototype.init = function () {
        var $element = this.element;

        $element.on("mousedown touchstart", function (event) {
            /**
             * Verify if the user is just touching on a device and return if so
             */
            if (self.isTouch() && event.type === "mousedown") {
                return;
            }


            /**
             * Verify if the current element already has a ripple wrapper element and
             * creates if it doesn't
             */
            if (!($element.find(".ripple-container").length)) {
                $element.append("<div class=\"ripple-container\"></div>");
            }


            /**
             * Find the ripple wrapper
             */
            var $wrapper = $element.children(".ripple-container");


            /**
             * Get relY and relX positions
             */
            var relY = self.getRelY($wrapper, event);
            var relX = self.getRelX($wrapper, event);


            /**
             * If relY and/or relX are false, return the event
             */
            if (!relY && !relX) {
                return;
            }


            /**
             * Get the ripple color
             */
            var rippleColor = self.getRipplesColor($element);


            /**
             * Create the ripple element
             */
            var $ripple = $("<div></div>");

            $ripple
                .addClass("ripple")
                .css({
                    "left": relX,
                    "top": relY,
                    "background-color": rippleColor
                });


            /**
             * Append the ripple to the wrapper
             */
            $wrapper.append($ripple);


            /**
             * Make sure the ripple has the styles applied (ugly hack but it works)
             */
            (function () {
                return window.getComputedStyle($ripple[0]).opacity;
            })();


            /**
             * Turn on the ripple animation
             */
            self.rippleOn($element, $ripple);


            /**
             * Call the rippleEnd function when the transition "on" ends
             */
            setTimeout(function () {
                self.rippleEnd($ripple);
            }, 500);


            /**
             * Detect when the user leaves the element
             */
            $element.on("mouseup mouseleave touchend", function () {
                $ripple.data("mousedown", "off");

                if ($ripple.data("animating") === "off") {
                    self.rippleOut($ripple);
                }
            });

        });
    };


    /**
     * Get the new size based on the element height/width and the ripple width
     */
    Ripples.prototype.getNewSize = function ($element, $ripple) {

        return (Math.max($element.outerWidth(), $element.outerHeight()) / $ripple.outerWidth()) * 2.5;
    };


    /**
     * Get the relX
     */
    Ripples.prototype.getRelX = function ($wrapper, event) {
        var wrapperOffset = $wrapper.offset();

        if (!self.isTouch()) {
            /**
             * Get the mouse position relative to the ripple wrapper
             */
            return event.pageX - wrapperOffset.left;
        } else {
            /**
             * Make sure the user is using only one finger and then get the touch
             * position relative to the ripple wrapper
             */
            event = event.originalEvent;

            if (event.touches.length === 1) {
                return event.touches[0].pageX - wrapperOffset.left;
            }

            return false;
        }
    };


    /**
     * Get the relY
     */
    Ripples.prototype.getRelY = function ($wrapper, event) {
        var wrapperOffset = $wrapper.offset();

        if (!self.isTouch()) {
            /**
             * Get the mouse position relative to the ripple wrapper
             */
            return event.pageY - wrapperOffset.top;
        } else {
            /**
             * Make sure the user is using only one finger and then get the touch
             * position relative to the ripple wrapper
             */
            event = event.originalEvent;

            if (event.touches.length === 1) {
                return event.touches[0].pageY - wrapperOffset.top;
            }

            return false;
        }
    };


    /**
     * Get the ripple color
     */
    Ripples.prototype.getRipplesColor = function ($element) {

        var color = $element.data("ripple-color") ? $element.data("ripple-color") : window.getComputedStyle($element[0]).color;

        return color;
    };


    /**
     * Verify if the client browser has transistion support
     */
    Ripples.prototype.hasTransitionSupport = function () {
        var thisBody = document.body || document.documentElement;
        var thisStyle = thisBody.style;

        var support = (
            thisStyle.transition !== undefined ||
            thisStyle.WebkitTransition !== undefined ||
            thisStyle.MozTransition !== undefined ||
            thisStyle.MsTransition !== undefined ||
            thisStyle.OTransition !== undefined
        );

        return support;
    };


    /**
     * Verify if the client is using a mobile device
     */
    Ripples.prototype.isTouch = function () {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    };


    /**
     * End the animation of the ripple
     */
    Ripples.prototype.rippleEnd = function ($ripple) {
        $ripple.data("animating", "off");

        if ($ripple.data("mousedown") === "off") {
            self.rippleOut($ripple);
        }
    };


    /**
     * Turn off the ripple effect
     */
    Ripples.prototype.rippleOut = function ($ripple) {
        $ripple.off();

        if (self.hasTransitionSupport()) {
            $ripple.addClass("ripple-out");
        } else {
            $ripple.animate({"opacity": 0}, 100, function () {
                $ripple.trigger("transitionend");
            });
        }

        $ripple.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function () {
            $ripple.remove();
        });
    };


    /**
     * Turn on the ripple effect
     */
    Ripples.prototype.rippleOn = function ($element, $ripple) {
        var size = self.getNewSize($element, $ripple);

        if (self.hasTransitionSupport()) {
            $ripple
                .css({
                    "-ms-transform": "scale(" + size + ")",
                    "-moz-transform": "scale(" + size + ")",
                    "-webkit-transform": "scale(" + size + ")",
                    "transform": "scale(" + size + ")"
                })
                .addClass("ripple-on")
                .data("animating", "on")
                .data("mousedown", "on");
        } else {
            $ripple.animate({
                "width": Math.max($element.outerWidth(), $element.outerHeight()) * 2,
                "height": Math.max($element.outerWidth(), $element.outerHeight()) * 2,
                "margin-left": Math.max($element.outerWidth(), $element.outerHeight()) * (-1),
                "margin-top": Math.max($element.outerWidth(), $element.outerHeight()) * (-1),
                "opacity": 0.2
            }, 500, function () {
                $ripple.trigger("transitionend");
            });
        }
    };


    /**
     * Create the jquery plugin function
     */
    $.fn.ripples = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + ripples)) {
                $.data(this, "plugin_" + ripples, new Ripples(this, options));
            }
        });
    };

})(jQuery, window, document);

/*
 * jQuery Navgoco Menus Plugin v0.1.5 (2013-09-07)
 * https://github.com/tefra/navgoco
 *
 * Copyright (c) 2013 Chris T (@tefra)
 * BSD - https://github.com/tefra/navgoco/blob/master/LICENSE-BSD
 */
(function ($) {

    "use strict";

    /**
     * Plugin Constructor. Every menu must have a unique id which will either
     * be the actual id attribute or its index in the page.
     *
     * @param {Element} el
     * @param {Object} options
     * @param {Integer} idx
     * @returns {Object} Plugin Instance
     */
    var Plugin = function (el, options, idx) {
        this.el = el;
        this.$el = $(el);
        this.options = options;
        this.uuid = this.$el.attr('id') ? this.$el.attr('id') : idx;
        this.state = {};
        this.init();
        return this;
    };

    /**
     * Plugin methods
     */
    Plugin.prototype = {
        /**
         * Load cookie, assign a unique data-index attribute to
         * all sub-menus and show|hide them according to cookie
         * or based on the parent open class. Find all parent li > a
         * links add the carent if it's on and attach the event click
         * to them.
         */
        init: function () {
            var self = this;
            self._load();
            self.$el.find('ul').each(function (idx) {
                var sub = $(this);
                sub.attr('data-index', idx);
                if (self.options.save && self.state.hasOwnProperty(idx)) {
                    sub.parent().addClass(self.options.openClass);
                    sub.show();
                } else if (sub.parent().hasClass(self.options.openClass)) {
                    sub.show();
                    self.state[idx] = 1;
                } else {
                    sub.hide();
                }
            });

            if (self.options.caret) {
                self.$el.find("li:has(ul) > a").append(self.options.caret);
            }

            var links = self.$el.find("li > a");
            links.on('click', function (event) {
                event.stopPropagation();
                var sub = $(this).next();
                sub = sub.length > 0 ? sub : false;
                self.options.onClickBefore.call(this, event, sub);
                if (sub) {
                    event.preventDefault();
                    self._toggle(sub, sub.is(":hidden"));
                    self._save();
                } else {
                    if (self.options.accordion) {
                        var allowed = self.state = self._parents($(this));
                        self.$el.find('ul').filter(':visible').each(function () {
                            var sub = $(this),
                                idx = sub.attr('data-index');

                            if (!allowed.hasOwnProperty(idx)) {
                                self._toggle(sub, false);
                            }
                        });
                        self._save();
                    }
                }
                self.options.onClickAfter.call(this, event, sub);
            });
        },
        /**
         * Accepts a JQuery Element and a boolean flag. If flag is false it removes the `open` css
         * class from the parent li and slides up the sub-menu. If flag is open it adds the `open`
         * css class to the parent li and slides down the menu. If accordion mode is on all
         * sub-menus except the direct parent tree will close. Internally an object with the menus
         * states is maintained for later save duty.
         *
         * @param {Element} sub
         * @param {Boolean} open
         */
        _toggle: function (sub, open) {
            var self = this,
                idx = sub.attr('data-index'),
                parent = sub.parent();

            self.options.onToggleBefore.call(this, sub, open);
            if (open) {
                parent.addClass(self.options.openClass);
                sub.slideDown(self.options.slide);
                self.state[idx] = 1;

                if (self.options.accordion) {
                    var allowed = self.state = self._parents(sub);
                    allowed[idx] = self.state[idx] = 1;

                    self.$el.find('ul').filter(':visible').each(function () {
                        var sub = $(this),
                            idx = sub.attr('data-index');

                        if (!allowed.hasOwnProperty(idx)) {
                            self._toggle(sub, false);
                        }
                    });
                }
            } else {
                parent.removeClass(self.options.openClass);
                sub.slideUp(self.options.slide);
                self.state[idx] = 0;
            }
            self.options.onToggleAfter.call(this, sub, open);
        },
        /**
         * Returns all parents of a sub-menu. When obj is true It returns an object with indexes for
         * keys and the elements as values, if obj is false the object is filled with the value `1`.
         *
         * @since v0.1.2
         * @param {Element} sub
         * @param {Boolean} obj
         * @returns {Object}
         */
        _parents: function (sub, obj) {
            var result = {},
                parent = sub.parent(),
                parents = parent.parents('ul');

            parents.each(function () {
                var par = $(this),
                    idx = par.attr('data-index');

                if (!idx) {
                    return false;
                }
                result[idx] = obj ? par : 1;
            });
            return result;
        },
        /**
         * If `save` option is on the internal object that keeps track of the sub-menus states is
         * saved with a cookie. For size reasons only the open sub-menus indexes are stored.         *
         */
        _save: function () {
            if (this.options.save) {
                var save = {};
                for (var key in this.state) {
                    if (this.state[key] === 1) {
                        save[key] = 1;
                    }
                }
                cookie[this.uuid] = this.state = save;
                $.cookie(this.options.cookie.name, JSON.stringify(cookie), this.options.cookie);
            }
        },
        /**
         * If `save` option is on it reads the cookie data. The cookie contains data for all
         * navgoco menus so the read happens only once and stored in the global `cookie` var.
         */
        _load: function () {
            if (this.options.save) {
                if (cookie === null) {
                    var data = $.cookie(this.options.cookie.name);
                    cookie = (data) ? JSON.parse(data) : {};
                }
                this.state = cookie.hasOwnProperty(this.uuid) ? cookie[this.uuid] : {};
            }
        },
        /**
         * Public method toggle to manually show|hide sub-menus. If no indexes are provided all
         * items will be toggled. You can pass sub-menus indexes as regular params. eg:
         * navgoco('toggle', true, 1, 2, 3, 4, 5);
         *
         * Since v0.1.2 it will also open parents when providing sub-menu indexes.
         *
         * @param {Boolean} open
         */
        toggle: function (open) {
            var self = this,
                length = arguments.length;

            if (length <= 1) {
                self.$el.find('ul').each(function () {
                    var sub = $(this);
                    self._toggle(sub, open);
                });
            } else {
                var idx,
                    list = {},
                    args = Array.prototype.slice.call(arguments, 1);
                length--;

                for (var i = 0; i < length; i++) {
                    idx = args[i];
                    var sub = self.$el.find('ul[data-index="' + idx + '"]').first();
                    if (sub) {
                        list[idx] = sub;
                        if (open) {
                            var parents = self._parents(sub, true);
                            for (var pIdx in parents) {
                                if (!list.hasOwnProperty(pIdx)) {
                                    list[pIdx] = parents[pIdx];
                                }
                            }
                        }
                    }
                }

                for (idx in list) {
                    self._toggle(list[idx], open);
                }
            }
            self._save();
        },
        /**
         * Removes instance from JQuery data cache and unbinds events.
         */
        destroy: function () {
            $.removeData(this.$el);
            this.$el.find("li:has(ul) > a").unbind('click');
        }
    };

    /**
     * A JQuery plugin wrapper for navgoco. It prevents from multiple instances and also handles
     * public methods calls. If we attempt to call a public method on an element that doesn't have
     * a navgoco instance, one will be created for it with the default options.
     *
     * @param {Object|String} options
     */
    $.fn.navgoco = function (options) {
        if (typeof options === 'string' && options.charAt(0) !== '_' && options !== 'init') {
            var callback = true,
                args = Array.prototype.slice.call(arguments, 1);
        } else {
            options = $.extend({}, $.fn.navgoco.defaults, options || {});
            if (!$.cookie) {
                options.save = false;
            }
        }
        return this.each(function (idx) {
            var $this = $(this),
                obj = $this.data('navgoco');

            if (!obj) {
                obj = new Plugin(this, callback ? $.fn.navgoco.defaults : options, idx);
                $this.data('navgoco', obj);
            }
            if (callback) {
                obj[options].apply(obj, args);
            }
        });
    };
    /**
     * Global var holding all navgoco menus open states
     *
     * @type {Object}
     */
    var cookie = null;

    /**
     * Default navgoco options
     *
     * @type {Object}
     */
    $.fn.navgoco.defaults = {
        caret: '<span class="caret"></span>',
        accordion: false,
        openClass: 'open',
        save: true,
        cookie: {
            name: 'navgoco',
            expires: false,
            path: '/'
        },
        slide: {
            duration: 400,
            easing: 'swing'
        },
        onClickBefore: $.noop,
        onClickAfter: $.noop,
        onToggleBefore: $.noop,
        onToggleAfter: $.noop
    };
})(jQuery);
//# sourceMappingURL=theme.js.map
