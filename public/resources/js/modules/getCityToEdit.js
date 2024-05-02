import {xhr} from "../utils/xhr.js";
import {delay} from "../utils/delay.js";
import {eventDispatcher} from "../utils/eventDispatcher.js";
import {useAjaxTable} from "./ajax-table.js";

export function useEditCity() {

    const {requestData} = useAjaxTable()

    const editCityForm = document.getElementById('editCityForm');
    const editCityModal = document.getElementById('editCity');
    const submitForm = document.getElementById('edit-city-btn');
    const btnClose = document.querySelector('.btn-close');



    const editCity = () => {
        editCityForm.addEventListener('submit', async function (event) {
            event.preventDefault();

            const data = await xhr({
                url: `/api/cities/edit/`,
                method: 'PUT',
                responseType: 'json',
                body: JSON.stringify({
                    id: this.getAttribute('data-id'),
                    name: this.cityname.value,
                    population: this.citypopulation.value
                }),
                beforeResponse: async () => {
                    await delay(1000);
                },
                beforeRequest: async () => {
                    submitForm.disabled = true;
                    submitForm.textContent = 'Editing...';
                },
                afterResponse: async (data) => {
                    console.log(data)
                    submitForm.disabled = false;
                    Swal.fire({
                        title: data.message,
                        icon: 'success',
                        confirmButtonText: 'Cool',
                        confirmButtonColor: '#0d6efd',
                        cancelButtonText: 'Cancel',
                    })
                    await requestData(+document.querySelector('.page-item.active').textContent)

                    submitForm.textContent = 'Edit changes';



                },
                errorHandler: async (data) => {
                    Swal.fire({
                        title: data,
                        icon: 'error',
                        confirmButtonText: 'Close',
                        confirmButtonColor: 'red',
                    })
                    submitForm.textContent = 'Edit changes';
                    submitForm.disabled = false;

                }
            })



        })


    }

    return {
        editCity,
    }
}