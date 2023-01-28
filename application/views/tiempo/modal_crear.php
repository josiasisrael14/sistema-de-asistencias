

<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-title">Horarios</div>
			</div>
         <div class="modal-body">
         	<form  id="gridform">	
        <input type="hidden" id="idhorario" name="idhorario" value="<?php echo $horario->idhorario ?>">
       	<div class="row">
       	<div class="col-md-12">
         <div class="form-group">
         <label id="respuesta_time1" >entrada</label>
         <input type="text" name="horaentrada" id="horaentrada" class="form-control input-sm" value="<?php echo $horario->horaentrada ?> ">	
         </div>
         <div class="form-group">
          <label id="respuesta_time2">salida</label>
          <input type="text" name="horasalida" id="horasalida" class="form-control input-sm" value="<?php echo $horario->horasalida ?>">	
         </div>

            
       	</div>
       	</div>
			
           
 			</form>
		
			
  			</div>
  			<div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnguardar">Guardar</button> 
       		</div>
		</div><!--cerrar  -->
	</div><!--cerrar  -->


	 <script type="text/javascript">


	 	 $(function() {
   $('#horaentrada').timepicker({
 
  timeFormat: 'H:i:s'

   });

    $('#horasalida').timepicker({
   timeFormat:'H:i:s'

    });
 });

$("#btnguardar").click(function (e) {
        e.preventDefault();

       var horaentrada = $('#horaentrada').val();
      var horasalida = $('#horasalida').val();


    
        if (horaentrada === '' || horasalida === '') {
             alert('Error debe completar todos los datos');
             $('#respuesta_time1').attr("style", "color:red");
             $('#respuesta_time2').attr("style", "color:red");

         } 
         else{

              $('#respuesta_time1').attr("style", "color:blue");
             $('#respuesta_time2').attr("style", "color:blue");


         
          var enviar = $('#gridform')[0];
         
          var data = new FormData(enviar);
          //data.append('iddepartamento', $('#iddepartamento').prop('value'));
          // data.append('idtipoempleado', $('#idtipoempleado').prop('value'));
        $.ajax({
            url:'<?= base_url()?>index.php/horarios/guardar/',
            dataType: 'json',
            method: 'post',
            contentType: false,
            data: data,
            processData: false,
            success: function (result) {
              if (result.status==2) {
        
           toast("success",1500,"registrado");
            $("#modalCajaMov").modal('hide');
             location='<?php echo base_url()?>index.php/horarios/index/'; 
          }else{

          }if (result.status==1) {
         
              toast("danger",1500,"error");
          }
                 

               
            }


        });

         }


    });


	 	 </script>