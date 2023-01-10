<form class="form-horizontal form-label-left input_mask" method="post" id="upd_casas" name="upd_casas">    
	<!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar casas</h4>
                </div>
                <div class="modal-body">


                    
                        <div id="result_casas2"></div>
                        <input type="hidden" name="mod_id" id="mod_id">
            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Casa <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_casa" id="mod_casa" class="date-picker form-control col-md-7 col-xs-12" required type="text" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Propietario <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_propietario" id="mod_propietario" class="date-picker form-control col-md-7 col-xs-12" required type="text" readonly>
                            </div>
                        </div>

                         
                         <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo<span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_correo" id="mod_correo" class="date-picker form-control col-md-7 col-xs-12" required type="text" pattern="(?![_.-])((?![_.-][_.-])[a-zA-Z\d_.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo 2do.
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_correo_sec" id="mod_correo_sec" class="date-picker form-control col-md-7 col-xs-12"  type="text" pattern="(?![_.-])((?![_.-][_.-])[a-zA-Z\d_.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 1ro. <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_telefono1" id="mod_telefono1" class="date-picker form-control col-md-7 col-xs-12" required type="text" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="16">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono 2do. 
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_telefono2" id="mod_telefono2" class="date-picker form-control col-md-7 col-xs-12"  type="text" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="16">
                            </div>
                        </div>
               
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tarjeta
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" id="mod_tarjeta" name="mod_tarjeta" required>
                                <option value="" selected>-- Selecciona estado --</option>
                                <option value="1" >Activo</option>
                                <option value="0" >Inactivo</option>  
                            </select>
                            </div>
                        </div>  

                                                               
                </div>
                <div class="modal-footer">
                    <button id="upd_saldo" type="submit" class="btn float-left btn-info btn-outline-primary glyphicon glyphicon-envelope"></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
 </form>	
