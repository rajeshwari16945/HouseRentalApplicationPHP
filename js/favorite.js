//created by Ganamukkula
function start() {
    //event listener for the button
    let favoriteButtons = document.querySelectorAll(".favorite-button");
    favoriteButtons.forEach(function(button) {
        button.addEventListener("click", toggleFavorite, false);
    });
    //to clear the controls in filter page
    document.getElementById("clear-all-controls").addEventListener("click", function() {
        console.log("clear-all");
        location.reload();
    }, false);
}//start()

function toggleFavorite(event) {
    this.classList.toggle('active');
    let button = event.target;
    let houseId = button.dataset.id; // Get the data-id attribute value
    let isButtonActive = button.classList.contains('active');
    let action = isButtonActive ? 'add' : 'delete';

    //creating a form element and setting its method and action 
    var form = document.createElement('form');
    form.method = 'post';
    form.action = '../pages/favoriteSession.php'; 
    // Create hidden input for argument1
    var input1 = document.createElement('input');
    input1.type = 'hidden';
    input1.name = 'houseId';
    input1.value = houseId;
    // Create hidden input for argument2
    var input2 = document.createElement('input');
    input2.type = 'hidden';
    input2.name = 'action';
    input2.value = action;
    //the input fields are appended to the form element.
    form.appendChild(input2);
    form.appendChild(input1);
    //the form is appended to the document body.
    document.body.appendChild(form);
    form.submit();
}

//pageLoad event listener
window.addEventListener("load", start, false);