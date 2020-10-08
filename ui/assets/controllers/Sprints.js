import View from "./View.js";
export default class extends View {
    constructor(params) {
        super(params);
        this.setTitle("Backlogs");
    }
    async getViewSource() {
        let sprints_table = document.createElement('table', {is: 'table-ds'});
        const { data:{data} } = (await axios.get("http://localhost/applog/api/sprints"));
        sprints_table.setAttribute("headers",JSON.stringify(["sprint_goal", "sprint_time", "sprint_start_date", "sprint_end_date"]));
        sprints_table.setAttribute("data",JSON.stringify(data))
        return sprints_table;
    }
}