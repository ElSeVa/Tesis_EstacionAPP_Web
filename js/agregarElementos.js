var main = document.getElementById("main");
var info_extra;

var nombre_span;
var strong_;
var direccion_disponibilidad_span;
var telefono_span;
var div_extra;
var vehiculo_span;
var div_inline_flex;
var div_bd_highlight;
var vehiculos_span;
var div_block;
var precio_horario_span;
var precio_horario_strong;
var precio_span;



function id_className(elemento, id, className){
    elemento.id = id;
    elemento.className = className;
}

function setID(elemento,id){
    elemento.id = id;
}

function buscarYllenar(id, texto){
    document.getElementById(id).innerHTML = texto;
}

function crearElemento(id,element,text,id_document) {
    // createElement
    var elementNode = document.createElement(element);
    // createTextNode
    elementNode.id = id;
    var textNode = document.createTextNode(text);

    var div = document.getElementById(id_document);
    elementNode.appendChild(textNode);
    div.appendChild(elementNode);
}

function crearLink(id,element,text,id_document,id_garage) {
    // createElement
    var elementNode = document.createElement(element);
    // createTextNode
    elementNode.id = id;
    elementNode.type = "button";
    elementNode.className = 'btn btn-primary w-50 mx-auto';
    elementNode.setAttribute('href', "mapa.php?seccion=comentarios&id="+id_garage );
    var textNode = document.createTextNode(text);

    var div = document.getElementById(id_document);
    elementNode.appendChild(textNode);
    div.appendChild(elementNode);
}

function eliminarElemento(id){
    var elemento = document.getElementById(id);
    elemento.parentNode.removeChild(elemento);
}

function verificar(pop,idGarage){
    if(pop.isOpen){
        info_extra = document.createElement("div");
        nombre_span = document.createElement("span");
        strong_ = document.createElement("strong");
        direccion_disponibilidad_span = document.createElement("span");
        telefono_span = document.createElement("span");
        div_extra = document.createElement("div");
        vehiculo_span = document.createElement("span");
        div_inline_flex = document.createElement("div");
        div_bd_highlight = document.createElement("div");
        vehiculos_span = document.createElement("span");
        div_block = document.createElement("div");
        precio_horario_span = document.createElement("span");
        precio_horario_strong = document.createElement("strong");
        precio_span = document.createElement("span");
        var text = "info-extra-";
        id_className(info_extra,text.concat(idGarage),"d-flex mt-3 flex-column");
        id_className(nombre_span,"nombre-span","lead");
        id_className(direccion_disponibilidad_span,"direccion-disponibildad-span","lead mx-2");
        id_className(telefono_span,"telefono-span","lead");
        id_className(div_extra,"div-extra","mx-2");
        id_className(vehiculo_span,"vehiculo-span","py-1 lead");
        id_className(div_inline_flex,"div-inline-flex","d-inline-flex");
        id_className(div_bd_highlight,"div-bd-highlight","p-1 bd-highlight");
        id_className(vehiculos_span,"vehiculos-span","lead");
        id_className(div_block,"div-block","d-block mb-3");
        id_className(precio_horario_span,"precio-horario-span","py-1 lead");
        id_className(precio_span,"precio-span","py-1 lead");
        setID(strong_, "strong_nombre");
        setID(precio_horario_strong, "precio-horario");
    
        nombre_span.appendChild(strong_);
    
        info_extra.appendChild(nombre_span);
        info_extra.appendChild(direccion_disponibilidad_span);
        info_extra.appendChild(telefono_span);
    
        div_extra.appendChild(vehiculo_span);
        div_bd_highlight.appendChild(vehiculos_span);
        div_inline_flex.appendChild(div_bd_highlight);
        div_extra.appendChild(div_inline_flex);
    
        precio_horario_span.appendChild(precio_horario_strong);
        div_block.appendChild(precio_horario_span);
        div_block.appendChild(precio_span);
        div_extra.appendChild(div_block);
        info_extra.appendChild(div_extra);
        main.appendChild(info_extra);
        return true;
    }
    

}
