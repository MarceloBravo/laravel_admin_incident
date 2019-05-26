
var botones = {
    nuevo: function(){
        $("#id").val("");
        $("#divGrid").css("display","none");
        $("#divForm").css("display","block");
        $("#form")[0].reset();
        $("#_method").val("POST");
        $("#btnEliminar").attr("disabled",true);
        $("div[id*='message-'").css("display","none");
    },
    
    
    grabar: function(url){
        
        if(confirm("¿Desea grabar el registro?")){
            
            $.ajax({
               url: url + ($("#_method").val() == "PUT" ? "/"+$("#id").val() : ""),           
               type: $("#_method").val(),
               data: $("#form").serialize(),
               success:function(data){
                   botones.cancelar();
                   $("#message-ok").css("display","block");
                   $("#lbl_message-ok").html(data[1]);
               },
               error: function(resp){
                   $("#message-error").css("display","block");
                   var msg = "";
                   $("#form input").each(function(i, e){
                        if(resp.responseJSON.errors[e.name] != undefined)
                            msg += resp.responseJSON.errors[e.name]+"</br>";
                   })
                   $("#lbl_message-error").html(msg);
               }
            });
            return true;
        }
        return false;
        
        
    },
    
    
    eliminar: function(url){
        if(confirm("¿Desea eliminar el registro?")){
            
            $.ajax({
               url: url,
               headers: {"X-CSRF-TOKEN":$("#_token").val()},
               type: "DELETE",
               success: function(data){
                   botones.cancelar();
                   $("#message-ok").css("display","block");
                   $("#lbl_message-ok").html(data[1]);
               },
               error: function(resp){
                   $("#message-error").css("display","block");
                   var msg = "";
                   $("#form input").each(function(i, e){
                        if(resp.responseJSON.errors[e.name] != undefined)
                            msg += resp.responseJSON.errors[e.name]+"</br>";
                   })
                   $("#lbl_message-error").html(msg);
               }
            });
            return true;
        }
        return false;
    },
    
    
    cancelar: function(){
        $("#divGrid").css("display","block");
        $("#divForm").css("display","none");
        $("#btnEliminar").attr("disabled",false);
        $("div[id*='message-'").css("display","none");
    }
};

