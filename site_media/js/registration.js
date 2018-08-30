function registrarUsuario(){
  $.ajax({
      url: '../services/registro.php',
      type:     'POST',
      dataType: 'JSON',
      data: {
        "accion":     'registrarUsuario',
        "first_name": $("#firstName").val(),
        "last_name" : $("#lastName").val(),
        "email"     : $("#email").val()
      },
    })
    .done(function(respuesta) {
      if (respuesta.exito != 0){
        if (respuesta.id ==-1){
          $("#warning-signin").html("Email already exists");   
        }
        else{
          $("#warning-signin").html("All fields are required*");
          localStorage.setItem("idRegistro", respuesta.id);
          guardarDatosUsuario();
        }
      }
      else{
        console.log("Error al guardar el usuario");
     
      }
    })
    .fail(function() {
      console.log("Error de conexión");
    });
}
function guardarDatosUsuario(){
  console.log("Seccion para entrar a datos de usuario");
  
  $.ajax({
      url:      '../services/autenticacion.php',
      type:     'POST',
      dataType: 'JSON',
      data: {
        "accion":     'guardarDatosUsuario',
        "username"                : $("#username").val(),
        "password"                : $("#password").val(),
        "users_information_id"    : localStorage.getItem("idRegistro")
      },
    })
    .done(function(respuesta) {
      if (respuesta.exito != 0){
          $("#usernameWarning").html("");
          cleanFields();
          $(".warning-signin").html("You have signed up successfully!");
      }
      else{
        console.log("Error al guardar el usuario");
     
      }
    })
    .fail(function() {
      console.log("Error de conexión");
    });
}

$(document).ready(function(){
  
  var cont = 0;

  $("#sign-up-button").click(function(){
    console.log("entre al registro");
    cont = 0;
    $(".reg-input").each(function(){
      if ($(this).val()!=""){
        cont+=1;
      }
    });
    //Quick verification
    if (cont>5){
      if ($("#password").val() == $("#passwordVerification").val())
      {
         registrarUsuario();
         $(".warning-signin").html("All fields are required*");
      }
      else{
        $(".warning-signin").html("Password fields doesn't match");
      }
    }
    else{
      $(".warning-signin").html("All fields are required, complete them");
    }
  });
});