/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@wordpress/icons/build-module/library/page.js":
/*!********************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/page.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const page = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M7 5.5h10a.5.5 0 01.5.5v12a.5.5 0 01-.5.5H7a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5zM17 4H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2zm-1 3.75H8v1.5h8v-1.5zM8 11h8v1.5H8V11zm6 3.25H8v1.5h6v-1.5z"
}));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (page);
//# sourceMappingURL=page.js.map

/***/ }),

/***/ "./node_modules/@wordpress/icons/build-module/library/title.js":
/*!*********************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/title.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);


/**
 * WordPress dependencies
 */

const title = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "https://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M4 5.417h2.267V12h1.466V5.417H10V4H4v1.417ZM20 16H4v-1.5h16V16Zm-7 4H4v-1.5h9V20Z"
}));
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (title);
//# sourceMappingURL=title.js.map

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/archive/edit.tsx":
/*!********************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/archive/edit.tsx ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "edit": () => (/* binding */ edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/page.js");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);





const edit = props => {
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Placeholder, {
    icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_4__["default"],
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Thim Real Estate Content Archive', 'realpress')
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('This is an editor placeholder for the Archive Property page. Content will render content of list properties. Should be not remove it', 'realpress'))));
};

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/archive/index.tsx":
/*!*********************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/archive/index.tsx ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "settings": () => (/* binding */ settings)
/* harmony export */ });
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit */ "./assets/src/js/admin/block/legacy-template/archive/edit.tsx");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./assets/src/js/admin/block/legacy-template/archive/block.json");
/**
 * Register block archive property.
 */


const settings = { ..._block_json__WEBPACK_IMPORTED_MODULE_1__,
  edit: _edit__WEBPACK_IMPORTED_MODULE_0__.edit
};

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/single/edit.tsx":
/*!*******************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/single/edit.tsx ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "edit": () => (/* binding */ edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);




const edit = props => {
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Placeholder, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)("Thim Real Estate Single content", "realpress")
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('This is an editor placeholder for the Single Property page. Content will render content of single property. Should be not remove it', 'realpress'))));
};

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/single/index.tsx":
/*!********************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/single/index.tsx ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "settings": () => (/* binding */ settings)
/* harmony export */ });
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit */ "./assets/src/js/admin/block/legacy-template/single/edit.tsx");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./assets/src/js/admin/block/legacy-template/single/block.json");
/**
 * Register block single property.
 */


const settings = { ..._block_json__WEBPACK_IMPORTED_MODULE_1__,
  edit: _edit__WEBPACK_IMPORTED_MODULE_0__.edit
};

/***/ }),

/***/ "./assets/src/js/admin/block/list-properties/edit.tsx":
/*!************************************************************!*\
  !*** ./assets/src/js/admin/block/list-properties/edit.tsx ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "edit": () => (/* binding */ edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _inspector__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./inspector */ "./assets/src/js/admin/block/list-properties/inspector.tsx");







const edit = props => {
  const [isEditing, setEditing] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const innerBlocks = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    const {
      getBlock,
      getBlockName,
      getBlockAttributes
    } = select(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.store);
    return getBlock(props.clientId);
  });
  console.log(innerBlocks.innerBlocks);
  console.log(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks);
  const {
    attributes,
    isSelected,
    setAttributes
  } = props;
  const {
    postsPerPage
  } = attributes;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)();

  const togglePreview = () => {
    setEditing(!isEditing);
  };

  const getBlockControls = () => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.BlockControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.ToolbarGroup, {
      controls: [{
        icon: 'edit',
        title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Edit inner product layout', 'realpress'),
        onClick: () => togglePreview(),
        isActive: isEditing
      }]
    }));
  };

  const renderEditMode = props => {
    const onDone = () => {
      togglePreview();
    };

    const onCancel = () => {
      togglePreview();
    };

    const onReset = () => {};

    const InnerBlockProps = {
      allowedBlocks: ['realpress/property-title', "realpress/property-price"],
      template: [],
      // default templates
      templateLock: true // default false

    };
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Tip, null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Display item property on list properties.', 'realpress')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "wc-block-all-products-grid-item-template"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks, InnerBlockProps), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "wc-block-all-products__actions"
    }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      className: "wc-block-all-products__done-button",
      isPrimary: true,
      onClick: onDone
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Done', 'woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      className: "wc-block-all-products__cancel-button",
      isTertiary: true,
      onClick: onCancel
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Cancel', 'woocommerce')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Button, {
      className: "wc-block-all-products__reset-button",
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Reset layout to default', 'woocommerce'),
      onClick: onReset
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Reset Layout', 'woocommerce')))));
  };

  const renderViewMode = attributes => {
    return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, "Posts per page: ", postsPerPage), innerBlocks.innerBlocks.map(el => {
      const {
        attributes
      } = el;
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "realpress-price-property",
        style: {
          padding: "20px"
        }
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
        style: {
          color: attributes === null || attributes === void 0 ? void 0 : attributes.color
        }
      }, "Price property"));
    }));
  };

  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, getBlockControls(), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.Placeholder, null, isSelected && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_inspector__WEBPACK_IMPORTED_MODULE_5__["default"], {
    attributes: attributes,
    setAttributes: setAttributes
  }), isEditing ? renderEditMode(attributes) : renderViewMode(attributes)));
};

