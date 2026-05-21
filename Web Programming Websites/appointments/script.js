//see index.php for comment header block (with sources)

//fuction used to validate id's
function valid_number(id){
    let num = document.getElementById(id).value;
    return condition(num, Number(num));
}

//condition checked with each value
function condition(num, num_val){
    if(num.length > 0 && !isNaN(num_val) && num_val >= 1 && Number.isInteger(num_val)){
        return true;     
    } else {
        alert("(EVIL) INVALID INPUT");
        return false;
    }

}

//used to validate delete
function valid_number_list(name){
    const checkedBoxes = document.querySelectorAll(`input[name="${name}"]:checked`);
    is_true = true;
    checkedBoxes.forEach(appointment => {
        is_true &&= condition(appointment.value, Number(appointment.value));
    });
    return is_true;
}
