//Requiere instalar node.js para instalar el paquete websocket
//npm install ws
//Se requiere que exista el archivo server.js (node.js) el cual levanta un servidor para el chat 
//Luego ejecutar node server.js

$(function () {
    $("#btnEnviarMensaje").click(function () {
        chat.enviar();
    });
});

const wsUri = "ws://localhost:5001";
let socket = new WebSocket(wsUri);

var chat = {
    iniciarChat: function () {        
        socket.onopen = event => {
            console.log(event)
            socket.send(JSON.stringify({
                type: "name",
                data: name
            }));
            console.log("Socket connected successfully...");
        };

        socket.onmessage = event => {
            
            const data = JSON.parse(event.data);
            console.log(data);
            $("#chatList").append("<li><div>" + data.data.message + "</div><div class='user-name-message'>"+ data.data.from + "</di></li>");
            //messages.innerHTML += '<span class="text-success">${data.name}:</\span> ${data.data}<br /\>';
        }
    },

    enviar: async function () {
        var msg = $("#txtMensaje").val();
        $("#incident_id").val($("#proyectoSeleccionado").val());
        var datos = await chat.enviarMensaje();
        if (datos.name !== 'error')
        {
            socketSendMessage(datos.data, datos.name);
            $("#chatList").append("<li><div>" + datos.data + "</div><div class='user-name-message'>"+ datos.name + "</di></li>");
            $("#txtMensaje").val("");
        }

        function socketSendMessage(msg, remitente) {
            socket.send(JSON.stringify({
                type: "message",
                data: {message:msg, from:remitente}
            }));
        }
    },

    enviarMensaje: function () {
        const promise = new Promise(function (resolve, reject) {
            try {
                $.post("/chat", $("#messageChat").serialize(), function(data) {
                    resolve(data);
                });
            } catch (e) {
                reject(e);
            }
        });
        return promise;
    }
};

chat.iniciarChat();