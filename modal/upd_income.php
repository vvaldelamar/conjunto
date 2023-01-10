<form class="form-horizontal form-label-left input_mask" method="post" id="upd_income" name="upd_income">    
	<!-- Modal -->
    <div class="modal fade bs-example-modal-lg-udp" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"> Editar Ingreso</h4>
                </div>
                <div class="modal-body">
                    
                        <div id="result_income2"></div>
                        <input type="hidden" name="mod_id" id="mod_id">
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" required id="mod_created_at" name="mod_created_at" class="form-control" placeholder="Default Input">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Casa <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_casas" id="mod_casas" class="date-picker form-control col-md-7 col-xs-12" required type="text" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Propietario <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_description" id="mod_description" class="date-picker form-control col-md-7 col-xs-12" required type="text" readonly>
                            </div>
                        </div>

                         
                        <div id="result_income"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" required  id="mod_fecha_pago" name="mod_fecha_pago" class="form-control" placeholder="Default Input" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Transferencia
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" id="mod_tipo" name="mod_tipo" required>
                                <option value="DEPOSITO EN CUENTA">DEPOSITO EN CUENTA</option>
                                <option value="EFECTIVO">EFECTIVO</option>
                                <option value="OTROS">OTROS</option>
                                <option value="SPEI">SPEI</option>
                            </select>
                            </div>
                        </div>        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_notas" id="mod_notas" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero de recibo <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_recibonum" id="mod_recibonum" class="date-picker form-control col-md-7 col-xs-12" required type="text">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ordenante <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="mod_ordena" id="mod_ordena" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>	

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categoria
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" id="mod_category" name="mod_category" required>
                                    <option selected="" value="">-- Selecciona Categoria --</option>
                                    <?php $categories = mysqli_query($con,"select * from category_income where id='3' or id ='4' or id ='5'");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                        <option value="<?php echo $cat['id']; ?>" ><?php echo $cat['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
    			
			 <legend>Select File to Upload:</legend> 

			 <div class="form-group">
			  <div class="bg-warning col-md-12">
				<div class="col-md-6 w-auto ml-auto">
				<div class="btn-group">
   				<input type="file" name="imagefile2" id="imagefile2"  accept="image/png, .jpeg, .jpg, image/gif">
   				<input type="hidden" name="mod_image" id="mod_image">
				</div>
				</div>

				<div class="btn-group col-md-6">
				<div class="btn-group">
				<a class="link fa fa-cloud-download fa-lg btn-group" href="" download></a>
				</div>
				<div class="btn-group col-md-4 ml-auto">
				 <button type="button" class="cerrar fa fa-times" id="cerrar" name="cerrar"></button>
				</div>
			 </div>
			</div>

			</div>
                        <div id="load_img"> </div>

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
