"use strict";

function Iteminview($el, options) {
    this.element = $el;
    this.callback = options.callback;
    this.inview = false;
    this.initialize();
}

Iteminview.prototype.initialize = function () {
    var self = this;
    this.windowHeight = window.innerHeight;
    this.checkPosition();
    this.addEventHandlers();
};
Iteminview.prototype.addEventHandlers = function () {
    var self = this;
    window.addEventListener("scroll", function () {
        self.checkPosition();
    });
    window.addEventListener("DOMMouseScroll", function () {
        self.checkPosition();
    });
};
Iteminview.prototype.checkPosition = function () {
    var self = this;
    var posFromTop = self.element.getBoundingClientRect().top;
    var $item = self.element;
    if (posFromTop - this.windowHeight <= -50) {
        var delay = 100;
        if (window.scrollY == 0) {
            delay = 400;
        }
        setTimeout(function () {
            $item.classList.add('inview');
            self.inview = true;
            self.callback(true);
        }, delay);
    } else {
        self.inview = false;
        self.callback();
        if ($item.classList.contains('repeat')) {
            setTimeout(function () {
                $item.classList.remove('inview');
            }, 100);
        }
    }
};
window.requestAnimFrame = function () {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {
        window.setTimeout(callback, 1000 / 60);
    };
}();

function Sjkroll($el, options) {
    this.element = $el;
    this.part = options.part;
    this.breakpoint = options.breakpoint;
    this.direction = options.direction;
    this.speed = options.speed;
    this.initialize();
}

