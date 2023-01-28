



<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-title">Departamento</div>
			</div>
         <div class="modal-body">
         	<form  id="gridform">	
     <input type="hidden" id="iddepartamento" name="iddepartamento" value="<?php echo $departamento->iddepartamento ?>" readonly>
       	<div class="row">
       	<div class="col-md-12">
         <div class="form-group">
         <label>nombre</label>
         <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="<?php echo $departamento->nombre ?> ">	
         </div>
         <div class="form-group">
          <label>Descripcion</label>
          <input type="text" name="descripcion" id="descripcion" class="form-control input-sm" value="<?php echo $departamento->descripcion ?>">	
         </div>

            
       	</div>
       	</div>
			
           
 			</form>
		
			
  			</div>
  			<div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btnaccion"  id="btn_guardar_pago">Guardar</button> 
       		</div>
		</div><!--cerrar  -->
	</div><!--cerrar  -->

  <script type="text/javascript">
    $("#btn_guardar_pago").click(function(e){
      e.preventDefault();

      var nombre=$("#nombre").val();
     var descripcion=$("#descripcion").val();

       if(nombre.length==0 || descripcion.length==0){

      alert("campos vacios");  
     
     }else{


       var enviar=new FormData();
        enviar.append('iddepartamento',$('#iddepartamento').prop('value'));
        enviar.append('nombre',$('#nombre').prop('value'));
        enviar.append('descripcion',$('#descripcion').prop('value'));
   
       $.ajax({
        url:'<?= base_url()?>index.php/departamento/guardar/',
        dataType:'json',
        method:'post',
        contentType:false,
        data:enviar,
        processData:false,
        success:function(response){

          if (response.status==2) {
        
           toast("success",1500,"registrado");
            $("#modalCajaMov").modal('hide');
             location='<?php echo base_url()?>index.php/departamento/index/'; 
          }else{

          }if (response.status==1) {
         
              toast("danger",1500,"error");
          }
        }
       });


     }


    });




  </script>