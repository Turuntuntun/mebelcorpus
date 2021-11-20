window.onload =function (){
    let submitButton = document.querySelectorAll('[data-add-to-basket-item]');

    if (submitButton) {
        submitButton.forEach((item)=>{
            item.addEventListener('click',function (event) {
                event.preventDefault();
                let id = item.dataset.addToBasketItem;
                let color = item.dataset.addToBasketColor;
                addToBasketElementItem(id,color);
            });
        });
    }
}
function addToBasketElementItem(id,propcolor) {
    let link = '?action=ADD2BASKET&id=' + id;
    let formData = new  FormData();
    if (propcolor) {
        formData.append('prop[COLORS]',propcolor);
    }
    formData.append('ajax_basket','Y');
    fetch(link,{
        method: 'POST',
        body: formData
    });
}
