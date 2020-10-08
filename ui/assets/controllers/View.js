export default class {
    constructor(params) {
        this.params = params;
    }
    setTitle(title) {
        document.title = title;
    }
    async getViewSource() {
        throw new Error("getViewSource has to be implemented");
    }
};