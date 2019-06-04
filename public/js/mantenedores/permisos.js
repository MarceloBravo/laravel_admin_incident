$(function () {

    $(document).ready(function () {
        grid.configurar();
        grid.listar();
    });

    $("#btnGrabar").click(function () {
        botones.grabar("/pantallas");
        grid.listar();
    });

    $("#btnCancelar").click(function () {
        botones.cancelar();
        grid.listar();
    });

    $("#txtFiltro").change(function () {
        grid.filtrar();
    });
    
    $("#checkAll").change(function(){
        botones.marcarDescarcarTodos();
    });
    
});

var grid = {
    configurar: function () {
        $("#titulo").html("Permisos por rol");
        $("#thead").html("<tr><th>Rol</th><th class='colAccion'>Acción</th></tr>");
    },

    listar: function () {
        $("#tbody").empty();
        $.get("/listar_permisos", function (data) {
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Configurar</button></td></tr>");
            });
        });
        configurar.botones();
    },

    filtrar: function () {
        $("#tbody").empty();
        $.post("/permisos/filtro", $("#formFiltro").serialize(), function (data) {
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td><button class='btn btn-primary btnEditar' value='" + elem.id + "' onclick='editar(this)'>Configurar</button></td></tr>");
            });
        });
        configurar.botones();
    }
};


function editar(obj) {
    botones.nuevo();
    $("#rol_id").val(obj.value);
    $.get("/permisos/" + obj.value, function (data) {
        
        $(data).each(function (index, elem) {
            $("#bRolName").html(elem.rol);
            
            item = "<div class='col-md-12'>";
            item += "<label id='" + (elem.id == null ? 0 : elem.id) + "' for='" + elem.pantalla_id + "' class='col-md-4 control-label pantalla' data-pantalla='" + elem.pantalla_id + "'>" + elem.pantalla + "</label>";            
            item += "<input type='checkbox' id='" + elem.pantalla_id + "_ver' name='" + elem.pantalla + "_ver' class='col-md-2 checkbox' " + (elem.ver ? "checked" : "") + " '/>";            
            item += (elem.boton_nuevo) ? "<input type='checkbox' id='" + elem.pantalla_id + "_crear' name='" + elem.pantalla + "_crear' class='col-md-2 checkbox' " + (elem.crear ? "checked" : "") + "/>" : "<label class='col-md-2'></label>";            
            item += (elem.boton_grabar) ? "<input type='checkbox' id='" + elem.pantalla_id + "_modificar' name='" + elem.pantalla + "_modificar' class='col-md-2 checkbox' " + (elem.modificar ? "checked" : "") + "/>" : "<label class='col-md-2'></label>";            
            item += (elem.boton_eliminar) ? "<input type='checkbox' id='" + elem.pantalla_id + "_eliminar' name='" + elem.pantalla + "_eliminar' class='col-md-2 checkbox' " + (elem.eliminar ? "checked" : "") + "/>" : "<label class='col-md-2'></label>";            
            item += "</div>";

            $("#divCheckPermisos").append(item);
                        
        });
        $("#_method").val("PUT");
        $("#id").val(data.id);
    });
}
;


var botones = {
    nuevo: function () {
        $("#divForm").css("display", "block");
        $("#divGrid").css("display", "none");
        $("#divCheckPermisos").empty();
        $("#message-ok").css("display", "none");
        $("#message-error").css("display", "none");
        $("#bRolName").html("");
    },

    grabar: function () {
        var datos = Array();
        $(".pantalla").each(function (index, elem) {
            pantallaId = elem.dataset.pantalla;
            pantalla = {
                id: elem.id,
                rol_id: $("#rol_id").val(),
                pantalla_id: pantallaId,
                ver: $("#" + pantallaId + "_ver").is(":checked") ? 1 : 0,
                crear: $("#" + pantallaId + "_crear").is(":checked") ? 1 : 0,
                modificar: $("#" + pantallaId + "_modificar").is(":checked") ? 1 : 0,
                eliminar: $("#" + pantallaId + "_eliminar").is(":checked") ? 1 : 0
            };
            datos.push(pantalla);

        });

        $.ajax({
            url: "/permisos",
            type: "POST",
            headers: {"X-CSRF-TOKEN": $("#_token").val()},
            data: {permisos: datos},
            success: function (data) {
                botones.cancelar();
                $("#message-ok").css("display", "block");
                $("#lbl_message-ok").html(data[1]);
            },
            error: function (resp) {
                $("#message-error").css("display", "block");
                var msg = "";
                $("#form input").each(function (i, e) {
                    if (resp.responseJSON.errors[e.name] != undefined)
                        msg += resp.responseJSON.errors[e.name] + "</br>";
                })
                $("#lbl_message-error").html(msg);
            }
        });

    },

    cancelar: function () {
        $("#divForm").css("display", "none");
        $("#divGrid").css("display", "block");
    },
    
    marcarDescarcarTodos: function(){
        $(".checkbox").attr("checked", $("#checkAll").is(":checked"));
    }
};
