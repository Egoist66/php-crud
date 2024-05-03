import {useAjaxTable} from "./modules/ajax-table.js";
import {useAddCity} from "./modules/addCity.js";
import {useValidateFields} from "./modules/validateFields.js";
import {useEditCity} from "./modules/getCityToEdit.js";
import {useDeleteCity} from "./modules/deleteCity.js";
import {useFindCities} from "./modules/findCities.js";

class App {

    /**
     * A static method that initializes the functionality when the DOM content has loaded.
     */
    static init() {

        document.addEventListener('DOMContentLoaded', () => {
            const table = useAjaxTable();
            const city = useAddCity();
            const fields = useValidateFields();
            const editCity = useEditCity();
            const deleteCity = useDeleteCity();
            const findCities = useFindCities();

            table.paginate();
            fields.checkFields();
            city.createCity();
            editCity.initEditCity();
            editCity.editCity();
            deleteCity.cityDelete();
            findCities.findCity();


        })



    }
}

App.init()