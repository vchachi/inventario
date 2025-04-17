

<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Subir Plantilla</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                  <div class="card-body">
            {!! Form::open(array('method'=>'POST', 'id' => 'formId','files' => true)) !!}
                    <label for="file">Archivo:</label>
                    <input id="file" type="file" name="file" accept=".csv"/>
       
                    {!! Form::close() !!}

                  </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="carga" onclick="datoEnviar()">Cargar</button>
            </div>
    </div>
  </div>
</div>