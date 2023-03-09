const form = document.querySelector('#cat');
const categoryInput = document.querySelector('#category');
const descInput = document.querySelector('#desc');

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
    if(categoryInput.value.trim()==''){
        setError(categoryInput, 'Fill the name');
    }else if(categoryInput.value.trim().length <3 || categoryInput.value.trim().length > 15){
        setError(categoryInput, 'Name must be min 3 and max 15 charecters');
    }else {
        setSuccess(categoryInput);
    }
    //EMAIL
    if(descInput.value.trim()==''){
        setError(descInput, 'Fill the name');
    }else if(descInput.value.trim().length <3 || descInput.value.trim().length > 15){
        setError(descInput, 'Name must be min 3 and max 15 charecters');
    }else {
        setSuccess(descInput);
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
