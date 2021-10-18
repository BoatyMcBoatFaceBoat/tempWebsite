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
    }
  ]
};


function findRouteTo(locationName){
  let res = [];

  function findPath(pageName, obj = hierarchy, path = []) {
    path.push(obj.name);
    if (obj.name === pageName) {
      console.log(path)
      return path;
    } else {
      // if(!children.length) { return; }
      obj.children.forEach(chObj => {
        let subPath = path.slice();
        res = findPath(pageName, chObj, subPath);
      });
    }
    // console.log(res)
    return res;
  }

  console.log(findPath(locationName));
  return findPath(locationName);
}

console.log(findRouteTo('excel'));
let ex = findRouteTo('excel')
console.log(ex)


// console.log(findPath('raku', hierarchy, []))
// console.log(findPath('electron', hierarchy, []));
// console.log(findPath('excel', hierarchy, []));
// console.log(findPath('lang', hierarchy, []));

function getCurHref() {
  // const fullLink = window.location.href;
  // const paramList = new URL(fullLink).hash;

  let pagename = window.location.pathname;
  console.log(pagename);
  // pagename.replace('')
  // const paramList = new URLSearchParams(searchParams);

  // let loc = paramList.substr(1, paramList.length);
  // console.log(loc)
  // return loc;
  return pagename;
}

function redrawBreadCrumbs(curLoc){
  console.log(curLoc)
  const crumbSpace = document.querySelector('.breadCrumb');
  crumbSpace.innerHTML = "";
  // let levels = findRouteTo(curLoc);
  // let levels = [];
  // levels.push(findPath(curLoc));
  // console.log(findPath(curLoc))
  let levels = findRouteTo(curLoc);
  if(!levels.length){ return; }

  levels.forEach(level => {
    let link = document.createElement('a');
    link.setAttribute('href', '#'+level);
    // let link = document.createElement('span');
    link.innerHTML = level;
    let span = document.createElement('span');
    span.innerHTML = '/';
    crumbSpace.append(link);
    crumbSpace.append(span);
  })
}




function loadWebsite(){
  // redr
  let loc = getCurHref();
  //     let loc = 'model';
  // redrawBreadCrumbs('raku');
  redrawBreadCrumbs(loc);
  // console.log(navLinks);
  // for (let breadLink of breadLinks){
  //   breadLink.addEventListener('click', () => {
  //     // direct page here

  //     // window.location.reload(); //doesn work



  //     // let loc = getCurHref();
  //     let loc = 'model';
  //     redrawBreadCrumbs(loc);
  //   })
  // }
  // return;


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