class paginator
{
    constructor()
    {
        this.containerSelector = '[data-discount-contatainer]';
        this.butonnPaginatorSelector = '[data-show-more]';
        this.pagiContainerSelector = '[data-paggination]';
        this.page = location.pathname + '?PAGEN_1=';
    }

    init()
    {
        this.container = document.querySelector(this.containerSelector);
        this.button = document.querySelector(this.butonnPaginatorSelector);
        this.pagination = document.querySelector(this.pagiContainerSelector);
        if (this.button) {
            this.newPage = this.button.dataset.nextPage;
            this.listenClick();
        }
    }

    listenClick()
    {
        let link = this.page + this.newPage;
        this.button.addEventListener('click',(item)=>{
            fetch(link).then(response => response.text()).then(result => {
                this.reloadHtml(result);
            })
        });
    }

    reloadHtml(result)
    {
        let parser = new DOMParser();
        let html = parser.parseFromString(result, "text/html");
        let containerHtml = html.querySelector(this.containerSelector).children;
        containerHtml = Array.prototype.slice.call(containerHtml);
        this.insertToContainer(this.container,containerHtml);

        let pagiHtml = html.querySelector(this.pagiContainerSelector).children;
        pagiHtml = Array.prototype.slice.call(pagiHtml);
        this.pagination.innerHTML = '';
        this.insertToContainer(this.pagination,pagiHtml);

        this.init();
    }

    insertToContainer(container,html)
    {
        for (let i = 0; i < html.length; i++) {
            container.append(html[i]);
        }
    }
}
let componentPaginator = new paginator();
componentPaginator.init();