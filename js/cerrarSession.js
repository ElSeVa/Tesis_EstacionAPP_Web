window.addEventListener("beforeunload", function (e) {
    saveFormData();
(e || window.event).returnValue = null;
    return null;
});

function saveFormData() {
    console.log('saved');
}

$(document).ready(function(){
    gettatus();
});

function gettatus(){
    $.get("./sesionCheck.php", function(data){
        if(!data) {
            window.location = "../logout.php";
        }
        setTimeout(function(){
            checkLoginStatus(data);
        }, 3000);
    });
}

function checkLoginStatus(data){
    console.log('Esto: ' + data);
}