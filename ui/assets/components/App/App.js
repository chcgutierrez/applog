import Auth from "../../js/Auth.js";
export default class extends HTMLElement
{
    connectedCallback()
    {
        Auth.login();
        if(Auth.isAuthenticated())
        {
            const header = document.createElement("applog-header");
            const body = document.createElement("main");
            this.appendChild(header);
            this.appendChild(body);
        }
        else
        {
            history.pushState(null, null, "/login.html");
            history.go();
        }
    }
}