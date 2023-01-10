<form class="form-horizontal form-label-left input_mask" method="post" id="upd_expence" name="upd_expence">    
	<!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Gasto</h4>
                </div>
                <div class="modal-body">
                    
                        <div id="result_expence2"></div>
                        <input type="hidden" name="mod_id" id="mod_id">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_description" id="mod_description" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_amount" id="mod_amount" class="date-picker form-control col-md-7 col-xs-12" required type="text" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categoria
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" id="mod_category" name="mod_category" required>
                                    <option selected="" value="">-- Selecciona Categoria --</option>
                                    <?php $categories = mysqli_query($con,"select * from category_expence");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                        <option value="<?php echo $cat['id']; ?>" ><?php echo $cat['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="upd_data" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
</form>	
	