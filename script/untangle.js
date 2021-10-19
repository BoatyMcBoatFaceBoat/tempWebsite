const c = function (descrip, something) {

  return console.log(`${descrip}:  ${something}`);
}


const j = function (object) {
  return console.log(JSON.stringify(object));
}

const $$ = function(queryName) {
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


function findRouteTo(locationName){
  let res = [];

  function findPath(pageName, obj = hierarchy, path = []) {
    path.push(obj.name);
    if (obj.name === pageName) {
      return path;
    } else {
      obj.children.forEach(chObj => {
        let subPath = path.slice();
        res = findPath(pageName, chObj, subPath);
      });
    }
    return res;
  }

  return findPath(locationName);
}


function redrawBreadCrumbs(curLoc ){
  const crumbSpace = document.querySelector('.breadCrumb');
  
  crumbSpace.innerHTML = "";
  let levels = findRouteTo(curLoc);
  if(!levels.length){ return; }

  levels.forEach(level => {
    let link = document.createElement('a');
    link.setAttribute('href', level);
    link.innerHTML = level;
    let span = document.createElement('span');
    span.innerHTML = '/';
    crumbSpace.append(link);
    crumbSpace.append(span);
  })
}


function loadWebsite(){

  let loc = window.location.pathname;
  let addressArr = loc.replace(/\s*\/tempWebsite\//, "");
  let subj;
  let addArr = addressArr.split('/');
  console.log(addArr)  
  if(addArr.length > 1 ){
    // lang = addressArr[0];
    subj = addArr[1];
  } else {
    subj = addArr[0];
  }

  c('addressArr', addressArr);
  c('subj', subj);
  redrawBreadCrumbs(subj);

  const moreElms = $$('.more');
  for(let moreElm of moreElms){
    moreElm.addEventListener('click', function(event){
      console.log(event);
      let plus = moreElm.querySelector('.readmore-elm');
      let text = moreElm.querySelector('.more-content');
      plus.style.display = 'none';
      text.style.display = 'block';

    })
  }

}






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