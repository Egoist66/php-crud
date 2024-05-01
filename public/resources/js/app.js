import {ajaxTable} from "./modules/ajax-table.js";

class App {

    static init() {

        document.addEventListener('DOMContentLoaded', () => {
            const table = ajaxTable();
            table.paginate();
        })
    }
}

App.init()