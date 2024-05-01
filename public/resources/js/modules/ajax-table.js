import {delay} from "../utils/delay.js";

export function ajaxTable() {
    const wrapper = document.querySelector('.wrapper');
    const spinner = document.querySelector('.spinner');


    const state = {
        page: 1
    }

    const requestData = async (page = 1, after = () => {
    }) => {
        try {
            spinner.classList.add('active-spinner');
            document.body.classList.add('loading');

            const response = await fetch(`/api/cities`, {
                method: 'POST',
                body: JSON.stringify({
                    page
                })
            });

            await delay(500);

            if (response.ok) {
                wrapper.innerHTML = await response.text();
                spinner.classList.remove('active-spinner');
                document.body.classList.remove('loading');
                after();
            }
        } catch (error) {
            console.log(error);
        }
    }

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
        paginate
    }
}