//////////// Pinta estilos de error y valido
function pintarStilos(elem, tipo) {

  if (tipo === 'error') {
    elem.addClass('error');
    elem.removeClass('correcto');
    cumple = 0;

  } else if (tipo === 'valido') {
    elem.addClass('correcto');
    elem.removeClass('error');
    cumple = 1;
  }

}

function showAlert(cumple, timeIn, timeOut) {

  const divAlert = $('div.alert-container');
  const contentAlert = 'div.alert-content';

  divAlert.find('div.alert-content').empty();


  if (cumple === 1) {

    divAlert.addClass('alert-check').find(contentAlert).text('Nice !');
  } else if (cumple === 2) {

    divAlert.addClass('alert-error').find(contentAlert).text('Hmm, something went wrong');
  } else if (cumple === 3) {
    divAlert.addClass('alert-server').find(contentAlert).text('Maybe the server is down :(');
  }

  divAlert.fadeIn(timeIn, "linear", function() {
    setTimeout(function() {
      divAlert.fadeOut().animate({
        'bottom': '0%'
      }, {
        duration: 'slow',
        queue: false
      });
    }, timeOut);
  }).animate({
    'bottom': '20vh'
  }, {
    duration: 'slow',
    queue: false
  });

}




//////////// Valida longitud
function validarLength(valor, minLength, maxLength) {
  if ((valor >= minLength) & (valor <= maxLength)) {
    return true;
  } else {
    return false;
  }
}

function validateForm(form) {

  event.preventDefault();

  var camposObliga = $(form).find('input,select').length;
  var botonSubmit = $(form).find('button[type="submit"]');

  // // Desabilitar el boton submit
  // if (camposObliga != null) {
  //   botonSubmit.attr('disabled', true);
  //   setTimeout(() => {
  //     botonSubmit.attr('disabled', false);
  //   }, 3000);
  // }


  var total = 0;
  //Arreglo donde almacenará cada campo
  //expresiones Regulares
  const regExpEmail = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  const regExpNumber = /^\d+$/;

  ////Validar los campos
  $(form).find('input,select').each(function(i, e) {

    var id = $(e).attr('id')
    //Poner el id en el name para mandar los datos por serialize
    $(e).attr('name', id);

    var valorInput = $(e).val();
    var valorCheckbox = $(e).prop('checked');
    var valorSelect = $(e).val();
    var customDivCheck = $(e).parent().find('div.custom-checkbox');


    if ($(e).length !== 0) {
      switch ($(e).attr('type')) {

        case "text":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "password":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "date":
          valorInput !== "" ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "identification":
          if ((regExpNumber.test($(e).prop('value'))) & (validarLength(valorInput.length, 10, 10))) {
            pintarStilos($(e), 'valido');
          } else {
            pintarStilos($(e), 'error');
          }
          break;

        case "emailCustom":
          regExpEmail.test($(e).prop('value')) ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;

        case "checkbox":
          valorCheckbox !== false ? pintarStilos(customDivCheck, 'valido') : pintarStilos(customDivCheck, 'error');
          break;

        case "select":
          valorSelect != 1 ? pintarStilos($(e), 'valido') : pintarStilos($(e), 'error');
          break;
      }
      total = total + cumple;
    }

  });

  if (total === camposObliga) {
    return true;
  } else {
    return false;
  }

}

$.ajaxSetup({
  url: 'procesar.php',
  type: 'POST',
  async: true,
  beforeSend: function() {
    $('.loading').show();
  },
  error: function(response) {
    console.log(response);
    showAlert(3, 1000, 3000);
  }
});



$('form#matricula').submit(function(event) {
  var formulario = $(this);

  if (validateForm(this)) {
    //Data que se envia a la base de datos
    var data = $(this).serialize();
    $.ajax({
      data: data,
      success: function(response) {

        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          formulario.hide();
          $('form#clinic').show();
          formulario.parent().find('.loading').fadeOut(1000);

        } else {
          showAlert(2, 1000, 3000);
          clinic
        }
      },
    });
  }

});

$('form#clinic').submit(function(event) {

  var formulario = $(this);

  if (validateForm(this)) {
    // Data que se envia a la base de datos
    var data = $(this).serialize();
    $.ajax({
      data: data,
      success: function(response) {

        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          formulario.hide();
          $('form#estudiante').show();
          formulario.parent().find('.loading').fadeOut(1000);
        } else {
          showAlert(2, 1000, 3000);
        }
      },
    });
  }

});


$('form#estudiante').submit(function(event) {

  var formulario = $(this);

  if (validateForm(this)) {
    // Data que se envia a la base de datos
    var data = $(this).serialize();
    $.ajax({
      data: data,
      success: function(response) {

        var jsonData = JSON.parse(response);
        if (jsonData.success == "1") {
          formulario.closest('.modal').fadeOut();
          formulario.closest('.modal').find('form').hide();
          formulario.closest('.modal').find('form#matricula').show();
          formulario.parent().find('.loading').fadeOut(1000);
          showAlert(1, 1000, 3000);
        } else {
          showAlert(2, 1000, 3000);
        }
      },
    });
  }

});


//
// function submitAjax(form) {
//
//   var estudiante = form.serialize();
//   console.log('lo que envio' + estudiante);
//
//   $.post("example.php", function() {
//     alert("success");
//   })
//   // .done(function() {
//   //   insertCliet(insertDocument())
//   // })
//   //
//   // function insertCliet(onSuccess){
//   //   $.post( "example.php", function() {
//   //     alert( "success" );
//   //   })
//   //   .done(function() {
//   //     onSuccess();
//   //   })
//   // }
//   //
//   // function insertDocument(onSuccess){
//   //   $.post( "example.php", function() {
//   //     alert( "success" );
//   //   })
//   //   .done(function() {
//   //     alert('completo!')
//   //   })
//   // }
//
//
// }
