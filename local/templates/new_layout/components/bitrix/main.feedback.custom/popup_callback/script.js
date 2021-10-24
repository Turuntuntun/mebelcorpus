class FeedBack
{
    constructor()
    {
        this.formName = 'callback-form';
        this.attributeName = 'data-component';
        this.container = '.modal__container.default';
        this.containerSuccess = '.modal__container.success';
        this.form = this.findForm();
        this.link = this.form.getAttribute('action');
        this.checkSubmit();

    }

    findForm()
    {
        let attr = '[' + this.attributeName + '=' + this.formName  + ']';
        return document.querySelector(attr);
    }

    checkSubmit()
    {
        this.form.addEventListener('submit', (event)=> {
            event.preventDefault()
            this.submitForm();
            this.sendRequest();
        });
    }

    submitForm()
    {
        this.formData = new FormData(this.form);
    }

    sendRequest()
    {
        fetch(
            this.link,{
                method : 'POST',
                body : this.formData
            }
        ).then(response => response.json()).then(result => {
            this.reloadHtml(result);
        });
    }

    reloadHtml(result)
    {
        if (result['status'] == 'ok') {
            document.querySelector(this.container).hidden = true;
            document.querySelector(this.containerSuccess).hidden = false;
        }
    }
}

let FeedBackObject = new FeedBack();