/***/ }),

/***/ "./assets/src/js/admin/block/list-properties/index.tsx":
/*!*************************************************************!*\
  !*** ./assets/src/js/admin/block/list-properties/index.tsx ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "settings": () => (/* binding */ settings)
/* harmony export */ });
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit */ "./assets/src/js/admin/block/list-properties/edit.tsx");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./save */ "./assets/src/js/admin/block/list-properties/save.tsx");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./block.json */ "./assets/src/js/admin/block/list-properties/block.json");
/**
 * Register block list properties.
 */



const settings = { ..._block_json__WEBPACK_IMPORTED_MODULE_2__,
  edit: _edit__WEBPACK_IMPORTED_MODULE_0__.edit,
  save: _save__WEBPACK_IMPORTED_MODULE_1__.save
};

/***/ }),

/***/ "./assets/src/js/admin/block/list-properties/inspector.tsx":
/*!*****************************************************************!*\
  !*** ./assets/src/js/admin/block/list-properties/inspector.tsx ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);





const Inspector = _ref => {
  let {
    attributes,
    setAttributes
  } = _ref;
  const {
    postsPerPage,
    orderBy
  } = attributes;
  const orderByList = [{
    value: 'popular',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Popularity', 'realpress')
  }, {
    value: 'latest',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Latest', 'realpress')
  }, {
    value: 'price',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Price: low to high', 'realpress')
  }, {
    value: 'price-to-low',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Price: high to low', 'realpress')
  }];
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Settings', 'gridflow'),
    initialOpen: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: "Post per page",
    type: "number",
    value: parseInt(postsPerPage),
    min: 1,
    onChange: value => setAttributes({
      postsPerPage: parseInt(value)
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.SelectControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Order by', 'realpress'),
    value: orderBy,
    options: orderByList,
    onChange: value => setAttributes({
      orderBy: value
    })
  }))));
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Inspector);

/***/ }),

/***/ "./assets/src/js/admin/block/list-properties/save.tsx":
/*!************************************************************!*\
  !*** ./assets/src/js/admin/block/list-properties/save.tsx ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "save": () => (/* binding */ save)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);


const save = props => {
  const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null));
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/price/edit.tsx":
/*!***********************************************************!*\
  !*** ./assets/src/js/admin/block/property/price/edit.tsx ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "edit": () => (/* binding */ edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _inspector__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./inspector */ "./assets/src/js/admin/block/property/price/inspector.tsx");




const edit = props => {
  const {
    attributes,
    setAttributes
  } = props;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.BlockControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ToolbarGroup, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "realpress-price-property",
    style: {
      padding: "20px"
    }
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("i", {
    style: {
      color: attributes.color
    }
  }, "Price property")), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_inspector__WEBPACK_IMPORTED_MODULE_3__["default"], {
    attributes: attributes,
    setAttributes: setAttributes
  }));
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/price/index.tsx":
/*!************************************************************!*\
  !*** ./assets/src/js/admin/block/property/price/index.tsx ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "settings": () => (/* binding */ settings)
/* harmony export */ });
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/title.js");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit */ "./assets/src/js/admin/block/property/price/edit.tsx");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./save */ "./assets/src/js/admin/block/property/price/save.tsx");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./block.json */ "./assets/src/js/admin/block/property/price/block.json");
/**
 * Register block title property.
 */




