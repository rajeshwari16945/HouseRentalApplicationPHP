//Created by Ganamukkula
const getStartedButton = document.getElementById("getOwnerAgent");
const agentSearchButton = document.getElementById("agentsearchButton");


function detailsPopup(){
    document.getElementById("agentsListTable").style.display = "block";
    document.getElementById("agentDetailCard").style.display = "block";
}

function detailsHide(){
    document.getElementById("searchAgentImg").style.display = "none";
}

window.addEventListener("load", function(e){
    e.preventDefault();
    getStartedButton.addEventListener("click", detailsPopup, false);
    agentSearchButton.addEventListener("click", detailsPopup, false);
    agentSearchButton.addEventListener("click", detailsHide, false);
}, false);