import {delay} from "../utils/delay.js";
import {xhr} from "../utils/xhr.js";
import {useAddCity} from "./addCity.js";
import {useValidateFields} from "./validateFields.js";
import {useEditCity} from "./getCityToEdit.js";

/**
 * A function that sends a request to the server to fetch cities data.
 *
 * @param {number} page - The page number to fetch data from (default is 1).
 * @param {function} after - A callback function to execute after fetching data.
 * @return {{paginate: ((function(): Promise<void>)|*), requestData: ((function(number=, Function=): Promise<void>)|*)}} A promise that resolves when the pagination is completed.
 */
export function useAjaxTable() {
    const wrapper = document.querySelector('.wrapper');
    const spinner = document.querySelector('.spinner');
    const controls = document.querySelector('.controls');


    /**
     * A function that sends a request to the server to fetch cities data.
     *
     * @param {number} page - The page number to fetch data from (default is 1).
     * @param {function} after - A callback function to execute after fetching data.
     */

    const requestData = async (page = 1, after = () => {}) => {
        try {
            spinner.classList.add('active-spinner');

            xhr({
                url: '/api/cities',
                method: 'POST',
                responseType: 'text',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    page
                }),
                beforeResponse: async () => {
                    await delay(500);
                },

            }).then(response => {
                if (response) {
                    wrapper.innerHTML = response;
                    spinner.classList.remove('active-spinner');
                    document.body.classList.remove('loading');
                    controls.classList.remove('loading');

                    after();
                }
            })


        } catch (error) {
            console.log(error);
        }
    }

    /**
     * A function that paginates data when a page link is clicked.
     *
     * @param None
     * @return {Promise<void>} A promise that resolves when the pagination is completed.
     */
    const paginate = async () => {
        try {
            await requestData(1, () => {
                wrapper.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const target = e.target;
                    if (target.classList.contains('page-link')) {
                        const page = +target.dataset.page ?? 1;
                        if (page) {
                            await requestData(page);
                        }
                    }
                });
            });
        } catch (error) {
            console.log(error);
        }
    }

    return {
        paginate,
        requestData
    }
}