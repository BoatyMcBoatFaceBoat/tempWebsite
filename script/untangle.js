const c = function (descrip, something) {

  // return console.log(`${descrip}:  ${something}`);
}

const j = function (object) {
  // return console.log(JSON.stringify(object));
}

const $ = function (queryName) {
  return document.querySelector(queryName);
}

const $$ = function (queryName) {
  return document.querySelectorAll(queryName);
}


// hierarchy for href names:
const hierarchy = {
  name: 'home',
  children: [{
      name: 'excel',
      children: []
    },
    {
      name: 'consultancy',
      children: [{
          name: 'model',
          children: [{
            name: 'lang',
            children: []
          }]
        },
        {
          name: 'software',
          children: [{
              name: 'electron',
              children: []
            },
            {
              name: 'raku',
              children: []
            }
          ]
        }
      ]
    },

    {
      name: 'values',
      children: []
    },
    {
      name: 'team',
      children: []
    },
    {
      name: 'contact',
      children: []
    },
    {
      name: 'impressum',
      children: []
    },
    {
      name: 'partners',
      children: []
    }
  ]
};


function loadWebsite() {
  let touch = false;
  if (!("ontouchstart" in document.documentElement)) {
    document.documentElement.className += " no-touch";
  } else {
    touch = true;
  }

  // console.log('touchscreen? ' + touch);

  let plus = $('.readmore-elm');
  let minus = $('.readless-elm');
  let text = $('.more-content');
  let phone = $('.contact-element');
  let langMenu = $('.lang');

  if (plus) {
    plus.classList.add('show');

    plus.addEventListener('click', () => {
      // console.log('hellp')
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

  if (touch) {
    let openContact = false;
    let openLang = false;

    document.addEventListener('click', ({target}) => {

      if (target.classList.contains('clickable-contact-element')) {
        openContact = !openContact;
        if (phone) phone.classList.toggle('open', openContact);

      } else {
        openContact = false;
        if (phone) phone.classList.toggle('open', false);
      }

      // console.log(target)

      if (target.classList.contains('flag')) {
        openLang = !openLang;
        langMenu.classList.toggle('open', openLang);

      } else {
        openLang = false;
        langMenu.classList.toggle('open', false);
      }


    });

  
  
  } else if (phone)  {
    phone.addEventListener('mouseover', () => {
      // console.log('mouseover')
      phone.classList.add('open');
    })

    phone.addEventListener('mouseout', () => {
      phone.classList.remove('open');
    })
  }






}



// let loc = window.location.pathname;
// let addressArr = loc.replace(/\s*\/tempWebsite\//, "");
// let subj;
// let addArr = addressArr.split('/');
// console.log(addArr)  
// if(addArr.length > 1 ){
//   // lang = addressArr[0];
//   subj = addArr[1];
// } else {
//   subj = addArr[0];
// }

// function findRouteTo(locationName){
//   let res = [];

//   function findPath(pageName, obj = hierarchy, path = []) {
//     path.push(obj.name);
//     if (obj.name === pageName) {
//       return path;
//     } else {
//       obj.children.forEach(chObj => {
//         let subPath = path.slice();
//         res = findPath(pageName, chObj, subPath);
//       });
//     }
//     return res;
//   }

//   return findPath(locationName);
// }



// function redrawBreadCrumbs(curLoc ){
//   const crumbSpace = document.querySelector('.breadCrumb');

//   crumbSpace.innerHTML = "";
//   let levels = findRouteTo(curLoc);
//   if(!levels.length){ return; }

//   levels.forEach(level => {
//     let link = document.createElement('a');
//     link.setAttribute('href', level);
//     link.innerHTML = level;
//     let span = document.createElement('span');
//     span.innerHTML = '/';
//     crumbSpace.append(link);
//     crumbSpace.append(span);
//   })
// }




// j(hierarchy);

// let endPath

// function findPath(pageName, obj, path) {
//   path.push(obj.name);
//   if (obj.name === pageName) {
//     c('path', path);
//     return path;
//   } else {
//     obj.children.forEach(chObj => {
//       let subPath = path.slice();
//       c('subpath', subPath);
//       findPath(pageName, chObj, subPath);
//     });
//   }
// }

// let result = findPath('raku', hierarchy, "");

// c('result', result);