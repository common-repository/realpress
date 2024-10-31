/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/frontend/agent-list/agent-list.js":
/*!*********************************************************!*\
  !*** ./assets/src/js/frontend/agent-list/agent-list.js ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _mixins_search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mixins/search */ "./assets/src/js/frontend/mixins/search.js");


const agentListNode = document.querySelector('.realpress-agent-list');
let sortNode, containerNode, searchNode, restNamespace, orderby, order, query, agentListContent;

const init = () => {
  sortNode = agentListNode.querySelector('.realpress-sort-by select');
  agentListContent = agentListNode.querySelector('.realpress-agent-list-content');
  containerNode = agentListNode.querySelector('.realpress-agent-list-container');
  searchNode = document.querySelector('.realpress-agent-search');
  restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
  query = {
    offset: 1,
    orderby: 'display_name',
    order: 'ASC'
  };
  const queryParams = (0,_mixins_search__WEBPACK_IMPORTED_MODULE_1__.getParamsOfUrl)();

  if (Object.keys(queryParams).length) {
    query = { ...query,
      ...queryParams
    };
  }
};

const realpressAgentList = () => {
  if (!agentListNode) {
    return;
  }

  init();
  getAgents(query);
  sort();
  search();
};

const getAgents = function () {
  let query = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  containerNode.style.opacity = 0.4;
  wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('/' + restNamespace + '/agents', query),
    method: 'GET'
  }).then(res => {
    if (res.data.content !== undefined) {
      containerNode.innerHTML = res.data.content;
    } else if (res.msg) {
      containerNode.innerHTML = res.msg;
    }

    if (res.data.pagination !== undefined) {
      agentListNode.querySelector('.realpress-agent-list-pagination').innerHTML = res.data.pagination;
    } else {
      agentListNode.querySelector('.realpress-agent-list-pagination').innerHTML = '';
    }

    if (res.data.from_to !== undefined) {
      agentListNode.querySelector('.realpress-agent-list-from-to').innerHTML = res.data.from_to;
    } else {
      agentListNode.querySelector('.realpress-agent-list-from-to').innerHTML = '';
    }

    const paginationNode = agentListNode.querySelector('.realpress-pagination');

    if (!!paginationNode) {
      const pageNodes = paginationNode.querySelectorAll('a');

      for (let i = 0; i < pageNodes.length; i++) {
        pageNodes[i].addEventListener('click', function (event) {
          event.preventDefault();
          const offset = this.getAttribute('data-page');
          getAgents({ ...query,
            offset
          });
          agentListContent.scrollIntoView({
            behavior: 'smooth'
          });
        });
      }
    }
  }).catch(err => {
    console.log(err);
  }).finally(() => {
    const urlPush = (0,_mixins_search__WEBPACK_IMPORTED_MODULE_1__.getUrl)(query);
    window.history.pushState('', '', urlPush);
    containerNode.style.opacity = 1;
  });
};

const sort = () => {
  sortNode.addEventListener('change', function (event) {
    const selected = event.target.value;

    switch (selected) {
      case 'name_asc':
        orderby = 'display_name';
        order = 'ASC';
        break;

      case 'name_desc':
        orderby = 'display_name';
        order = 'DESC';
        break;

      default:
        orderby = 'ID';
        order = 'DESC';
        break;
    }

    getAgents({ ...query,
      orderby,
      order
    });
    agentListContent.scrollIntoView({
      behavior: 'smooth'
    });
  });
};

const search = () => {
  if (!searchNode) {
    return;
  }

  const searchButton = searchNode.querySelector('button');
  searchButton.addEventListener('click', function () {
    const fieldNodes = searchNode.querySelectorAll('input,select');

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
    getAgents(query);
    agentListContent.scrollIntoView({
      behavior: 'smooth'
    });
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressAgentList);

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
/*!*********************************************************!*\
  !*** ./assets/src/js/frontend/realpress-agent-list.tsx ***!
  \*********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _agent_list_agent_list__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./agent-list/agent-list */ "./assets/src/js/frontend/agent-list/agent-list.js");

document.addEventListener('DOMContentLoaded', event => {
  (0,_agent_list_agent_list__WEBPACK_IMPORTED_MODULE_0__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-agent-list.js.map