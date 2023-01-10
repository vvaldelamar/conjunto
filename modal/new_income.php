<form class="form-horizontal form-label-left input_mask" method="post" id="add_income" name="add_income">
    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar Ingreso</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Ingreso</h4>
                </div>
                <div class="modal-body">
                    
                        <div id="result_income"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" required name="date" class="form-control" placeholder="Default Input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Transferencia
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control"  name="tipo_trans" required>
                            <option value="DEPOSITO EN CUENTA">DEPOSITO EN CUENTA</option>
                            <option value="EFECTIVO">EFECTIVO</option>
                            <option value="OTROS">OTROS</option>
                            <option value="SPEI" selected>SPEI</option>
                            </select>
                            </div>
                        </div>        

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="description" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de recibo <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="recibonum" class="date-picker form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Casa
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="casa" required>
                                    <option selected="" value="">-- Selecciona Categoria --</option>
                                    <?php
                                    $categories = mysqli_query($con,"select * from personas");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                    <option value="<?php echo $cat['casa']; ?>"> <?php echo $cat['propietario'] ; ?> <b>Referencia: <?php echo $cat['referencia']; ?> </b>Casa: <b> <?php echo $cat['casa'] ; ?></b> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>              
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="amount" class="date-picker form-control col-md-7 col-xs-12" required type="text" pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categoria
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" name="category" required>
                                    <option selected="" value="">-- Selecciona Categoria --</option>
                                    <?php
                                    $categories = mysqli_query($con,"select * from category_income where id='3' or id ='4' or id ='5'");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                       
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div> <!-- /Modal -->
</form>	