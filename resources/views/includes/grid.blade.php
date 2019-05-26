<div id="divGrid" class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 id='titulo'></h3>
            <div class="row">
                <div class="col-md-6">

                    <button id="btnNuevo" class="btn btn-default">Nuevo</button>
                </div>
                <div class="col-md-6">
                    <form id="formFiltro" action="" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input id="txtFiltro" name="txtFiltro" type="text" class="form-control" placeholder="Ingrese el texto a buscar" value=""/>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead id='thead'>
                    
                </thead>
                <tbody id="tbody">
                    
                    
                </tbody>
            </table>
            
        </div>
    </div>
</div>
