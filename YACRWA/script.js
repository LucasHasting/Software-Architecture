//see index.php for comment header block (with sources)

//-----------------------------------------------------------------------------
//Valdiation Functions (the name describes what we are validating):

function valid_reserve(){
    let date_in = document.getElementById("in").value;
    let date_out = document.getElementById("out").value;
    let type = document.getElementById("type").value;
    
    if(valid_date(date_in) && valid_date(date_out) && valid_type(type) && date_in <= date_out){
        return true;
    } else {
        alert("Bad Input");
        return false;
    }
}

function compare_dates(date_in, date_out){
    return date_out > date_in;
}

function valid_date(date){
    if(typeof date === 'string'){
        const pattern = new RegExp("^\\d{4}-\\d{2}-\\d{2}$");
        return pattern.test(date);
    } else {
        return false;
    }
}

function valid_type(type){
    if(typeof type === 'string'){
        return type.length === 1 && (type === "T" || type === "P" || type === "F");
    } else {
        return false;
    }
}

function valid_name(name){
    if(typeof name === 'string'){
        return name.length >= 1 && name.length <= 64;
    } else {
        return false;
    }
}

function valid_id(id){
    if(typeof id === 'string'){
        return id.length >= 1 && id.length <= 4;
    } else {
        return false;
    }
}


function valid_email(email){
    if(typeof email === 'string'){
        const pattern = new RegExp("^.+@.+\\..+$");
        return pattern.test(email) && email.length <= 64;
    } else {
        return false;
    }
}

function valid_confirm_num(c_num){
    return c_num > 0 && !Number.isNaN(c_num);
}

function valid_ids(ids){
    const checkedBoxes = document.querySelectorAll(`input[name="ids[]"]:checked`);
    is_true = true;
    checkedBoxes.forEach(id => {
        is_true &&= valid_id(id.value);
    });
    return is_true;
}

//-----------------------------------------------------------------------------
//AJAX and HTML Interaction:

//used to display the delete button
function delete_reservation_menu(){
    document.getElementById(`delete_area`).innerHTML = "";
    document.getElementById(`reservation`).innerHTML = "";
    show(2).then(check => {
        if(!check){
            return;
        }
    
        let button = `<form method="POST" action="delete.php">
                        <input type="submit" value="Confirm">
                      </form>`;

        document.getElementById(`delete_area`).innerHTML = button;
    });
}

//set the user info html
function reserveUserInfo(){
    const checkedBoxes = document.querySelectorAll(`input[name="ids[]"]:checked`);

    if(checkedBoxes.length > 0){
        let user_input = `<label for="fname">First Name: </label>\n
                      <input type="text" id="fname" name="fname" autocomplete="off" required maxlength="64" minlength="1">
                <br>
                <label for="lname">Last Name: </label>
                <input type="text" id="lname" name="lname" autocomplete="off" required maxlength="64" minlength="1">
                <br>
                <label for="email">Email: </label>
                <input type="email" id="email" name="email" autocomplete="off" required maxlength="64">
                <br>
                <button name="user_info" onclick="reserve();">Confirm</button>`
        document.getElementById(`user`).innerHTML = user_input;
    } else {
        document.getElementById(`user`).innerHTML = "";
    }
}

//reserves an a camp site
async function reserve(){
    //get and validate input fields
    const first_name = document.getElementById('fname').value;
    const last_name = document.getElementById('lname').value;
    const email = document.getElementById('email').value;
    const ids = document.querySelectorAll(`input[name="ids[]"]:checked`);
    if (valid_name(first_name) && valid_name(last_name) && valid_email(email) && valid_ids(ids)){
   
        //store everything in form data object
        const request = new FormData();
        
        //create arrary of values to be sent via POST
        let id_values = [];
        ids.forEach(reservation => {
            id_values.push(reservation.value);
        });

        //set post key value pairs
        request.set("fname", first_name);
        request.set("lname", last_name);
        request.set("email", email);
        request.set("ids", id_values);

        //setup POST request
        const options = {
            method: 'POST',
            body: request
        };

        //send a post request to the php file :)
        try {
            const response = await fetch("reserve_camp.php", options);
            if (!response.ok){
                throw new Error('Server error: ' + response.status);
            }

            const data = await response.json();
        
            //display result
            document.getElementById(`user`).innerHTML = "";

            let result = `<h2>Below is your confirmation number(s):</h2>
            <table>
            <tr>
                <th>Site ID</th>
                <th>Confirmation Number</th>
            </tr>`;

            for (let i = 0; i < data.ids.length; i++){
                result += `<tr><td>${data.ids[i]}</td>\n`;
                result += `<td>${data.confirmation_numbers[i]}</td></tr>\n`;
            }

            result += "\n           </table>";
            
            document.getElementById(`theForm`).innerHTML = result;
        } catch (e) {
            //or fail :(
            document.getElementById(`user`).innerHTML = "";
            document.getElementById(`theForm`).innerHTML = "";
            console.error('network error ' + e.description);
        }
    } else {
        alert("Bad Input");
    }
}

//shows reservation info based on options
//options: 1 = fname, lname, email; 2 = confirmation number; 3 = date
async function show(option){
    //store everything in form data object
    const request = new FormData();        

    //get input based on option, validate and set it 

    //option 1 = fname, lname, email
    if(option === 1){
        const first_name = document.getElementById('fname').value;
        const last_name = document.getElementById('lname').value;
        const email = document.getElementById('email').value;
        if(!(valid_name(first_name) && valid_name(last_name) && valid_email(email))){
            alert("Bad Input");
            return;
        }
        request.set("fname", first_name);
        request.set("lname", last_name);
        request.set("email", email);

    //option 2 = confirmation #
    } else if (option === 2){
        const confirm_num = document.getElementById('confirmation_num').value.toString();  
        if(!valid_confirm_num(confirm_num)){
            alert("Bad Input");
            return false;
        }
        request.set("confirmation_num", confirm_num);

    //option 3 = date
    } else if (option === 3){
        const date = document.getElementById('date').value;  
        if(!valid_date(date)){
            alert("Bad Input");
            return;
        }
        request.set("date", date);
    
    //not possible without some manipulation
    } else {
        alert("EVIL MANIPULATOR");
        return;
    }

    //setup POST request
    const options = {
        method: 'POST',
        body: request
    };

    //send a post request to the php file :)
    try {
        const response = await fetch("show.php", options);
        if (!response.ok){
            throw new Error('Server error: ' + response.status);
        }
        const data = await response.json();
    
        //display result
        let result = `
        <table>
        <tr>
            <th>Site ID</th>
            <th>Confirmation Number</th>
            <th>Ckeck-in Date</th>
            <th>Ckeck-out Date</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>`;

        for (let i = 0; i < data.ids.length; i++){
            result += `<tr><td>${data.ids[i]}</td>\n`;
            result += `<td>${data.confirmation_numbers[i]}</td>\n`;
            result += `<td>${data.in[i]}</td>\n`;
            result += `<td>${data.out[i]}</td>\n`;
            result += `<td>${data.fname[i]}</td>\n`;
            result += `<td>${data.lname[i]}</td>\n`;
            result += `<td>${data.email[i]}</td></tr>\n`;
        }

        result += "\n           </table>";
        document.getElementById(`reservation`).innerHTML = result;
    } catch (e) {
        //or fail :(
        console.error('network error ' + e.description);
    }
    return true;
}
