(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define("/App/Mailbox", ["exports", "BaseApp"], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require("BaseApp"));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.BaseApp);
    global.AppBeast = mod.exports;
  }
})(this, function (_exports, _BaseApp2) {
  "use strict";

  Object.defineProperty(_exports, "__esModule", {
    value: true
  });
  _exports.run = run;
  _exports.getInstance = getInstance;
  _exports.AppBeast = _exports.default = void 0;
  _BaseApp2 = babelHelpers.interopRequireDefault(_BaseApp2);

  var AppBeast =
  /*#__PURE__*/
  function (_BaseApp) {
    babelHelpers.inherits(AppBeast, _BaseApp);

    function AppBeast() {
      babelHelpers.classCallCheck(this, AppBeast);
      return babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(AppBeast).apply(this, arguments));
    }

    babelHelpers.createClass(AppBeast, [{
      key: "initialize",
      value: function initialize() {
        babelHelpers.get(babelHelpers.getPrototypeOf(AppBeast.prototype), "initialize", this).call(this);
        this.$actionBtn = $('.site-action');
        this.$actionToggleBtn = this.$actionBtn.find('.site-action-toggle');
        this.$addMainForm = $('#addMailForm').modal({
          show: false
        });
        this.$content = $('#mailContent'); // states

        this.states = {
          checked: false
        };
      }
    }, {
      key: "process",
      value: function process() {
        babelHelpers.get(babelHelpers.getPrototypeOf(AppBeast.prototype), "process", this).call(this);
        this.setupActionBtn();
        this.bindListChecked();
      }
    }, {
      key: "listChecked",
      value: function listChecked(checked) {
        var api = this.$actionBtn.data('actionBtn');

        if (checked) {
          api.show();
        } else {
          api.hide();
        }

        this.states.checked = checked;
      }
    }, {
      key: "setupActionBtn",
      value: function setupActionBtn() {
        var _this = this;

        this.$actionToggleBtn.on('click', function (e) {
          if (!_this.states.checked) {
            _this.$addMainForm.modal('show');

            e.stopPropagation();
          }
        });
      }
    }, {
      key: "bindListChecked",
      value: function bindListChecked() {
        var _this2 = this;

        this.$content.on('asSelectable::change', function (e, api, checked) {
          _this2.listChecked(checked);
        });
      }
    }]);
    return AppBeast;
  }(_BaseApp2.default);

  _exports.AppBeast = AppBeast;
  var instance = null;

  function getInstance() {
    if (!instance) {
      instance = new AppBeast();
    }

    return instance;
  }

  function run() {
    var app = getInstance();
    app.run();
  }

  var _default = AppBeast;
  _exports.default = _default;
});