const settings = { ..._block_json__WEBPACK_IMPORTED_MODULE_2__,
  icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_0__.edit,
  save: _save__WEBPACK_IMPORTED_MODULE_1__.save
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/price/inspector.tsx":
/*!****************************************************************!*\
  !*** ./assets/src/js/admin/block/property/price/inspector.tsx ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);





const Inspector = _ref => {
  let {
    attributes,
    setAttributes
  } = _ref;
  const {
    color
  } = attributes;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Settings', 'gridflow'),
    initialOpen: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.TextControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Color', 'gridflow'),
    value: color,
    onChange: value => setAttributes({
      color: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ColorPicker, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Color', 'gridflow'),
    value: color,
    enableAlpha: true,
    onChange: value => setAttributes({
      color: value
    })
  }))));
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Inspector);

/***/ }),

/***/ "./assets/src/js/admin/block/property/price/save.tsx":
/*!***********************************************************!*\
  !*** ./assets/src/js/admin/block/property/price/save.tsx ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "save": () => (/* binding */ save)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);

const save = props => {
  const {
    attributes,
    setAttributes
  } = props;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    style: {
      color: attributes.color
    }
  }, "Content Property Price"));
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/title/edit.tsx":
/*!***********************************************************!*\
  !*** ./assets/src/js/admin/block/property/title/edit.tsx ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "edit": () => (/* binding */ edit)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _inspector__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./inspector */ "./assets/src/js/admin/block/property/title/inspector.tsx");





const edit = props => {
  const {
    attributes,
    setAttributes,
    isSelected
  } = props;
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)();
  const {
    color
  } = attributes;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", blockProps, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.BlockControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.ToolbarGroup, null)), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_inspector__WEBPACK_IMPORTED_MODULE_4__["default"], {
    attributes: attributes,
    setAttributes: setAttributes
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      padding: "20px",
      color: color
    }
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_3__.__)('Title property', 'realpress')));
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/title/index.tsx":
/*!************************************************************!*\
  !*** ./assets/src/js/admin/block/property/title/index.tsx ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "settings": () => (/* binding */ settings)
/* harmony export */ });
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/title.js");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./edit */ "./assets/src/js/admin/block/property/title/edit.tsx");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./save */ "./assets/src/js/admin/block/property/title/save.tsx");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./block.json */ "./assets/src/js/admin/block/property/title/block.json");
/**
 * Register block title property.
 */




const settings = { ..._block_json__WEBPACK_IMPORTED_MODULE_2__,
  icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_3__["default"],
  edit: _edit__WEBPACK_IMPORTED_MODULE_0__.edit,
  save: _save__WEBPACK_IMPORTED_MODULE_1__.save
};

/***/ }),

/***/ "./assets/src/js/admin/block/property/title/inspector.tsx":
/*!****************************************************************!*\
  !*** ./assets/src/js/admin/block/property/title/inspector.tsx ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__);





const inspector = _ref => {
  let {
    attributes,
    setAttributes
  } = _ref;
  const {
    isLink,
    openNewTab,
    color,
    fontSize
  } = attributes;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Settings', 'realpress'),
    initialOpen: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Make title a link', 'realpress'),
    checked: isLink,
    onChange: () => setAttributes({
      isLink: !isLink
    })
  }), isLink && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ToggleControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Open link in a new tab', 'realpress'),
    checked: openNewTab,
    onChange: () => setAttributes({
      openNewTab: !openNewTab
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.Dropdown, {
    className: "my-container-class-name",
    contentClassName: "my-popover-content-classname",
    position: "bottom center",
    renderToggle: _ref2 => {
      let {
        isOpen,
        onToggle
      } = _ref2;
      return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
        onClick: onToggle,
        "aria-expanded": isOpen
      }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", null, "Color  "), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
        style: {
          display: "inline-block",
          background: color,
          width: "20px",
          height: "20px",
          borderRadius: "50%",
          paddingLeft: "10px",
          border: "1px solid black"
        }
      }));
    },
    renderContent: () => (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_3__.ColorPicker, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Color', 'realpress'),
      value: color,
      onChange: value => setAttributes({
        color: value
      })
    })
  }))));
};

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (inspector);

/***/ }),

/***/ "./assets/src/js/admin/block/property/title/save.tsx":
/*!***********************************************************!*\
  !*** ./assets/src/js/admin/block/property/title/save.tsx ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "save": () => (/* binding */ save)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);


