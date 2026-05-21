function loadXMLDoc(){
    let xmlhttp = new XMLHttpRequest;

    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState === 4 && xmlhttp.status === 200){
            document.getElementById("messagetext").innerHTML = xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", 'demo.txt');
    xmlhttp.send();
}
