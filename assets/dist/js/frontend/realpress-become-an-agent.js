/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/frontend/become-an-agent/submit.js":
/*!**********************************************************!*\
  !*** ./assets/src/js/frontend/become-an-agent/submit.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const realpressBecomeAgent = () => {
  const becomeAgentNode = document.querySelector('#realpress-become-an-agent');

  if (!becomeAgentNode) {
    return;
  }

  const containerNode = becomeAgentNode.querySelector('.realpress-become-an-agent-container');
  const formNode = containerNode.querySelector('form');

  if (!formNode) {
    return;
  }

  const restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
  const btnNode = formNode.querySelector('button');
  btnNode.addEventListener('click', function (event) {
    event.preventDefault();
    const firstName = formNode.querySelector('[name="realpress-baa-firstname"]').value || '';
    const lastName = formNode.querySelector('[name="realpress-baa-lastname"]').value || '';
    const agencyName = formNode.querySelector('[name="realpress-baa-agencyname"]').value || '';
    const phoneNumber = formNode.querySelector('[name="realpress-baa-phonenumber"]').value || '';
    const additionalInfo = formNode.querySelector('[name="realpress-baa-additional-information"]').value || '';
    const termAndCondition = formNode.querySelector('[name="realpress-baa-terms-and-conditions"]').checked;
    const warningNode = formNode.querySelector('.realpress-baa-warning');
    const data = {
      first_name: firstName,
      last_name: lastName,
      agency_name: agencyName,
      phone_number: phoneNumber,
      additional_info: additionalInfo,
      terms_and_conditions: termAndCondition
    };
    wp.apiFetch({
      path: '/' + restNamespace + '/become-an-agent',
      method: 'POST',
      data
    }).then(res => {
      if (res.msg) {
        containerNode.innerHTML = res.msg;
      }
    }).catch(err => {
      if (err.msg) {
        warningNode.classList.add('failed');
        warningNode.innerHTML = err.msg;
      }
    });
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressBecomeAgent);

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
/*!**************************************************************!*\
  !*** ./assets/src/js/frontend/realpress-become-an-agent.tsx ***!
  \**************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _become_an_agent_submit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./become-an-agent/submit */ "./assets/src/js/frontend/become-an-agent/submit.js");

document.addEventListener('DOMContentLoaded', event => {
  (0,_become_an_agent_submit__WEBPACK_IMPORTED_MODULE_0__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-become-an-agent.js.map