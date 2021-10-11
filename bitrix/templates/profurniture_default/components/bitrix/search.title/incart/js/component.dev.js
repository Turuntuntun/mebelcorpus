(function(window)
{
    "use strict";

    window.RS = window.RS || {};
    window.RS.Vue = window.RS.Vue || {};
    window.RS.Vue.Components = window.RS.Vue.Components || {};
    
    const BX = window.BX;
    const RS = window.RS;

    BX.Vue.use(window.Toasted);

    if (RS.Vue.Components.SuggestionItems)
    {
        return;
    }

    const RedsignSuggestionItems = 
    {
		template: `
            <div class="suggestion-items">
            
                <div class="suggestion-items__form suggestion-items-form">
                    <input
                        ref="input"
                        type="text"
                        class="form-control suggestion-items-form__input"
                        v-model="query"
                        :id="inputId"
                        :placeholder="placeholder"
                        @focus="handleFocus"
                        @blur="handleBlur"
                        @keydown.down="handleDown"
                        @keydown.up="handleUp"
                        @keydown.enter.prevent="handleEnter"
                        @input="handleInput"
                    >

                    <button
                        :disabled="!!!item.id" 
                        @click.prevent="add(item)" 
                        class="btn btn-primary suggestion-items-form__button" 
                        ref="button"
                    > 
                        {{ buttonTitle }}
                    </button>
                </div>
                
                <div v-show="isShowPopup" class="suggestion-items__popup suggestion-items-popup" ref="popup" :class="{'is-processing': isProcessing}">

                    <ul v-if="items.length > 0" class="list-unstyled suggestion-items-list" :class="{'invisible': isProcessing}">
                        <li v-for="(item, index) in items" :key="item.id" class="suggestion-items-list-item" :class="{active: active == index}">
                            <a v-if="!item.hasOffers" href="#" @mouseenter="setActive(index)"  @click.prevent="selectItem(item)" class="suggestion-items-list-item__link">
                                
                                <span v-if="item.picture" class="suggestion-items-list-item__pic">
                                    <img class="icon" :src="item.picture.src" :alt="item.name" :title="item.name">
                                </span>
                                <span v-else-if="item.isOffer && data[item.parentId] && data[item.parentId].picture" class="suggestion-items-list-item__pic">
                                    <img class="icon" :src="data[item.parentId].picture.src" :alt="item.name" :title="item.name">
                                </span>

                                <span class="suggestion-items-list-item__title"> 
                                    <span v-html="item.phrase" class="suggestion-items-list-item__phrase"></span>
                                    <span class="nowrap" v-if="item.priceValue">
                                        <span class="suggestion-items-list-item__price">{{ localize.RS_SUGGEST_ITEMS_PRICE }}: </span> 
                                        <span class="suggestion-items-list-item__price-val"> {{ item.price }} </span> 
                                    </span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div v-else-if="!isProcessing">
                        <div class="suggestion-items-popup__empty">{{ localize.RS_SUGGEST_ITEMS_NOT_FOUND }}</div>
                    </div>

                    <div class="area2darken" v-if="isProcessing"><i class="icon animashka"></i></div>
                </div>
			</div>
        `,

		props: {
			minLength: Number,
			inputId: String,
            ajaxPath: String,
            placeholder: String,
            value: String,
            buttonTitle: String 
		},

		data()
		{
			return {
				isFocused: false,
                data: {},
                cachedData: {},
                item: {},
                query: this.value,
                isProcessing: true,
                active: -1
			}
        },

        mounted()
        {
            const clickOutside = (event) => {

                if (this.isFocused)
                {
                    const target = event.target;
                    if (target != this.$el && !this.$el.contains(target))
                    {
                        this.$refs.input.blur();
                        this.isFocused = false;
                    }
                }

            }


            document.addEventListener('mouseup', clickOutside);
            document.addEventListener('touchstart', clickOutside);

            document.addEventListener('keydown', (event) => {
                const keyName = event.key;

                if (this.isFocused && keyName == 'Escape')
                {
                    this.isFocused = false;
                    this.$refs.input.blur();
                }
            });
        },

		methods: 
		{
			handleFocus(event)
			{
                this.isFocused = true;
            },

			handleBlur(event)
			{
                const relatedTarget = event.relatedTarget;

                if (relatedTarget)
                {
                    if (
                        relatedTarget != this.$refs.popup && 
                        !this.$refs.popup.contains(relatedTarget)
                    )
                    {
                        this.isFocused = false;
                    }
                }
                else
                {   
                    this.isFocused = false;
                }

                if (!this.isFocused)
                {
                    if (this.item.id && this.query != this.item.name)
                    {
                        this.query = this.item.name;
                    }
                }
            },

            handleDown()
            {
                if (this.active >= this.items.length - 1)
                {
                    this.setActive(-1);
                }
                else
                {
                    this.setActive(this.active + 1);
                }
            },

            handleUp()
            {
                if (this.active <= -1)
                {
                    this.setActive(this.items.length -1);
                }
                else
                {
                    this.setActive(this.active - 1);
                }
            },

            handleEnter()
            {
                if (this.active > -1)
                {
                    if (this.items[this.active])
                    {
                        this.selectItem(this.items[this.active]);
                    }
                }
                else if (this.item.id)
                {
                    this.add(this.item);
                }
            },

            handleInput(event)
            {
                if (event.target.value != this.query)
                {
                    this.query = event.target.value;
                }

                this.$emit('input', this.query);
            },

            setActive(index)
            {
                this.active = index;
            },

            loadData(query) 
            {
                return new Promise((resolve, reject) => {

                    const requestData = {
                        'ajax_call': 'y',
                        'INPUT_ID': this.inputId,
                        'q': query,
                        'l': this.minLength
                    };

                    BX.ajax({
                        url: this.ajaxPath,
                        method: "POST",
                        data: requestData,
                        dataType: 'json',
                        onsuccess: (result) => {
                            resolve(result);
                        }
                    });
                });
            },

            
            getData(query)
            {
                return new Promise((resolve, reject) => {

                    if (this.cachedData[query])
                    {
                        resolve(this.cachedData[query]);
                    }
                    else
                    {
                        this.loadData(query)
                            .then(data => this.cachedData[query] = data)
                            .then(data => resolve(data))
                    }
                });
            },


            selectItem(item)
            {
                setTimeout(() => {
                    this.$refs.input.blur();
                    this.$refs.button.focus();
                    
                    this.isFocused = false;
                });

                
                this.query = item.name;
                this.$emit('input', this.query);
                
                this.item = item;
            },

            add(item)
            {
                this.$emit('add', item);

                this.item = {};
            },

            updateData: BX.debounce(function (queryVal) {

                const resFn = (data) => {
                    if (queryVal == this.query)
                    {
                        this.data = data || [];

                        this.isProcessing = false;
                    }
                }

                this.getData(queryVal)
                    .then(resFn);
            }, 250)
        },
        
        computed: 
        {
            localize(state)
            {
                return BX.Vue.getFilteredPhrases('RS_SUGGEST_ITEMS_');
            },

            isShowPopup()
            {
                return (
                    this.isFocused && 
                    this.query.length > this.minLength &&
                    this.query != this.item.name
                );
            },

            items()
            {
                return (this.data ? BX.util.array_values(this.data) : []).filter((item) => !item.hasOffers);
            }
        },

		watch:
		{
			query: function (queryVal) {
                if (queryVal.length >= this.minLength)
                {
                    this.isProcessing = true;

                    this.updateData(queryVal);
                }
                else
                {
                    this.isProcessing = false;

                    this.data = [];
                }

            },
            
            value(newValue) 
            {
                this.query = newValue;
            }
		}
    };

    RS.Vue.Components.SuggestionItems = RedsignSuggestionItems;

})(window);