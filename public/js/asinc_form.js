$(function(){
    /*
    $(document).ready(function(){
        $.get("/proyectos", function(res){
            $(res).each(function(key, elem){
               $("#tbody").append("<tr><td>"+elem.nombre+"</td><td><button type='button' value='"+elem.id+"' onclick='editar(this)' class='btn btn-primary'>Editar</button></td></tr>")
            });
        });
        
        $.ajax({
                url: "/proyectos",                
                type: 'get',
                data: $("#form").serialize(),
                success:function(response){
                    for(var i=0;i<response.length;i++){                        
                        $("#tbody").append("<tr><td>"+response[i].nombre+"</td></td></td></tr>");
                    }
                    
                    //document.location = response;
                }
            });
            
    });
   */
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