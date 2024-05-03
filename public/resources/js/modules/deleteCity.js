import {xhr} from "../utils/xhr.js";
import {delay} from "../utils/delay.js";
import {useAjaxTable} from "./ajax-table.js";

export function useDeleteCity() {

    const {requestData} = useAjaxTable()
    const wrapper = document.querySelector('.wrapper');

    const cityDelete = () => {
        wrapper.addEventListener('click', async (event) => {

            if (event.target.classList.contains('btn-delete')) {
                await xhr({
                    url: `/api/cities/delete`,
                    method: 'DELETE',
                    body: JSON.stringify({
                        id: +event.target.id
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('[name="csrf_token"]').value
                    },
                    responseType: 'json',

                    beforeResponse: async () => {
                        await delay(1000);
                    },
                    beforeRequest: async () => {
                        event.target.disabled = true;
                        event.target.textContent = 'Deleting...';
                    },
                    afterResponse: async (data, token) => {
                        document.querySelector('input[name="csrf_token"]').value = token;

                        console.log(data)
                        event.target.disabled = false;
                        Swal.fire({
                            title: data.message,
                            icon: 'success',
                            confirmButtonText: 'Cool',
                            confirmButtonColor: '#0d6efd',
                            cancelButtonText: 'Cancel',

                        })
                        await requestData(+document.querySelector('.page-item.active').textContent)
                        event.target.textContent = 'Delete';


                    },
                    errorHandler: async (data) => {
                        Swal.fire({
                            title: data,
                            icon: 'error',
                            confirmButtonText: 'Close',
                            confirmButtonColor: 'red',
                        })
                        event.target.textContent = 'Delete';
                        event.target.disabled = false;

                    }
                })


            }
        })
    }


    return {
        cityDelete
    }



}