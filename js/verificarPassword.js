$(function(){
    var mayus = new RegExp("^(?=.*[A-Z])");
    var special = new RegExp("^(?=.*[!@#$%&*])");
    var numbers = new RegExp("^(?=.*[0-9])");
    var lower = new RegExp("^(?=.*[a-z])");
    var lenght = new RegExp("^(?=.{8,})");

    var regExp = [mayus, special, numbers, lower, lenght];
    var elemns = [$("#mayus"),$("#special"),$("#numbers"),$("#lower"),$("#lenght")];
    $("#inputPassword").on( "keyup", function(){
        var pass = $("#inputPassword").val();
        var check = 0;
        
        for(var i = 0; i < 5; i++){
            if(regExp[i].test(pass)){
                elemns[i].hide();
                check++;
            }else{
                elemns[i].show();
            }
        }
        

        if(check>=1 && check<=2){
            $("#mensaje").text("Muy inseguro").css({"color":"red"});
        }else if(check>=3 && check<=4){
            $("#mensaje").text("Poco seguro").css({"color":"orange"});
        }else if(check==5){
            $("#mensaje").text("Muy seguro").css({"color":"green"});
        }else{
            $("#mensaje").text("");
        }
    });

    $("#inputContrasena").on( "keyup", function(){
        var pass = $("#inputContrasena").val();
        var check = 0;
        
        for(var i = 0; i < 5; i++){
            if(regExp[i].test(pass)){
                elemns[i].hide();
                check++;
            }else{
                elemns[i].show();
            }
        }
        

        if(check>=1 && check<=2){
            $("#mensaje").text("Muy inseguro").css({"color":"red"});
        }else if(check>=3 && check<=4){
            $("#mensaje").text("Poco seguro").css({"color":"orange"});
        }else if(check==5){
            $("#mensaje").text("Muy seguro").css({"color":"green"});
        }else{
            $("#mensaje").text("");
        }
    });
});