/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/admin/setup/import-demo.js":
/*!**************************************************!*\
  !*** ./assets/src/js/admin/setup/import-demo.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);


const realpressImportDemo = () => {
  const importDemoNode = document.querySelector('.realpress-import-demo-content');

  if (!importDemoNode) {
    return;
  }

  const importBtnNode = importDemoNode.querySelector('button');
  const importNotifyNode = importDemoNode.querySelector('.realpress-import-demo-notification');
  const {
    __
  } = wp.i18n;
  importBtnNode.addEventListener('click', function () {
    importBtnNode.disabled = true;
    importNotifyNode.innerHTML = __('System is running…', ' realpress');
    const restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
    wp.apiFetch({
      path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('/' + restNamespace + '/import-demo'),
      method: 'POST'
    }).then(res => {
      if (res.msg) {
        importNotifyNode.innerHTML = `<p>${res.msg}</p>`;
      }
    }).catch(err => {
      console.log(err);
    }).finally(() => {
      importBtnNode.disabled = false;
    });
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressImportDemo);

/***/ }),

/***/ "./assets/src/js/admin/setup/pages.js":
/*!********************************************!*\
  !*** ./assets/src/js/admin/setup/pages.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const realpressSetupPages = () => {
  const pageSettingNode = document.querySelector('.realpress-page-setting');

  if (!pageSettingNode) {
    return;
  }

  const createPagesButtonNode = pageSettingNode.querySelector('button#realpress-create-all-pages');

  if (!createPagesButtonNode) {
    return;
  }

  const {
    __
  } = wp.i18n;
  const agentListPageId = REALPRESS_GLOBAL_OBJECT.agent_list_page_id || '';
  const termsAndConditionsPageId = REALPRESS_GLOBAL_OBJECT.terms_and_conditions_page_id || '';
  const becomeAnAgentPageId = REALPRESS_GLOBAL_OBJECT.become_an_agent_page_id || '';
  const wishlistPageId = REALPRESS_GLOBAL_OBJECT.wishlist_page_id || '';
  const agentListPageNode = pageSettingNode.querySelector('#realpress_agent_list_page');
  const termsAndConditionsPageNode = pageSettingNode.querySelector('#realpress_terms_and_conditions_page');
  const becomeAnAgentPageNode = pageSettingNode.querySelector('#realpress_become_an_agent_page');
  const wishlistPageNode = pageSettingNode.querySelector('#realpress_wishlist_page');
  createPagesButtonNode.addEventListener('click', async function (event) {
    event.preventDefault();
    createPagesButtonNode.disabled = true;
    createPagesButtonNode.insertAdjacentHTML('afterbegin', ' <i class="fa fa-spinner fa-spin"></i>' + ' ');

    if (agentListPageNode) {
      let agentListResult = await create_page(agentListPageId, agentListPageNode.tomselect, __('Agent List', 'realpress'));
      addValueToSelect(agentListResult, agentListPageNode);
    }

    if (termsAndConditionsPageNode) {
      let termsAndConditionsResult = await create_page(termsAndConditionsPageId, termsAndConditionsPageNode.tomselect, __('Terms and Conditions', 'realpress'));
      addValueToSelect(termsAndConditionsResult, termsAndConditionsPageNode);
    }

    if (becomeAnAgentPageNode) {
      let becomeAnAgentResult = await create_page(becomeAnAgentPageId, becomeAnAgentPageNode.tomselect, __('Become an Agent', 'realpress'));
      addValueToSelect(becomeAnAgentResult, becomeAnAgentPageNode);
    }

    if (wishlistPageNode) {
      let wishlisttResult = await create_page(wishlistPageId, wishlistPageNode.tomselect, __('WishList', 'realpress'));
      addValueToSelect(wishlisttResult, wishlistPageNode);
    }

    createPagesButtonNode.querySelector('i.fa-spinner').remove();
    createPagesButtonNode.disabled = false;
  });
};

const create_page = (pageId, node, title) => {
  const restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';

  if (pageId) {
    node.setValue([pageId]);
    return new Promise(resolve => resolve('success'));
  } else {
    let data = {
      title,
      post_type: 'page',
      post_status: 'publish'
    };
    return wp.apiFetch({
      path: '/' + restNamespace + '/page',
      method: 'POST',
      data
    });
  }
};

const addValueToSelect = (result, selectNode) => {
  if (result.status && result.status === 'success' && result.data) {
    selectNode.tomselect.addOption({
      value: result.data.id,
      text: result.data.title
    });
    selectNode.tomselect.setValue([result.data.id]);
  }
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressSetupPages);

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
/*!*************************************************!*\
  !*** ./assets/src/js/admin/realpress-setup.tsx ***!
  \*************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _setup_import_demo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./setup/import-demo */ "./assets/src/js/admin/setup/import-demo.js");
/* harmony import */ var _setup_pages__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./setup/pages */ "./assets/src/js/admin/setup/pages.js");


document.addEventListener('DOMContentLoaded', event => {
  (0,_setup_import_demo__WEBPACK_IMPORTED_MODULE_0__["default"])();
  (0,_setup_pages__WEBPACK_IMPORTED_MODULE_1__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-setup.js.map