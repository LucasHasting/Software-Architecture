/*
Sources:
https://www.bankrate.com/mortgages/mortgage-calculator/#calculate-mortgage-payment
https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/isNaN
*/

//validation functions

//validate number related fields within a range
function valid_number(min,max,id){
    let num = document.getElementById(id).value;
    let num_val = Number(num);

    return num.length > 0 && !isNaN(num_val) && num_val >= min && num_val <= max;
}

//validate the term field
function valid_term(){
    let val = document.getElementById("term").value;
    switch(val){
        case "15":
        case "20":
        case "25":
        case "30":
            return true;
        default:
            return false;
    }
}

//function used to display range 
function rate_change() {
    let elem_rate = document.getElementById("rate");
    let num = Number(elem_rate.value);

    let elem_rate_num = document.getElementById("rate_num");
    elem_rate_num.innerHTML = num.toFixed(2) + "%";
    return;
}

//function used to validate input and compute result
function result(){
    //check that every field is valid
    if(!(valid_number(1,1000000000000000,"price")
    && valid_number(1,1000000000000000,"down")
    && valid_number(1,15,"rate")
    && valid_term())){
        document.getElementById("ans").innerHTML = "Invalid input.";
        return;
    }

    //get principle amount
    let p = Number(document.getElementById("price").value) - Number(document.getElementById("down").value);

    //get rate and term
    let r = Number(document.getElementById("rate").value)/(100*12);
    let n = Number(document.getElementById("term").value)*12;

    //get payment
    let ans = p * (r*((1+r)**n))/(((1+r)**n)-1);
    document.getElementById("ans").innerHTML = "Monthly Payment Amount: $" + ans.toFixed(2);
    return;
}

//function used to reset rate and result
function reset_rate() {
    let elem_rate_num = document.getElementById("rate_num");
    elem_rate_num.innerHTML = "1.00%";
    document.getElementById("ans").innerHTML = "";
    return;
}
