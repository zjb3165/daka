(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[2],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var element_ui__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! element-ui */ "./node_modules/element-ui/lib/element-ui.common.js");
/* harmony import */ var element_ui__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(element_ui__WEBPACK_IMPORTED_MODULE_0__);
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
      listLoading: false,
      dialogVisible: false,
      showDeletePopover: {},
      deletePopoverLoading: {},
      mode: '',
      dlgTitle: '',
      passwordTip: '请填写密码，在6-20位之间',
      adminForm: {
        username: '',
        name: '',
        password: ''
      },
      rules: {},
      formLoading: false
    };
  },
  created: function created() {
    var _this = this;

    this.listLoading = true;
    this.$store.dispatch('admins/getList').then(function () {
      _this.listLoading = false;
    });
  },
  computed: {
    list: function list() {
      return this.$store.getters['admins/list'];
    }
  },
  methods: {
    handleNew: function handleNew() {
      var _this2 = this;

      var validUserName = function validUserName(rule, value, callback) {
        if (value === '') {
          callback(new Error('请填写用户名'));
          return;
        }

        _this2.$store.dispatch('admins/check', value).then(function () {
          if (_this2.$store.getters['admins/usernameExists']) {
            callback(new Error('用户名已存在，请重新选择用户名'));
          } else {
            callback();
          }
        });
      };

      this.dlgTitle = '添加新用户';
      this.dialogVisible = true;
      this.mode = 'create';
      this.passwordTip = '请填写密码，在6-20位之间';
      this.rules = {
        username: [{
          required: true,
          trigger: 'blur',
          message: '必须填写用户名'
        }, {
          min: 4,
          max: 12,
          message: '长度在4-12位字符',
          trigger: 'blur'
        }, {
          trigger: 'blur',
          validator: validUserName
        }],
        name: [{
          required: true,
          trigger: 'blur',
          message: '必须填写姓名'
        }],
        password: [{
          required: true,
          trigger: 'blur',
          message: '必须填写密码'
        }, {
          min: 6,
          max: 20,
          message: '长度在6-20位字符',
          trigger: 'blur'
        }]
      };
      this.adminForm = {
        username: '',
        name: '',
        password: ''
      };
    },
    handleCreate: function handleCreate() {
      var _this3 = this;

      this.$refs.adminForm.validate(function (valid) {
        _this3.formLoading = true;

        if (valid) {
          _this3.$store.dispatch('admins/add', _this3.adminForm).then(function () {
            _this3.formLoading = false;
            _this3.dialogVisible = false;
            Object(element_ui__WEBPACK_IMPORTED_MODULE_0__["Message"])({
              message: '添加成功',
              type: 'success',
              duration: 2000
            });
          })["catch"](function () {
            _this3.formLoading = false;
          });
        } else {
          _this3.formLoading = false;
        }
      });
    },
    handleEdit: function handleEdit(id) {
      var _this4 = this;

      this.$store.dispatch('admins/get', id).then(function () {
        var validPassword = function validPassword(rule, value, callback) {
          if (value !== '' && (value.length < 6 || value.length > 20)) {
            callback('长度在6-20位字符');
          } else {
            callback();
          }
        };

        _this4.dlgTitle = '修改用户', _this4.dialogVisible = true;
        _this4.passwordTip = '如果不需要修改密码，请留空';
        _this4.mode = 'edit';
        _this4.rules = {
          name: [{
            required: true,
            trigger: 'blur',
            message: '必须填写姓名'
          }],
          password: [{
            trigger: 'blur',
            validator: validPassword
          }]
        };
        _this4.adminForm = {
          id: _this4.$store.getters['admins/user'].id,
          username: _this4.$store.getters['admins/user'].username,
          name: _this4.$store.getters['admins/user'].name,
          password: ''
        };
      });
    },
    handleUpdate: function handleUpdate() {
      var _this5 = this;

      this.$refs.adminForm.validate(function (valid) {
        _this5.formLoading = true;

        if (valid) {
          _this5.$store.dispatch('admins/update', {
            id: _this5.adminForm.id,
            name: _this5.adminForm.name,
            password: _this5.adminForm.password
          }).then(function () {
            _this5.formLoading = false;
            _this5.dialogVisible = false;
            Object(element_ui__WEBPACK_IMPORTED_MODULE_0__["Message"])({
              message: '修改成功',
              type: 'success',
              duration: 2000
            });
          })["catch"](function () {
            _this5.formLoading = false;
          });
        } else {
          _this5.formLoading = false;
        }
      });
    },
    handleSave: function handleSave() {
      if (this.mode === 'edit') {
        this.handleUpdate();
      } else {
        this.handleCreate();
      }
    },
    handleDelete: function handleDelete(id) {
      var _this6 = this;

      this.deletePopoverLoading[id] = true;
      this.$store.dispatch('admins/delete', id).then(function () {
        _this6.showDeletePopover[id] = false;
        _this6.deletePopoverLoading[id] = false;
      })["catch"](function () {
        _this6.showDeletePopover[id] = false;
        _this6.deletePopoverLoading[id] = false;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc& ***!
  \**************************************************************************************************************************************************************************************************************/
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
    [
      _c(
        "el-card",
        { attrs: { shadow: "never", "body-style": { padding: "0px" } } },
        [
          _c(
            "div",
            { attrs: { slot: "header" }, slot: "header" },
            [
              _c(
                "el-row",
                { attrs: { type: "flex", justify: "space-between" } },
                [
                  _c("el-col", { attrs: { span: 12 } }, [
                    _c("span", [_vm._v("系统用户管理")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "el-col",
                    { attrs: { span: 12 } },
                    [
                      _c(
                        "el-row",
                        { attrs: { type: "flex", justify: "end" } },
                        [
                          _c(
                            "el-button",
                            {
                              attrs: { icon: "el-icon-plus" },
                              on: { click: _vm.handleNew }
                            },
                            [_vm._v("添加管理员")]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "el-table",
            {
              directives: [
                {
                  name: "loading",
                  rawName: "v-loading",
                  value: _vm.listLoading,
                  expression: "listLoading"
                }
              ],
              attrs: { data: _vm.list, stripe: true }
            },
            [
              _c("el-table-column", {
                attrs: { prop: "id", label: "id", width: "80", align: "center" }
              }),
              _vm._v(" "),
              _c("el-table-column", {
                attrs: { prop: "username", label: "用户名" }
              }),
              _vm._v(" "),
              _c("el-table-column", { attrs: { prop: "name", label: "姓名" } }),
              _vm._v(" "),
              _c("el-table-column", {
                attrs: { label: "操作", width: "250" },
                scopedSlots: _vm._u([
                  {
                    key: "default",
                    fn: function(scope) {
                      return [
                        _c(
                          "el-button",
                          {
                            attrs: { size: "medium", icon: "el-icon-edit" },
                            on: {
                              click: function($event) {
                                return _vm.handleEdit(scope.row.id)
                              }
                            }
                          },
                          [_vm._v("修改")]
                        ),
                        _vm._v(" "),
                        scope.row.username !== "root"
                          ? _c(
                              "el-popover",
                              {
                                attrs: { placement: "top" },
                                model: {
                                  value: _vm.showDeletePopover[scope.row.id],
                                  callback: function($$v) {
                                    _vm.$set(
                                      _vm.showDeletePopover,
                                      scope.row.id,
                                      $$v
                                    )
                                  },
                                  expression: "showDeletePopover[scope.row.id]"
                                }
                              },
                              [
                                _c(
                                  "p",
                                  { staticStyle: { "text-align": "center" } },
                                  [_vm._v("确定要删除吗？")]
                                ),
                                _vm._v(" "),
                                _c(
                                  "div",
                                  { staticStyle: { "text-align": "center" } },
                                  [
                                    _c(
                                      "el-button",
                                      {
                                        attrs: {
                                          size: "mini",
                                          type: "primary",
                                          loading:
                                            _vm.deletePopoverLoading[
                                              scope.row.id
                                            ]
                                        },
                                        on: {
                                          click: function($event) {
                                            return _vm.handleDelete(
                                              scope.row.id
                                            )
                                          }
                                        }
                                      },
                                      [_vm._v("确定")]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "el-button",
                                      {
                                        attrs: { size: "mini" },
                                        on: {
                                          click: function($event) {
                                            _vm.showDeletePopover[
                                              scope.row.id
                                            ] = false
                                          }
                                        }
                                      },
                                      [_vm._v("取消")]
                                    )
                                  ],
                                  1
                                ),
                                _vm._v(" "),
                                _c(
                                  "el-button",
                                  {
                                    attrs: {
                                      slot: "reference",
                                      size: "medium",
                                      icon: "el-icon-delete",
                                      type: "danger"
                                    },
                                    slot: "reference"
                                  },
                                  [_vm._v("删除")]
                                )
                              ],
                              1
                            )
                          : _vm._e()
                      ]
                    }
                  }
                ])
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-dialog",
        {
          attrs: { title: _vm.dlgTitle, visible: _vm.dialogVisible },
          on: {
            "update:visible": function($event) {
              _vm.dialogVisible = $event
            }
          }
        },
        [
          _c(
            "el-form",
            {
              ref: "adminForm",
              attrs: {
                model: _vm.adminForm,
                rules: _vm.rules,
                "label-position": "right",
                "label-width": "80px"
              }
            },
            [
              _c(
                "el-form-item",
                { attrs: { label: "用户名", prop: "username" } },
                [
                  _c("el-input", {
                    attrs: {
                      name: "username",
                      placeholder: "请输入用户名",
                      disabled: _vm.mode === "edit",
                      tabindex: "1"
                    },
                    model: {
                      value: _vm.adminForm.username,
                      callback: function($$v) {
                        _vm.$set(_vm.adminForm, "username", $$v)
                      },
                      expression: "adminForm.username"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "姓名", prop: "name" } },
                [
                  _c("el-input", {
                    attrs: {
                      name: "name",
                      placeholder: "请输入姓名",
                      tabindex: "2"
                    },
                    model: {
                      value: _vm.adminForm.name,
                      callback: function($$v) {
                        _vm.$set(_vm.adminForm, "name", $$v)
                      },
                      expression: "adminForm.name"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form-item",
                { attrs: { label: "密码", prop: "password" } },
                [
                  _c("el-input", {
                    attrs: {
                      name: "password",
                      placeholder: _vm.passwordTip,
                      tabindex: "3"
                    },
                    model: {
                      value: _vm.adminForm.password,
                      callback: function($$v) {
                        _vm.$set(_vm.adminForm, "password", $$v)
                      },
                      expression: "adminForm.password"
                    }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "dialog-footer",
              attrs: { slot: "footer" },
              slot: "footer"
            },
            [
              _c(
                "el-button",
                {
                  attrs: { type: "primary", loading: _vm.formLoading },
                  on: { click: _vm.handleSave }
                },
                [_vm._v("保存")]
              ),
              _vm._v(" "),
              _c(
                "el-button",
                {
                  on: {
                    click: function($event) {
                      _vm.dialogVisible = false
                    }
                  }
                },
                [_vm._v("取消")]
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/sys/src/pages/admin/index.vue":
/*!*************************************************!*\
  !*** ./resources/sys/src/pages/admin/index.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=b51044dc& */ "./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/sys/src/pages/admin/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/sys/src/pages/admin/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc&":
/*!********************************************************************************!*\
  !*** ./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=b51044dc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/sys/src/pages/admin/index.vue?vue&type=template&id=b51044dc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_b51044dc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);