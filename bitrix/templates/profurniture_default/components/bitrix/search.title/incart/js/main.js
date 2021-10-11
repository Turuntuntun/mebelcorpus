"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

(function (window) {
  "use strict";

  var BX = window.BX;
  var RS = window.RS;

  var GoproIncartSearchItems =
  /*#__PURE__*/
  function () {
    function GoproIncartSearchItems(container, params) {
      _classCallCheck(this, GoproIncartSearchItems);

      this.container = container;
      this.params = params;
      this.templateEngine = undefined;

      if (BX.Sale.BasketComponent) {
        this.observeActionPoolRequestProcessing();
      }

      this.attachTemplate();
    }

    _createClass(GoproIncartSearchItems, [{
      key: "observeActionPoolRequestProcessing",
      value: function observeActionPoolRequestProcessing() {
        var _this2 = this;

        if (BX.Sale.BasketComponent.actionPool) {
          var lastState = BX.Sale.BasketComponent.actionPool.requestProcessing;

          var _this = this;

          Object.defineProperty(BX.Sale.BasketComponent.actionPool, "requestProcessing", {
            set: function set(val) {
              if (lastState == true && val == false) {
                _this.updatedBasketComponent();
              }

              lastState = val;
              this._requestProcessing = val;
            }
          });
        } else {
          setTimeout(function () {
            return _this2.observeActionPoolRequestProcessing();
          }, 500);
        }
      }
    }, {
      key: "updatedBasketComponent",
      value: function updatedBasketComponent() {
        setTimeout(function () {
          return BX.Sale.BasketComponent.lazyLoad();
        });
      }
    }, {
      key: "updateBasketComponent",
      value: function updateBasketComponent() {
        BX.Sale.BasketComponent.actionPool.setRefreshStatus(false);
        BX.Sale.BasketComponent.actionPool.switchTimer();
      }
    }, {
      key: "add2basket",
      value: function add2basket(item) {
        var _this3 = this;

        return new Promise(function (resolve, reject) {
          var urlParams = {};
          urlParams[_this3.params.actionVariable] = 'BUY';
          urlParams[_this3.params.productIdVariable] = item.id;
          var url = BX.util.add_url_param(item.pageUrl, urlParams);
          BX.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
              ajax_basket: 'Y'
            },
            onsuccess: function onsuccess(result) {
              if (BX.Sale.BasketComponent) {
                _this3.updateBasketComponent();
              }

              resolve(result);
            }
          });
        });
      }
    }, {
      key: "attachTemplate",
      value: function attachTemplate() {
        var component = this;
        this.container.innerHTML = '';
        this.templateEngine = BX.Vue.create({
          el: this.container,
          components: {
            'redsign-suggestion-items': RS.Vue.Components.SuggestionItems
          },
          data: function data() {
            return {
              query: '',
              isLoading: false,
              messageParams: {
                position: 'bottom-left',
                duration: 5000
              }
            };
          },
          computed: {
            localize: function localize(state) {
              return BX.Vue.getFilteredPhrases('RS_GOPRO_INCART_SEARCH_');
            }
          },
          template: "\n                    <div>\n                        <div :class=\"{invisible: isLoading}\">\n                            <h4>{{ localize.RS_GOPRO_INCART_SEARCH_ADD_ITEMS }}</h4>\n                            <redsign-suggestion-items \n                                v-model=\"query\"\n                                ajax-path=\"".concat(this.params.ajaxPath, "\"\n                                input-id=\"").concat(this.params.inputId, "\"\n                                :placeholder=\"localize.RS_GOPRO_INCART_SEARCH_INPUT_PLACEHOLDER\"\n                                :min-length=\"").concat(this.params.minLength, "\" \n                                @add=\"add2basket\" \n                                :buttonTitle=\"localize.RS_GOPRO_INCART_SEARCH_BUTTON_TITLE\"\n                            />\n                        </div>\n                        <div v-show=\"isLoading\">\n                            <div class=\"suggestion-items-spinner\"></div>\n                        </div>\n                    </div>\n                "),
          methods: {
            reset: function reset() {
              this.isLoading = false;
              this.query = '';
              $(window).scroll();
            },
            message: function message(result) {
              if (result.STATUS == 'OK') {
                this.$toasted.show(result.MESSAGE, this.messageParams);
              } else if (result.STATUS == 'ERROR') {
                this.$toasted.show(result.MESSAGE, this.messageParams);
              }
            },
            add2basket: function add2basket(item) {
              this.isLoading = true;
              component.add2basket(item).then(this.message).then(this.reset);
            }
          }
        });
      }
    }]);

    return GoproIncartSearchItems;
  }();

  window.GoproIncartSearchItems = GoproIncartSearchItems;
})(window);
