/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/frontend/agent-detail/agent-comment.js":
/*!**************************************************************!*\
  !*** ./assets/src/js/frontend/agent-detail/agent-comment.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);

const contentNode = document.querySelector('.realpress-agent-detail-property-comment-content');
const commentNode = contentNode.querySelector('.realpress-agent-detail-comment-content');
let commentContainerNode, paginationWrapNode, paginationNode, formNode, userId, restNamespace;
let data;

const init = () => {
  commentContainerNode = commentNode.querySelector('.realpress-comments-container');
  paginationWrapNode = commentNode.querySelector('.realpress-comment-pagination-wrap');
  formNode = commentNode.querySelector('form');
  userId = REALPRESS_AGENT_DETAIL_OBJECT.user_id || '';
  restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
  data = {
    offset: 1,
    orderby: 'date',
    order: 'DESC',
    user_id: userId,
    type: 'agent',
    posts_per_page: 6
  };
};

const realpressAgentComment = () => {
  if (!commentNode) {
    return;
  }

  init();
  getComment(data);

  if (!!formNode) {
    addComment();
  }
};

const addComment = () => {
  commentNode.querySelector('#realpress-submit-comment').addEventListener('click', function (event) {
    event.preventDefault();
    this.disabled = true;
    const messageNode = commentNode.querySelector('.realpress-form-message');
    const content = commentNode.querySelector('#realpress-comment-content').value;
    const data = {
      content,
      type: 'agent',
      user_id: userId
    };
    wp.apiFetch({
      path: '/' + restNamespace + '/comments',
      method: 'POST',
      data
    }).then(res => {
      if (!!res.msg) {
        messageNode.classList.remove('failed');
        messageNode.classList.add('success');
        messageNode.innerHTML = res.msg;
      }
    }).catch(err => {
      if (!!err.msg) {
        messageNode.classList.remove('success');
        messageNode.classList.add('failed');
        messageNode.innerHTML = err.msg;
      }
    }).finally(() => {
      this.disabled = false;
      contentNode.scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
};

const getComment = function () {
  let data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

  if (!commentContainerNode) {
    return;
  }

  commentContainerNode.style.opacity = 0.4;
  wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('/' + restNamespace + '/comments', data),
    method: 'GET'
  }).then(res => {
    if (!!res.data.content) {
      commentContainerNode.innerHTML = res.data.content;
    }

    if (!!res.data.pagination) {
      paginationWrapNode.innerHTML = res.data.pagination;
    }

    paginationNode = paginationWrapNode.querySelector('.realpress-pagination');

    if (!!paginationNode) {
      const pageNodes = paginationNode.querySelectorAll('a');

      for (let i = 0; i < pageNodes.length; i++) {
        pageNodes[i].addEventListener('click', function (event) {
          event.preventDefault();
          const offset = this.getAttribute('data-page');
          getComment({ ...data,
            offset
          });
          commentNode.scrollIntoView({
            behavior: 'smooth'
          });
        });
      }
    }
  }).catch(err => {
    if (!!err.msg) {
      console.log(err.msg);
    }
  }).finally(() => {
    commentContainerNode.style.opacity = 1;
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressAgentComment);

/***/ }),

/***/ "./assets/src/js/frontend/agent-detail/agent-property.js":
/*!***************************************************************!*\
  !*** ./assets/src/js/frontend/agent-detail/agent-property.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _mixins_property_list__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../mixins/property-list */ "./assets/src/js/frontend/mixins/property-list.js");


const propertyCommentNode = document.querySelector('.realpress-agent-detail-property-comment');
let contentNode, sortPropertyNode, restNamespace, author, propertyQuery;

