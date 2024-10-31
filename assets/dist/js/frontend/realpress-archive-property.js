/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/frontend/archive-property/property-list.js":
/*!******************************************************************!*\
  !*** ./assets/src/js/frontend/archive-property/property-list.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _mixins_property_list__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mixins/property-list */ "./assets/src/js/frontend/mixins/property-list.js");
/* harmony import */ var _mixins_search__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../mixins/search */ "./assets/src/js/frontend/mixins/search.js");



const archivePropertyNode = document.querySelector('.realpress-archive-property');
const archivePropertyContentNode = archivePropertyNode.querySelector('.realpress-archive-property-content');
const sortNode = archivePropertyNode.querySelector('.realpress-sort-by select');
const containerNode = archivePropertyNode.querySelector('.realpress-property-container');
const searchNode = archivePropertyNode.querySelector('.realpress-advanced-search');
const restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
let query = {
  offset: 1,
  orderby: 'date',
  order: 'DESC',
  template: 'archive_page'
};

const realpressListProperty = () => {
  const {
    taxonomy = ''
  } = REALPRESS_PROPERTY_ARCHIVE_OBJECT;
  const termId = REALPRESS_PROPERTY_ARCHIVE_OBJECT.term_id || '';

  if (!!termId && taxonomy) {
    query = { ...query,
      term_id: termId,
      taxonomy
    };
  }

  const queryParams = (0,_mixins_search__WEBPACK_IMPORTED_MODULE_2__.getParamsOfUrl)();

  if (Object.keys(queryParams).length) {
    query = { ...query,
      ...queryParams
    };
  }

  sort();

  if (searchNode) {
    search();
  }

  getProperties(query);
};

const getProperties = function () {
  let query = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  containerNode.style.opacity = 0.4;
  wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('/' + restNamespace + '/property-list', query),
    method: 'GET'
  }).then(res => {
    if (res.data.content !== undefined) {
      containerNode.innerHTML = res.data.content;
    } else if (res.msg) {
      containerNode.innerHTML = res.msg;
    }

    if (res.data.pagination !== undefined) {
      archivePropertyNode.querySelector('.realpress-archive-property-pagination').innerHTML = res.data.pagination;
    } else {
      archivePropertyNode.querySelector('.realpress-archive-property-pagination').innerHTML = '';
    }

    if (res.data.from_to !== undefined) {
      archivePropertyNode.querySelector('.realpress-archive-property-from-to').innerHTML = res.data.from_to;
    } else {
      archivePropertyNode.querySelector('.realpress-archive-property-from-to').innerHTML = '';
    }

    const paginationNode = archivePropertyNode.querySelector('.realpress-pagination');

    if (!!paginationNode) {
      const pageNodes = paginationNode.querySelectorAll('a');

      for (let i = 0; i < pageNodes.length; i++) {
        pageNodes[i].addEventListener('click', function (event) {
          event.preventDefault();
          const offset = this.getAttribute('data-page');
          query = { ...query,
            offset
          };
          getProperties(query);
          archivePropertyContentNode.scrollIntoView({
            behavior: 'smooth'
          });
        });
      }
    }
  }).catch(err => {
    console.log(err);
  }).finally(() => {
    const urlPush = (0,_mixins_search__WEBPACK_IMPORTED_MODULE_2__.getUrl)(query);
    window.history.pushState('', '', urlPush);
    containerNode.style.opacity = 1;
  });
};

const sort = () => {
  sortNode.addEventListener('change', function (event) {
    const paginationNode = archivePropertyNode.querySelector('.realpress-archive-property-pagination .realpress-pagination');
    let offset = 1;

    if (paginationNode) {
      offset = paginationNode.querySelector('li.current a').getAttribute('data-page');
    }

    const selected = event.target.value;
    const sortParams = (0,_mixins_property_list__WEBPACK_IMPORTED_MODULE_1__.getOrderParams)(selected);
    query = { ...query,
      ...sortParams,
      offset
    };
    getProperties(query);
    archivePropertyContentNode.scrollIntoView({
      behavior: 'smooth'
    });
  });
};

const search = () => {
  const searchButtonNode = searchNode.querySelector('button.realpress-search-property-button');
  searchButtonNode.addEventListener('click', function () {
    const fieldNodes = searchNode.querySelectorAll('.realpress-search-field input,select');

    if (!fieldNodes) {
      return;
    }

    for (let i = 0; i < fieldNodes.length; i++) {
      const fieldNode = fieldNodes[i];
      const name = fieldNode.getAttribute('name');

      if (fieldNode.value === '') {
        if (query.hasOwnProperty(name)) {
          delete query[name];
        }
      } else {
        query[name] = fieldNode.value;
      }
    }

    query = { ...query,
      offset: 1
    };
    getProperties(query);
    archivePropertyContentNode.scrollIntoView({
      behavior: 'smooth'
    });
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressListProperty);

/***/ }),

