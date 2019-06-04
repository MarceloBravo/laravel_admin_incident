$(function () {

    $(document).ready(function () {
        grid.configurar();
        grid.listar();
    });


    $("#btnNuevo").click(function () {
        botones.nuevo();
    });

    $("#btnGrabar").click(function () {
        botones.grabar("/niveles");
        grid.listar();
    });
    
    $("#btnEliminar").click(function () {
        botones.eliminar("/niveles/"+$("#id").val());
        grid.listar();
    });

    $("#btnCancelar").click(function () {
        botones.cancelar();
    });
    
    $("#txtFiltro").change(function(){
        grid.filtrar();
    });

});

var grid = {
    configurar: function () {
        $("#titulo").html("Niveles");
        $("#thead").html("<tr><th>Nombre</th><th class='colAccion'>Acción</th></tr>");
    },

    listar: function () {
        $("#tbody").empty();
        $.get("/listar_niveles", function (data) {
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td class='colAccion'><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    },

    filtrar: function () {
        $("#tbody").empty();
        $.post("/niveles/filtro", $("#formFiltro").serialize(), function(data){
            $(data).each(function(index, elem){
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    }

};

var form = {

    editar: function (obj) {
        botones.nuevo();
        $.get("/niveles/" + obj.value, function (data) {
            $("#id").val(data.id);
            $("#nombre").val(data.nombre);
            $("#btnEliminar").attr("disabled", false);
            $("#_method").val("PUT");
        });
    }
    
};

function editar(obj) {
    form.editar(obj);
}