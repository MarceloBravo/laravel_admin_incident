$(function(){
    
    $("#btnCerrarDetalles").click(function(){
        incidencias.ocultarDetalle();
    });
    
    $("#btnGestionar").click(function(){
       document.location = "/gestion_incidencias/"+$("#lblCodigo").html(); 
    });
    
});

function detalleIncidencia(id, tab){ incidencias.mostrarDetalle(id, tab); }

var incidencias = {
    mostrarDetalle: function(id, tab){
        $.get("/incidencias/"+id,function(data){
        $("#lblCodigo").html(data.incidente.id); 
        $("#lblProyecto").html(data.proyecto.nombre); 
        $("#lblCategoria").html(data.categoria.nombre); 
        $("#lblFechaIngreso").html(data.proyecto.created_at); 
        $("#lblAsignadoA").html(data.soporte); 
        $("#lblSeveridad").html(data.severidad); 
        $("#lblEstado").html(data.estado); 
        $("#lblTitulo").html(data.incidente.titulo); 
        $("#lblDescripcion").html(data.incidente.descripcion); 
        $("#lblAdjuntos").html("No existen archivos adjuntos."); 
        $("#detalle-incidencias").css("display","block");
        $("#listado-incidencias").css("display","none");
    });
    },
    
    ocultarDetalle: function(){
        $("#detalle-incidencias").css("display","none");
        $("#listado-incidencias").css("display","block");
    }
};

