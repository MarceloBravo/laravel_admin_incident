$(function(){
    
    $(document).ready(function(){
        incidente.cargarCategorias();
        configurar.botones();
    });
    
   $("#btnGrabar").click(function(){
        if($("#proyectoSeleccionado").val() !=  "")
        {
            incidente.grabar();
        }else{
            $("#message-error").css("display", "block");
            $("#lbl_message-error").html("Debe seleccionar un proyecto.");
        }
   });
    
   $("#btnLimpiarForm").click(function(){
      incidente.nuevo();
   });
   
   $("#descripcion").keydown(function(){
       incidente.contadorCaracteres(document.getElementById("descripcion"));
   }); 
   
    $("#descripcion").change(function(){
       incidente.contadorCaracteres(document.getElementById("descripcion"));
   }); 
});


var incidente = {
    cargarCategorias: function(){
        $("#categoria_id").empty();
        $.get("/listar_categorias",function(data){
            $("#categoria_id").append("<option value=''> -- Seleccione -- </option>");
            $(data).each(function(index, elem){
                $("#categoria_id").append("<option value='"+elem.id+"'>"+elem.nombre+"</option>");
            });
        });
    },
    
    grabar: function(){
        if(confirm("¿Desea grabar la incidencia?"))
        {   
            $.ajax({
               url: "/incidencias",
               type: "POST",
               data: $("#form").serialize(),
               success:function(data){                   
                   $("#message-error").css("display", "none");
                    $("#message-ok").css("display", "block");
                    $("#lbl_message-ok").html(data[1]);
                    incidente.changeInputsState(true);
                },
                error: function (resp) {
                    $("#message-error").css("display", "block");
                    var msg = "";
                    var errores = resp.responseJSON.errors;
                    if(errores['categoria_id'] != undefined)msg += errores['categoria_id'] + "</br>";
                    if(errores['severidad'] != undefined)msg += errores['severidad'] + "</br>";
                    if(errores['titulo'] != undefined)msg += errores['titulo'] + "</br>";
                    if(errores['descripcion'] != undefined)msg += errores['descripcion'] + "</br>";
                    
                    $("#lbl_message-error").html(msg);   
               }
            });
        }
    },
    
   changeInputsState: function(disabled){
       $("#categoria_id").attr("disabled",disabled);
       $("#severidad").attr("disabled",disabled);
       $("#titulo_incidente").attr("disabled",disabled);
       $("#descripcion").attr("disabled",disabled);
       $("#btnGrabar").css("display","none");
       $("#btnLimpiarForm").css("display","block");
   },
   
   nuevo: function(){
       incidente.changeInputsState(false);
       $("#btnGrabar").css("display","block");
       $("#btnLimpiarForm").css("display","none");
       $("#form")[0].reset();
       $("#message-ok").css("display", "none");
       $("#message-error").css("display", "none");
       $("#restChar").html("255");
   },
   
   contadorCaracteres: function(input){
       if(255 - input.value.length < 0)
       {
           input.value = input.value.substr(0,255);
       }
      $("#restChar").html(255 - input.value.length);
   }
    
};