var RSGoPro_OffersExt_timeout_id=0,RSGoPro_ajaxTimeout=0,RSGoPro_ajaxTimeoutTime=1e3;function RSGoPro_OffersExt_ChangeHTML(e){var s=e.data("elementid");if(RSGoPro_OFFERS[s]){var i=new Object;e.find(".js-attributes__option.selected").each(function(e){var s=$(this),r=s.parents(".js-attributes__prop").data("code"),t=s.data("value");i[r]=t});var r=0,t=!0;for(offerID in RSGoPro_OFFERS[s].OFFERS){for(pCode in t=!0,i)if(i[pCode]!=RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[pCode]){t=!1;break}if(t){r=offerID;break}}if(r<1)return void console.error("Right offer not found. OfferID not found. Product error.");BX.onCustomEvent("rs.gopro.before.offerChange",[{product:e,elementId:s,offerId:r}]),$article=e.find(".js-article"),0<$article.length&&("Y"==$article.data("article-from-id")?RSGoPro_OFFERS[s].OFFERS[r].ID?$article.find(".js-article__value").html(RSGoPro_OFFERS[s].OFFERS[r].ID).parent(".js-article").removeClass("js-article-invisible"):e.find(".js-article").data("prodarticle")?$article.find(".js-article__value").html(e.find(".js-article").data("prodarticle")).parent(".js-article").removeClass("js-article-invisible"):$article.find(".js-article__value").parent(".js-article").addClass("js-article-invisible"):RSGoPro_OFFERS[s].OFFERS[r].ARTICLE?$article.find(".js-article__value").html(RSGoPro_OFFERS[s].OFFERS[r].ARTICLE).parent(".js-article").removeClass("js-article-invisible"):e.find(".js-article").data("prodarticle")?$article.find(".js-article__value").html(e.find(".js-article").data("prodarticle")).parent(".js-article").removeClass("js-article-invisible"):$article.find(".js-article__value").parent(".js-article").addClass("js-article-invisible")),0<e.find(".js-quantity").length&&RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_RATIO&&(e.find(".js-quantity").data("ratio",RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_RATIO),e.find(".js-quantity").val(e.find(".js-quantity").data("ratio"))),0<e.find(".js-measurename").length&&RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_NAME&&e.find(".js-measurename").html(RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_NAME);var o=e.find(".js-prices"),a=o.data("page"),_=o.data("view"),d=o.data("maxshow"),n=(o.data("showmore"),o.data("usealone")),l=0,S=0;if(RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX)RSGoPro_SetPriceMatrix(e,RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX);else if(RSGoPro_OFFERS[s].OFFERS[r].PRICES){var R=null,c=RSGoPro_OFFERS[s].OFFERS[r].PRICES,p=Object.keys(c).length;for(var f in o.removeClass("product-multiple product-alone"),o.find(".js-prices__price").addClass("c-prices__hide c-prices__empty"),o.find(".js-prices__more").addClass("c-prices__hide"),c)if(!((R=o.find(".js-prices__price-code_"+f)).length<1)){if(R.removeClass("c-prices__empty"),d<=l&&"list"==a&&"line"==_)break;S<d&&R.removeClass("c-prices__hide"),0<o.find(".js-prices_pdv_"+f).length&&(o.find(".js-prices_pdv_"+f).html(c[f].PRINT_DISCOUNT_VALUE),0<parseInt(c[f].DISCOUNT_DIFF)&&o.find(".js-prices_pdv_"+f)),0<o.find(".js-prices_pd_"+f).length&&(0<parseInt(c[f].DISCOUNT_DIFF)||parseInt(c[f].DISCOUNT_DIFF_PERCENT)?0<parseInt(c[f].DISCOUNT_DIFF)?(o.find(".js-prices_pd_"+f+"_hide").removeClass("c-prices__hide"),o.find(".js-prices_pd_"+f).removeClass("c-prices__hide").html(c[f].PRINT_DISCOUNT)):(o.find(".js-prices_pd_"+f+"_hide").removeClass("c-prices__hide"),o.find(".js-prices_pd_"+f).removeClass("c-prices__hide").html(c[f].DISCOUNT_DIFF_PERCENT)):o.find(".js-prices_pd_"+f+"_hide").addClass("c-prices__hide")),0<o.find(".js-prices_pv_"+f).length&&(0<parseInt(c[f].DISCOUNT_DIFF)?(o.find(".js-prices_pv_"+f+"_hide").removeClass("c-prices__hide"),o.find(".js-prices_pv_"+f).removeClass("c-prices__hide").html(c[f].PRINT_VALUE)):o.find(".js-prices_pv_"+f+"_hide").addClass("c-prices__hide")),0<o.find(".js-prices_ddp_"+f).length&&(0<c[f].DISCOUNT_DIFF_PERCENT?(o.find(".js-prices_ddp_"+f+"_hide").removeClass("c-prices__hide"),o.find(".js-prices_ddp_"+f).html(c[f].DISCOUNT_DIFF_PERCENT)):o.find(".js-prices_ddp_"+f+"_hide").addClass("c-prices__hide")),S++,l++}o.data("priceCountShowed",S),o.data("priceCount",l)}if(S=o.data("priceCountShowed"),l=o.data("priceCount"),S<2&&"Y"==n)o.addClass("product-alone"),o.removeClass("product-multiple");else if(o.addClass("product-multiple"),o.removeClass("product-alone"),d<p&&0<parseInt(p-d)){var E=parseInt(p-d);o.find(".js-prices__more").removeClass("c-prices__hide").find(".js-prices__more-count").html(E)}var F=RSGoPro_OFFERS[s].OFFERS[r].DISPLAY_PROPERTIES;for(var O in F)e.find(".js-changelable-props-val__"+O).html(F[O].DISPLAY_VALUE);if(e.removeClass("qb da2"),e.find(".timers .timer").hide(),(RSGoPro_OFFERS[s].ELEMENT.QUICKBUY||RSGoPro_OFFERS[s].OFFERS[r].QUICKBUY)&&(e.addClass("qb"),0<e.find(".timers .qb.js-timer_id"+s).length?e.find(".timers .qb.js-timer_id"+s).css("display","inline-block"):0<e.find(".timers .qb.js-timer_id"+r).length&&e.find(".timers .qb.js-timer_id"+r).css("display","inline-block")),(RSGoPro_OFFERS[s].ELEMENT.DAYSARTICLE2||RSGoPro_OFFERS[s].OFFERS[r].DAYSARTICLE2)&&(e.removeClass("qb").addClass("da2"),0<e.find(".timers .da2.js-timer_id"+s).length?(e.find(".timers .timer").hide(),e.find(".timers .da2.js-timer_id"+s).css("display","inline-block")):0<e.find(".timers .da2.js-timer_id"+r).length&&(e.find(".timers .timer").hide(),e.find(".timers .da2.js-timer_id"+r).css("display","inline-block"))),e.find(".js-add2basketpid").val(r),e.find(".js-buy1click").data("insertdata",{RS_ORDER_IDS:r}),RSGoPro_OFFERS[s].OFFERS[r].CAN_BUY?e.find(".js-pay__form").removeClass("cantbuy"):e.find(".js-pay__form").addClass("cantbuy"),e.find(".js-product-subscribe").attr("data-item",r),e.find(".js-product-subscribe").data("item",r),0<e.find(".js-stores").length&&0<r)if(RSGoPro_STOCK[s]){for(storeID in RSGoPro_STOCK[s].JS.SKU[r]){var P=RSGoPro_STOCK[s].JS.SKU[r][storeID],C=$("#popupstores_"+s).find(".js-stores__store"+storeID);1==RSGoPro_STOCK[s].USE_MIN_AMOUNT?P<1?C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_EMPTY):P<RSGoPro_STOCK[s].MIN_AMOUNT?(console.log("wonk 2"),console.log(RSGoPro_STOCK[s].MESSAGE_LOW),C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_LOW)):C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_ISSET):C.find(".js-stores__value").html(P),0==RSGoPro_STOCK[s].SHOW_EMPTY_STORE&&P<1?C.hide():C.show()}if(RSGoPro_STOCK[s].QUANTITY[s]){P=parseInt(RSGoPro_STOCK[s].QUANTITY[r]);1==RSGoPro_STOCK[s].USE_MIN_AMOUNT?P<1?e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_EMPTY):P<RSGoPro_STOCK[s].MIN_AMOUNT?e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_LOW):e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_ISSET):P<1?e.find(".js-stores__value").html("0"):e.find(".js-stores__value").html(P),e.find(".js-stores-string").length&&(0<P?(e.find(".js-stores-string").hide(),e.find(".js-stores").show()):(e.find(".js-stores-string").show(),e.find(".js-stores").hide()))}}else console.warn("OffersExt_ChangeHTML -> store not found");RSGoPro_SetInBasket(),$(document).trigger("RSGoProOnOfferChange",[e]),BX.onCustomEvent("rs.gopro.after.offerChange",[{product:e,elementId:s,offerId:r}])}}function RSGoPro_OffersExt_PropChanged(e){var s=e.parents(".js-element").data("elementid"),r=e.parents(".js-attributes__prop").data("code"),t=e.data("value");if(RSGoPro_OFFERS[s]&&!e.hasClass("disabled")){e.parents(".js-attributes__prop").removeClass("open").addClass("close"),e.parents(".js-attributes__prop").find(".js-attributes__option").removeClass("selected"),e.addClass("selected"),e.parents(".js-attributes__prop").find(".js-attributes__set-value-text").html(t),e.parents(".js-attributes__prop").hasClass("js-pic")&&e.parents(".js-attributes__prop").find(".js-attributes__set-value-pic").css("backgroundImage","url('"+e.data("value-pic")+"')");var i=0,o="",a="",_=new Object;for(index in RSGoPro_OFFERS[s].SORT_PROPS)if(_[a=RSGoPro_OFFERS[s].SORT_PROPS[index]]=e.parents(".js-element").find(".js-attributes__code__"+a).find(".js-attributes__option.selected").data("value"),a==r){i=parseInt(index)+1;o=!!RSGoPro_OFFERS[s].SORT_PROPS[i]&&RSGoPro_OFFERS[s].SORT_PROPS[i];break}if(o){var d=!0,n=new Array;for(offerID in RSGoPro_OFFERS[s].OFFERS){for(pCode1 in d=!0,_)_[pCode1]!=RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[pCode1]&&(d=!1);d&&n.push(RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[o])}e.parents(".js-element").find(".js-attributes__code__"+o).find(".js-attributes__option").each(function(e){var s=$(this),r=!0;for(inden in n)if(s.data("value")==n[inden]){r=!1;break}s.addClass("disabled"),r||s.removeClass("disabled")}),RSGoPro_OffersExt_PropChanged(e.parents(".js-element").find(".js-attributes__code__"+o).find(".js-attributes__option.selected").hasClass("disabled")?e.parents(".js-element").find(".js-attributes__code__"+o).find(".js-attributes__option:not(.disabled):first"):e.parents(".js-element").find(".js-attributes__code__"+o).find(".js-attributes__option.selected"))}else RSGoPro_OffersExt_ChangeHTML(e.parents(".js-element"))}}function RSGoPro_SetPrice(e){var s=e.data("elementid"),r=e.find(".js-add2basketpid").val();RSGoPro_OFFERS[s]&&(RSGoPro_OFFERS[s].OFFERS[r]&&RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX&&RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX?RSGoPro_SetPriceMatrix(e,RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX):RSGoPro_OFFERS[s].ELEMENT.PRICE_MATRIX&&RSGoPro_SetPriceMatrix(e,RSGoPro_OFFERS[s].ELEMENT.PRICE_MATRIX))}function RSGoPro_SetPriceMatrix(e,s){var r=e.find(".js-quantity").val(),t=e.find(".js-prices"),i=null,o=null,a=null,_=t.data("page"),d=t.data("view"),n=t.data("maxshow"),l=(t.data("showmore"),t.data("usealone")),S=0,R=0;for(var c in t.removeClass("product-multiple product-alone"),"list"!=_&&"line"!=d&&t.find(".js-prices__price").addClass("c-prices__hide c-prices__empty"),t.find(".js-prices__more").addClass("c-prices__hide"),s.ROWS){if((0==s.ROWS[c].QUANTITY_FROM||s.ROWS[c].QUANTITY_FROM<=r)&&(0==s.ROWS[c].QUANTITY_TO||s.ROWS[c].QUANTITY_TO>=r)){for(var p in o=s.COLS,a=Object.keys(o).length,o)if(s.MATRIX[p][c]){if(PRICE_CODE=s.COLS[p].NAME,(i=t.find(".js-prices__price-code_"+PRICE_CODE)).length<1)continue;if(i.removeClass("c-prices__empty"),n<=S&&"list"==_&&"line"==d)break;R<n&&i.removeClass("c-prices__hide"),e.find(".js-prices_pdv_"+PRICE_CODE)&&(e.find(".js-prices_pdv_"+PRICE_CODE).html(s.MATRIX[p][c].PRINT_DISCOUNT_VALUE),0<parseInt(s.MATRIX[p][c].DISCOUNT_DIFF)&&e.find(".js-prices_pdv_"+PRICE_CODE)),e.find(".js-prices_pd_"+PRICE_CODE)&&(0<parseInt(s.MATRIX[p][c].DISCOUNT_DIFF)?e.find(".js-prices_pd_"+PRICE_CODE).removeClass("c-prices__hide").html(s.MATRIX[p][c].PRINT_DISCOUNT_DIFF):e.find(".js-prices_pd_"+PRICE_CODE).addClass("c-prices__hide")),e.find(".js-prices_pv_"+PRICE_CODE)&&(0<parseInt(s.MATRIX[p][c].DISCOUNT_DIFF)?e.find(".js-prices_pv_"+PRICE_CODE).removeClass("c-prices__hide").html(s.MATRIX[p][c].PRINT_VALUE):e.find(".js-prices_pv_"+PRICE_CODE).addClass("c-prices__hide")),R++,S++}break}t.data("priceCountShowed",R),t.data("priceCount",S)}if(R<2&&"Y"==l)t.addClass("product-alone");else if(t.addClass("product-multiple"),n<a&&0<parseInt(a-n)){var f=parseInt(a-n);t.find(".js-prices__more").removeClass("c-prices__hide").find(".js-prices__more-count").html(f)}}$(document).on("click",".js-attributes__option",function(e){e.stopPropagation(),clearTimeout(RSGoPro_OffersExt_timeout_id);var s=$(this),r=s.closest(".js-element"),t=r.find(".js-element__shadow"),i=r.data("detail");if(!s.hasClass("disabled")){var o=r.data("elementid");if(0<o){s.parents(".js-attributes__prop").data("code"),s.data("value");if(RSGoPro_OFFERS[o])RSGoPro_OffersExt_PropChanged(s);else{RSGoPro_Area2Darken(t,"animashka");var a=i+"?AJAX_CALL=Y&"+rsGoProActionVariableName+"=get_element_json&"+rsGoProProductIdVariableName+"="+o;$.getJSON(a,{},function(e){RSGoPro_OFFERS[o]=e,RSGoPro_OffersExt_PropChanged(s),RSGoPro_Area2Darken(t)}).fail(function(e){console.warn("Get element JSON -> fail request"),RSGoPro_Area2Darken(t)})}}else console.warn("Get element JSON -> element_id is empty")}return!1}),$(document).on("change",".js-element .js-quantity.js-use_count",function(){clearTimeout(RSGoPro_OffersExt_timeout_id),clearTimeout(RSGoPro_ajaxTimeout);var r=$(this).closest(".js-element"),e=r.data("detail"),t=r.data("elementid");if(0<t)if(RSGoPro_OFFERS[t]){var s=r.find(".js-add2basketpid").val();RSGoPro_OFFERS[t].OFFERS[s]&&RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX?RSGoPro_SetPriceMatrix(r,RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX):RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX&&RSGoPro_SetPriceMatrix(r,RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX),$(document).trigger("RSGoProOnChangeQuantity",[r])}else{var i=e+"?AJAX_CALL=Y&"+rsGoProActionVariableName+"=get_element_json&"+rsGoProProductIdVariableName+"="+t;RSGoPro_ajaxTimeout=setTimeout(function(){RSGoPro_Area2Darken(r,"animashka"),$.ajax({type:"POST",url:i,dataType:"json",success:function(e){RSGoPro_OFFERS[t]=e;var s=r.find(".js-add2basketpid").val();RSGoPro_OFFERS[t]&&(RSGoPro_OFFERS[t].OFFERS[s]&&RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX?RSGoPro_SetPriceMatrix(r,RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX):RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX&&RSGoPro_SetPriceMatrix(r,RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX))},error:function(){console.warn("Get element JSON -> fail request")},complete:function(){RSGoPro_Area2Darken(r),$(document).trigger("RSGoProOnChangeQuantity",[r])}})},RSGoPro_ajaxTimeoutTime)}else console.warn("Get element JSON -> element_id is empty");return!1}),$(document).on("click",".js-attributes__curent-value",function(e){var s=$(this);return $(".js-attributes__prop.open:not(.js-attributes__code__"+s.parents(".js-attributes__prop").data("code")+")").removeClass("open").addClass("close"),s.parents(".js-attributes__prop").hasClass("open")?s.parents(".js-attributes__prop").removeClass("open").addClass("close"):s.parents(".js-attributes__prop").removeClass("close").addClass("open"),!1}),$(document).on("click",function(e){0<$(e.target).parents(".js-attributes__prop").length&&!$(e.target).parents(".js-attributes__prop").hasClass("js-pic")||$(".js-attributes__prop").removeClass("open").addClass("close")});