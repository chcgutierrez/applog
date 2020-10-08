import App from "../components/App/App.js";
import Header from "../components/Header/Header.js";
import Table from "../components/Table.js";
import Backlogs from "../controllers/Backlogs.js";
import Home from "../controllers/Home.js";
// import Backlogs from "../controllers/Backlogs.js";
// import Sprints from "../controllers/Sprints.js";
const navigateTo = url => {
    history.pushState(null, null, url);
    router();
};
const getParams = route => {
    const values = route.result.slice(1);
    const keys = Array.from(route.route.path.matchAll(/:(\w+)/g)).map(result => result[1]);
    return Object.fromEntries(keys.map((key, i) => {
        return [key, values[i]];
    }));
};
const pathToRegex = path => new RegExp(`^${path.replace(/\//g, "\\/").replace(/:\w+/g, "(.+)")}$`);
const router = async () => {
    const routes = [
        {
            path: "/",
            view: Home
        },
        {
            path: '/product-backlog',
            view: Backlogs
        },
        // {
        //     path: '/sprints',
        //     view: Sprints
        // }
    ];
    const potential_routes = routes.map(route => {
        return {
            route,
            result: location.pathname.match(pathToRegex(route.path))
        };
    });
    let current_route = potential_routes.find(route => route.result !== null);
    if(!current_route) {
        current_route = {
            route: routes[0],
            result: [location.pathname]
        };
    }
    const view = new current_route.route.view(getParams(current_route));
    // document.querySelector("#app").innerHTML = await view.getViewSource();
    document.querySelector("main").innerHTML = '';
    document.querySelector("main").appendChild(await view.getViewSource());
};
window.addEventListener("popstate", router);
document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", e => {
        if(e.target.matches("[data-link]")) {
            e.preventDefault();
            navigateTo(e.target.href);
        }
    });
    router();
});
customElements.define('applog-app', App);
customElements.define('applog-header', Header);
customElements.define('applog-table', Table, { extends: "table" });