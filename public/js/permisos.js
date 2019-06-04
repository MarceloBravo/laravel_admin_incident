$(function(){
    var splitUrl = document.URL.split("/");
   $(document).ready(function(){       
      $.get("/consultar_permisos/"+splitUrl[splitUrl.length-1],function(data){
          $("#btnNuevo").css("display", data.crear ? "block" : "none");
          $("#btnGrabar").css("display", (data.crear || data.modificar) ? "block" : "none" );
          $(".btnEditar").css("display", (data.modificar || data.eliminar) ? "block" : "none" );
          $("#btnEliminar").css("display", data.eliminar ? "block" : "none");
      });
   });
    
    
});