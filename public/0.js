webpackJsonp([0],{

/***/ 485:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(486)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(488)
/* template */
var __vue_template__ = __webpack_require__(489)
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3d543f23"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources\\assets\\js\\components\\View\\Dashboard.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Dashboard.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3d543f23", Component.options)
  } else {
    hotAPI.reload("data-v-3d543f23", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 486:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(487);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("17fe20be", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d543f23\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dashboard.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3d543f23\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dashboard.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 487:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(undefined);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* Profie */\n\n/* Grid Menu */\n.grid-menu[data-v-3d543f23] {\n    width: 100%;\n}\n.float-left[data-v-3d543f23] {\n    float: left;\n}\n.centering-and-alignment[data-v-3d543f23] {\n    display: box;\n    display: -ms-box;\n    display: -moz-box;\n    display: -o-box;\n    display: -webkit-box;\n    box-align: center;\n    -ms-box-align: center;\n    -moz-box-align: center;\n    -o-box-align: center;\n    -webkit-box-align: center;\n    box-pack: center;\n    -ms-box-pack: center;\n    -moz-box-pack: center;\n    -o-box-pack: center;\n    -webkit-box-pack: center;\n}\n.grid-menu-item[data-v-3d543f23] {\n    width: 50%;\n    height: 100%;\n    min-width: 100px;\n    min-height: 100px;\n    margin: 0;\n    padding: 0;\n    border-left: 1px solid #cecece !important;\n    border-bottom: 1px solid #cecece !important;\n    font-size: 48px;\n    text-align: center;\n}\n.grid-menu-item[data-v-3d543f23]:first-child {\n    border-left: none !important;\n}\n.grid-menu-item ons-icon[data-v-3d543f23] {\n    margin-top: 20px;\n    font-size: 36px;\n}\n.grid-menu-item-label[data-v-3d543f23] {\n    font-size: 16px;\n}\n.grid-menu-item.topcoat-list__item[data-v-3d543f23] {\n    border: none;\n}\n\n/* Onsen Ranges */\n.margin-top-adjust[data-v-3d543f23] {\n    margin-top: -1px;\n}\n.list-item-left[data-v-3d543f23] {\n    display: inline-block;\n    width: 10%;\n    text-align: center;\n}\n.list-item-center[data-v-3d543f23] {\n    display: inline-block;\n    width: 75%;\n    text-align: center;\n}\n.range-center[data-v-3d543f23] {\n    width: 100%;\n    vertical-align: -10px;\n}\n.list-item-right[data-v-3d543f23] {\n    display: inline-block;\n    width: 10%;\n    text-align: center;\n}\n.lower[data-v-3d543f23] {\n    opacity: 0.4;\n}\n\n/* Extra style rule for the Home Grid home.html */\n.home-grid[data-v-3d543f23] {\n    padding: 0 0 20px 0;\n}\n\n/* Fix for Onsen 1.2.2 */\n.navigation-bar__title[data-v-3d543f23] {\n    text-overflow: ellipsis;\n    overflow: hidden;\n    height: auto;\n}\n.navigation-bar--android__center[data-v-3d543f23] {\n    max-width: 50%;\n    overflow: hidden;\n    text-overflow: ellipsis;\n}\n.row-center[data-v-3d543f23] {\n    text-align: center;\n}\n", ""]);

// exports


/***/ }),

/***/ 488:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Ajax_getData__ = __webpack_require__(1);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            gridList: [[{
                icon: 'fa-leaf',
                color: 'w3-flat-turquoise',
                label: 'Repositories of Plants',
                url: 'plant-navigator'
            }, {
                icon: 'ion-images',
                color: 'w3-flat-green-sea',
                label: 'Gallery',
                url: 'plant-navigator'
            }], [{
                icon: 'fa-map-marker',
                color: 'w3-flat-peter-river',
                label: 'Map',
                url: 'navigation-map'
            }, {
                icon: 'fa-comment',
                color: 'w3-flat-belize-hole',
                label: 'Contact Us!',
                url: 'chat-manage'
            }], [{
                icon: 'md-settings',
                color: 'w3-flat-amethyst',
                label: 'Setting',
                url: 'view-settings'
            }, {
                icon: 'fa-history',
                color: 'w3-flat-wisteria',
                label: 'Recent',
                url: 'navigation-timeline'
            }], [{
                icon: 'fa-comments',
                color: 'w3-flat-alizarin',
                label: 'Feedback',
                url: 'view-settings'
            }, {
                icon: 'fa-question-circle',
                color: 'w3-flat-pomegranate',
                label: 'Help',
                url: 'navigation-timeline'
            }]]
        };
    },
    mounted: function mounted() {
        var vm = this;
    },

    methods: {
        changeView: function changeView() {
            var vm = this;
            Object(__WEBPACK_IMPORTED_MODULE_0__Ajax_getData__["s" /* change_view */])();
            vm.onBack = true;
        },
        dashView: function dashView(url, name) {
            Object(__WEBPACK_IMPORTED_MODULE_0__Ajax_getData__["B" /* currentPageSwitcher */])(url, name);
        }
    }
});

/***/ }),

/***/ 489:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-ons-page",
    { attrs: { id: "main" } },
    [
      _c("v-ons-toolbar", [
        _c(
          "div",
          { staticClass: "left" },
          [
            _c(
              "v-ons-toolbar-button",
              { on: { click: _vm.changeView } },
              [
                _c("v-ons-icon", {
                  attrs: { icon: "ion-navicon, material:md-menu" }
                })
              ],
              1
            )
          ],
          1
        ),
        _vm._v(" "),
        _c("div", { staticClass: "center" }, [_vm._v("Dashboard")])
      ]),
      _vm._v(" "),
      _c("v-ons-list", [
        _c("div", { staticClass: "w3-flat-wet-asphalt profile-card" }, [
          _c("div", { staticClass: "profile-desc" }, [
            _vm._v(
              "The Mount Hamiguitan range, with an area of 6,834 hectares (68.34 km2), was\n                declared a national park and a wildlife sanctuary in 2003. In 2014, the park was inscribed as a\n                UNESCO World Heritage Site, becoming the first in Mindanao.\n            "
            )
          ])
        ]),
        _vm._v(" "),
        _c("section", { staticClass: "home-grid" }, [
          _c(
            "div",
            { staticClass: "grid-menu" },
            _vm._l(_vm.gridList, function(grid) {
              return _c(
                "div",
                { staticClass: "centering-and-alignment" },
                _vm._l(grid, function(list) {
                  return _c(
                    "div",
                    {
                      staticClass:
                        "grid-menu-item list__item list__item--tappable",
                      class: list.color,
                      on: {
                        click: function($event) {
                          _vm.dashView(list.url, list.label)
                        }
                      }
                    },
                    [
                      _c("v-ons-icon", { attrs: { icon: list.icon } }),
                      _vm._v(" "),
                      _c("div", { staticClass: "grid-menu-item-label" }, [
                        _vm._v(_vm._s(list.label))
                      ])
                    ],
                    1
                  )
                })
              )
            })
          )
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-3d543f23", module.exports)
  }
}

/***/ })

});