<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 text-center">
         <h3>
            Subir imágenes con Codeigniter
         </h3>
      </div>
   </div>

   <div class="row">
   <div class="col-md-offset-3 col-md-6"> <form method="POST" action="<?php echo base_url()?>index.php/inicio/subir" enctype="multipart/form-data">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Dato</label>
                  <input class="form-control" type="text" id="txt_dato" name="txt_dato" value="" placeholder="Pon un dato de texto">
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label>Imagen</label>
                  <input type="file" name="archivoImagen" /> 
               </div>
            </div>
            <div class="col-xs-12">
               <input type="submit" class="btn btn-success" value="Guardar">
            </div>
         </form>
      </div>
   </div>
</div>