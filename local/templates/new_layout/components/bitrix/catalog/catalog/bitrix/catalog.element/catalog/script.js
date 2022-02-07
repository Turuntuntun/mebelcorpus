window.onload =function (){
    let submitButton = document.querySelector('[data-add-to-basket]');

    if (submitButton) {
        submitButton.addEventListener('click',function (){
            let id = submitButton.dataset.elementId;
            let radioArray = document.querySelectorAll("[data-color-input]");
            if (radioArray) {
                let propColor;
                radioArray.forEach((item)=>{
                    if (item.checked) {
                        propColor = item.value;
                    }
                });
                addToBasketElement(id,propColor);
            }
        });
    }

    // let all_colors = document.querySelectorAll('.catalog-item__color-list .color-list__item');
    // all_colors.forEach(color => {
    //     color.addEventListener('click',function (){
    //         console.log(123);
    //     });
    // });
}
function addToBasketElement(id,propcolor) {
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
