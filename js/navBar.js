//Created by Ganamukkula
function start() {
    document.getElementById("open-button").addEventListener("click", openNav, false);
    document.getElementById("close-button").addEventListener("click", closeNav, false);
}

function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementsByClassName("sidebarmain")[0].style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementsByClassName("sidebarmain")[0].style.marginLeft = "0";
}

window.addEventListener("load", start, false);