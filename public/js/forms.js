$(function(){
   
    $("#btnGrabar").click(function(){
        if(confirm("¿Desea grabar el registro?")){
            $("#form").submit();
        }
       
    });
   
    $("#btnEliminar").click(function(){
       if(confirm("¿Desea eliminar el registro?")){
            $("#formDelete").submit();
        }
    });
   
    $("#btnCancelar").click(function(){
       window.history.back();
    });
});