import { hasClass } from './polyfills.js'

console.log(hasClass)

const layout = document.querySelector('.horizontal-grid')
const list_button = document.querySelector('.layout-switch--list')
const grid_button = document.querySelector('.layout-switch--grid')

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

//toggle taxnomomy submenu
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









