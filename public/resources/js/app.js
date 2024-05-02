import {useAjaxTable} from "./modules/ajax-table.js";
import {useAddCity} from "./modules/addCity.js";
import {useValidateFields} from "./modules/validateFields.js";

class App {

    /**
     * A static method that initializes the functionality when the DOM content has loaded.
     */
    static init() {

        document.addEventListener('DOMContentLoaded', () => {
            const table = useAjaxTable();
            const city = useAddCity();
            const fields = useValidateFields();

            table.paginate();
            fields.checkFields();
            city.createCity();


        })



    }
}

App.init()