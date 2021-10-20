document.addEventListener("DOMContentLoaded", function () {
  
    document.querySelector('.header-menu-icon').addEventListener('click', (event) => {
      const menuElem = document.querySelector('.header-menu-icon');
      const menuContentElem = document.querySelector('.header-menu');
      if(menuElem.classList.contains('open')) {
        menuElem.classList.remove('open');
        menuElem.classList.add('close');
      } else {
        menuElem.classList.remove('close');
        menuElem.classList.add('open');
      }
      if(menuContentElem.classList.contains('open')) {
        menuContentElem.classList.remove('open');
      } else {
        menuContentElem.classList.add('open');
      }
      // console.log(event.target.classList);
    });
    document.querySelector('.trigger-open').addEventListener('click', (event) => {
        event.preventDefault();
        const clickedElem = event.target.closest('.trigger-open');
        const parentElem = clickedElem.closest('.trigger-openable');
        if(parentElem.classList.contains('open')) {
            parentElem.classList.remove('open');
            parentElem.classList.add('close');
        } else {
            parentElem.classList.add('open');
            if(parentElem.classList.contains('close')) {
              parentElem.classList.remove('close');
            }
        }
    })
});