$(function(){
   
    $(document).ready(function(){
        grid.configGrid();
    });
});

var form = {
    
};

var grid = {
    configGrid: function(){
        $("#titulo").html("Proyectos asignados");
        $("#thead").append("<tr><th>Proyecto</th><th>Nivel</th><th class='colAccion'>Acción</th></tr>");
    }
};