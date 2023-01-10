<form class="form-horizontal form-label-left input_mask" method="post" id="upd_cominica" name="upd_cominica">    
	<!-- Modal -->
    <div class="modal fade bs-example-modal-lg-mail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Comunica</h4>
                </div>
                <div class="modal-body">
                    
                        <div id="result_casas3"></div>
                        <input type="hidden" name="mod_id" id="mod_id">
            
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Asunto<span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_asunto" id="mod_asunto" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <textarea id="mod_body" name="mod_body"  title="Por favor describa el mensaje..."  placeholder="Por favor describa el mensaje..."  rows="10" cols="50" required ></textarea>
                                <br>
                            </div>
                        </div>
                                                               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="upd_comun" type="submit" class="btn btn-success">Enviar</button>                    
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
 </form>	
