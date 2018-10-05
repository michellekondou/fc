!function(e){var t=window.webpackHotUpdate;window.webpackHotUpdate=function(e,n){!function(e,t){if(_[e]&&b[e]){for(var n in b[e]=!1,t)Object.prototype.hasOwnProperty.call(t,n)&&(f[n]=t[n]);0==--g&&0===v&&O()}}(e,n),t&&t(e,n)};var n,r=!0,o="0ece386e58cca652e7fa",i=1e4,s={},c=[],a=[];function d(e){var t=R[e];if(!t)return L;var r=function(r){return t.hot.active?(R[r]?-1===R[r].parents.indexOf(e)&&R[r].parents.push(e):(c=[e],n=r),-1===t.children.indexOf(r)&&t.children.push(r)):(console.warn("[HMR] unexpected require("+r+") from disposed module "+e),c=[]),L(r)},o=function(e){return{configurable:!0,enumerable:!0,get:function(){return L[e]},set:function(t){L[e]=t}}};for(var i in L)Object.prototype.hasOwnProperty.call(L,i)&&"e"!==i&&"t"!==i&&Object.defineProperty(r,i,o(i));return r.e=function(e){return"ready"===u&&h("prepare"),v++,L.e(e).then(t,function(e){throw t(),e});function t(){v--,"prepare"===u&&(y[e]||I(e),0===v&&0===g&&O())}},r.t=function(e,t){return 1&t&&(e=r(e)),L.t(e,-2&t)},r}var l=[],u="idle";function h(e){u=e;for(var t=0;t<l.length;t++)l[t].call(null,e)}var p,f,m,g=0,v=0,y={},b={},_={};function w(e){return+e+""===e?+e:e}function E(e){if("idle"!==u)throw new Error("check() is only allowed in idle status");return r=e,h("check"),(t=i,t=t||1e4,new Promise(function(e,n){if("undefined"==typeof XMLHttpRequest)return n(new Error("No browser support"));try{var r=new XMLHttpRequest,i=L.p+""+o+".hot-update.json";r.open("GET",i,!0),r.timeout=t,r.send(null)}catch(e){return n(e)}r.onreadystatechange=function(){if(4===r.readyState)if(0===r.status)n(new Error("Manifest request to "+i+" timed out."));else if(404===r.status)e();else if(200!==r.status&&304!==r.status)n(new Error("Manifest request to "+i+" failed."));else{try{var t=JSON.parse(r.responseText)}catch(t){return void n(t)}e(t)}}})).then(function(e){if(!e)return h("idle"),null;b={},y={},_=e.c,m=e.h,h("prepare");var t=new Promise(function(e,t){p={resolve:e,reject:t}});return f={},I(0),"prepare"===u&&0===v&&0===g&&O(),t});var t}function I(e){var t,n,r;_[e]?(b[e]=!0,g++,t=e,n=document.getElementsByTagName("head")[0],(r=document.createElement("script")).charset="utf-8",r.src=L.p+""+t+"."+o+".hot-update.js",n.appendChild(r)):y[e]=!0}function O(){h("ready");var e=p;if(p=null,e)if(r)Promise.resolve().then(function(){return T(r)}).then(function(t){e.resolve(t)},function(t){e.reject(t)});else{var t=[];for(var n in f)Object.prototype.hasOwnProperty.call(f,n)&&t.push(w(n));e.resolve(t)}}function T(t){if("ready"!==u)throw new Error("apply() is only allowed in ready status");var n,r,i,a,d;function l(e){for(var t=[e],n={},r=t.slice().map(function(e){return{chain:[e],id:e}});0<r.length;){var o=r.pop(),i=o.id,s=o.chain;if((a=R[i])&&!a.hot._selfAccepted){if(a.hot._selfDeclined)return{type:"self-declined",chain:s,moduleId:i};if(a.hot._main)return{type:"unaccepted",chain:s,moduleId:i};for(var c=0;c<a.parents.length;c++){var d=a.parents[c],l=R[d];if(l){if(l.hot._declinedDependencies[i])return{type:"declined",chain:s.concat([d]),moduleId:i,parentId:d};-1===t.indexOf(d)&&(l.hot._acceptedDependencies[i]?(n[d]||(n[d]=[]),p(n[d],[i])):(delete n[d],t.push(d),r.push({chain:s.concat([d]),id:d})))}}}}return{type:"accepted",moduleId:e,outdatedModules:t,outdatedDependencies:n}}function p(e,t){for(var n=0;n<t.length;n++){var r=t[n];-1===e.indexOf(r)&&e.push(r)}}t=t||{};var g={},v=[],y={},b=function(){console.warn("[HMR] unexpected require("+I.moduleId+") to disposed module")};for(var E in f)if(Object.prototype.hasOwnProperty.call(f,E)){var I;d=w(E);var O=!1,T=!1,x=!1,M="";switch((I=f[E]?l(d):{type:"disposed",moduleId:E}).chain&&(M="\nUpdate propagation: "+I.chain.join(" -> ")),I.type){case"self-declined":t.onDeclined&&t.onDeclined(I),t.ignoreDeclined||(O=new Error("Aborted because of self decline: "+I.moduleId+M));break;case"declined":t.onDeclined&&t.onDeclined(I),t.ignoreDeclined||(O=new Error("Aborted because of declined dependency: "+I.moduleId+" in "+I.parentId+M));break;case"unaccepted":t.onUnaccepted&&t.onUnaccepted(I),t.ignoreUnaccepted||(O=new Error("Aborted because "+d+" is not accepted"+M));break;case"accepted":t.onAccepted&&t.onAccepted(I),T=!0;break;case"disposed":t.onDisposed&&t.onDisposed(I),x=!0;break;default:throw new Error("Unexception type "+I.type)}if(O)return h("abort"),Promise.reject(O);if(T)for(d in y[d]=f[d],p(v,I.outdatedModules),I.outdatedDependencies)Object.prototype.hasOwnProperty.call(I.outdatedDependencies,d)&&(g[d]||(g[d]=[]),p(g[d],I.outdatedDependencies[d]));x&&(p(v,[I.moduleId]),y[d]=b)}var D,k=[];for(r=0;r<v.length;r++)d=v[r],R[d]&&R[d].hot._selfAccepted&&k.push({module:d,errorHandler:R[d].hot._selfAccepted});h("dispose"),Object.keys(_).forEach(function(e){!1===_[e]&&delete installedChunks[e]});for(var A,S,N=v.slice();0<N.length;)if(d=N.pop(),a=R[d]){var P={},j=a.hot._disposeHandlers;for(i=0;i<j.length;i++)(n=j[i])(P);for(s[d]=P,a.hot.active=!1,delete R[d],delete g[d],i=0;i<a.children.length;i++){var H=R[a.children[i]];H&&0<=(D=H.parents.indexOf(d))&&H.parents.splice(D,1)}}for(d in g)if(Object.prototype.hasOwnProperty.call(g,d)&&(a=R[d]))for(S=g[d],i=0;i<S.length;i++)A=S[i],0<=(D=a.children.indexOf(A))&&a.children.splice(D,1);for(d in h("apply"),o=m,y)Object.prototype.hasOwnProperty.call(y,d)&&(e[d]=y[d]);var C=null;for(d in g)if(Object.prototype.hasOwnProperty.call(g,d)&&(a=R[d])){S=g[d];var q=[];for(r=0;r<S.length;r++)if(A=S[r],n=a.hot._acceptedDependencies[A]){if(-1!==q.indexOf(n))continue;q.push(n)}for(r=0;r<q.length;r++){n=q[r];try{n(S)}catch(n){t.onErrored&&t.onErrored({type:"accept-errored",moduleId:d,dependencyId:S[r],error:n}),t.ignoreErrored||C||(C=n)}}}for(r=0;r<k.length;r++){var U=k[r];d=U.module,c=[d];try{L(d)}catch(r){if("function"==typeof U.errorHandler)try{U.errorHandler(r)}catch(n){t.onErrored&&t.onErrored({type:"self-accept-error-handler-errored",moduleId:d,error:n,originalError:r}),t.ignoreErrored||C||(C=n),C||(C=r)}else t.onErrored&&t.onErrored({type:"self-accept-errored",moduleId:d,error:r}),t.ignoreErrored||C||(C=r)}}return C?(h("fail"),Promise.reject(C)):(h("idle"),new Promise(function(e){e(v)}))}var R={};function L(t){if(R[t])return R[t].exports;var r,o,i=R[t]={i:t,l:!1,exports:{},hot:(r=t,o={_acceptedDependencies:{},_declinedDependencies:{},_selfAccepted:!1,_selfDeclined:!1,_disposeHandlers:[],_main:n!==r,active:!0,accept:function(e,t){if(void 0===e)o._selfAccepted=!0;else if("function"==typeof e)o._selfAccepted=e;else if("object"==typeof e)for(var n=0;n<e.length;n++)o._acceptedDependencies[e[n]]=t||function(){};else o._acceptedDependencies[e]=t||function(){}},decline:function(e){if(void 0===e)o._selfDeclined=!0;else if("object"==typeof e)for(var t=0;t<e.length;t++)o._declinedDependencies[e[t]]=!0;else o._declinedDependencies[e]=!0},dispose:function(e){o._disposeHandlers.push(e)},addDisposeHandler:function(e){o._disposeHandlers.push(e)},removeDisposeHandler:function(e){var t=o._disposeHandlers.indexOf(e);0<=t&&o._disposeHandlers.splice(t,1)},check:E,apply:T,status:function(e){if(!e)return u;l.push(e)},addStatusHandler:function(e){l.push(e)},removeStatusHandler:function(e){var t=l.indexOf(e);0<=t&&l.splice(t,1)},data:s[r]},n=void 0,o),parents:(a=c,c=[],a),children:[]};return e[t].call(i.exports,i,i.exports,d(t)),i.l=!0,i.exports}L.m=e,L.c=R,L.d=function(e,t,n){L.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},L.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},L.t=function(e,t){if(1&t&&(e=L(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(L.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)L.d(n,r,function(t){return e[t]}.bind(null,r));return n},L.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return L.d(t,"a",t),t},L.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},L.p="/public",L.h=function(){return o},d(62)(L.s=62)}({36:function(e,t,n){"use strict";n.r(t),n.d(t,"hasClass",function(){return r}),window.NodeList&&!NodeList.prototype.forEach&&(NodeList.prototype.forEach=function(e,t){t=t||window;for(var n=0;n<this.length;n++)e.call(t,this[n],n,this)}),Element.prototype.matches=Element.prototype.webkitMatchesSelector||Element.prototype.oMatchesSelector||Element.prototype.msMatchesSelector||Element.prototype.mozMatchesSelector||function(e){for(var t=(this.document||this.ownerDocument).querySelectorAll(e),n=0;t[n]&&t[n]!==this;)++n;return!!t[n]},Element.prototype.closest=function(e){for(var t=this;t;){if(t.matches(e))return t;t="SVGElement"in window&&t instanceof SVGElement?t.parentNode:t.parentElement}return null},
/*! @source http://purl.eligrey.com/github/classList.js/blob/master/classList.js */
"document"in self&&("classList"in document.createElement("_")&&(!document.createElementNS||"classList"in document.createElementNS("http://www.w3.org/2000/svg","g"))||function(e){if("Element"in e){var t="classList",n="prototype",r=e.Element[n],o=Object,i=String[n].trim||function(){return this.replace(/^\s+|\s+$/g,"")},s=Array[n].indexOf||function(e){for(var t=0,n=this.length;t<n;t++)if(t in this&&this[t]===e)return t;return-1},c=function(e,t){this.name=e,this.code=DOMException[e],this.message=t},a=function(e,t){if(""===t)throw new c("SYNTAX_ERR","The token must not be empty.");if(/\s/.test(t))throw new c("INVALID_CHARACTER_ERR","The token must not contain space characters.");return s.call(e,t)},d=function(e){for(var t=i.call(e.getAttribute("class")||""),n=t?t.split(/\s+/):[],r=0,o=n.length;r<o;r++)this.push(n[r]);this._updateClassName=function(){e.setAttribute("class",this.toString())}},l=d[n]=[],u=function(){return new d(this)};if(c[n]=Error[n],l.item=function(e){return this[e]||null},l.contains=function(e){return~a(this,e+"")},l.add=function(){for(var e,t=arguments,n=0,r=t.length,o=!1;e=t[n]+"",~a(this,e)||(this.push(e),o=!0),++n<r;);o&&this._updateClassName()},l.remove=function(){var e,t,n=arguments,r=0,o=n.length,i=!1;do{for(e=n[r]+"",t=a(this,e);~t;)this.splice(t,1),i=!0,t=a(this,e)}while(++r<o);i&&this._updateClassName()},l.toggle=function(e,t){var n=this.contains(e),r=n?!0!==t&&"remove":!1!==t&&"add";return r&&this[r](e),!0===t||!1===t?t:!n},l.replace=function(e,t){var n=a(e+"");~n&&(this.splice(n,1,t),this._updateClassName())},l.toString=function(){return this.join(" ")},o.defineProperty){var h={get:u,enumerable:!0,configurable:!0};try{o.defineProperty(r,t,h)}catch(e){void 0!==e.number&&-2146823252!==e.number||(h.enumerable=!1,o.defineProperty(r,t,h))}}else o[n].__defineGetter__&&r.__defineGetter__(t,u)}}(self),function(){var e=document.createElement("_");if(e.classList.add("c1","c2"),!e.classList.contains("c2")){var t=function(e){var t=DOMTokenList.prototype[e];DOMTokenList.prototype[e]=function(e){var n,r=arguments.length;for(n=0;n<r;n++)e=arguments[n],t.call(this,e)}};t("add"),t("remove")}if(e.classList.toggle("c3",!1),e.classList.contains("c3")){var n=DOMTokenList.prototype.toggle;DOMTokenList.prototype.toggle=function(e,t){return 1 in arguments&&!this.contains(e)==!t?t:n.call(this,e)}}"replace"in document.createElement("_").classList||(DOMTokenList.prototype.replace=function(e,t){var n=this.toString().split(" "),r=n.indexOf(e+"");~r&&(n=n.slice(r),this.remove.apply(this,n),this.add(t),this.add.apply(this,n.slice(1)))}),e=null}()),-1!=navigator.userAgent.indexOf("Safari")&&-1!=navigator.userAgent.indexOf("Mac")&&-1==navigator.userAgent.indexOf("Chrome")&&document.documentElement.classList.add("safari-mac"),function(e,t){if("IntersectionObserver"in e&&"IntersectionObserverEntry"in e&&"intersectionRatio"in e.IntersectionObserverEntry.prototype)"isIntersecting"in e.IntersectionObserverEntry.prototype||Object.defineProperty(e.IntersectionObserverEntry.prototype,"isIntersecting",{get:function(){return 0<this.intersectionRatio}});else{var n=[];o.prototype.THROTTLE_TIMEOUT=100,o.prototype.POLL_INTERVAL=null,o.prototype.USE_MUTATION_OBSERVER=!0,o.prototype.observe=function(e){if(!this._observationTargets.some(function(t){return t.element==e})){if(!e||1!=e.nodeType)throw new Error("target must be an Element");this._registerInstance(),this._observationTargets.push({element:e,entry:null}),this._monitorIntersections(),this._checkForIntersections()}},o.prototype.unobserve=function(e){this._observationTargets=this._observationTargets.filter(function(t){return t.element!=e}),this._observationTargets.length||(this._unmonitorIntersections(),this._unregisterInstance())},o.prototype.disconnect=function(){this._observationTargets=[],this._unmonitorIntersections(),this._unregisterInstance()},o.prototype.takeRecords=function(){var e=this._queuedEntries.slice();return this._queuedEntries=[],e},o.prototype._initThresholds=function(e){var t=e||[0];return Array.isArray(t)||(t=[t]),t.sort().filter(function(e,t,n){if("number"!=typeof e||isNaN(e)||e<0||1<e)throw new Error("threshold must be a number between 0 and 1 inclusively");return e!==n[t-1]})},o.prototype._parseRootMargin=function(e){var t=(e||"0px").split(/\s+/).map(function(e){var t=/^(-?\d*\.?\d+)(px|%)$/.exec(e);if(!t)throw new Error("rootMargin must be specified in pixels or percent");return{value:parseFloat(t[1]),unit:t[2]}});return t[1]=t[1]||t[0],t[2]=t[2]||t[0],t[3]=t[3]||t[1],t},o.prototype._monitorIntersections=function(){this._monitoringIntersections||(this._monitoringIntersections=!0,this.POLL_INTERVAL?this._monitoringInterval=setInterval(this._checkForIntersections,this.POLL_INTERVAL):(i(e,"resize",this._checkForIntersections,!0),i(t,"scroll",this._checkForIntersections,!0),this.USE_MUTATION_OBSERVER&&"MutationObserver"in e&&(this._domObserver=new MutationObserver(this._checkForIntersections),this._domObserver.observe(t,{attributes:!0,childList:!0,characterData:!0,subtree:!0}))))},o.prototype._unmonitorIntersections=function(){this._monitoringIntersections&&(this._monitoringIntersections=!1,clearInterval(this._monitoringInterval),this._monitoringInterval=null,s(e,"resize",this._checkForIntersections,!0),s(t,"scroll",this._checkForIntersections,!0),this._domObserver&&(this._domObserver.disconnect(),this._domObserver=null))},o.prototype._checkForIntersections=function(){var t=this._rootIsInDom(),n=t?this._getRootRect():{top:0,bottom:0,left:0,right:0,width:0,height:0};this._observationTargets.forEach(function(o){var i=o.element,s=c(i),a=this._rootContainsTarget(i),d=o.entry,l=t&&a&&this._computeTargetAndRootIntersection(i,n),u=o.entry=new r({time:e.performance&&performance.now&&performance.now(),target:i,boundingClientRect:s,rootBounds:n,intersectionRect:l});d?t&&a?this._hasCrossedThreshold(d,u)&&this._queuedEntries.push(u):d&&d.isIntersecting&&this._queuedEntries.push(u):this._queuedEntries.push(u)},this),this._queuedEntries.length&&this._callback(this.takeRecords(),this)},o.prototype._computeTargetAndRootIntersection=function(n,r){if("none"!=e.getComputedStyle(n).display){for(var o,i,s,a,l,u,h,p,f=c(n),m=d(n),g=!1;!g;){var v=null,y=1==m.nodeType?e.getComputedStyle(m):{};if("none"==y.display)return;if(m==this.root||m==t?(g=!0,v=r):m!=t.body&&m!=t.documentElement&&"visible"!=y.overflow&&(v=c(m)),v&&(o=v,i=f,s=Math.max(o.top,i.top),a=Math.min(o.bottom,i.bottom),l=Math.max(o.left,i.left),p=a-s,!(f=0<=(h=(u=Math.min(o.right,i.right))-l)&&0<=p&&{top:s,bottom:a,left:l,right:u,width:h,height:p})))break;m=d(m)}return f}},o.prototype._getRootRect=function(){var e;if(this.root)e=c(this.root);else{var n=t.documentElement,r=t.body;e={top:0,left:0,right:n.clientWidth||r.clientWidth,width:n.clientWidth||r.clientWidth,bottom:n.clientHeight||r.clientHeight,height:n.clientHeight||r.clientHeight}}return this._expandRectByRootMargin(e)},o.prototype._expandRectByRootMargin=function(e){var t=this._rootMarginValues.map(function(t,n){return"px"==t.unit?t.value:t.value*(n%2?e.width:e.height)/100}),n={top:e.top-t[0],right:e.right+t[1],bottom:e.bottom+t[2],left:e.left-t[3]};return n.width=n.right-n.left,n.height=n.bottom-n.top,n},o.prototype._hasCrossedThreshold=function(e,t){var n=e&&e.isIntersecting?e.intersectionRatio||0:-1,r=t.isIntersecting?t.intersectionRatio||0:-1;if(n!==r)for(var o=0;o<this.thresholds.length;o++){var i=this.thresholds[o];if(i==n||i==r||i<n!=i<r)return!0}},o.prototype._rootIsInDom=function(){return!this.root||a(t,this.root)},o.prototype._rootContainsTarget=function(e){return a(this.root||t,e)},o.prototype._registerInstance=function(){n.indexOf(this)<0&&n.push(this)},o.prototype._unregisterInstance=function(){var e=n.indexOf(this);-1!=e&&n.splice(e,1)},e.IntersectionObserver=o,e.IntersectionObserverEntry=r}function r(e){this.time=e.time,this.target=e.target,this.rootBounds=e.rootBounds,this.boundingClientRect=e.boundingClientRect,this.intersectionRect=e.intersectionRect||{top:0,bottom:0,left:0,right:0,width:0,height:0},this.isIntersecting=!!e.intersectionRect;var t=this.boundingClientRect,n=t.width*t.height,r=this.intersectionRect,o=r.width*r.height;this.intersectionRatio=n?o/n:this.isIntersecting?1:0}function o(e,t){var n,r,o,i=t||{};if("function"!=typeof e)throw new Error("callback must be a function");if(i.root&&1!=i.root.nodeType)throw new Error("root must be an Element");this._checkForIntersections=(n=this._checkForIntersections.bind(this),r=this.THROTTLE_TIMEOUT,o=null,function(){o||(o=setTimeout(function(){n(),o=null},r))}),this._callback=e,this._observationTargets=[],this._queuedEntries=[],this._rootMarginValues=this._parseRootMargin(i.rootMargin),this.thresholds=this._initThresholds(i.threshold),this.root=i.root||null,this.rootMargin=this._rootMarginValues.map(function(e){return e.value+e.unit}).join(" ")}function i(e,t,n,r){"function"==typeof e.addEventListener?e.addEventListener(t,n,r||!1):"function"==typeof e.attachEvent&&e.attachEvent("on"+t,n)}function s(e,t,n,r){"function"==typeof e.removeEventListener?e.removeEventListener(t,n,r||!1):"function"==typeof e.detatchEvent&&e.detatchEvent("on"+t,n)}function c(e){var t;try{t=e.getBoundingClientRect()}catch(e){}return t?(t.width&&t.height||(t={top:t.top,right:t.right,bottom:t.bottom,left:t.left,width:t.right-t.left,height:t.bottom-t.top}),t):{top:0,bottom:0,left:0,right:0,width:0,height:0}}function a(e,t){for(var n=t;n;){if(n==e)return!0;n=d(n)}return!1}function d(e){var t=e.parentNode;return t&&11==t.nodeType&&t.host?t.host:t}}(window,document),window.addEventListener("load",function(){var e=0,t=document.querySelector(".main-navigation");document.body.getBoundingClientRect().top<=-60&&(t.classList.add("sticky"),t.classList.add("slide-down")),window.addEventListener("scroll",function(){var n=t.getBoundingClientRect().top,r=document.body.getBoundingClientRect().top;e<r?20<=r&&(document.querySelector(".site-main").classList.remove("sticky-state"),t.classList.remove("sticky"),t.classList.remove("slide-down")):n<=-160&&(document.querySelector(".site-main").classList.add("sticky-state"),t.classList.add("sticky"),t.classList.add("slide-down")),e=r})});var r=function(e,t){return-1<(" "+e.className+" ").indexOf(" "+t+" ")};document.addEventListener("DOMContentLoaded",function(){!function(e){for(var t=function(e){(e=e||window.event).preventDefault?e.preventDefault():e.returnValue=!1;var t=function e(t,n){return t&&(n(t)?t:e(t.parentNode,n))}(e.target||e.srcElement,function(e){return"A"===e.tagName});if(t){for(var r,o=t.parentNode,i=t.parentNode.childNodes,s=i.length,c=0,a=0;a<s;a++)if(1===i[a].nodeType){if(i[a]===t){r=c;break}c++}return 0<=r&&n(r,o),!1}},n=function(e,t,n,r){var o,i,s,c=document.querySelectorAll(".pswp")[0];if(s=function(e){for(var t,n,r,o=e.childNodes,i=o.length,s=[],c=0;c<i;c++)if(1===(e=o[c]).nodeType){t=e.children,n=e.getAttribute("data-size").split("x"),(r={src:e.getAttribute("href"),w:parseInt(n[0],10),h:parseInt(n[1],10),author:e.getAttribute("data-author")}).el=e,0<t.length&&(r.msrc=t[0].children[0].getAttribute("data-ie"),1<t.length&&(r.title=t[0].children[1].innerHTML));var a=e.getAttribute("data-med");a&&(n=e.getAttribute("data-med-size").split("x"),r.m={src:a,w:parseInt(n[0],10),h:parseInt(n[1],10)}),r.o={src:r.src,w:r.w,h:r.h},s.push(r)}return s}(t),i={galleryUID:t.getAttribute("data-pswp-uid"),getThumbBoundsFn:function(e){var t=s[e].el.children[0],n=window.pageYOffset||document.documentElement.scrollTop,r=t.getBoundingClientRect();return{x:r.left,y:r.top+n,w:r.width}},addCaptionHTMLFn:function(e,t,n){return e.title?(t.children[0].innerHTML=e.title,!0):(t.children[0].innerText="",!1)}},r)if(i.galleryPIDs){for(var a=0;a<s.length;a++)if(s[a].pid==e){i.index=a;break}}else i.index=parseInt(e,10)-1;else i.index=parseInt(e,10);if(!isNaN(i.index)){n&&(i.showAnimationDuration=0);var d=!1,l=!0;(o=new PhotoSwipe(c,PhotoSwipeUI_Default,s,i)).listen("beforeResize",function(){var e=window.devicePixelRatio?window.devicePixelRatio:1;e=Math.min(e,2.5),o.viewportSize.x,(d=!0)&&!l&&o.invalidateCurrItems(),l&&(l=!1)}),o.listen("gettingData",function(e,t){t.h=d?(t.src=t.o.src,t.w=t.o.w,t.o.h):(t.src=t.m.src,t.w=t.m.w,t.m.h)}),o.init()}},r=document.querySelectorAll(".magnifiable"),o=0,i=r.length;o<i;o++)r[o].setAttribute("data-pswp-uid",o+1),r[o].onclick=t;var s=function(){var e=window.location.hash.substring(1),t={};if(e.length<5)return t;for(var n=e.split("&"),r=0;r<n.length;r++)if(n[r]){var o=n[r].split("=");o.length<2||(t[o[0]]=o[1])}return t.gid&&(t.gid=parseInt(t.gid,10)),t}();s.pid&&s.gid&&n(s.pid,r[s.gid-1],!0,!0)}()})},62:function(e,t,n){e.exports=n(36)}});