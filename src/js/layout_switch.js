const layout = document.querySelector('.horizontal-grid')
const list_button = document.querySelector('.layout-switch--list');
const grid_button = document.querySelector('.layout-switch--grid');

layout.classList.remove('visually-hidden')
layout.classList.add('fade-in')

//set local storage
console.log('29', localStorage.getItem('layout'))

list_button.addEventListener('click', ((e) => {
    //add list class to collection archive container
    layout.classList.add('list-layout')
    //set layout=list in local storage
    localStorage.setItem('layout', 'list');
    console.log(localStorage.getItem('layout'))
}))

grid_button.addEventListener('click', ((e) => {
    layout.classList.remove('list-layout')
    //remove and clear local storage
    localStorage.removeItem('layout');
    localStorage.clear();
    console.log('storage cleared')
}))

if(localStorage.getItem('layout')) {
    console.log('local storage set: ',localStorage.getItem('layout'))
    layout.classList.add('list-layout')
}







