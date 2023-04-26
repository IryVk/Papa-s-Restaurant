// stop submitting if user isn't logged in
function forceLogin(event){
    event.preventDefault();
    document.getElementById('signup').style.display='block';
}

// add danger attribte to wrong fields
function addRed(){
    divs = document.getElementsByClassName("danger")
    for (var i =0; i < divs.length; i++){
        if (divs[i].innerText != ""){ 
            divs[i].previousElementSibling.className = "error-input";
        }
    }
    }
addRed();