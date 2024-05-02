export function useValidateFields() {
    const addInputs = [...document.querySelectorAll('#addCityForm .city-fields')];
    const addCityBtn = document.getElementById('add-city-btn');


    const checkFields = () => {
        addInputs.forEach(input => {
            addCityBtn.disabled = addInputs[0].value === '' || addInputs[1].value === '';
            input.addEventListener('input', (e) => {
                addCityBtn.disabled = addInputs[0].value === '' || addInputs[1].value === '';


            })
        })
    }

    return {
        checkFields
    }
}