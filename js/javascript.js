$(document).ready(function(){
    $("#checkPropietario").on( "change", function() {
        if(this.checked){        
            $("#inputGarage").prop('required', true);
            $("#inputDireccion").prop('required', true);
            $("#inputDisponibilidad").val("Abierto");
            $('#mostrarOcultar').show(); //muestro mediante id
        }else{            
            $("#inputGarage").prop('required', false);
            $("#inputDireccion").prop('required', false);
            $("#inputGarage").val("");
            $("#inputDireccion").val("");
            $("#inputDisponibilidad").val("");
            $("#inputTelefono").val("");
            $('#mostrarOcultar').hide(); //muestro mediante id
        }
     });
});

$(document).ready(function(){
    $("#switch").on( "change", function() {
        if(this.checked){            
            window.location.replace("panel?seccion=promociones");
        }
     });
    $("#switch1").on( "change", function() {
        if(!this.checked){
            window.location.replace("panel?seccion=promos");
        }
     });
});