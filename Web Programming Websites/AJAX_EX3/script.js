function isValid(){
    const searchtext = document.getElementById("searchtext").value;
    const pattern = /^[0-9a-zA-Z !\-\.]{1,64}$/;

    return ((searchtext.length > 0) && (pattern.test(searchtext)));
}

async function getCar(){
    //valid
    if (isValid()){
        //get city value
        const searchtext = document.getElementById('searchtext').value;

        //store in form data object
        const request = new FormData();
        request.set("name", searchtext);

        //setup POST request
        const options = {
            method: 'POST',
            body: request
        };

        //send a post request to the php file :)
        try {
            const response = await fetch('lookup.php', options);
            if (!response.ok){
                throw new Error('Server error: ' + response.status);
            }

            const data = await response.json();

            //display result
            let matchString = new String();
            for (let i = 0; i < data.name.length; i++){
                matchString += data.name[i] + '<br>';
            }

            //set the result - html
            document.getElementById('searchResult').innerHTML = matchString;
        } catch (e) {
            //or fail :(
            console.error('network error ' + e.description);
        }
   }
}
