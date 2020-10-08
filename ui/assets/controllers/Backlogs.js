import View from "./View.js";
export default class extends View {
    constructor(params) {
        super(params);
        this.setTitle("Product backlog");
    }
    async getViewSource() {
        let backlog_items_table = document.createElement('table', {is: 'applog-table'});
        const { data:{data} } = (await axios.get("http://192.168.0.17/applog/api/backlog-items"));
        // backlog_items_table.setAttribute("headers",JSON.stringify(["user_email", "role_id"]));
        // backlog_items_table.setAttribute("data",JSON.stringify(data))
        backlog_items_table.setContent("backlog_item_id", "backlog-items", ["backlog_item_name", "backlog_item_description", "backlog_item_effort", "backlog_id"], data, this.deleteUser, this.updateUser);
        return backlog_items_table;
    }
    deleteUser(id)
    {
        axios.delete(`http://192.168.0.17/applog/api/backlog-items/${id}`)
            .then(response => {
                console.log(response);
            });
    }
    updateUser(id, data)
    {
        console.log(id);
        axios.put(`http://localhost/applog/api/backlog-items/${id}`, data)
            .then(response => {
                console.log(response);
            });
    }
}