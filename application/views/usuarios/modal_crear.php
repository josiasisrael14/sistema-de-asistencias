


<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-title">usuarios</div>
			</div>
         <div class="modal-body">
         	<form  id="gridform">	
        <input type="hidden" id="idusuario" value="<?php echo $usuarios->idusuario ?>">
       	<div class="row">
       	<div class="col-md-12">
         <div class="form-group">
         <label>tipo usuario</label>
         <input type="text" name="nombre" id="nombre" class="form-control input-sm">	
         </div>
         <div class="form-group">
          <label>Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control input-sm">	
         </div>

            
       	</div>
       	</div>
			
           
 			</form>
		
			
  			</div>
  			<div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar_pago">Guardar</button> 
       		</div>
		</div><!--cerrar  -->
	</div><!--cerrar  -->