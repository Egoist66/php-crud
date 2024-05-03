import {xhr} from "../utils/xhr.js";
import {debounce} from "../utils/debounce.js";
import {delay} from "../utils/delay.js";
import {useAjaxTable} from "./ajax-table.js";

export function useFindCities() {

    const {requestData} = useAjaxTable();
    const search = document.querySelector('#search');
    const spinner = document.querySelector('.spinner');
    const wrapper = document.querySelector('.wrapper');

    const findCity = () => {
        console.log(search.name)
        search.addEventListener('input', debounce(async function () {

            if (!search.value) {
                await requestData(1);
                return
            }

            await xhr({
                method: 'GET',
                url: `/api/cities/find/?q=${search.value}`,
                responseType: 'text',
                beforeResponse: async () => {
                    await delay(500);
                },
                beforeRequest: async () => {
                    spinner.classList.add('active-spinner');
                    document.querySelector('.search-label').textContent = 'Searching...';
                },

                afterResponse: async (data) => {
                    document.querySelector('.search-label').textContent = 'Search';
                    wrapper.innerHTML = data;

                    spinner.classList.remove('active-spinner');
                    document.body.classList.remove('loading');


                }
            })
        }, 500))

    }


    return {
        findCity
    }
}