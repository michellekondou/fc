import { hasClass } from './polyfills.js'


const layout = document.querySelector('.horizontal-grid')
const list_button = document.querySelector('.layout-switch--list')
const grid_button = document.querySelector('.layout-switch--grid')

if (list_button !== null) {

    layout.classList.remove('visually-hidden')
    layout.classList.add('fade-in')

    //set local storage
    list_button.addEventListener('click', ((e) => {
        grid_button.classList.remove('selected')
        //add list class to collection archive container
        e.target.classList.add('selected')
        layout.classList.add('list-layout')
        //set layout=list in local storage
        localStorage.setItem('layout', 'list')
        //console.log(localStorage.getItem('layout'))
    }))

    grid_button.addEventListener('click', ((e) => {
        list_button.classList.remove('selected')
        e.target.classList.add('selected')
        layout.classList.remove('list-layout')
        //remove and clear local storage
        localStorage.removeItem('layout')
        localStorage.clear()
        //console.log('storage cleared')
    }))


    if(localStorage.getItem('layout')) {
        //console.log('local storage set: ',localStorage.getItem('layout'))
        layout.classList.add('list-layout')
        grid_button.classList.remove('selected')
        list_button.classList.add('selected')
    }

}

// //toggle taxnomomy submenu
const dropdown_toggle = document.querySelectorAll('.dropdown-toggle')
const dropdown_menus = document.querySelectorAll('.dropdown-menu')

Array.from(dropdown_toggle).forEach(el => el.addEventListener('click', (e) => {
    const dropdown_toggle_icon = el.querySelector('.icon')
    
    Array.from(dropdown_menus).filter(el => {
        if(el.getAttribute('data-source') === e.target.getAttribute('data-target')) {
            el.classList.toggle('open')
            dropdown_toggle_icon.classList.toggle('rotated')
            e.target.classList.toggle('active')
        } else {
            el.classList.remove('open')
            const elParent = el.closest('.dropdown')
            const anchor = elParent.children[0]
            const icon = elParent.children[0].querySelector('.icon')
            console.log(anchor)
            anchor.classList.remove('active')
            icon.classList.remove('rotated')
        }
    })

}) )


// //keyboard navigation in collection
document.addEventListener('keydown', (event) => {
    const keyName = event.key
    const keyCode = event.keyCode
    const nav_prev_link = document.querySelector('.nav-previous a')
    const nav_next_link = document.querySelector('.nav-next a')

    if (keyName === 'Control') {
        // do not alert when only Control key is pressed.
        return;
    }

    let post_navigation_link = false;

    if (nav_prev_link !== null) {
        if (keyName === 'ArrowRight' || keyCode === '39') {
            post_navigation_link = nav_prev_link.getAttribute('href')
        }
    } 
    if (nav_next_link !== null) {
        if (keyName === 'ArrowLeft' || keyCode === '37') {
            post_navigation_link = nav_next_link.getAttribute('href')
        }
    }

    if (post_navigation_link) {
        window.location = post_navigation_link;
    }

}, false);


// //photoswipe
document.addEventListener("DOMContentLoaded", function () {
    // var flickity_img = document.querySelectorAll('.carousel-cell');
    //----Start PhotoSwipe
    var initPhotoSwipeFromDOM = function (gallerySelector) {

        var parseThumbnailElements = function (el) {

            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for (var i = 0; i < numNodes; i++) {
                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes 
                if (figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element
                console.log(linkEl)
                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if (figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if (linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('data-ie');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function (e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function (el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if (!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if (index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function () {
            var hash = window.location.hash.substring(1),
                params = {};

            if (hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if (!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if (pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if (params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function (index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
                }

            };

            // PhotoSwipe opened from URL
            if (fromURL) {
                if (options.galleryPIDs) {
                    // parse real index when custom PIDs are used 
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for (var j = 0; j < items.length; j++) {
                        if (items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll(gallerySelector);

        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if (hashData.pid && hashData.gid) {
            openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
        }
    };


    initPhotoSwipeFromDOM('.magnifiable');

});
// //set the images in collection to resize to the size of the viewport
window.addEventListener('load', () => {

    const imageContainer = document.querySelector('.artwork .post-thumbnail')
    if (imageContainer !== null) {
        const imageContainerPortrait = document.querySelector('.artwork.portrait .post-thumbnail')
        const imageContainerLandscape = document.querySelector('.artwork.landscape .post-thumbnail')
        const imageContainerTop = imageContainer.getBoundingClientRect().top
        const viewportHeight = (window.innerHeight || document.documentElement.clientHeight)
        const imageContainerHeight = (viewportHeight - imageContainerTop - 25)
        const artworkDetails = document.querySelector('.artwork .detail-container')

        if (imageContainerPortrait !== null) {
            imageContainer.style.height = imageContainerHeight + 'px'
        }

        if (imageContainerLandscape !== null) {
            if (parseInt(imageContainerLandscape.style.height) < imageContainerHeight) {
                return;
            } else {
                imageContainerLandscape.style.height = imageContainerHeight + 'px'
            }
        }
    }
    

})