/***/ "./assets/src/js/frontend/archive-property/switch-layout.js":
/*!******************************************************************!*\
  !*** ./assets/src/js/frontend/archive-property/switch-layout.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
let archivePropertyContentNode, switchViewNodes, container;

const realpressSwitchLayout = () => {
  archivePropertyContentNode = document.querySelector('.realpress-archive-property-content');

  if (!archivePropertyContentNode) {
    return;
  }

  switchViewNodes = archivePropertyContentNode.querySelectorAll('.realpress-item-switch-view li');

  if (!switchViewNodes) {
    return;
  }

  container = archivePropertyContentNode.querySelector('.realpress-property-container');
  let col = JSON.parse(localStorage.getItem('realpress_archive_property_layout_active'));

  if (col == null) {
    col = switchViewNodes[0].getAttribute('data-grid-col');
    switchViewNodes[0].classList.add('active');
    localStorage.setItem('realpress_archive_property_layout_active', JSON.stringify(col));
  } else {
    archivePropertyContentNode.querySelector('.realpress-item-switch-view li[data-grid-col="' + col + '"]').classList.add('active');
    container.setAttribute('data-grid-col', col);
  }

  switchViewMode();
};

const switchViewMode = () => {
  for (let i = 0; i < switchViewNodes.length; i++) {
    switchViewNodes[i].addEventListener('click', function () {
      const activeViewNode = archivePropertyContentNode.querySelector('.realpress-item-switch-view li.active');
      const activeView = activeViewNode.getAttribute('class');
      const view = this.getAttribute('class');

      if (view !== activeView) {
        activeViewNode.classList.remove('active');
        this.classList.add('active');
        const col = this.getAttribute('data-grid-col');
        container.setAttribute('data-grid-col', col);
        localStorage.setItem('realpress_archive_property_layout_active', JSON.stringify(col));
      }
    });
  }
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressSwitchLayout);

/***/ }),

/***/ "./assets/src/js/frontend/mixins/property-list.js":
/*!********************************************************!*\
  !*** ./assets/src/js/frontend/mixins/property-list.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getOrderParams": () => (/* binding */ getOrderParams)
/* harmony export */ });
const getOrderParams = selected => {
  let orderby, order;

  switch (selected) {
    case 'default':
      orderby = 'date';
      order = 'DESC';
      break;

    case 'name_asc':
      orderby = 'title';
      order = 'ASC';
      break;

    case 'name_desc':
      orderby = 'title';
      order = 'DESC';
      break;

    case 'price_desc':
      orderby = 'price';
      order = 'DESC';
      break;

    case 'price_asc':
      orderby = 'price';
      order = 'ASC';
      break;

    case 'rating_desc':
      orderby = 'rating';
      order = 'DESC';
      break;

    case 'rating_asc':
      orderby = 'rating';
      order = 'ASC';
      break;

    default:
      orderby = 'date';
      order = 'DESC';
      break;
  }

  return {
    orderby,
    order
  };
};



/***/ }),

/***/ "./assets/src/js/frontend/mixins/search.js":
/*!*************************************************!*\
  !*** ./assets/src/js/frontend/mixins/search.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getParamOfUrl": () => (/* binding */ getParamOfUrl),
/* harmony export */   "getParamsOfUrl": () => (/* binding */ getParamsOfUrl),
/* harmony export */   "getUrl": () => (/* binding */ getUrl)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);


const getParamOfUrl = param => {
  const urlParams = new URLSearchParams(location.search);
  return urlParams.get(param);
};

const getParamsOfUrl = () => {
  const urlParams = new URLSearchParams(location.search);
  const queryParams = {};

  for (const [key, value] of urlParams) {
    queryParams[key] = value;
  }

  return queryParams;
};

const getUrl = args => {
  return (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(document.location.origin + document.location.pathname, args);
};



/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ ((module) => {

module.exports = window["wp"]["url"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************************************************!*\
  !*** ./assets/src/js/frontend/realpress-archive-property.tsx ***!
  \***************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _archive_property_property_list__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./archive-property/property-list */ "./assets/src/js/frontend/archive-property/property-list.js");
/* harmony import */ var _archive_property_switch_layout__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./archive-property/switch-layout */ "./assets/src/js/frontend/archive-property/switch-layout.js");


document.addEventListener('DOMContentLoaded', event => {
  (0,_archive_property_property_list__WEBPACK_IMPORTED_MODULE_0__["default"])();
  (0,_archive_property_switch_layout__WEBPACK_IMPORTED_MODULE_1__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-archive-property.js.map