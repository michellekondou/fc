/* Disable minification (remove `.min` from URL path) for more info */

(function (undefined) { }).call('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});

// PolyFill for "isIntersecting"
// https://github.com/WICG/IntersectionObserver/issues/211#issuecomment-309144669
if ('IntersectionObserver' in window &&
    'IntersectionObserverEntry' in window &&
    'intersectionRatio' in window.IntersectionObserverEntry.prototype &&
    !('isIntersecting' in IntersectionObserverEntry.prototype)) {

    Object.defineProperty(window.IntersectionObserverEntry.prototype, 'isIntersecting', {
        get: function () {
            return this.intersectionRatio > 0
        }
    })
}

class IOlazy {

    constructor( { image = '.lazyload', threshold = .006, rootMargin = '0px' } = {} ) {

        this.threshold = threshold;
        this.rootMargin = rootMargin;
        this.image = document.querySelectorAll(image);
        // the intersection observer
        this.observer = new IntersectionObserver( ::this.handleChange, {
            threshold: [ this.threshold ],
            rootMargin:  this.rootMargin
        });

        this.lazyLoad();
    }

    handleChange(changes) {

        changes.forEach(change => {
            if (change.isIntersecting) {

                change.target.classList.add('fade-in')

                if (change.target.parentNode.getElementsByClassName('loader-2').length > 0) {
                    change.target.parentNode.getElementsByClassName('loader-2')[0].style.display = 'none';
                }

                if ( change.target.getAttribute('data-srcset') ) {
                    change.target.srcset = change.target.getAttribute('data-srcset');
                }

                if ( change.target.getAttribute('data-src') ) {
                    change.target.src = change.target.getAttribute('data-src');
                }

                this.observer.unobserve(change.target);
            }
        });
    }

    lazyLoad() {

        this.image.forEach( img => {
            this.observer.observe(img);
        })
    }
}



document.addEventListener("DOMContentLoaded", function () {

    const allLazyLoad = document.querySelectorAll('.lazyload');

    var isIE11 = /Trident.*rv[ :]*11\./.test(navigator.userAgent);
    var IE = (function () {
        "use strict";

        var ret, isTheBrowser,
            actualVersion,
            jscriptMap, jscriptVersion;

        isTheBrowser = false;
        jscriptMap = {
            "5.5": "5.5",
            "5.6": "6",
            "5.7": "7",
            "5.8": "8",
            "9": "9",
            "10": "10"
        };
        jscriptVersion = new Function("/*@cc_on return @_jscript_version; @*/")();

        if (jscriptVersion !== undefined) {
            isTheBrowser = true;
            actualVersion = jscriptMap[jscriptVersion];
        }

        ret = {
            isTheBrowser: isTheBrowser,
            actualVersion: actualVersion
        }; 
        
        return ret;
    }());

    
 
    Array.from(allLazyLoad).forEach(item => {
        if (window.innerWidth <= 768 && window.innerWidth > 490) {
            item.setAttribute('width', '600');
            item.setAttribute('height', item.getAttribute('data-mobile-height'));
        }
        if (isIE11 || IE.isTheBrowser) {
            item.setAttribute('src', item.getAttribute('data-ie')); 
            item.parentNode.getElementsByClassName('loader-2')[0].style.display = 'none';
            item.setAttribute('class', '');
        }

        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf('safari') != -1) {
            if (ua.indexOf('chrome') > -1) {
             
            } else {
                console.log("safari") // Safari
                item.setAttribute('src', item.getAttribute('data-ie'));
                item.parentNode.getElementsByClassName('loader-2')[0].style.display = 'none';
                item.setAttribute('class', '');
            }
        }
    });

    if ('IntersectionObserver' in window) {
        new IOlazy({
            image: '.lazyload',
            threshold: 0.06
        });
    } 
    
});

