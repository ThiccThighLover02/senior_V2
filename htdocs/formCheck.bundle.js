/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/formCheck.js":
/*!**************************!*\
  !*** ./src/formCheck.js ***!
  \**************************/
/***/ (() => {

eval("$(document).ready(() => {\n  let password = $('#password');\n  $('#checked').click(function () {\n    let isChecked = $(this).prop('checked');\n    if (isChecked) {\n      password.attr(\"type\", \"text\");\n    } else {\n      password.attr(\"type\", \"password\");\n    }\n  });\n  $('#login-form').submit(function (event) {\n    let formData = {\n      username: $('#username').val(),\n      password: $('#password').val()\n    };\n    console.log(formData);\n    fetch('http://localhost/new_systemV2/queries/login_check.php', {\n      method: \"POST\",\n      headers: {\n        'Content-Type': 'application/json'\n      },\n      body: JSON.stringify(formData)\n    }).then(response => {\n      if (!response.ok) {\n        throw new Error('Network response was not ok');\n      }\n      // Handle response data directly here\n      return response.json(); // Parse JSON response\n    }).then(data => {\n      let {\n        success,\n        message,\n        user\n      } = data;\n      // Handle JSON data\n      if (success) {\n        if (user == \"admin\") {\n          window.location.href = \"admin/admin_home.php\";\n        } else if (user == \"senior\") {\n          window.location.href = \"localhost/new_systemV2/senior_home\";\n        }\n      } else {\n        alert(message);\n      }\n    }).catch(err => {\n      console.log(err);\n    });\n    event.preventDefault();\n  });\n});\n\n//# sourceURL=webpack://new_systemv2/./src/formCheck.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/formCheck.js"]();
/******/ 	
/******/ })()
;