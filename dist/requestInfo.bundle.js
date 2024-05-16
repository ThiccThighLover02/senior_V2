/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/requestInfo.js":
/*!****************************!*\
  !*** ./src/requestInfo.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _service_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./service.js */ \"./src/service.js\");\n\n$(document).ready(function () {\n  //initialize the data to get the info for the request\n  const urlParams = new URLSearchParams(window.location.search);\n  let id = urlParams.get(\"id\");\n  let requestContainer = $(\"#profile-container\");\n  let spinner = $(\"#spinner\");\n  let buttonContainer = $(\"#button-container\"); //this is the container for the buttons\n\n  //this will fetch the data from the seniorInfo file\n  (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(`/components/seniorInfo.php?id=${id}&info=request`).then(response => response.text()).then(data => {\n    spinner.hide();\n    requestContainer.removeClass(\"d-flex justify-content-center align-items-center\");\n    requestContainer.html(data);\n  }).catch(err => {\n    alert(err);\n  });\n\n  //all the functions for the buttons in the button container will go here\n\n  buttonContainer.on(\"click\", \"#accept-senior\", function () {\n    let requestId = $(this).data(\"request-id\");\n    (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(`queries/create_senior.php?id=${requestId}&action=approve`).then(response => response.text()).then(data => {\n      alert(data);\n      window.location.href = \"./admin_requests.php\";\n    }).catch(err => {\n      alert(`Catched this ${err}`);\n    });\n  });\n  buttonContainer.on(\"click\", \"#reject-senior\", function () {\n    let requestId = $(this).data(\"request-id\");\n    if (confirm(\"Reject this request?\")) {\n      (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(`queries/create_senior.php?id=${requestId}&action=reject`).then(response => {\n        if (!response.ok) {\n          alert(\"An error has occurred, try again\");\n        }\n        return response.json();\n      }).then(data => {\n        let {\n          success,\n          message\n        } = data;\n        if (success) {\n          alert(message);\n          window.location.href = \"./admin_requests.php\";\n        }\n      }).catch(err => {\n        alert(`Catched this ${err}`);\n      });\n    }\n  });\n});\n\n//# sourceURL=webpack://new_systemv2/./src/requestInfo.js?");

/***/ }),

/***/ "./src/service.js":
/*!************************!*\
  !*** ./src/service.js ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\nconst getData = (url, fetchOptions = {}) => {\n  if (url) {\n    return fetch(`http://localhost/new_systemV2/${url}`, fetchOptions);\n  }\n  return fetch('http://localhost/new_systemV2');\n};\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (getData);\n\n//# sourceURL=webpack://new_systemv2/./src/service.js?");

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
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/requestInfo.js");
/******/ 	
/******/ })()
;