const save = _ref => {
  let {
    attributes,
    className
  } = _ref;
  const {
    color
  } = attributes;
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    style: {
      padding: "20px",
      color: color
    }
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Title property', 'realpress')));
};

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "@wordpress/primitives":
/*!************************************!*\
  !*** external ["wp","primitives"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["primitives"];

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/archive/block.json":
/*!**********************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/archive/block.json ***!
  \**********************************************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"realpress/archive-property","title":"Archive Property","category":"realpress-category","description":"Renders legacy Thim Real Estate Archive property PHP templates.","textdomain":"realpress","keywords":["single property","thim realpress"],"usesContext":["postType","postId","queryId"],"supports":{"html":false,"spacing":{"margin":true,"padding":true},"typography":{"fontSize":true,"lineHeight":true},"color":{"gradients":true,"link":true}}}');

/***/ }),

/***/ "./assets/src/js/admin/block/legacy-template/single/block.json":
/*!*********************************************************************!*\
  !*** ./assets/src/js/admin/block/legacy-template/single/block.json ***!
  \*********************************************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"realpress/single-property","title":"Single Property","category":"realpress-category","description":"Renders legacy Thim Real Estate Single property PHP templates.","textdomain":"realpress","keywords":["single property","thim realpress"],"usesContext":["postType","postId","queryId"]}');

/***/ }),

/***/ "./assets/src/js/admin/block/list-properties/block.json":
/*!**************************************************************!*\
  !*** ./assets/src/js/admin/block/list-properties/block.json ***!
  \**************************************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"realpress/list-properties","title":"List Properties","category":"realpress-category","description":"Renders legacy Thim Real Estate Archive property PHP templates.","textdomain":"realpress","attributes":{"postsPerPage":{"type":"number","default":3},"orderBy":{"type":"string","default":"latest"}}}');

/***/ }),

/***/ "./assets/src/js/admin/block/property/price/block.json":
/*!*************************************************************!*\
  !*** ./assets/src/js/admin/block/property/price/block.json ***!
  \*************************************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"realpress/property-price","title":"Price Property","category":"realpress-category","description":"Display property price.","textdomain":"realpress","usesContext":["postType","postId","queryId"],"parent":["realpress/list-properties"],"attributes":{"color":{"type":"string","default":"#000000"},"fontSize":{"type":"string","default":"h1"}}}');

/***/ }),

/***/ "./assets/src/js/admin/block/property/title/block.json":
/*!*************************************************************!*\
  !*** ./assets/src/js/admin/block/property/title/block.json ***!
  \*************************************************************/
/***/ ((module) => {

module.exports = JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"realpress/property-title","title":"Property Title","textdomain":"realpress","description":"Display property title.","usesContext":["postType","postId","queryId"],"parent":["realpress/list-properties"],"supports":{},"attributes":{"isLink":{"type":"boolean","default":true},"openNewTab":{"type":"boolean","default":true},"color":{"type":"string","default":"#000000"},"fontSize":{"type":"string","default":"h1"}}}');

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
/*!*********************************************!*\
  !*** ./assets/src/js/admin/block/block.tsx ***!
  \*********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _legacy_template_single__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./legacy-template/single */ "./assets/src/js/admin/block/legacy-template/single/index.tsx");
/* harmony import */ var _legacy_template_archive__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./legacy-template/archive */ "./assets/src/js/admin/block/legacy-template/archive/index.tsx");
/* harmony import */ var _list_properties__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./list-properties */ "./assets/src/js/admin/block/list-properties/index.tsx");
/* harmony import */ var _property_price__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./property/price */ "./assets/src/js/admin/block/property/price/index.tsx");
/* harmony import */ var _property_title__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./property/title */ "./assets/src/js/admin/block/property/title/index.tsx");
/**
 * Call list block of Thim Real Estate
 */







const getAllBlock = () => {
  // return [ archive, single, listProperties, priceProperty, titleProperty ];
  return [_legacy_template_single__WEBPACK_IMPORTED_MODULE_1__, _legacy_template_archive__WEBPACK_IMPORTED_MODULE_2__, _list_properties__WEBPACK_IMPORTED_MODULE_3__, _property_title__WEBPACK_IMPORTED_MODULE_5__, _property_price__WEBPACK_IMPORTED_MODULE_4__];
};

getAllBlock().forEach(block => {
  const {
    settings
  } = block;
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)(settings.name, { ...settings
  });
});
})();

/******/ })()
;
//# sourceMappingURL=realpress-edit-block.js.map