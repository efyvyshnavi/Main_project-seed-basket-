const form = document.querySelector('#category');
const nameInput = document.querySelector('#category');
const desInput = document.querySelector('#description');

form.addEventListener('submit', (event)=>{
    
    validateForm();
    console.log(isFormValid());
    if(isFormValid()==true){
        form.submit();
     }else {
         event.preventDefault();
     }

});

function isFormValid(){
    const inputContainers = form.querySelectorAll('.input-group');
    let result = true;
    inputContainers.forEach((container)=>{
        if(container.classList.contains('error')){
            result = false;
        }
    });
    return result;
}

function validateForm() {
    //USERNAME
    if(nameInput.value.trim()==''){
        setError(nameInput, 'Name can not be empty');
    }else if(nameInput.value.trim().length <5 || nameInput.value.trim().length > 15){
        setError(nameInput, 'Name must be min 5 and max 15 charecters');
    }else {
        setSuccess(nameInput);
    }

    if(desInput.value.trim()==''){
        setError(desInput, 'Name can not be empty');
    }else if(desInput.value.trim().length <5 || desInput.value.trim().length > 15){
        setError(desInput, 'Name must be min 5 and max 15 charecters');
    }else {
        setSuccess(desInput);
    }
    
}

function setError(element, errorMessage) {
    const parent = element.parentElement;
    if(parent.classList.contains('success')){
        parent.classList.remove('success');
    }
    parent.classList.add('error');
    const paragraph = parent.querySelector('p');
    paragraph.textContent = errorMessage;
}

function setSuccess(element){
    const parent = element.parentElement;
    if(parent.classList.contains('error')){
        parent.classList.remove('error');
    }
    parent.classList.add('success');
}
