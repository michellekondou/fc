webpackHotUpdate(3,{89:function(e,t,s){"use strict";s.r(t);var l=s(23),o=s.n(l),a=s(36);console.log(a.hasClass);var c=document.querySelector(".horizontal-grid"),r=document.querySelector(".layout-switch--list"),i=document.querySelector(".layout-switch--grid");c.classList.remove("visually-hidden"),c.classList.add("fade-in"),r.addEventListener("click",function(e){i.classList.remove("selected"),e.target.classList.add("selected"),c.classList.add("list-layout"),localStorage.setItem("layout","list")}),i.addEventListener("click",function(e){r.classList.remove("selected"),e.target.classList.add("selected"),c.classList.remove("list-layout"),localStorage.removeItem("layout"),localStorage.clear()}),localStorage.getItem("layout")&&(c.classList.add("list-layout"),i.classList.remove("selected"),r.classList.add("selected"));var d=document.querySelectorAll(".dropdown-toggle"),n=document.querySelectorAll(".dropdown-menu");o()(d).forEach(function(e){return e.addEventListener("click",function(t){var s=e.querySelector(".icon");o()(n).filter(function(e){if(e.getAttribute("data-source")===t.target.getAttribute("data-target"))e.classList.toggle("open"),s.classList.toggle("rotated"),t.target.classList.toggle("active");else{e.classList.remove("open");var l=e.closest(".dropdown"),o=l.children[0],a=l.children[0].querySelector(".icon");console.log(o),o.classList.remove("active"),a.classList.remove("rotated")}})})})}});