const firebaseConfig = {
    apiKey: "AIzaSyAK3-ylCteaDq4avNx2ns0zdR2S0iWOLvs",
    authDomain: "estacionapp-web.firebaseapp.com",
    projectId: "estacionapp-web",
    storageBucket: "estacionapp-web.appspot.com",
    messagingSenderId: "859276928588",
    appId: "1:859276928588:web:c7edbd0aec61bc9d60b6e9"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const fs = firebase.firestore();

$("#btnGoogleLogin").click(function(){
    const provider = new firebase.auth.GoogleAuthProvider();
    auth.signInWithPopup(provider).then((result) => {
        const credential = result.credential;
        const token = credential.accessToken;
        const user = result.user;        
        var request = $.ajax({
            url: "loginGoogle.php",    //Leerá la url en la etiqueta action del formulario (archivo.php)
            method: "POST", //Leerá el método en etiqueta method del formulario
            data: { 
                'email': user.email,
                'accessToken': token
              }                //Variable serializada más arriba                        
        });
        //Este bloque se ejecutará si no hay error en la petición
        request.done(function(respuesta) {
            if(respuesta == 201){
                window.location.replace("mapa?seccion=mapa&accion=exitoso");
            }else if(respuesta == 202){
                window.location.replace("panel/panel?seccion=garage&accion=exitoso");
            }else if(respuesta == 301){
                window.location.replace("pageIndex?seccion=login&accion=completar");
            }else if(respuesta == 302){
                window.location.replace("pageIndex?seccion=login&accion=errorLogin");
            }
            
            //Tratamos a respuesta según sea el tipo  y la estructura               
        });

        //Este bloque se ejecuta si hay un error
        request.fail(function(jqXHR, textStatus) {
            alert("Hubo un error: " + textStatus);
        });
        /*$.post('login', { email: email, contrasena: '' },
            function(response){
                //window.location.replace("mapa?seccion=mapa");
                console.log(true);
        }).fail(function(){
                console.log("fail");
        });*/
        //console.log(result);
        //console.log("google sign in");
    })
    .catch(err => {
        console.log(err);
    })
});

$("#btnGoogleRegister").click(function(){
    const provider = new firebase.auth.GoogleAuthProvider();
    auth.signInWithPopup(provider).then((result) => {
        const user = result.user;
        const name = user.displayName;
        const email = user.email;
        $("#inputNombre").val(name);
        $("#inputEmail").val(email);
    })
    .catch(err => {
        console.log(err);
    })
});