import View from "./View.js";
export default class extends View {
    constructor(params) {
        super(params);
        this.setTitle("Home");
    }
    async getViewSource() {
        const home = document.createTextNode("Welcome");
        return home;
    }
}