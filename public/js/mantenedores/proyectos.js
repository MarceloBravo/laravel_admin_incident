$(function () {

    $(document).ready(function () {
        proyecto.configForm();
        proyecto.listar();
    });

    $("#btnNuevo").click(function () {
        proyecto.nuevo();
    });


    $("#btnGrabar").click(function () {
        proyecto.grabar();
    });


    $("#btnEliminar").click(function () {
        proyecto.eliminar();
    });



    $("#btnCancelar").click(function () {
        proyecto.actualizarListado();
    });


    $("#txtFiltro").change(function () {
        proyecto.filtrar();
    });

});

var proyecto = {
    configForm: function () {
        $("#thead").html("<tr><th>Nombre</th><th>Descripcion</th><th>Fecha de inicio</th><th class='colAccion'>Acción</th></tr>")
        $("#titulo").html("Proyectos");
        $("#formDelete").attr("action", "/proyectos/filtro");
    },

    listar: function () {
        $("#tbody").empty();
        $.get("listar_proyectos", function (data) {
            $(data).each(function (key, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td>" + elem.descripcion + "</td><td>" + elem.fecha_inicio + "</td><td><button type='button' value='" + elem.id + "' onclick='editar(this)' class='btn btn-primary btnEditar'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    },

    actualizarListado: function (msg) {
        proyecto.listar();
        $("#divForm").css("display", "none");
        $("#divGrid").css("display", "block");
        if (msg != undefined) {
            $("#" + msg[0]).css("display", "block");
            $("#lbl_" + msg[0]).html(msg[1]);
        }
    },

    nuevo: function () {
        $("#divForm").css("display", "block");
        $("#divGrid").css("display", "none");
        $("#form")[0].reset();
        proyecto.ocultarMensajes();
    },

    grabar: function () {
        if (confirm("¿Desea grabar el proyecto?")) {
            if ($("#id").val() != "") {
                $.ajax({
                    url: "/proyectos/" + $("#id").val(),
                    type: "PUT",
                    data: $("#form").serialize(),
                    success: function (data) {
                        proyecto.actualizarListado(data);
                    },
                    errors: function (resp) {
                        $("#message-error").css("display", "block");
                        var msg = "";
                        $("#form input").each(function (i, e) {
                            if (resp.responseJSON.errors[e.name] != undefined)
                                msg += resp.responseJSON.errors[e.name] + "</br>";
                        })
                        $("#lbl_message-error").html(msg);
                    }

                });

            } else {
                $.post("/proyectos", $("#form").serialize(), function (data) {
                    proyecto.actualizarListado(data);
                });

            }
        }
        ;
    },

    editar: function (obj) {
        proyecto.nuevo();
        proyecto.ocultarMensajes();
        $("#divForm").css("display", "block");
        $("#divGrid").css("display", "none");
        $.get("/proyectos/" + obj.value, function (data) {
            $("#id").val(data.id);
            $("#nombre").val(data.nombre);
            $("#descripcion").val(data.descripcion);
            var date = new Date(data.fecha_inicio)
            //var fecha = (date.getDay() < 10 ? "0" : "")+date.getDay() + "-" + (date.getMonth() < 10 ? "0" : "")+date.getMonth()+"-"+date.getFullYear();
            var fecha = date.getFullYear() + "-" + (date.getMonth() < 10 ? "0" : "") + date.getMonth() + "-" + (date.getDay() < 10 ? "0" : "")+date.getDay();
            $("#fecha_inicio").val(fecha);
            $("#btnEliminar").attr("disabled", (data.nombre == ""));
        });
    },

    eliminar: function () {
        if (confirm("¿Desea eliminar el registro?"))
        {
            $.ajax({
                url: "/proyectos/" + $("#id").val(),
                type: "DELETE",
                data: $("#form").serialize(),
                success: function (data) {
                    proyecto.actualizarListado(data);
                }
            });
        }
    },

    filtrar: function () {
        $.post("/proyectos/filtro", $("#formFiltro").serialize(), function (data) {
            $("#tbody").empty();
            $(data).each(function (key, elem) {
                $("#tbody").append("<tr><td>" + elem.nombre + "</td><td>" + elem.descripcion + "</td><td>" + elem.fecha_inicio + "</td><td><button type='button' value='" + elem.id + "' onclick='editar(this)' class='btn btn-primary btnEditar'>Editar</button></td></tr>");
            });
        });
        configurar.botones();
    },
    
    ocultarMensajes: function(){
        $("#message-ok").css("display", "none");
        $("#message-error").css("display", "none");
    }
};



function editar(obj) {
    proyecto.editar(obj);
}