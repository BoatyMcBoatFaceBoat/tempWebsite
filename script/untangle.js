const c = function (descrip, something) {
  return console.log(`${descrip}:  ${something}`);
}

const $ = function (queryName) {
  return document.querySelector(queryName);
}

const $$ = function (queryName) {
  return document.querySelectorAll(queryName);
}

function loadWebsite() {
  // let touch = false;
  // if (!("ontouchstart" in document.documentElement)) {
  //   document.documentElement.className += " no-touch";
  // } else {
  //   touch = true;
  // }
  //deprecated

  const plus = $('.readmore-elm');
  const minus = $('.readless-elm');
  const text = $('.more-content');
  const toggleElmClasses = ['contact-element', 'lang'];

  if (plus) {
    plus.classList.add('show');
    plus.addEventListener('click', () => {
      text.classList.toggle('show', true);
      plus.classList.toggle('show', false);
      minus.classList.toggle('show', true);
    })

    minus.addEventListener('click', () => {
      text.classList.toggle('show', false);
      plus.classList.toggle('show', true);
      minus.classList.toggle('show', false);
    })
  }

  toggleElmClasses.forEach(elmClass => {
    // if (touch) {
    //   addToggleTo(elmClass);
    //  } else {
    //   addMouseoverTo(elmClass);

       addToggleAndHoverTo(elmClass);
    // }
  })
}







function addToggleAndHoverTo(className) {
  const domEl = $(`.${className}`);
  if (!domEl) { return; }
  let isOpen = false;
  let clicked = false;

 

  domEl.addEventListener('mouseover', () => {
    if(clicked) return;
    isOpen = true;
    domEl.classList.add('open');
  })

  domEl.addEventListener('mouseout', () => {
    if(clicked) return;
    isOpen = false;
    domEl.classList.remove('open');
  })

  domEl.addEventListener('click', () => {
    clicked = true;
    domEl.removeEventLister
    isOpen = !isOpen;
    domEl.classList.toggle('open', isOpen);
  })
  
  document.addEventListener('click', ({target}) => {
    if(!(target.closest(`.${className}`))) {
      isOpen = false;
      domEl.classList.toggle('open', false);
    }
  })

}



function addToggleTo(className){
  const domEl = $(`.${className}`);
  if (!domEl) { return; }
  let isOpen = false;

  domEl.addEventListener('click', () => {
    isOpen = !isOpen;
    domEl.classList.toggle('open', isOpen);
  })
  
  document.addEventListener('click', ({target}) => {
    if(!(target.closest(`.${className}`))) {
      isOpen = false;
      domEl.classList.toggle('open', false);
    }
  })
}



function addMouseoverTo(className){
  const domEl = $(`.${className}`);
  if (!(domEl)) { return; }
  domEl.addEventListener('mouseover', () => {
    domEl.classList.add('open');
  })

  domEl.addEventListener('mouseout', () => {
    domEl.classList.remove('open');
  })
}
