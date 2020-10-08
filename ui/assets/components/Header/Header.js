export default class extends HTMLElement
{
    constructor()
    {
        super();
        this.state = {
            links: [
                {
                    path: "/",
                    name: "home"
                },
                {
                    path: "/product-backlog",
                    name: "product-backlog"
                }
            ]
        };
    }
    connectedCallback()
    {
        this.state.links.map(link => {
            let link_element = document.createElement("a");
            link_element.setAttribute("data-link", true);
            link_element.setAttribute("href", link.path);
            link_element.innerText = link.name;
            this.appendChild(link_element);
        });
    }
}