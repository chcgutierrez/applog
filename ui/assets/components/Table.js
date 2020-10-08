export default class extends HTMLTableElement{
    constructor(){
        super();
    }
    connectedCallback(){
        
    }
    setContent(id, resource, headers, data, deleteAction, updateAction)
    {
        this.setAttribute("border", 1);
        console.log(headers);
        let header_container = document.createElement('thead');
        let body_container = document.createElement('tbody');
        let tr_header = document.createElement("tr");
        headers.map(header => {
            let header_cell = document.createElement('th');
            header_cell.append(header)
            tr_header.append(header_cell);
        });
        let header_cell = document.createElement('th');
        header_cell.append("actions")
        tr_header.append(header_cell);
        header_container.append(tr_header);
        this.append(header_container);
        data.map(row => {
            let row_container = document.createElement("tr");
            const actions = [
                {
                    name: "update",
                    action: () => {},
                    link: "/1"
                },
                {
                    name: "delete",
                    action: () => {
                        deleteAction(row[id])
                    }
                }
            ];
            headers.map(header => {
                let body_cell = document.createElement('td');
                body_cell.append(row[header])
                row_container.append(body_cell);
            });
            const actions_container = document.createElement("td");
            actions.map(action => {
                const action_button = document.createElement("button");
                action_button.innerText = action.name;
                if(action.link)
                {
                    let link = document.createElement("a");
                    link.href = action.link;
                    link.innerText = action.name;
                    action_button.appendChild(link);
                }
                action_button.addEventListener("click", action.action);
                actions_container.append(action_button);
            });
            row_container.append(actions_container);
            body_container.append(row_container);
        });
        this.append(body_container);
    }
}