const init = () => {
  contentNode = propertyCommentNode.querySelector('.realpress-agent-detail-property-comment-content');
  sortPropertyNode = contentNode.querySelector('.realpress-agent-detail-property-count-sort-group .realpress-sort-by');
  restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
  author = REALPRESS_AGENT_DETAIL_OBJECT.user_id || '';
  propertyQuery = {
    author,
    posts_per_page: 6,
    offset: 1,
    orderby: 'date',
    order: 'DESC',
    template: 'agent_detail'
  };
};

const realpressAgentProperty = () => {
  if (!propertyCommentNode) {
    return;
  }

  init();

  if (!sortPropertyNode) {
    return;
  }

  getProperties(propertyQuery);
  sortProperties();
};

const sortProperties = () => {
  sortPropertyNode.addEventListener('change', function (event) {
    const paginationNode = contentNode.querySelector('.realpress-pagination');
    let offset = 1;

    if (paginationNode) {
      offset = paginationNode.querySelector('li.current a').getAttribute('data-page');
    }

    const selected = event.target.value;
    const sortParams = (0,_mixins_property_list__WEBPACK_IMPORTED_MODULE_1__.getOrderParams)(selected);
    propertyQuery = { ...propertyQuery,
      ...sortParams,
      offset
    };
    getProperties(propertyQuery);
  });
};

const getProperties = function () {
  let propertyQuery = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  const containerNode = contentNode.querySelector('.realpress-agent-detail-property-container');
  const paginationWrapperNode = contentNode.querySelector('.realpress-agent-detail-property-pagination-wrapper');
  containerNode.style.opacity = 0.4;
  wp.apiFetch({
    path: (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)('/' + restNamespace + '/property-list', propertyQuery),
    method: 'GET'
  }).then(res => {
    if (res.data.content !== undefined) {
      containerNode.innerHTML = res.data.content;
    }

    if (res.data.pagination !== undefined) {
      paginationWrapperNode.innerHTML = res.data.pagination;
    } else {
      paginationWrapperNode.innerHTML = '';
    }

    const paginationNode = paginationWrapperNode.querySelector('.realpress-pagination');

    if (!!paginationNode) {
      const pageNodes = paginationNode.querySelectorAll('a');

      for (let i = 0; i < pageNodes.length; i++) {
        pageNodes[i].addEventListener('click', function (event) {
          event.preventDefault();
          const offset = this.getAttribute('data-page');
          getProperties({ ...propertyQuery,
            offset
          });
          contentNode.scrollIntoView({
            behavior: 'smooth'
          });
        });
      }
    }
  }).catch(err => {
    console.log(err);
  }).finally(() => {
    containerNode.style.opacity = 1;
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressAgentProperty);

/***/ }),

/***/ "./assets/src/js/frontend/agent-detail/contact-form.js":
/*!*************************************************************!*\
  !*** ./assets/src/js/frontend/agent-detail/contact-form.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _mixins_contact_form__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../mixins/contact-form */ "./assets/src/js/frontend/mixins/contact-form.js");


const realpressContactForm = () => {
  const contactButtonNode = document.querySelector('.realpress-agent-detail-contact button');
  const contactFormNode = document.querySelector('.realpress-agent-contact-form');

  if (!contactButtonNode || !contactFormNode) {
    return;
  }

  contactButtonNode.addEventListener('click', function () {
    contactFormNode.style.display = 'block';
  });
  contactFormNode.querySelector('.realpress-agent-contact-form-close').addEventListener('click', function () {
    contactFormNode.style.display = 'none';
  });
  document.addEventListener('click', function (event) {
    if (event.target === contactFormNode) {
      contactFormNode.style.display = 'none';
    }
  });
  const formNode = contactFormNode.querySelector('form.realpress-contact-form');
  (0,_mixins_contact_form__WEBPACK_IMPORTED_MODULE_0__.realpressContactFormSendEmail)(formNode);
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressContactForm);

/***/ }),

