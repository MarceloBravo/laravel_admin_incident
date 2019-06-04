$(function(){
    $(document).ready(function(){
       botones.configurar(); 
    });
   
    $("#btnCerrar").click(function(){
        document.location = "/";
    });
    
    $("#btnAtender").click(function(){
        botones.atender();
    });
    
    $("#btnActualizar").click(function(){
        botones.actualizar();
    });
    
    $("#btnEditar").click(function(){
        botones.editar();
    });
    
    $("#btnVolver").click(function(){
        botones.volver();
    });
    
    $("#btnDerivar").click(function(){
       botones.derivar();
    });
    
    $("#btnFinalizarIncidencia").click(function(){
       botones.finalizar();
    });
    
    $("#btnReabrir").click(function(){
       botones.reabrir();
    });
});


var botones = {
    configurar: function(){
        $.post("/gestion_estado_botones/"+$("#lblCodigo").html(),{_token:$("#_token").val()}, function(data){
            botones.activaDesactiva(data);
        });
    },
    
    atender: function(){
        $("#message-ok, #message-error").css("display","none");
        $.post("/gestion_incidencias",{_token:$("#_token").val(),id:$("#lblCodigo").html()},function(data){            
            datos.mostrar(data);
            botones.activaDesactiva(data[2]);
        });
    },
    
    editar: function(){
        $("#message-ok, #message-error").css("display","none");
        $("#detalle-incidencias").css("display","none");
        $("#editar-incidencias").css("display","block");
    },
    
    actualizar: function(){
        $("#message-ok, #message-error").css("display","none");
        $.post("/gestion_incidencias/"+$("#lblCodigo").html(),$("#updateForm").serialize(),function(data){
                datos.mostrar(data);
                botones.activaDesactiva(data[2]);
                $("#detalle-incidencias").css("display","block");
                $("#editar-incidencias").css("display","none");
            });
    },
    
    volver: function(){
        $("#message-ok, #message-error").css("display","none");
        $("#detalle-incidencias").css("display","block");
        $("#editar-incidencias").css("display","none");
    },
    
    derivar: async function(){
        
        $("#message-ok, #message-error").css("display","none");
        var data = await derivar();
        datos.mostrar(data);
        botones.activaDesactiva(accion.derivar);
        $("#btnDerivar").css("display","none");
        
        
        function derivar()
        {
            const promise = new Promise(function(resolve, reject){
                try{
                    $.post("/gestion_incidencias/"+$("#lblCodigo").html()+"/derivar",{"_token":$("#_token").val()}, function(data){
                        resolve(data);
                    });
                }catch( e){
                    reject(e);
                }
            });
            
            return promise;
        }
        
    },
    
    finalizar: function(){
        $("#message-ok, #message-error").css("display","none");
        $.post("/gestion_incidencias/"+$("#lblCodigo").html()+"/finalizar",{_token:$("#_token").val()}, function(data){
            datos.mostrar(data);
            botones.activaDesactiva(data[2]);
        });
    },
    
    reabrir: function(){
        $("#message-ok, #message-error").css("display","none");
        $.post("/gestion_incidencias/"+$("#lblCodigo").html()+"/reabrir",{_token:$("#_token").val()}, function(data){
            datos.mostrar(data);
            botones.activaDesactiva(data[2]);
        });
    },
    
    activaDesactiva: function(estadoBotones){
        $("#btnAtender").css("display", estadoBotones.atender);
        $("#btnActualizar").css("display", estadoBotones.actualizar);
        $("#btnDerivar").css("display", estadoBotones.derivar);
        $("#btnFinalizarIncidencia").css("display", estadoBotones.finalizar);        
        $("#btnReabrir").css("display", estadoBotones.reabrir);
    }
};


var datos = {
    mostrar: function(data)
    {
        $("#"+data[1][0]).css("display","block");
        $("#lbl_"+data[1][0]).html(data[1][1]);
        var incidente = data[0];
        $("#lblTitulo").html(incidente.titulo != undefined ? incidente.titulo : ""); 
        $("#lblDescripcion").html(incidente.descripcion != undefined ? incidente.descripcion : "");
        $("#lblCategoria").html(incidente.categoria != undefined ? incidente.categoria : "");
        $("#lblSeveridad").html(incidente.severidad != undefined ? incidente.severidad : "");
        $("#lblEstado").html(incidente.estado != undefined ? incidente.estado : "");
        $("#lblAsignadoA").html(incidente.soporte != undefined ? incidente.soporte : "Sin asignar");
        $("#categoria_id").val(incidente.categoria_id);
        $("#severidad").val(incidente.codigo_severidad);
        $("#titulo").val(incidente.titulo);
        $("#descripcion").val(incidente.descripcion);
    }
};