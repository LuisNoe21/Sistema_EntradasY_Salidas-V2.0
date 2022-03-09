$(document).ready(function(){ 
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    identidad = fila.find('td:eq(2)').text();
    caracteristicas = fila.find('td:eq(3)').text();
    placa = fila.find('td:eq(4)').text();
    referencia = fila.find('td:eq(5)').text();
    fentrada = fila.find('td:eq(6)').text();
    hentrada = fila.find('td:eq(7)').text();
    hsalida = fila.find('td:eq(8)').text();

    $("#nombre").val(nombre);
    $("#identidad").val(identidad);
    $("#caracteristicas").val(caracteristicas);
    $("#placa").val(placa);
    $("#referencia").val(referencia);
    $("#fentrada").val(fentrada);
    $("#hentrada").val(hentrada);
    $("#hsalida").val(hsalida);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    identidad = $.trim($("#identidad").val());
    caracteristicas = $.trim($("#caracteristicas").val());
    placa = $.trim($("#placa").val());
    referencia = $.trim($("#referencia").val());
    fentrada = $.trim($("#fentrada").val());
    hentrada = $.trim($("#hentrada").val());   
    hsalida = $.trim($("#hsalida").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, identidad:identidad, caracteristicas:caracteristicas, placa:placa, referencia:referencia, fentrada:fentrada,hentrada:hentrada, hsalida:hsalida, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            identidad = data[0].identidad;
            caracteristicas = data[0].caracteristicas;
            placa = data[0].placa;
            referencia = data[0].referencia;
            fentrada = data[0].fentrada;
            hentrada = data[0].hentrada;
            hsalida = data[0].hsalida;

            if(opcion == 1){tablaPersonas.row.add([id,nombre, identidad,caracteristicas, placa,referencia,fentrada,hentrada,hsalida]).draw();}
            else{tablaPersonas.row(fila).data([id,nombre,identidad, caracteristicas, placa,referencia,fentrada,hentrada,hsalida]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
  });  

  

var myDate = $('#fentrada');
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if(dd < 10)
  dd = '0' + dd;

if(mm < 10)
  mm = '0' + mm;

today = yyyy + '-' + mm + '-' + dd;
myDate.attr("min", today);

function myFunction(){
  var date = myDate.val();
  if(Date.parse(date)){
    if(date < today){
      alert('La fecha no puede ser menor a la actual');
      myDate.val("");
      
    }
  }
}
  
  


});