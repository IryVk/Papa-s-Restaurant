// grab elements for the size changing
var elements = document.getElementsByTagName("select");

// call back for changing size
sizePrice = function(){
    // grab real price in invisible div
    var real_price = this.parentNode.parentNode.previousElementSibling.childNodes[5].innerText;
    // grab current displayed price
    var current_price = this.parentNode.parentNode.previousElementSibling.childNodes[1];
    console.log(real_price);
    // do calcs depending on size
    if (this.value == "s"){
        x = real_price;
        current_price.innerText = Math.round(x) + " L.E.";
    }  
    else if (this.value == "m"){
        x = parseFloat(real_price) * 0.5 + parseFloat(real_price);
        current_price.innerText = Math.round(x) + " L.E.";
    }
    else if (this.value == "l"){
        x = parseFloat(real_price) * 0.9 + parseFloat(real_price);
        current_price.innerText = Math.round(x) + " L.E.";
    }   
}
// add event listeners to all elements
for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', sizePrice, false);
}

// stay on same scroll position on relaod
document.addEventListener("DOMContentLoaded", function(event) { 
    var scrollpos = localStorage.getItem('scrollpos');
    if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};