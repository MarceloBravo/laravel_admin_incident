$(function(){
   
    $(document).ready(function(){
        grid.configGrid();
        grid.listar();
        form.configForm();
    });
    
    $("#btnNuevo").click(function(){
        $("#_method").val("POST")
        botones.nuevo();
    });
    
    $("#btnGrabar").click(function(){        
        if(botones.grabar("/categorias")){  
            if(botones.errors == null){
                grid.listar();
            }else{
                $("#message-error").html(botones.errors.nombre);
                $("#message-error").html(botones.errors.descripcion);
            }
        }
    });
    
    $("#btnEliminar").click(function(){
        if(botones.eliminar("/categorias/"+$("#id").val())){
            grid.listar();
        }
    });
    
    $("#btnCancelar").click(function(){
        botones.cancelar();
        grid.listar();
    });
    
    $("#txtFiltro").change(function(){
        grid.filtrar();
    });

    
});



var grid = {
    configGrid: function(){
      $("#thead").html("<tr><th>Nombre</th><th>Descripción</th><th class='colAccion'>Acción</th></tr>"); 
      $("#titulo").html("Categorías");
    },
    
    listar: function(){
        $.get("/listar_categorias",function(data){
            $("#tbody").empty();
            $(data).each(function(index, elem){
                $("#tbody").append("<tr><td>"+elem.nombre+"</td><td>"+elem.descripcion+"</td><td><button class='btn btn-primary btnEditar' value='"+elem.id+"' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    },
    
    filtrar: function(){
        $("#tbody").empty();
        $.post("/categorias/filtro",$("#formFiltro").serialize(),function(data){
            $(data).each(function(index, elem){
              $("#tbody").append("<tr><td>"+elem.nombre+"</td><td>"+elem.descripcion+"</td><td><button class='btn btn-primary btnEditar' value='"+elem.id+"' onclick='editar(this)'>Editar</button></td></tr>");  
            });   
        });
        configurar.botones();
    }
    
};



var form = {
    configForm: function(){
        $("#formDelete").attr("action","/categorias/filtro");
    }
    /*,
    
    cargarProyectos: function(){
        $.get("/get_options_proyects", function(data){
            $(data).each(function(index, elem){
                $("#proyecto_id").append("<option value='"+elem.id+"'>"+elem.nombre+"</option>");
            });
        })
    }
    */
};


function editar(obj){
    $.get("/categorias/"+obj.value, function(data){
        botones.nuevo();
        $("#_method").val("PUT");
        $("#id").val(data.id);
        $("#nombre").val(data.nombre);
        $("#descripcion").val(data.descripcion);
        $("#btnEliminar").attr("disabled",false);
    });
}


