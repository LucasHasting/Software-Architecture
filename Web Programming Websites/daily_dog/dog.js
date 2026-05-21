/* Data validation for Daily Dog subscribe form */

function textfield(field){
    let txt = document.getElementById(field).value;

    if(txt.length < 1){
        return field +  " cannot be blank\n";
    }
    return "";
}

function dropdown(field){
    let ndx = document.getElementById(field).selectedIndex;

    if(ndx == -1){
        return "No " + field + " option selected\n";
    }
    return "";
}

function checkbox(field){
    let cbox = document.getElementById(field).checked;
    
    if(!cbox){ //!(cbox == null && cbox == true)
        return field + " must be checked\n";
    }
    return "";
}

function radioset(field){
    let rad = document.getElementsByName(field);
    let not_empty = false;

    for (let i = 0; i < rad.length i++) {
        not_empty |= rad[i].checked;
    }

    if(!not_empty){
        return "No " + field + " radio button selected\n";
    }
    return "";
}

function validate() {
    //change based on html
    let msg = textfield('petname');
    msg += dropdown('gender');
    msg += dropdown('food');
    msg += radioset('age');
    msg += checkbox('subscribe');

    if(msg.length > 0){
        alert(msg);
        return false
    }
    return true;
}
