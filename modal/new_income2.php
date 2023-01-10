<form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" id="add_income" name="add_income">
    <div> 
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-new"><i class="fa fa-plus-circle"></i> Agregar Ingreso</button>
    </div>
    <div class="modal fade bs-example-modal-lg-new" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Ingreso</h4>
                </div>
                <div class="modal-body">
                    

 <ul class="nav nav-tabs">
     <li><a href="#settings" data-toggle="tab">Pago</a></li>
    <li><a href="#timeline" data-toggle="tab">Buscar</a></li>
 </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
		<br><br>
   
   <div class="tab-content">
   
     <div class="tab-pane" id="timeline">
	<div class="form-group">
    <div id="events">
    </div>
      <table id="example" class="table stripe table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Casa</th>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Leyenda</th>
                <th>Movimiento</th>
                <th>Abono</th>
                <th>Ordenante</th>
            </tr>
        </thead>
        <tbody>

                <?php
			$query = mysqli_query($con,"select * from ordenante");
                        while ($r=mysqli_fetch_array($query)) {

                            $casa=$r['casa'];
                            $fecha=$r['fecha'];
                            $referencia=$r['referencia'];
                            $leyenda=$r['leyenda'];
                            $movimiento=$r['movimiento'];
                            $abono=$r['abono'];
                            $ordenante=$r['ordenante'];
                         
                ?>
                    <tr>
                        <td ><?php echo $casa; ?></td>
                        <td><?php echo $fecha;?></td>
                        <td ><?php echo $referencia; ?></td>
                        <td ><?php echo $leyenda; ?></td>
                        <td ><?php echo $movimiento; ?></td>
                        <td ><?php echo $abono; ?></td>
                        <td ><?php echo $ordenante; ?></td>
 		    </tr>                   

                <?php
                    } //end while
                ?>

    	</tbody>
         <tfoot>
            <tr>
                <th>Casa</th>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Leyenda</th>
                <th>Movimiento</th>
                <th>Abono</th>
                <th>Ordenante</th>
            </tr>
         </tfoot>
      </table>

						




						</div>
                  </div><!-- /.tab-pane -->
                  
                  <div class="active tab-pane" id="settings">
                  
                        <div id="result_income"></div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="date" required name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Default Input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Transferencia<span class="required">*</span>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Propietario <span class="required">*</span>
                            </label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <select class="form-control" name="casa" onchange="getval(this);" required>
                                    <option selected="" value="">-- Selecciona un Propietario --</option>
                                    <?php
                                    $categories = mysqli_query($con,"select * from personas");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                    <option value="<?php echo $cat['casa']; ?>"> <?php echo $cat['propietario'] ; ?> Casa: <b> <?php echo $cat['casa'] ; ?></b>  </option>
                                    <?php } ?>
                                </select>
                            </div>


				<div class="col-md-4 col-sm-4 col-xs-6">
                                <select class="form-control" name="ref" onchange="getvalr(this);" required>
                                    <option selected="" value="">-- Selecciona Referencia --</option>
                                    <?php
                                    $categories = mysqli_query($con,"select * from personas");
                                    while ($cat=mysqli_fetch_array($categories)) { ?>
                                    <option value="<?php echo $cat['casa']; ?>"> <?php echo $cat['referencia'] ; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>              

			<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ordenante <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <input name="ord_name" id="ord_name" class="date-picker form-control col-md-7 col-xs-12" required type="text">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Categoria <span class="required">*</span>
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
		   	 	<legend>Select File to Upload:</legend>
            			<div class="form-group">
				<input type="file" name="imagefile" id="imagefile"  accept="image/png, .jpeg, .jpg, image/gif">
           			 </div>
 			<div id="load_img"> </div>
			 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button id="save_data" type="submit" class="btn btn-success">Guardar</button>
                </div>

                        
                     </div>    
                  </div>
              </div>
            </div>
                </div>
            </div>

        </div>
    </div> <!-- /Modal -->
</form>
