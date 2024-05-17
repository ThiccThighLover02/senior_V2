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

/***/ "./src/service.js":
/*!************************!*\
  !*** ./src/service.js ***!
  \************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\nconst getData = (url, fetchOptions = {}) => {\n  if (url) {\n    return fetch(`http://localhost/new_systemV2/${url}`, fetchOptions);\n  }\n  return fetch('http://localhost/new_systemV2');\n};\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (getData);\n\n//# sourceURL=webpack://new_systemv2/./src/service.js?");

/***/ }),

/***/ "./src/signUp.js":
/*!***********************!*\
  !*** ./src/signUp.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _service_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./service.js */ \"./src/service.js\");\n\n$(document).ready(function () {\n  let signUpForm = $(\"#login-form\");\n  let currDate = new Date();\n\n  //setup minimum date (at least 100 years)\n  let minDate = new Date(currDate);\n  minDate.setFullYear(currDate.getFullYear() - 100);\n  const minString = minDate.toISOString().split(\"T\")[0];\n\n  //setup maximun date (at least 60 years)\n  let maxDate = new Date(currDate);\n  maxDate.setFullYear(currDate.getFullYear() - 60);\n  const maxString = maxDate.toISOString().split(\"T\")[0];\n  $(\"#birthDate\").attr(\"max\", maxString);\n  signUpForm.submit(function (event) {\n    // Check the validity of each input element\n    $(this).addClass(\"was-validated\"); //add was-validated to the class\n    var isValid = true;\n    $(this).find(\"input, select, textarea\").each(function () {\n      if (!this.checkValidity()) {\n        isValid = false;\n        return false; // Stop the loop if an invalid input is found\n      }\n    });\n\n    // If any input is invalid, prevent form submission\n    if (!isValid) {\n      event.preventDefault();\n      event.stopPropagation();\n    } else {\n      event.preventDefault();\n      console.log(\"submitted\");\n      let formData = new FormData(this);\n      let profilePic = $(\"#id-pic\")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!\n      let birthCertificate = $(\"#birth-certificate\")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!\n      let barangayCertificate = $(\"#barangay-certificate\")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!\n\n      formData.append(\"id_pic\", profilePic); //append to form data\n      formData.append(\"birth_certificate\", birthCertificate); //append to form data\n      formData.append(\"barangay_certificate\", barangayCertificate); //append to form data\n      formData.append(\"action\", \"request\"); //push this object to the data array\n\n      (0,_service_js__WEBPACK_IMPORTED_MODULE_0__[\"default\"])(\"queries/senior_request.php\", {\n        method: \"POST\",\n        body: formData\n      }).then(response => {\n        if (!response.ok) {\n          console.log(\"this shit is not ok\");\n        }\n        return response.json();\n      }).then(data => {\n        const {\n          success,\n          message,\n          exist = false\n        } = data;\n        console.log(data);\n        if (success) {\n          alert(message);\n          window.location.href = \"../new_systemV2/login.php\";\n        } else if (!success && exist) {\n          alert(message);\n        }\n        console.log(success, message);\n      });\n    }\n  });\n  window.validateInput = function (input, type) {\n    const feedbackElement = $(`#${input.id}Feedback`);\n    switch (type) {\n      case \"text\":\n        validateTextInput(input, feedbackElement);\n        break;\n      case \"date\":\n        validateDateInput(input, feedbackElement);\n        break;\n      case \"email\":\n        validateEmailInput(input, feedbackElement);\n        break;\n      case \"contact1\":\n        validateContactInput(input, feedbackElement);\n        break;\n      case \"contact2\":\n        validateGuardianContact(input, feedbackElement);\n        break;\n    }\n  };\n  function validateTextInput(input, feedbackElement) {\n    if (!input.checkValidity()) {\n      let minLength = input.minLength;\n      if (input.value.length < minLength) {\n        feedbackElement.text(\"Must be more than 2 characters\");\n      }\n    }\n  }\n  function validateDateInput(input, feedbackElement) {\n    const today = new Date();\n    const birthDate = new Date(input.value);\n    let age = today.getFullYear() - birthDate.getFullYear();\n    const monthDiff = today.getMonth() - birthDate.getMonth();\n\n    // If the birth month is greater than the current month or if both are the same\n    // but the birth day is greater than the current day, decrement age\n    if (monthDiff < 0 || monthDiff === 0 && today.getDate() < birthDate.getDate()) {\n      age--;\n    }\n    console.log(age);\n    if (input.value == \"\") {\n      feedbackElement.text(\"required\");\n      input.setCustomValidity(\"required\");\n    } else if (age < 60) {\n      feedbackElement.text(\"You are not old enough\");\n      input.setCustomValidity(\"You are not old enough\");\n    } else {\n      input.setCustomValidity(\"\");\n    }\n  }\n  function validateEmailInput(input, feedbackElement) {\n    if (!input.checkValidity()) {\n      feedbackElement.text(\"Please input valid email\");\n    }\n  }\n  function validateContactInput(input, feedbackElement) {\n    // let regex = /^9\\d{9}$/;\n    console.log(input.value.match(regex));\n    if (!input.checkValidity()) {\n      feedbackElement.text(\"Required\");\n    } else {}\n  }\n  function validateGuardianContact(input, feedbackElement) {\n    let regex = /^9\\d{9}$/;\n    if (!input.checkValidity()) {\n      feedbackElement.text(\"Required\");\n    } else if (!regex.test(input.value)) {\n      feedbackElement.text(\"Invalid Contact Number\");\n      input.setCustomValidity(\"Invalid Contact Number\");\n    } else {\n      input.setCustomValidity(\"\");\n    }\n  }\n});\n\n//# sourceURL=webpack://new_systemv2/./src/signUp.js?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./src/signUp.js");
/******/ 	
/******/ })()
;