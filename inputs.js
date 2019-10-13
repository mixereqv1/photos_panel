const all_inputs = document.querySelectorAll('input');
all_inputs.forEach(element => {
    element.addEventListener('focus', event => {
        element.parentElement.classList.add('focused');
    })
    element.addEventListener('blur', event => {
        let input_value = element.value;
        if(input_value == '') {
            element.classList.remove('filled');
            element.parentElement.classList.remove('focused');
        } else {
            element.classList.add('filled');
        }
    })
});