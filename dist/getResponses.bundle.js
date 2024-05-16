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

/***/ "./src/getResponses.js":
/*!*****************************!*\
  !*** ./src/getResponses.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _service_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./service.js */ \"./src/service.js\");\n\n$(document).ready(function () {\n  let cardContainer = $(\"#card-container\"); //this is the card container, to hold the contents for the posts\n  let createPost = $(\"#create-post\"); //this is the button used to create a post\n  let modalBody = $(\"#modal-body\"); //This is the modal body, where we will put the content in\n  let modal = $(\"#modalId\"); //this is the modal that we are using\n  let spinner = $(\"#spinner\"); //this is for the loader or spinner\n  let spinnerModal = $(\"#spinner-modal\");\n\n  //This is used to fetch the posts from activity_tbl in newsFeedCards.php\n  spinner.show(); // we will show the spinner\n  (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(\"components/newsFeedCards.php\").then(response => response.text()).then(data => {\n    spinner.hide();\n    cardContainer.html(data);\n  }).catch(error => {\n    console.error(\"Error fetching data:\", error);\n    throw error; // Re-throw the error to propagate it to the caller\n  });\n\n  //used to edit the post\n  cardContainer.on(\"click\", \"#edit\", function () {\n    spinnerModal.show();\n    let cardValue = $(this).data(\"card-id\");\n    (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(`components/newsFeedCards.php?id=${cardValue}&modal=true`).then(response => response.text()).then(data => {\n      spinnerModal.hide(); //hide loading circle\n      modalBody.removeClass(\"d-flex align-items-center justify-content-center\");\n      modalBody.html(data);\n    }).catch(err => {\n      alert(`there has been an error ${err}`);\n    });\n    $(\"#modal-text\").html(cardValue);\n    modal.modal(\"show\");\n  });\n\n  //functions here will edit the post\n  modal.on(\"click\", \"#update-button\", function () {\n    if (confirm(\"Update this post?\")) {\n      $(\"#edit-form\").submit();\n    }\n  });\n  modal.on(\"submit\", \"#edit-form\", function (event) {\n    let formId = $(this).data(\"form-id\");\n    event.preventDefault();\n    const formArr = $(this).serializeArray();\n    formArr.push({\n      name: \"action\",\n      value: \"update\"\n    }, {\n      name: \"id\",\n      value: formId\n    });\n    (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(\"queries/createData.php\", {\n      method: \"POST\",\n      headers: {\n        \"Content-Type\": \"application/json\"\n      },\n      body: JSON.stringify(formArr)\n    }).then(response => {\n      if (!response.ok) {\n        console.log(\"deym sum wrong\");\n      }\n      return response.json();\n    }).then(data => {\n      let {\n        message\n      } = data;\n      console.log(message);\n      $(\"#modalId\").modal(\"hide\");\n    }).catch(err => {\n      console.log(err);\n    });\n  });\n\n  //used to create a post\n  createPost.click(function () {\n    spinnerModal.hide(); //hide loading circle\n    modalBody.removeClass(\"d-flex align-items-center justify-content-center\");\n    fetch(\"http://localhost/new_systemV2/components/createPostModal.php\").then(response => response.text()).then(data => {\n      modalBody.html(data);\n      modal.modal(\"show\");\n    }).catch(err => {\n      console.log(err);\n    });\n  });\n  modal.on(\"click\", \"#create-post\", function () {\n    $(\"#create-form\").submit();\n  });\n  modal.on(\"submit\", \"#create-form\", function (event) {\n    let formData = new FormData(this);\n    let image = $(\"#image\")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!\n\n    formData.append(\"image\", image);\n    formData.append(\"action\", \"post\"); //push this object to the data array\n\n    console.log(formData);\n\n    //use fetch api to send the data to getData.php\n    (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(\"queries/createPost.php\", {\n      method: \"POST\",\n      body: formData\n    }).then(response => {\n      if (!response.ok) {\n        console.log(\"this shit\");\n      }\n      return response.json();\n    }).then(res => {\n      console.log(res);\n      console.log(\"request to create sent\");\n    }).catch(err => {\n      console.log(err);\n    });\n    event.preventDefault(); //prevent the submission of the form\n  });\n});\n\n//# sourceURL=webpack://new_systemv2/./src/getResponses.js?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./src/getResponses.js");
/******/ 	
/******/ })()
;