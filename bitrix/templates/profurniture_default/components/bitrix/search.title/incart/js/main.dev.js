(function(window)
{
    "use strict";

    const BX = window.BX;
    const RS = window.RS;

    class GoproIncartSearchItems {
        
        constructor(container, params)
        {
            this.container = container;
            this.params = params;

            this.templateEngine = undefined;

            if (BX.Sale.BasketComponent)
            {
                this.observeActionPoolRequestProcessing();
            }

            this.attachTemplate();
        }

        observeActionPoolRequestProcessing()
        {
            if (BX.Sale.BasketComponent.actionPool)
            {
                let lastState = BX.Sale.BasketComponent.actionPool.requestProcessing;
                var _this = this;
                
                Object.defineProperty(
                    BX.Sale.BasketComponent.actionPool,
                    "requestProcessing", 
                    {
                        set(val) 
                        {
                            if (lastState == true && val == false)
                            {
                                _this.updatedBasketComponent();
                            }

                            lastState = val;
                            this._requestProcessing = val;
                        }
                    }
                );
            }
            else
            {
                setTimeout(() => this.observeActionPoolRequestProcessing(), 500);
            }
        }

        updatedBasketComponent()
        {
            setTimeout(() => BX.Sale.BasketComponent.lazyLoad()); 
        }

        updateBasketComponent()
        {
            BX.Sale.BasketComponent.actionPool.setRefreshStatus(false);
            BX.Sale.BasketComponent.actionPool.switchTimer();
        }


        add2basket(item)
        {
            return new Promise((resolve, reject) => {

                let urlParams = {};
                urlParams[this.params.actionVariable] = 'BUY';
                urlParams[this.params.productIdVariable] = item.id;

                const url = BX.util.add_url_param(
                    item.pageUrl, 
                    urlParams
                );

                BX.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        ajax_basket: 'Y'
                    },

                    onsuccess: (result) => {

                        if (BX.Sale.BasketComponent)
                        {
                            this.updateBasketComponent();
                        }

                        resolve(result);

                    }
                });

            });
        }

        attachTemplate()
        {
            const component = this;
            
            this.container.innerHTML = '';
            
            this.templateEngine = BX.Vue.create({

                el: this.container,

                components: {
                    'redsign-suggestion-items': RS.Vue.Components.SuggestionItems
                },
                
                data()
                {
                    return {
                        query: '',
                        isLoading: false,
                        messageParams: {
                            position: 'bottom-left',
                            duration: 5000
                        }
                    };
                },

                computed: 
                {
                    localize(state)
                    {
                        return BX.Vue.getFilteredPhrases('RS_GOPRO_INCART_SEARCH_');
                    }
                },

                template: `
                    <div>
                        <div :class="{invisible: isLoading}">
                            <h4>{{ localize.RS_GOPRO_INCART_SEARCH_ADD_ITEMS }}</h4>
                            <redsign-suggestion-items 
                                v-model="query"
                                ajax-path="${this.params.ajaxPath}"
                                input-id="${this.params.inputId}"
                                :placeholder="localize.RS_GOPRO_INCART_SEARCH_INPUT_PLACEHOLDER"
                                :min-length="${this.params.minLength}" 
                                @add="add2basket" 
                                :buttonTitle="localize.RS_GOPRO_INCART_SEARCH_BUTTON_TITLE"
                            />
                        </div>
                        <div v-show="isLoading">
                            <div class="suggestion-items-spinner"></div>
                        </div>
                    </div>
                `,

                methods:
                {
                    reset()
                    {
                        this.isLoading = false;
                        this.query = '';

                        $(window).scroll();
                    },

                    message(result)
                    {
                        if (result.STATUS == 'OK')
                        {
                            this.$toasted.show(
                                result.MESSAGE,
                                this.messageParams
                            );
                        }
                        else if (result.STATUS == 'ERROR')
                        {
                            this.$toasted.show(
                                result.MESSAGE, 
                                this.messageParams
                            );
                        }
                    },

                    add2basket(item)
                    {   
                        this.isLoading = true;

                        component.add2basket(item)
                            .then(this.message)
                            .then(this.reset);
                    }
                }
            });
        }
    }

    window.GoproIncartSearchItems = GoproIncartSearchItems;

})(window);