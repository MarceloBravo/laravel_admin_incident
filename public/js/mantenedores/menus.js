$(function () {

    $(document).ready(function () {
        grid.configGrid();
        grid.listar();
        form.cargarMenusPadres();
    });

    $("#btnNuevo").click(function () {
        form.cargarMenusPadres();
        botones.nuevo();
    });

    $("#btnGrabar").click(function () {
        botones.grabar("/menus");
        grid.listar();
    });

    $("#btnEliminar").click(function () {
        botones.eliminar("/menus/" + $("#id").val());
        grid.listar();
    });

    $("#btnCancelar").click(function () {
        grid.listar();
        botones.cancelar();
    });
    
    $("#txtFiltro").change(function(){
        grid.filtrar($(this).val());
    });
});


var grid = {
    configGrid: function () {
        $("#titulo").html("Menús");
        $("#thead").append("<tr><th>Nombre</th><th>Posición</th><th>Menú padre</th><th>Ruta</th><th class='colAccion'>Acción</th></tr>");
    },

    listar: function () {
        $.get("/listar_menus", function (data) {
            $("#tbody").empty();
            $(data).each(function (id, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td>" + elem.posicion + "</td><td>" + (elem.menu_padre == null ? "" : elem.menu_padre) + "</td><td>" + elem.ruta + "</td><td class='colAccion'><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    },
    
    filtrar: function(texto){
        $.post("/menus/filtro",$("#formFiltro").serialize(), function(data){
            $("#tbody").empty();
           $(data).each(function(id, elem){
               $("#tbody").append("<tr><td>" + elem.nombre + "</td><td>" + elem.posicion + "</td><td>" + (elem.menu_padre == null ? "" : elem.menu_padre) + "</td><td>" + elem.ruta + "</td><td class='colAccion'><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Editar</button></td></tr>");
           }) ;
        });
        configurar.botones();
    }
}

var form = {
    cargarMenusPadres: function () {
        $.get("/listar_menus", function (data) {
            $("#menu_padre_id").empty();
            $("#menu_padre_id").append("<option value=''> -- Sin menú padre -- </option>");
            $(data).each(function (id, elem) {
                $("#menu_padre_id").append("<option value='" + elem.id + "'>" + elem.nombre + "</option>");
            });
        });
    }
};

function editar(obj) {
    $.get("/menus/" + obj.value, function (data) {
        botones.nuevo();
        $("#id").val(data.id);
        $("#nombre").val(data.nombre);
        $("#ruta").val(data.ruta);
        $("#menu_padre_id").val(data.menu_padre_id);
        $("#posicion").val(data.posicion);
        $("#ocultar").val(data.ocultar);
        $("#btnEliminar").attr("disabled", false);
        $("#_method").val("PUT");
    });
}