/***/ "./assets/src/js/frontend/agent-detail/switch-property-review.js":
/*!***********************************************************************!*\
  !*** ./assets/src/js/frontend/agent-detail/switch-property-review.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
const propertyCommentNode = document.querySelector('.realpress-agent-detail-property-comment');
const controlNode = propertyCommentNode.querySelector('.realpress-agent-detail-property-comment-control');
const itemControlNodes = controlNode.querySelectorAll('li');
const contentNode = propertyCommentNode.querySelector('.realpress-agent-detail-property-comment-content');
const itemtcontentNodes = contentNode.querySelectorAll(':scope >div');
let activeItem;
const userId = REALPRESS_AGENT_DETAIL_OBJECT.user_id || '';

const realpressSwitchPropertyComment = () => {
  if (!propertyCommentNode || !userId) {
    return;
  }

  document.querySelector('.realpress-agent-detail-comment-scroll a').addEventListener('click', function () {
    const commentControlId = this.getAttribute('href');
    propertyCommentNode.querySelector(commentControlId).click();
  });
  activeItem = JSON.parse(localStorage.getItem('realpress_agent_detail_property_comment_active'));

  if (activeItem == null) {
    activeItem = {};
  }

  if (!activeItem[userId]) {
    itemControlNodes[0].classList.add('active');
    itemtcontentNodes[0].classList.add('active');
    activeItem[userId] = itemControlNodes[0].getAttribute('data-control');
    localStorage.setItem('realpress_agent_detail_property_comment_active', JSON.stringify(activeItem));
  } else {
    for (let j = 0; j < itemControlNodes.length; j++) {
      const item = itemControlNodes[j];
      const controlData = item.getAttribute('data-control');

      if (controlData === activeItem[userId]) {
        if (!item.classList.contains('active')) {
          item.classList.add('active');
          contentNode.querySelector('div[data-content=' + activeItem[userId] + ']').classList.add('active');
        }
      } else if (item.classList.contains('active')) {
        item.classList.remove('active');
        contentNode.querySelector('div[data-content="' + controlData + '"]').classList.remove('active');
      }
    }
  }

  handleSelectTab();
};

const handleSelectTab = () => {
  for (let i = 0; i < itemControlNodes.length; i++) {
    const itemControlNode = itemControlNodes[i];
    itemControlNode.addEventListener('click', function () {
      const selectedItem = this;

      for (let j = 0; j < itemControlNodes.length; j++) {
        const item = itemControlNodes[j];

        if (selectedItem === item) {
          if (!item.classList.contains('active')) {
            const controlData = item.getAttribute('data-control');
            item.classList.add('active');
            contentNode.querySelector('div[data-content=' + controlData + ']').classList.add('active');
            activeItem[userId] = controlData;
            localStorage.setItem('realpress_agent_detail_property_comment_active', JSON.stringify(activeItem));
          }
        } else if (item.classList.contains('active')) {
          item.classList.remove('active');
          const controlData = item.getAttribute('data-control');
          contentNode.querySelector('div[data-content="' + controlData + '"]').classList.remove('active');
        }
      }
    });
  }
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressSwitchPropertyComment);

/***/ }),

/***/ "./assets/src/js/frontend/mixins/contact-form.js":
/*!*******************************************************!*\
  !*** ./assets/src/js/frontend/mixins/contact-form.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "realpressContactFormSendEmail": () => (/* binding */ realpressContactFormSendEmail)
