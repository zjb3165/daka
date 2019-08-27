(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/components/switch.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'daka-switch',
  data: function data() {
    return {
      checkedValue: this.checked
    };
  },
  model: {
    prop: 'checked',
    event: 'change'
  },
  props: ['checked'],
  methods: {
    toggle: function toggle() {
      this.checkedValue = !this.checkedValue;
      this.$emit('change', this.checkedValue);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _components_switch__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/switch */ "./resources/front/src/components/switch.vue");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(source, true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(source).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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
  components: {
    DakaSwitch: _components_switch__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])({
    style: 'app/style',
    checked: 'caution/checked',
    type: 'caution/type',
    time: 'caution/time'
  })),
  methods: {
    toggleChange: function toggleChange(value) {
      this.$store.dispatch('caution/toggleCheck', {
        code: this.style,
        status: value
      });
    },
    choose: function choose(type) {
      this.$store.dispatch('caution/setType', type);
    },
    save: function save() {
      console.log('save');
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/lib/loader.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".daka-switch[data-v-31b4e6f4] {\n  position: relative;\n  width: 1.3333333333rem;\n  height: 0.8rem;\n  border-radius: 0.4rem;\n  background: #ccc;\n  border: 1px solid #ccc;\n}\n.daka-switch .round[data-v-31b4e6f4] {\n  float: left;\n  width: 0.7466666667rem;\n  height: 0.7466666667rem;\n  border-radius: 50%;\n  background: #fff;\n  padding: 0.0266666667rem;\n}\n.daka-switch.checked[data-v-31b4e6f4] {\n  background: #374674;\n}\n.daka-switch.checked .round[data-v-31b4e6f4] {\n  float: right;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/lib/loader.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".page[data-v-2d3cc1a4] {\n  padding: 0.4rem;\n  background: #fff;\n}\n.caution-line[data-v-2d3cc1a4] {\n  display: flex;\n  height: 0.8rem;\n  line-height: 0.8rem;\n  padding: 0.2rem;\n  justify-content: space-between;\n  border-bottom: 1px solid #eee;\n  font-weight: bold;\n}\n.caution-panel[data-v-2d3cc1a4] {\n  padding-top: 0.5333333333rem;\n}\n.caution-panel .panel-title[data-v-2d3cc1a4] {\n  font-weight: bold;\n}\n.caution-panel .panel-title span[data-v-2d3cc1a4] {\n  font-weight: normal;\n  font-size: 0.3733333333rem;\n  margin-left: 0.2rem;\n}\n.caution-panel .caution-select[data-v-2d3cc1a4] {\n  padding-top: 0.5333333333rem;\n  padding-bottom: 0.5333333333rem;\n  display: flex;\n  justify-content: space-around;\n}\n.caution-panel .caution-select .caution-col[data-v-2d3cc1a4] {\n  width: 50%;\n}\n.caution-panel .caution-select .caution-col .caution-block[data-v-2d3cc1a4] {\n  margin: 0 auto;\n  width: 3.2666666667rem;\n  height: 3.2666666667rem;\n}\n.caution-panel .caution-select .caution-col .block[data-v-2d3cc1a4] {\n  margin: 0 auto;\n  width: 2.6666666667rem;\n  height: 2.6666666667rem;\n  background: #f6f6f6;\n  transform: translateY(0.2933333333rem);\n}\n.caution-panel .caution-select .caution-col .block .icon[data-v-2d3cc1a4] {\n  margin: 0 auto;\n  width: 1.0666666667rem;\n  height: 1.0666666667rem;\n  transform: translateY(0.5333333333rem);\n  color: #cfcfcf;\n}\n.caution-panel .caution-select .caution-col .block .text[data-v-2d3cc1a4] {\n  margin-top: 0.4rem;\n  text-align: center;\n  color: #cfcfcf;\n  font-size: 0.3466666667rem;\n}\n.caution-panel .caution-select .caution-col .check-row[data-v-2d3cc1a4] {\n  text-align: center;\n  margin-top: 0.4rem;\n}\n.caution-panel .caution-select .caution-col .check-row .check-btn[data-v-2d3cc1a4] {\n  margin: 0 auto;\n  width: 0.5333333333rem;\n  height: 0.5333333333rem;\n  border-radius: 50%;\n  border: 1px solid #959595;\n}\n.caution-panel .caution-select .caution-col.active .block[data-v-2d3cc1a4] {\n  width: 3.2666666667rem;\n  height: 3.2666666667rem;\n  background: #fff;\n  box-shadow: 0 0 0.3333333333rem 0.0666666667rem #eee;\n  transform: translateY(0);\n}\n.caution-panel .caution-select .caution-col.active .check-btn[data-v-2d3cc1a4] {\n  border-color: #1d2a4f;\n  background: #1d2a4f;\n  color: #fff;\n}\n.caution-panel .caution-tips[data-v-2d3cc1a4] {\n  font-size: 0.3733333333rem;\n  text-align: center;\n  color: #333;\n  padding: 0.2666666667rem 0;\n}\n.caution-panel .caution-btns[data-v-2d3cc1a4] {\n  text-align: center;\n  padding: 0.3333333333rem 0;\n}\n.caution-panel .caution-btns .btn[data-v-2d3cc1a4] {\n  width: 6.9333333333rem;\n  height: 1.0666666667rem;\n  line-height: 1.0666666667rem;\n  display: inline-block;\n  background: #ccc;\n  color: #727272;\n  border-radius: 0.5333333333rem;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/lib/loader.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/sass-loader/lib/loader.js??ref--6-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/sass-loader/lib/loader.js??ref--6-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/sass-loader/lib/loader.js??ref--6-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "daka-switch",
      class: { checked: _vm.checkedValue },
      on: { click: _vm.toggle }
    },
    [_c("div", { staticClass: "round" })]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "page" }, [
    _c("div", { staticClass: "caution-line" }, [
      _c("div", { staticClass: "line-label" }, [
        _vm._v(
          "开启每日" +
            _vm._s(_vm.style === "morning" ? "早起" : "晚安") +
            "提醒"
        )
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "line-footer" },
        [
          _c("daka-switch", {
            attrs: { checked: _vm.checked },
            on: { change: _vm.toggleChange }
          })
        ],
        1
      )
    ]),
    _vm._v(" "),
    _vm.checked
      ? _c("div", { staticClass: "caution-panel" }, [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "panel-body" }, [
            _c("div", { staticClass: "caution-select" }, [
              _c(
                "div",
                {
                  staticClass: "caution-col",
                  class: { active: _vm.type === 1 },
                  on: {
                    click: function($event) {
                      return _vm.choose(1)
                    }
                  }
                },
                [_vm._m(1), _vm._v(" "), _vm._m(2)]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "caution-col",
                  class: { active: _vm.type === 2 },
                  on: {
                    click: function($event) {
                      return _vm.choose(2)
                    }
                  }
                },
                [_vm._m(3), _vm._v(" "), _vm._m(4)]
              )
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "caution-tips" },
              [
                _vm.type === 1
                  ? _c("div", { staticClass: "text" }, [
                      _vm._v("系统根据你最近的平均打卡时间"),
                      _c("br"),
                      _vm._v("发送一条消息提醒你打卡")
                    ])
                  : [
                      _c("div", { staticClass: "caution-line" }, [
                        _c("div", { staticClass: "line-label" }, [
                          _vm._v("设定提醒时间")
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "label-footer" }, [
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: _vm.time,
                                expression: "time"
                              }
                            ],
                            attrs: { type: "time" },
                            domProps: { value: _vm.time },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.time = $event.target.value
                              }
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _vm._m(5)
                    ]
              ],
              2
            ),
            _vm._v(" "),
            _c("div", { staticClass: "caution-btns" }, [
              _c("div", { staticClass: "btn save", on: { click: _vm.save } }, [
                _vm._v("保存")
              ])
            ])
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "panel-title" }, [
      _vm._v("\n            提醒方式"),
      _c("span", [_vm._v("(2选1)")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "caution-block" }, [
      _c("div", { staticClass: "block" }, [
        _c("div", { staticClass: "icon" }),
        _vm._v(" "),
        _c("div", { staticClass: "text" }, [
          _vm._v(
            "\n                                智能提醒\n                            "
          )
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "check-row" }, [
      _c("div", { staticClass: "check-btn" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "caution-block" }, [
      _c("div", { staticClass: "block" }, [
        _c("div", { staticClass: "icon" }),
        _vm._v(" "),
        _c("div", { staticClass: "text" }, [
          _vm._v(
            "\n                                自定义提醒\n                            "
          )
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "check-row" }, [
      _c("div", { staticClass: "check-btn" })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "text" }, [
      _vm._v("系统会在你设定的时间"),
      _c("br"),
      _vm._v("发送一条消息提醒你打卡")
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/front/src/components/switch.vue":
/*!***************************************************!*\
  !*** ./resources/front/src/components/switch.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./switch.vue?vue&type=template&id=31b4e6f4&scoped=true& */ "./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true&");
/* harmony import */ var _switch_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./switch.vue?vue&type=script&lang=js& */ "./resources/front/src/components/switch.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& */ "./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _switch_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "31b4e6f4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/front/src/components/switch.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/front/src/components/switch.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/front/src/components/switch.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./switch.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&":
/*!*************************************************************************************************************!*\
  !*** ./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& ***!
  \*************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/sass-loader/lib/loader.js??ref--6-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=style&index=0&id=31b4e6f4&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_style_index_0_id_31b4e6f4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./switch.vue?vue&type=template&id=31b4e6f4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/components/switch.vue?vue&type=template&id=31b4e6f4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_switch_vue_vue_type_template_id_31b4e6f4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/front/src/pages/feature/caution.vue":
/*!*******************************************************!*\
  !*** ./resources/front/src/pages/feature/caution.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./caution.vue?vue&type=template&id=2d3cc1a4&scoped=true& */ "./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true&");
/* harmony import */ var _caution_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./caution.vue?vue&type=script&lang=js& */ "./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& */ "./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _caution_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "2d3cc1a4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/front/src/pages/feature/caution.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./caution.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&":
/*!*****************************************************************************************************************!*\
  !*** ./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& ***!
  \*****************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--6-2!../../../../../node_modules/sass-loader/lib/loader.js??ref--6-3!../../../../../node_modules/vue-loader/lib??vue-loader-options!./caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/sass-loader/lib/loader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=style&index=0&id=2d3cc1a4&lang=scss&scoped=true&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_sass_loader_lib_loader_js_ref_6_3_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_style_index_0_id_2d3cc1a4_lang_scss_scoped_true___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true&":
/*!**************************************************************************************************!*\
  !*** ./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./caution.vue?vue&type=template&id=2d3cc1a4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/front/src/pages/feature/caution.vue?vue&type=template&id=2d3cc1a4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_caution_vue_vue_type_template_id_2d3cc1a4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);