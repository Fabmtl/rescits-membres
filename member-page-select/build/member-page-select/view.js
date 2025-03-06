/******/ (() => { // webpackBootstrap
/*!****************************************!*\
  !*** ./src/member-page-select/view.js ***!
  \****************************************/
// Version: 1.0
(function () {
  "use-strict";

  const selectedOption = document.querySelector(".selected-option");
  selectedOption.addEventListener("click", function () {
    const optionsContainer = document.querySelector(".options-container");
    const svgIcon = document.querySelector(".svg-icon");
    optionsContainer.classList.toggle("active");
    svgIcon.classList.toggle("active");
  });
})();
/******/ })()
;
//# sourceMappingURL=view.js.map