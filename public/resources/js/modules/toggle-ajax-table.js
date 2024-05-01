export const toggleAjaxTable = (table) => {
    let isOn = true;
    const toggler = document.querySelector('.toggler');

    toggler.addEventListener('click', function () {
        isOn = !isOn;


    })

    return isOn
}