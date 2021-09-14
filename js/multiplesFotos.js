var selector = document.getElementById("selector");
var inputFoto = document.getElementById("formFile");

if(selector != null){
    selector.addEventListener("change", function() {
        if(selector.value == "Principal"){
            inputFoto.setAttribute("name", "imagen");
            inputFoto.removeAttribute("multiple", "");
            console.log(selector.value);
        }

        if(selector.value == "Secundario"){  
            inputFoto.setAttribute("name", "imagenes[]");
            inputFoto.setAttribute("multiple", "");
            console.log(selector.value);
        }
    });
}
