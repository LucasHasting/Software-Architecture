//see index.html for comment header block (with sources)

//function used for validation
function isValid(max, id){
    const searchtext = document.getElementById(id).value;
    const pattern = new RegExp("^[a-zA-Z \\-]{1," + max + "}$");

    return ((searchtext.length > 0) && (pattern.test(searchtext)));
}

//gets a thing, state is boolean used to determine if getting state or zip
async function get(thing, state){
    //capitalize first letter of thing passed in
    const cthing = thing.charAt(0).toUpperCase() + thing.slice(1);

    //valid
    if (isValid("50", "city")){
        //get city value
        const searchtext = document.getElementById('city').value;
        
        //store in form data object
        const request = new FormData();
        request.set("city", searchtext);

        //store state if needed
        if(state == false){
            if(!isValid("20", "state")){
                alert("Bad Input");
                return;
            }

            const searchtext2 = document.getElementById('state').value;
            request.set("state", searchtext2);
        } else {
            document.getElementById(`search_zip`).innerHTML = "";
        }

        //setup POST request
        const options = {
            method: 'POST',
            body: request
        };

        //send a post request to the php file :)
        try {
            const response = await fetch("lookup_" + thing + ".php", options);
            if (!response.ok){
                throw new Error('Server error: ' + response.status);
            }

            const data = await response.json();
        
            //display result
            let matchString = `<label for="${thing}">${cthing}: </label>`;
                               
            if(state === true){
                matchString += `<select id="${thing}" name="${thing}" onchange="get('zip', false)">\n`;
                matchString += `<option disabled selected>Select a ${thing}</option>`;
            } else {
                matchString += `<select id="${thing}" name="${thing}">\n`;
            }

            for (let i = 0; i < data.name.length; i++){
                if(state == false && i == 0){
                    matchString += "<option selected>" + data.name[i] + "</option>\n";
                } else {
                    matchString += "<option>" + data.name[i] + "</option>\n";
                }
            }

            //set the result - html
            document.getElementById(`search_${thing}`).innerHTML = matchString;
        } catch (e) {
            //or fail :(
            console.error('network error ' + e.description);
        }
    } else {
        alert("Bad Input");
    }
}
