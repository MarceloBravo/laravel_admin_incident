$(function () {

    $(document).ready(function () {
        grid.configGrid();
    });

    $("#user_id").change(function () {
        form.buscarUsuario(this.value);
    });

    $("#btnAsignarProyecto").click(function () {
        form.asignarProyecto();
    });

    $("#txtFiltro").change(function () {
        grid.filtrar();
    });

    $(".close").click(function () {
        $(this).parent().css("display", "none");
        return false;
    })
});

var form = {

};

var grid = {
    configGrid: function () {
        $("#titulo").html("Proyectos asignados");
        $("#thead").append("<tr><th>Proyecto</th><th>Nivel</th><th class='colAccion'>Acción</th></tr>");
        grid.cargarProyectos();
        configurar.botones();
    },

    cargarProyectos: function () {
        $.get("/listar_asignaciones/" + $("#user_id").val(), function (data) {
            $("#tbody").empty();
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.proyecto + "</td><td>" + elem.nivel + "</td><td><button type='button' class='btn btn-default' value='" + elem.id + "' onclick='eliminar(this)'>Eliminar</button></td></tr>");
            });
        });
    },

    eliminar: function (id) {

        if (confirm("¿Desea eliminar el egistro?"))
        {
            $("#message-ok, #message-error ").css("display", "none");
            $.ajax({
                url: "/asignar_proyecto/" + id,
                type: "DELETE",
                headers: {"X-CSRF-TOKEN": $("#_token").val()},
                success: function (data) {
                    grid.cargarProyectos();
                    $("#message-ok").css("display", "block");
                    $("#lbl_message-ok").html(data[1]);
                },
                errors: function (resp) {
                    $("#message-error").css("display", "block");
                    var msg = "";
                    $("#form input").each(function (i, e) {
                        if (resp.responseJSON.errors[e.name] != undefined)
                            msg += resp.responseJSON.errors[e.name] + "</br>";
                    });
                    $("#lbl_message-error").html(msg);
                }
            });
        }
    },

    filtrar: function ()
    {
        $.post("/listar_asignaciones/filtro", {_token: $("#_token").val(), txtFiltro: $("#txtFiltro").val(), userId: $("#user_id").val()}, function (data) {
            $("#tbody").empty();
            $(data).each(function (index, elem) {
                $("#tbody").append("<tr><td>" + elem.proyecto + "</td><td>" + elem.nivel + "</td><td><button type='button' class='btn btn-default' value='" + elem.id + "' onclick='eliminar(this)'>Eliminar</button></td></tr>");
            });
        });
        configurar.botones();
    }
};

var form = {

    buscarUsuario: function (id) {
        $.get("/asignar_proyecto/" + id, function (data) {
            $("#rol").val(data.rol.nombre);
            $("#email").val(data.usuario.email);
            grid.cargarProyectos();
        });
    },

    asignarProyecto: function () {
        $("#message-ok, #message-error ").css("display", "none");
        $.post("/asignar_proyecto", $("#form").serialize()).done(function (data) {
            grid.cargarProyectos();            
            $("#message_ok").css("display", "block");
            $("#lbl_message_ok").html(data[1]);
            $("#proyecto_id").val("");
            $("#nivel_id").val("");
        }).fail(function (xhr, status, error) {
            $("#message-error").css("display", "block");
            var msg = "";
            $("#form select").each(function (i, e) {
                if (xhr.responseJSON.errors[e.name] != undefined)
                    msg += xhr.responseJSON.errors[e.name] + "</br>";
            });
            $("#lbl_message-error").html(msg);
                    
            //console.log(xhr, status, error);
            //$("#message-error").css("display", "block");
            //$("#lbl_message-error").html(error);
        });

    }
};

function eliminar(obj)
{
    grid.eliminar(obj.value);
}