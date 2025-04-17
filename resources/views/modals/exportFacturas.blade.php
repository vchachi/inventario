

<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Facturas</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                       {!! Form::open(array('route' => 'Documents.pdfGlobal','method'=>'POST','files' => true,'target'=>'_blank')) !!}
                  
                        <div class="form-group">
                                            <label for="url">Fecha de Inicio:</label>
                                            <input class="form-control" id="datestart"  required type="date" name="datestart" />
                        </div>

                        <div class="form-group">
                                            <label for="url">Fecha de Fin:</label>
                                            <input class="form-control" id="dateend" required type="date" name="dateend" />
                        </div>       
               
                        <div class="form-group">
                                            <label for="url">Tipo de Facturas:</label>
                                            <select class="form-select" id="fact" name="fact" required>
                                                <option value="1">Ticket Factura</option>
                                                <option value="2">Ticket Factura Rectificada</option>
                                                <option value="3">Ticket Factura Simplificada</option>
                                                <option value="4">Factura A4</option>
                                                <option value="5">Factura A4 Rectificada</option>
                                                <option value="6">Factura A4 Simplificada</option>
                                                </select>
                        </div>  
                        <button type="submit" class="btn btn-primary">Descargar en PDF</button>
                    {!! Form::close() !!}


                    </div>
                 </div>
                    
                 <div class="card">
                  <div class="card-body">
                       {!! Form::open(array('route' => 'factura.excel','method'=>'POST','files' => true,'target'=>'_blank')) !!}
                  
                        <div class="form-group">
                                            <label for="url">Fecha de Inicio:</label>
                                            <input class="form-control" id="datestart"  required type="date" name="datestart" />
                        </div>

                        <div class="form-group">
                                            <label for="url">Fecha de Fin:</label>
                                            <input class="form-control" id="dateend" required type="date" name="dateend" />
                        </div>       
               
                        <button type="submit" class="btn btn-primary">Descargar en excel</button>
                    {!! Form::close() !!}


                    </div>
                 </div>
            </div>
    </div>
  </div>
</div>