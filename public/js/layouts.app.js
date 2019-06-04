$(function(){
    
    $("#proyectoSeleccionado").change(function(){
        $.get("/cambio_proyecto/"+$(this).val());
    });
    
    $(".close").click(function(){
       $(".alert").css("display","none");
    });
    
});