$(function(){
    
    $("#btnGrabar").click(function(){
        if(confirm("¿Desea grabar el registro?")){
            $.ajax({
                url: "/proyectos",                
                type: 'post',
                data: $("#form").serialize(),
                success:function(response){
                    document.location = response;
                }
            });
            
            
        }
       
    });
   
    $("#btnEliminar").click(function(){
       if(confirm("¿Desea eliminar el registro?")){
            $.ajax({
                url: "/proyectos/"+$("#id").val(),                
                type: 'post',
                method: 'DELETE',
                data: $("#form").serialize(),
                success:function(response){
                    document.location = response;
                }
            });
        }
    });
   
   $("#txtFiltro").change(function(){
      $.ajax({
            url: "/proyectos/filtro",                
            type: 'post',
            data: $("#formFiltro").serialize(),
            success:function(response){
                alert(response);                
            }
        }); 
   });
   
    $("#btnCancelar").click(function(){
       window.history.back();
    });
});