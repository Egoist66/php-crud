import {xhr} from "../utils/xhr.js";
import {delay} from "../utils/delay.js";
import {useAjaxTable} from "./ajax-table.js";
import {eventDispatcher} from "../utils/eventDispatcher.js";

export function useAddCity() {

    const {requestData} = useAjaxTable()

    const addCityForm = document.getElementById('addCityForm');
    const addCityModal = document.getElementById('addCityModal');
    const submitForm = document.getElementById('add-city-btn');
    const btnClose = document.querySelector('.btn-close');

    const createCity = () => {
        addCityForm.addEventListener('submit', async function (event) {
            event.preventDefault();

            const data = await xhr({
                url: '/api/cities/add',
                method: 'POST',
                responseType: 'json',
                body: new FormData(this),
                beforeResponse: async () => {
                    await delay(1000);
                },
                beforeRequest: async () => {
                    submitForm.disabled = true;
                    submitForm.textContent = 'Saving...';
                },
                afterResponse: async (data) => {
                    submitForm.disabled = false;
                    Swal.fire({
                        title: data.message,
                        icon: 'success',
                        confirmButtonText: 'Cool',
                        confirmButtonColor: '#0d6efd',
                        cancelButtonText: 'Cancel',
                    })
                    this.reset();

                    await requestData(9999999)

                    submitForm.textContent = 'Save changes';
                    eventDispatcher(btnClose, 'click', () => {
                        addCityModal.classList.remove('show');
                    })
                },
                errorHandler: async (data) => {
                    Swal.fire({
                        title: data,
                        icon: 'error',
                        confirmButtonText: 'Close',
                        confirmButtonColor: 'red',
                    })
                    submitForm.textContent = 'Save changes';
                    submitForm.disabled = false;

                }
            })



            //console.log(data)
        })


    }

    return {
        createCity
    }
}