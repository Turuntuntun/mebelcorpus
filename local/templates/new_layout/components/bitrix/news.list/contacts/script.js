class ContactsAjax
{
    constructor()
    {
        this.idSelector = 'data-contact-id';
        this.linkSelector = 'data-component-link';
        this.phoneSelector = 'data-contact-phone';
        this.adressSelector = 'data-contact-adress';
        this.emailSelector = 'data-contact-email';
        this.selectSelector = 'data-contact-select';
        this.init();
    }

    init()
    {
        this.selectorContainer = document.querySelector('[' + this.selectSelector + ']');
        if (this.selectorContainer) {
            this.checkChangeSelector();
        }
    }

    checkChangeSelector()
    {
        this.selectorContainer.addEventListener('change',(item)=>{
            let id = this.findSelectedId(this.selectorContainer);
            let pathContainer = document.querySelector('[' + this.linkSelector +']');
            if (pathContainer) {
                let path = pathContainer.getAttribute(this.linkSelector);
                let data = new FormData();
                data.append('ID',id);
                fetch(path,{
                    method:'POST',
                    body:data
                }) .then(response => response.json())
                    .then(result => {
                        this.reloadHtml(result);
                    });
            }
        });
    }

    findSelectedId(item)
    {
        let options = item.querySelectorAll('[' + this.idSelector + ']');
        if (options.length) {
            for (let key in options) {
                if (options[key].selected) {
                    return options[key].getAttribute(this.idSelector);
                }
            }
        }
    }

    reloadHtml(data)
    {
        this.fillContent(document.querySelector('[' + this.phoneSelector + ']'),data['PHONE'],'PHONE');
        this.fillContent(document.querySelector('[' + this.emailSelector + ']'),data['EMAIL'],'EMAIL');
        this.fillContent(document.querySelector('[' + this.adressSelector + ']'),data['ADRESS'],'ADRESS');
    }

    fillContent(container,data,key)
    {
        if (container) {
            if (key == 'PHONE') {
                container.setAttribute('href','tel:' + data)
            }
            if (key == 'EMAIL') {
                container.setAttribute('href','mailto:' + data)
            }
            container.innerHTML = data;
        }
    }
}
let contacts = new ContactsAjax();