/* harmony export */ });
const realpressContactFormSendEmail = formNode => {
  if (!formNode) {
    return;
  }

  const sendMessageNode = formNode.querySelector('button.realpress-send-message');
  const restNamespace = REALPRESS_GLOBAL_OBJECT.rest_namespace || '';
  sendMessageNode.addEventListener('click', function () {
    sendMessageNode.disabled = true;
    sendMessageNode.insertAdjacentHTML('afterbegin', ' <i class="fa fa-spinner fa-spin"></i>' + ' ');
    const emailTarget = formNode.querySelector('input[name="email-target"]').value || '';
    const name = formNode.querySelector('input[name="name"]').value || '';
    const phone = formNode.querySelector('input[name="phone"]').value || '';
    const email = formNode.querySelector('input[name="email"]').value || '';
    const message = formNode.querySelector(' textarea[name="message"]').value || '';
    let termsAndConditions;
    const termsAndConditionsNode = formNode.querySelector('input[name="terms_and_conditions"]');

    if (termsAndConditionsNode) {
      termsAndConditions = termsAndConditionsNode.checked || false;
    } else {
      termsAndConditions = true;
    }

    const data = {
      email_target: emailTarget,
      name,
      phone,
      email,
      message,
      terms_and_conditions: termsAndConditions
    };
    const messageResultNode = formNode.querySelector('.realpress-message-result');
    wp.apiFetch({
      path: '/' + restNamespace + '/contact-form',
      method: 'POST',
      data
    }).then(res => {
      if (res.msg) {
        messageResultNode.classList.remove('failed');
        messageResultNode.classList.add('success');
        messageResultNode.innerHTML = res.msg;
      }
    }).catch(err => {
      if (err.msg) {
        messageResultNode.classList.remove('success');
        messageResultNode.classList.add('failed');
        messageResultNode.innerHTML = err.msg;
      }
    }).finally(() => {
      sendMessageNode.disabled = false;
      sendMessageNode.querySelector('i.fa-spinner').remove();
    });
  });
};



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

/***/ "./assets/src/js/frontend/widgets/agent-search.js":
/*!********************************************************!*\
  !*** ./assets/src/js/frontend/widgets/agent-search.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);


const realpressAgentSeach = () => {
  const searchNode = document.querySelector('.realpress-agent-search');

  if (!searchNode) {
    return;
  }

  const agentListPageUrl = REALPRESS_GLOBAL_OBJECT.agent_list_page_url || '';

  if (!agentListPageUrl) {
    return;
  }

  const searchButton = searchNode.querySelector('button');
  searchButton.addEventListener('click', function () {
    const fieldNodes = searchNode.querySelectorAll('input,select');

    if (!fieldNodes) {
      return;
    }

    const query = {
      offset: 1,
      orderby: 'display_name',
      order: 'ASC'
    };

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

    document.location.href = (0,_wordpress_url__WEBPACK_IMPORTED_MODULE_0__.addQueryArgs)(agentListPageUrl, query);
  });
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (realpressAgentSeach);

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
/*!***********************************************************!*\
  !*** ./assets/src/js/frontend/realpress-agent-detail.tsx ***!
  \***********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _agent_detail_switch_property_review__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./agent-detail/switch-property-review */ "./assets/src/js/frontend/agent-detail/switch-property-review.js");
/* harmony import */ var _agent_detail_agent_property__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./agent-detail/agent-property */ "./assets/src/js/frontend/agent-detail/agent-property.js");
/* harmony import */ var _agent_detail_agent_comment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./agent-detail/agent-comment */ "./assets/src/js/frontend/agent-detail/agent-comment.js");
/* harmony import */ var _agent_detail_contact_form__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./agent-detail/contact-form */ "./assets/src/js/frontend/agent-detail/contact-form.js");
/* harmony import */ var _widgets_agent_search__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./widgets/agent-search */ "./assets/src/js/frontend/widgets/agent-search.js");





document.addEventListener('DOMContentLoaded', event => {
  (0,_agent_detail_switch_property_review__WEBPACK_IMPORTED_MODULE_0__["default"])();
  (0,_agent_detail_agent_property__WEBPACK_IMPORTED_MODULE_1__["default"])();
  (0,_agent_detail_agent_comment__WEBPACK_IMPORTED_MODULE_2__["default"])();
  (0,_agent_detail_contact_form__WEBPACK_IMPORTED_MODULE_3__["default"])();
  (0,_widgets_agent_search__WEBPACK_IMPORTED_MODULE_4__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-agent-detail.js.map