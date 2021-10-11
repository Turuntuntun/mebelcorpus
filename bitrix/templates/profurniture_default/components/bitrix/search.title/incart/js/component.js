"use strict";

(function (window) {
  "use strict";

  window.RS = window.RS || {};
  window.RS.Vue = window.RS.Vue || {};
  window.RS.Vue.Components = window.RS.Vue.Components || {};
  var BX = window.BX;
  var RS = window.RS;
  BX.Vue.use(window.Toasted);

  if (RS.Vue.Components.SuggestionItems) {
    return;
  }

  var RedsignSuggestionItems = {
    template: "\n            <div class=\"suggestion-items\">\n            \n                <div class=\"suggestion-items__form suggestion-items-form\">\n                    <input\n                        ref=\"input\"\n                        type=\"text\"\n                        class=\"form-control suggestion-items-form__input\"\n                        v-model=\"query\"\n                        :id=\"inputId\"\n                        :placeholder=\"placeholder\"\n                        @focus=\"handleFocus\"\n                        @blur=\"handleBlur\"\n                        @keydown.down=\"handleDown\"\n                        @keydown.up=\"handleUp\"\n                        @keydown.enter.prevent=\"handleEnter\"\n                        @input=\"handleInput\"\n                    >\n\n                    <button\n                        :disabled=\"!!!item.id\" \n                        @click.prevent=\"add(item)\" \n                        class=\"btn btn-primary suggestion-items-form__button\" \n                        ref=\"button\"\n                    > \n                        {{ buttonTitle }}\n                    </button>\n                </div>\n                \n                <div v-show=\"isShowPopup\" class=\"suggestion-items__popup suggestion-items-popup\" ref=\"popup\" :class=\"{'is-processing': isProcessing}\">\n\n                    <ul v-if=\"items.length > 0\" class=\"list-unstyled suggestion-items-list\" :class=\"{'invisible': isProcessing}\">\n                        <li v-for=\"(item, index) in items\" :key=\"item.id\" class=\"suggestion-items-list-item\" :class=\"{active: active == index}\">\n                            <a v-if=\"!item.hasOffers\" href=\"#\" @mouseenter=\"setActive(index)\"  @click.prevent=\"selectItem(item)\" class=\"suggestion-items-list-item__link\">\n                                \n                                <span v-if=\"item.picture\" class=\"suggestion-items-list-item__pic\">\n                                    <img class=\"icon\" :src=\"item.picture.src\" :alt=\"item.name\" :title=\"item.name\">\n                                </span>\n                                <span v-else-if=\"item.isOffer && data[item.parentId] && data[item.parentId].picture\" class=\"suggestion-items-list-item__pic\">\n                                    <img class=\"icon\" :src=\"data[item.parentId].picture.src\" :alt=\"item.name\" :title=\"item.name\">\n                                </span>\n\n                                <span class=\"suggestion-items-list-item__title\"> \n                                    <span v-html=\"item.phrase\" class=\"suggestion-items-list-item__phrase\"></span>\n                                    <span class=\"nowrap\" v-if=\"item.priceValue\">\n                                        <span class=\"suggestion-items-list-item__price\">{{ localize.RS_SUGGEST_ITEMS_PRICE }}: </span> \n                                        <span class=\"suggestion-items-list-item__price-val\"> {{ item.price }} </span> \n                                    </span>\n                                </span>\n                            </a>\n                        </li>\n                    </ul>\n                    <div v-else-if=\"!isProcessing\">\n                        <div class=\"suggestion-items-popup__empty\">{{ localize.RS_SUGGEST_ITEMS_NOT_FOUND }}</div>\n                    </div>\n\n                    <div class=\"area2darken\" v-if=\"isProcessing\"><i class=\"icon animashka\"></i></div>\n                </div>\n\t\t\t</div>\n        ",
    props: {
      minLength: Number,
      inputId: String,
      ajaxPath: String,
      placeholder: String,
      value: String,
      buttonTitle: String
    },
    data: function data() {
      return {
        isFocused: false,
        data: {},
        cachedData: {},
        item: {},
        query: this.value,
        isProcessing: true,
        active: -1
      };
    },
    mounted: function mounted() {
      var _this = this;

      var clickOutside = function clickOutside(event) {
        if (_this.isFocused) {
          var target = event.target;

          if (target != _this.$el && !_this.$el.contains(target)) {
            _this.$refs.input.blur();

            _this.isFocused = false;
          }
        }
      };

      document.addEventListener('mouseup', clickOutside);
      document.addEventListener('touchstart', clickOutside);
      document.addEventListener('keydown', function (event) {
        var keyName = event.key;

        if (_this.isFocused && keyName == 'Escape') {
          _this.isFocused = false;

          _this.$refs.input.blur();
        }
      });
    },
    methods: {
      handleFocus: function handleFocus(event) {
        this.isFocused = true;
      },
      handleBlur: function handleBlur(event) {
        var relatedTarget = event.relatedTarget;

        if (relatedTarget) {
          if (relatedTarget != this.$refs.popup && !this.$refs.popup.contains(relatedTarget)) {
            this.isFocused = false;
          }
        } else {
          this.isFocused = false;
        }

        if (!this.isFocused) {
          if (this.item.id && this.query != this.item.name) {
            this.query = this.item.name;
          }
        }
      },
      handleDown: function handleDown() {
        if (this.active >= this.items.length - 1) {
          this.setActive(-1);
        } else {
          this.setActive(this.active + 1);
        }
      },
      handleUp: function handleUp() {
        if (this.active <= -1) {
          this.setActive(this.items.length - 1);
        } else {
          this.setActive(this.active - 1);
        }
      },
      handleEnter: function handleEnter() {
        if (this.active > -1) {
          if (this.items[this.active]) {
            this.selectItem(this.items[this.active]);
          }
        } else if (this.item.id) {
          this.add(this.item);
        }
      },
      handleInput: function handleInput(event) {
        if (event.target.value != this.query) {
          this.query = event.target.value;
        }

        this.$emit('input', this.query);
      },
      setActive: function setActive(index) {
        this.active = index;
      },
      loadData: function loadData(query) {
        var _this2 = this;

        return new Promise(function (resolve, reject) {
          var requestData = {
            'ajax_call': 'y',
            'INPUT_ID': _this2.inputId,
            'q': query,
            'l': _this2.minLength
          };
          BX.ajax({
            url: _this2.ajaxPath,
            method: "POST",
            data: requestData,
            dataType: 'json',
            onsuccess: function onsuccess(result) {
              resolve(result);
            }
          });
        });
      },
      getData: function getData(query) {
        var _this3 = this;

        return new Promise(function (resolve, reject) {
          if (_this3.cachedData[query]) {
            resolve(_this3.cachedData[query]);
          } else {
            _this3.loadData(query).then(function (data) {
              return _this3.cachedData[query] = data;
            }).then(function (data) {
              return resolve(data);
            });
          }
        });
      },
      selectItem: function selectItem(item) {
        var _this4 = this;

        setTimeout(function () {
          _this4.$refs.input.blur();

          _this4.$refs.button.focus();

          _this4.isFocused = false;
        });
        this.query = item.name;
        this.$emit('input', this.query);
        this.item = item;
      },
      add: function add(item) {
        this.$emit('add', item);
        this.item = {};
      },
      updateData: BX.debounce(function (queryVal) {
        var _this5 = this;

        var resFn = function resFn(data) {
          if (queryVal == _this5.query) {
            _this5.data = data || [];
            _this5.isProcessing = false;
          }
        };

        this.getData(queryVal).then(resFn);
      }, 250)
    },
    computed: {
      localize: function localize(state) {
        return BX.Vue.getFilteredPhrases('RS_SUGGEST_ITEMS_');
      },
      isShowPopup: function isShowPopup() {
        return this.isFocused && this.query.length > this.minLength && this.query != this.item.name;
      },
      items: function items() {
        return (this.data ? BX.util.array_values(this.data) : []).filter(function (item) {
          return !item.hasOffers;
        });
      }
    },
    watch: {
      query: function query(queryVal) {
        if (queryVal.length >= this.minLength) {
          this.isProcessing = true;
          this.updateData(queryVal);
        } else {
          this.isProcessing = false;
          this.data = [];
        }
      },
      value: function value(newValue) {
        this.query = newValue;
      }
    }
  };
  RS.Vue.Components.SuggestionItems = RedsignSuggestionItems;
})(window);