Sjkroll.prototype.initialize = function () {
    var self = this;
    this.windowHeight = window.innerHeight;
    this.checkPosition();
    this.addEventHandlers();
};
Sjkroll.prototype.addEventHandlers = function () {
    var self = this;
    window.addEventListener("scroll", function () {
        this.animFrame = requestAnimFrame(function () {
            self.checkPosition();
        });
    });
    window.addEventListener("DOMMouseScroll", function () {
        self.checkPosition();
    });
};
Sjkroll.prototype.checkPosition = function () {
    var self = this;
    var posFromTop = this.element.getBoundingClientRect().top;

    if (posFromTop - this.windowHeight <= -50) {
        if (this.breakpoint !== undefined && window.innerWidth < this.breakpoint) {
            self.part.style.transform = '';
        } else {
            if (self.direction == 'vertical') {
                self.part.style.transform = 'translateY(' + parseInt(posFromTop / self.speed - self.speed) + 'px)';
            }
            if (self.direction == 'verticalReverse') {
                self.part.style.transform = 'translateY(' + parseInt(-posFromTop / 10 + 10) + 'px)';
            }
        }
    }
};
/* 
    This is your main JS file (frontend). Don't rename it. You can split up your script into sepperate files inside the src/javascript/scripts/ folder.
    Vendors will be bundled and prepended before all of your own javascript. Stick your vendor js files inside the src/javascript/vendor/ folder.
    Make sure to declare all the vendors and custom scripts inside the projectConfig.js file.
*/
document.addEventListener('DOMContentLoaded', function () {
    // let hero = document.getElementsByClassName("hero")[0];
    var header = document.getElementsByClassName("c-site-header")[0];
    var main = document.getElementsByTagName("main")[0];
    var hero = document.getElementsByClassName("c-hero")[0];
    var menuTimer = void 0;
    var desktopmenu = header.getElementsByClassName('main')[0];
    var submenus = header.getElementsByClassName('submenu');
    var subTogglers = header.getElementsByClassName('sub-toggler');
    var menuToggler = header.getElementsByClassName("menu-toggler")[0];
    var searchToggler = header.getElementsByClassName("search-toggler")[0];
    var searchInput = header.getElementsByClassName("search-desktop__overlay__input")[0];
    var svgRects = document.getElementsByClassName("svgrect");
    var svgInitials = document.getElementsByClassName("svgInitial");
    var arrowDown = document.querySelector('.arrow-down');
    var headerObj = {
        $el: header,
        $hero: hero,
        locked: false,
        scroll: 0,
        clearAmount: 0,
        isFixed: false,
        continueDown: true,
        continueUp: false,
        lockedOn: 0
    };

    // get only first level children
    function getChildNodes(node) {
        var children = new Array();
        for (var _i = 0; _i < node.childNodes.length; _i++) {
            if (node.childNodes[_i].nodeType == 1) {
                children.push(node.childNodes[_i]);
            }
        }
        return children;
    }

    // Create main navigation logic
    function desktopMenuListeners() {

        // close all submenus
        function closeSubMenus() {
            for (var n = 0; n < submenus.length; n++) {
                if (submenus[n] !== undefined) {
                    submenus[n].classList.remove('hover');
                }
            }
        }

        function removeListHovers() {
            for (var _i2 = 0; _i2 < $listItems.length; _i2++) {
                $listItems[_i2].classList.remove('hover');
            }
        }

        // footer.onmouseover = function(event) {
        //     closeSubMenus();
        //     removeBg();
        //     removeListHovers();
        // }
        main.onmouseover = function (event) {
            closeSubMenus();
            removeListHovers();
        };
        var $listItems = getChildNodes(desktopmenu);

        var _loop = function _loop(_i3) {
            $link = $listItems[_i3].getElementsByTagName("a")[0];
            href = $link.getAttribute("href");

            if (href == '#' && $listItems[_i3].classList.contains('has-sub')) {
                $link.onclick = function (event) {
                    event.preventDefault();
                    removeListHovers();
                    closeSubMenus();
                    if (!$listItems[_i3].classList.contains('hover')) {
                        $listItems[_i3].classList.add('hover');
                    };
                };
            }
            $link.onmouseover = function (event) {
                if ($listItems[_i3].classList.contains('has-sub')) {
                    removeListHovers();
                    menuTimer = setTimeout(function () {
                        closeSubMenus();
                        $listItems[_i3].classList.add('hover');
                    }, 300);
                } else {
                    closeSubMenus();
                    removeListHovers();
                }
            };
            $link.onmouseout = function (event) {
                clearTimeout(menuTimer);
            };
        };

        for (var _i3 = 0; _i3 < $listItems.length; _i3++) {
            var $link;
            var href;

            _loop(_i3);
        }
    }
    desktopMenuListeners();

    function initMenu() {
        menuToggler.onclick = function (e) {
            if (document.body.classList.contains('menu-open')) {
                document.body.classList.remove('menu-open');
                // When the modal is shown, we want a fixed body
                var scrollY = document.body.style.top;
                document.body.style.top = '';
                document.body.style.position = '';
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            } else {
                // console.log(window.scrollY);
                document.body.classList.add('menu-open');
                // When the modal is shown, we want a fixed body
                document.body.style.top = '-' + window.scrollY + 'px';
                document.body.style.position = 'fixed';
            }
        };
/*        searchToggler.onclick = function (e) {
            if (document.body.classList.contains('search-open')) {
                document.body.classList.remove('search-open');
            } else {
                document.body.classList.add('search-open');
                searchInput.focus();
            }
        };
*/
        if (subTogglers.length > 0) {
            var _loop2 = function _loop2() {
                var subToggler = subTogglers[i];
                var parent = subToggler.parentNode;
                var link = parent.getElementsByTagName("a")[0];
                href = link.getAttribute("href");

                if (href == '#') {
                    link.onclick = function (event) {
                        event.preventDefault();
                        if (parent.classList.contains('open')) {
                            parent.classList.remove('open');
                        } else {
                            parent.classList.add('open');
                        }
                    };
                }

                subToggler.onclick = function (event) {
                    if (parent.classList.contains('open')) {
                        parent.classList.remove('open');
                    } else {
                        parent.classList.add('open');
                    }
                };
            };

            for (var i = 0; i < subTogglers.length; i++) {
                var href;

                _loop2();
            }
        }
    }
    initMenu();

    function handleScroll() {
        var hh = headerObj.$el.clientHeight;

        if (window.pageYOffset > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        if (window.pageYOffset > 100) {
            headerObj.locked = false;
        } else {
            headerObj.locked = true;
        }
        if (window.pageYOffset > 10) {
            if (window.pageYOffset > headerObj.scroll) {
                // we go down
                headerObj.clearAmount = headerObj.clearAmount - (window.pageYOffset - headerObj.scroll);
                if (headerObj.clearAmount < 0) {
                    headerObj.clearAmount = 0;
                }
                if (headerObj.isFixed == true) {
                    if (headerObj.continueDown == false) {
                        headerObj.$el.style.position = 'absolute';
                        headerObj.$el.style.top = pageYOffset + 'px';
                        headerObj.continueUp = true;
                        headerObj.isFixed = false;
                    }
                }
                headerObj.continueDown = true;
            } else {
                headerObj.clearAmount = headerObj.clearAmount + (headerObj.scroll - window.pageYOffset);
                if (headerObj.clearAmount > hh) {
                    headerObj.clearAmount = hh;
                }
                if (headerObj.continueDown == true) {
                    headerObj.$el.style.top = pageYOffset - (hh - headerObj.clearAmount) + 'px';
                    headerObj.lockedOn = pageYOffset - (hh - headerObj.clearAmount);
                    headerObj.continueDown = false;
                } else {
                    if (headerObj.isFixed == false) {
                        if (pageYOffset < headerObj.lockedOn) {
                            headerObj.$el.style.top = 0;
                            headerObj.$el.style.position = 'fixed';
                            headerObj.isFixed = true;
                        }
                    }
                }
                headerObj.continueUp = true;
            }
        } else {
            headerObj.$el.style.top = 0 + 'px';
        }
        headerObj.scroll = window.pageYOffset;
    }

    window.addEventListener("scroll", function () {
        handleScroll();
    });
    window.addEventListener("DOMMouseScroll", function () {
        handleScroll();
    });
    setTimeout(function () {
        handleScroll();
    }, 0);

    // item in view listener
    var $inviewitems = document.getElementsByClassName("item-in-view");
    function inviewCB() {};
    if ($inviewitems.length > 0) {
        for (var i = 0; i < $inviewitems.length; i++) {
            var iv = new Iteminview($inviewitems[i], {
                row: false,
                callback: inviewCB
            });
        }
    }

    // lazy loading
    function loadImage($image) {
        if ("IntersectionObserver" in window) {
            var lazyImageObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("load");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
            lazyImageObserver.observe($image);
        } else {
            // Possibly fall back to a more compatible method here
        }
    };
    var $loadimages = document.getElementsByClassName("load");
    if ($loadimages.length > 0) {
        for (var i = 0; i < $loadimages.length; i++) {
            loadImage($loadimages[i]);
        }
    }

    // main function
    function scrollToY(scrollTargetY, speed, easing) {
        var scrollY = window.pageYOffset,
            scrollTargetY = scrollTargetY || 0,
            speed = speed || 2000,
            easing = easing || 'easeOutSine',
            currentTime = 0;

        // min time .1, max time .8 seconds
        var time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

        // easing equations from https://github.com/danro/easing-js/blob/master/easing.js
        var PI_D2 = Math.PI / 2,
            easingEquations = {
            easeOutSine: function easeOutSine(pos) {
                return Math.sin(pos * (Math.PI / 2));
            },
            easeInOutSine: function easeInOutSine(pos) {
                return -0.5 * (Math.cos(Math.PI * pos) - 1);
            },
            easeInOutQuint: function easeInOutQuint(pos) {
                if ((pos /= 0.5) < 1) {
                    return 0.5 * Math.pow(pos, 5);
                }
                return 0.5 * (Math.pow(pos - 2, 5) + 2);
            }
        };

        // add animation loop
        function tick() {
            currentTime += 1 / 60;

            var p = currentTime / time;
            var t = easingEquations[easing](p);

            if (p < 1) {
                requestAnimFrame(tick);
                window.scrollTo(0, scrollY + (scrollTargetY - scrollY) * t);
            } else {
                window.scrollTo(0, scrollTargetY);
            }
        }

        // call it once to get started
        tick();
    }

    if (arrowDown !== null) {
        arrowDown.onclick = function (e) {
            scrollToY(window.outerHeight, 800, 'easeInOutQuint');
        };
    }

    function SVGButtonsAnimation(svgRects) {
        setTimeout(function () {
            if (svgRects.length !== 0) {
                var _loop3 = function _loop3() {
                    var rect = svgRects[i];
                    var w = rect.parentNode.clientWidth;
                    var h = rect.parentNode.clientHeight;
                    rect.style.strokeDasharray = 2 * w + 2 * h;
                    rect.style.strokeDashoffset = 2 * w + 2 * h;
                    rect.parentNode.parentNode.onmouseover = function () {
                        rect.style.strokeDashoffset = h - 10;
                    };
                    rect.parentNode.parentNode.onmouseout = function () {
                        rect.style.strokeDashoffset = 2 * w + 2 * h;
                    };
                };

                for (var i = 0; i < svgRects.length; i++) {
                    _loop3();
                }
            }
        }, 1000);
    }
    SVGButtonsAnimation(svgRects);

    function SVGInitialsAnimation(svgInitials) {
        if (svgInitials.length !== 0) {
            setTimeout(function () {
                for (var i = 0; i < svgInitials.length; i++) {
                    var _rect = svgInitials[i];
                    var _w = _rect.parentNode.clientWidth;
                    var _h = _rect.parentNode.clientHeight;
                    _rect.style.strokeDasharray = 2 * _w + 2 * _h;
                    _rect.style.strokeDashoffset = 2 * _w + 2 * _h + 10;
                }
            }, 100);
        }
    }
    SVGInitialsAnimation(svgInitials);

    window.addEventListener("resize", function () {
        SVGButtonsAnimation(svgRects);
    });
});