
<div class='col-md-3'>
    <div class="card">
        <div class="card-header">Chat</div>

        <div id="chat" class="card-body divMensajesChat">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="row divMensajesChat">
                <ul id="chatList">
                    <li>

                    </li>
                </ul>
            </div>
            <div class="row">
                <form id="messageChat" name="messageChat">                            
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                    <input type="hidden" id="incident_id" name="incident_id" value=""/>
                    <div class="form-group col-md-11">
                        <input type="text" id="txtMensaje" name="mensaje" class="form-control" placeholder="Mensaje"/>
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" id="btnEnviarMensaje" class="btn btn-default" value="Enviar">Enviar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
