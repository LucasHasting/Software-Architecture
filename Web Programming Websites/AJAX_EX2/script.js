function isValid(){
    const searchtext = document.getElementById("searchtext").value;
    const pattern = /^[0-9a-zA-Z !\-\.]{1,64}$/;

    return ((searchtext.length > 0) && (pattern.test(searchtext)));
}

function getCar() {
    //validated!
    if(isValid()){
        const searchtext = document.getElementById('searchtext').value;
        let XHR = new XMLHttpRequest();

        XHR.onreadystatechange = function() {
            try {
                if((XHR.readyState === 4) && (XHR.status === 200)){
                    let jsonResponse = JSON.parse(XHR.responseText);
                    let matchString = new String;
                    for (let i = 0; i < jsonResponse.name.length; i++){
                        matchString += jsonResponse.name[i] + "<br>";
                    }
                    document.getElementById("searchResult").innerHTML = matchString;
                }
            } catch (e) {
                console.error('server error: ' + e.description);
            }
        }
        XHR.open('GET', 'lookup.php?name='+searchtext);
        XHR.send(null);
    }
}
