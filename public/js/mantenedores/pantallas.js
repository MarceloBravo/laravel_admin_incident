$(function () {

    $(document).ready(function () {
        grid.configurar();
        form.cargarOptMenus();
        grid.listar();
    });

    $("#btnNuevo").click(function () {
        botones.nuevo();
    });

    $("#btnGrabar").click(function () {
        botones.grabar("/pantallas");
        grid.listar();
        form.cargarOptMenus();
    });

    $("#btnEliminar").click(function () {
        botones.eliminar("/pantallas/" + $("#id").val());
        grid.listar();
    });

    $("#btnCancelar").click(function () {
        botones.cancelar();
        grid.listar();
    });

    $("#txtFiltro").change(function () {
        grid.filtrar();
    });
});

var grid = {
    configurar: function () {
        $("#titulo").html("Pantallas");
        $("#thead").html("<tr><th>Nombre</th><th>Menú</th><th class='colAccion'>Acción</th></tr>");
    },

    listar: function () {
        $("#tbody").empty();
        $.get("/listar_pantallas", function (data) {
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td>" + elem.menu + "</td><td><button class='btn btn-primary' value='" + elem.id + "' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
    },

    filtrar: function () {
        $("#tbody").empty();
        $.post("pantallas/filtro", $("#formFiltro").serialize(), function (data) {
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td><button class='btn btn-primary' onclick='editar(this)'>Editar</button></td></tr>");
            });
        });
    }
};

var form = {
    cargarOptMenus: function () {
        $.get("/menus_disponibles", function (data) {

            $(data).each(function (index, elem) {
                $("#menu_id").append("<option value='" + elem.id + "'>" + elem.nombre + "</option>");
            });
        });
    },
    buscarMenu: function (id) {
        $.get("/menus/" + id, function (data) {
            $(data).each(function (index, elem) {
                $("#menu_id").append("<option value='" + elem.id + "'>" + elem.nombre + "</option>");
            });
        });
    },

    editar: async function (obj) {
        var pantalla = await buscarPantalla(obj.value);
        botones.nuevo();
        $("#menu_id").html("");
        await form.buscarMenu(pantalla.menu_id);
        await form.cargarOptMenus();
        $("#_method").val("PUT");
        $("#id").val(pantalla.id);
        $("#nombre").val(pantalla.nombre);
        $("#menu_id").val(pantalla.menu_id);
        $("#boton_nuevo").val(pantalla.boton_nuevo);
        $("#boton_grabar").val(pantalla.boton_grabar);
        $("#boton_eliminar").val(pantalla.boton_eliminar);
        $("#btnEliminar").attr("disabled", false);
        


        function buscarPantalla(id) {
            const promesa = new Promise(function(resolve, reject){
                
                    try{
                        $.get("/pantallas/" + id, function (data) {
                            resolve(data);
                        });
                    }catch(e){
                        reject(e)
                    }
                });
            
            return promesa;
        }

    }
};


async function editar(obj) {
    form.editar(obj);
}
;