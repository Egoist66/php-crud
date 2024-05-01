
const API = {
    baseURL: ''
}

export function ajaxTable(){
    const links = document.querySelectorAll('.page-link');

    const getPage = () => {
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = +link.dataset.page
                if(page){
                  return page
                }

            })
        })
    }

    const paginate = () => {
        const page = getPage()
    }

    return {
        paginate
    }
}