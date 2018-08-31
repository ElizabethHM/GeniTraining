function comprobarUsuario(){
  $.ajax({
      url: '../services/autenticacion.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "accion":     'comprobarUsuario',
        "username": $("#usernameLogin").val()
      },
    })
    .done(function(respuesta) {
      if (respuesta.exito != 0){
        localStorage.setItem("idUsuarioComprobado", respuesta.idUsuario)
        comprobarContraseña();
      }
      else{
        $(".warning-login").html("User doesn't exist");
      }
    })
    .fail(function() {
      console.log("Error de conexión");
    });
}
function comprobarContraseña(){
  var idUsuario = localStorage.getItem("idUsuarioComprobado");
  $.ajax({
      url: '../services/autenticacion.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "accion"    : 'comprobarContraseña',
        "idUsuario" :  idUsuario,
        "password"  : $("#passwordLogin").val()
      },
    })
    .done(function(respuesta) {
      if (respuesta.exito != 0){
        localStorage.setItem("idUsuarioLogueado",idUsuario);
        hideForms("inner-container");
      }
      else{
        $(".warning-login").html("Wrong Password");
      }
    })
    .fail(function() {
      console.log("Error de conexión");
    });
}

function cambiarContraseña(){
  var idUsuario = localStorage.getItem("idUsuarioComprobado");
  $.ajax({
      url: '../services/autenticacion.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "accion"            :'cambiarContraseña',
        "idUsuario"         : idUsuario,
        "changePassword"    : $("#changePassword").val()
      },
    })
    .done(function(respuesta) {
      if (respuesta.exito!= 0){
        console.log("Éxito");
        if(respuesta.cambioExitoso ==0){
          $(".warning-change-Password").html("You have already use this password, choose a new one");
        }
        else{
          $(".warning-change-Password").html("Password saved successfully!");
        }
      }
      else{
        console.log("Fracaso");
      }
    })
    .fail(function() {
      console.log("Error de conexión");
    });
}
$(document).ready( function(){
 
  $("#login-button").click(function(){
    if($("#usernameLogin").val().trim()!="" && $("#passwordLogin").val().trim()!="")
      {
        comprobarUsuario();
      }
    else{
      $(".warning-login").html("All fields are required");
    }
  });

  $("#change-pass-button").click(function(){
    $("#emptyFieldsChangeWarning").html("");
    
    if ($("#changePassword").val().trim()!="" && $("#changePasswordVerification").val().trim()!=""){
      if($("#changePassword").val().trim() == $("#changePasswordVerification").val().trim())
        cambiarContraseña()
      else
        $(".warning-login").html("Password fields are not the same");
    }
    else{
      $(".warning-login").html("All fields are required");
    }
  });
});