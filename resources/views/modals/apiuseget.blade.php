

<div class="modal fade" id="demoModal2" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModal">Apis</h5>
                <button type="button" class="close" onclick="closeModal2()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                       {!! Form::open(array('route' => 'products.woocomerce','method'=>'POST', 'id' => 'formId','files' => true)) !!}
                  
                          <div class="form-group">
                                            <label for="url">Url Woocommerce:</label>
                                            <input id="url" required type="text" name="url" />
                        </div>

                        <div class="form-group">
                        <label for="usename">Username key Woocommerce:</label>
                                            <input id="userkey" required type="text" name="userkey" />
                        </div>
                        <div class="form-group">
                        <label for="password">Secret Key Woocommerce:</label>
                                            <input id="passkey" required  type="text" name="passkey" />
                        </div>         
               
                        <button type="submit" class="btn btn-primary">Cargar Woocommerce</button>
                    {!! Form::close() !!}


                    </div>
                    </div>
                    
                <div class="card">
                  <div class="card-body">
                    {!! Form::open(array('route' => 'products.shopify','method'=>'POST', 'id' => 'formId','files' => true)) !!}
                    <div class="form-group">
                                            <label for="url">Nombre de la Tienda:</label>
                                            <input id="url"  required type="text" name="url" />
                        </div>
                        <div class="form-group">
                        <label for="password">Token Shopify:</label>
                                            <input id="password" required type="text" name="password" />
                        </div>         
                    <button type="submit" class="btn btn-primary">Cargar Sphopify</button>
                    {!! Form::close() !!}

                  </div>
                </div>

                <div class="card" style="display:none;">
                  <div class="card-body">
                    {!! Form::open(array('route' => 'products.repairs','method'=>'POST', 'id' => 'formId','files' => true)) !!}
                     
                    <button type="submit" class="btn btn-primary">Cargar Repairs</button>
                    {!! Form::close() !!}

                  </div>
                </div>
            </div>
    </div>
  </div>
</div>