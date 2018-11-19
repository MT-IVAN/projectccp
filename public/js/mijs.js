 // Para la ordenaión de la tabla de preguntas
 $('th').click(function() {
    var table = $(this).parents('table').eq(0)
    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
    this.asc = !this.asc
    if (!this.asc) {
      rows = rows.reverse()
    }
    for (var i = 0; i < rows.length; i++) {
      table.append(rows[i])
    }
    setIcon($(this), this.asc);
  })

  function comparer(index) {
    return function(a, b) {
      var valA = getCellValue(a, index),
        valB = getCellValue(b, index)
      return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
    }
  }

  function getCellValue(row, index) {
    return $(row).children('td').eq(index).html()
  }

  function setIcon(element, asc) {
    $("th").each(function(index) {
      $(this).removeClass("sorting");
      $(this).removeClass("asc");
      $(this).removeClass("desc");
    });
    element.addClass("sorting");
    if (asc) element.addClass("asc");
    else element.addClass("desc");
  }
  // FIN:::: Para la ordenaión de la tabla de preguntas
  // Para conocer el listao de preguntas a adicionar en la prueba
  $(document).ready(function() {
         $('#estadoGuardar').mousemove(function() {
            var valores =  $('#datos');
            var favorite = [];
            $.each($("input[name='activar']:checked"), function(){            
                favorite.push($(this).val());
                valores.attr('value',favorite.join(", ") );
            });
            if(favorite.length<=0)
              $('#guardar').attr('disabled', true);
             else
              $('#guardar').removeAttr("disabled");
            console.log(favorite.length); 
            
        });
    });
  // FIN::::
  // Para activar los tooltips
 // $(function () {
   // $('[data-toggle="tooltip"]').tooltip()
  //})
  // FIN:::
  // Para AJAX en la pagina prueba
  $(document).ready(function() {
    var url = "prueba/uno";

    $('.btn_prueba').click(function(e) {

        e.preventDefault();
        $.ajax({
            data: {"id" :$(this).attr('name')},
            type: "GET",
            dataType: "json",
            url: url,
            success: function(data){
               setLstPublicadas(data);
            }
        })
         
         .fail(function( jqXHR, textStatus, errorThrown ) {
             if ( console && console.log ) {
                 console.log( "La solicitud a fallado: " +  textStatus);
             }
        });
       
    });
});

  function setLstPublicadas(data){
    var content = "<tr>"
    for(j=0; j<data.length; j++){
      if(data[j].visible==1){
        btnclass = "btn-warning";
        btntext = "Desactivar";
      }else{
        btnclass = "btn-success";
        btntext = "Activar";
      }
      content += '<td>' +data[j].nombre+ '</td>';
      content += '<td>' +data[j].created_at+ '</td>';
      content += '<td>' + '<button name="prueba/'+data[j].id+'" class="btn '+btnclass+' btn_prueba" onClick="activar('+data[j].id+')">'+btntext+'</button> <a href="prueba_details/'+data[j].id+'" class="btn btn-info">Detalles</a> <a href="#" class="btn btn-default">Resultados</a>' + '</td>';
      content += "</tr><tr>"
    }
    content += "</tr>"
    $('#lst_publicadas').html(content);
    
  }

  function activar(valor){
    var url = "prueba/uno";
        $.ajax({
            data: {"id" :"prueba/"+valor},
            type: "GET",
            dataType: "json",
            url: url,
            success: function(data){
               setLstPublicadas(data);
            }
        })
         
         .fail(function( jqXHR, textStatus, errorThrown ) {
             if ( console && console.log ) {
                 console.log( "La solicitud a fallado: " +  textStatus);
             }
        });
  }


  // FIN:::

//Paginación de pruebas con ajax
  $(document).ready(function()
{
 $(".pagination a").bind("click",function(e)
 {
alert("hola");
 e.preventDefault();
 var urlPagination = $(this).attr('href');
 $.ajax({
 url: urlPagination,
 type: "get",
 beforeSend: function()
 {
 $('#loadAjax').show();
 },
 success: function(data)
 {
 $('#loadAjax').hide();
 $("#paginacionAjax").empty().html(data.renderPagination);
 },
 error: function()
 {
 alert('Error obteniendo respuesta del servidor, prueba más tarde.');
 }
 });
 });
});