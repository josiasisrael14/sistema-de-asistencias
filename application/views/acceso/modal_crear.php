



<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="modal-title">Usuarios</div>
			</div>
         <div class="modal-body">
         	<form  id="gridform">	
          <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuarios->idusuario ?>">
       	<div class="row">
       		<div class="col-md-12">
       			<div class="form-group">

       		<label for="tipousuario">tipo Usuario</label>
       		<select class="form-control" id="idtipousuario" name="idtipousuario" value="<?php echo $usuarios->idtipousuario ?>">
           <option value="">seleccione</option>
             <?php foreach($tipousuario as $value):?>
            <option value="<?php echo $value->idtipousuario;?>" <?php if($value->idtipousuario==$usuarios->idtipousuario):?> selected <?php endif?>><?php echo $value->nombre;?>               
             </option> 

           <?php endforeach?>
          </select>


       			</div>




            <div class="form-group">
              <label for="tipodepartamento">Departamento</label>

      <select class="form-control" id="iddepartamento" name="iddepartamento" value="<?php echo $usuarios->iddepartamento ?>">


    <option value="">seleccione</option>
    <?php foreach ($departamento as  $value):?>
<option value="<?php echo $value->iddepartamento;?>" <?php if ($value->iddepartamento==$usuarios->iddepartamento):?> selected  <?php endif?> > <?php echo $value->nombre;?></option> 
            <?php endforeach?>      
              </select>

              </div>
            <div class="form-group">
              <label for="descripcion">nombre</label>
   <input type="text" id="nombre" name="nombre" class="form-control input-sm" value="<?php echo $usuarios->nombre_usuario ?>">
            </div>
             <div class="form-group">
              <label for="descripcion">apellidos</label>
              <input type="text" id="apellidos" name="apellidos" class="form-control input-sm" value="<?php echo $usuarios->apellidos ?>">
            </div> 

             <div class="form-group">
              <label for="descripcion">Login</label>
              <input type="text" id="login" name="login" class="form-control input-sm" value="<?php echo $usuarios->login ?>">
            </div>

             <div class="form-group">
              <label for="descripcion">email</label>
          <input type="text" id="email" name="email" class="form-control input-sm" value="<?php echo $usuarios->email ?>">
            </div>
            
               <div class="form-group">
              <label for="descripcion">Imagen</label>
          <input type="file" id="archivoImagen" name="archivoImagen" class="form-control input-sm" value="<?php echo $usuarios->imagen ?>">
          <td><img src="<?php echo base_url()?>imagenes1/<?php echo $usuarios->imagen ?> " height='50px' width='50px' ></td>

            </div>

            <div class="form-group">
              <label for="descripcion">clave de ingreso</label>
        <input type="password" id="password" name="password" class="form-control input-sm" value="<?php echo $usuarios->password ?>">
            </div>

             <div class="form-group">
              <label for="descripcion">Codigo Persona</label>
<button class="btn btn-info" type="button" id="generareven" onclick="generar(6);">Generar</button>
        <input type="text" id="codigo_persona" name="codigo_persona" class="form-control input-sm" value="<?php echo $usuarios->codigo_persona ?>">
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

  <script type="text/javascript">

   $("#btn_guardar_pago").on("click",function(){

    $("#gridform").submit();
       
    });

   $("#gridform").on('submit',function(e){

    e.preventDefault();

    /*var enviar=new FormData();
    enviar.append('idusuario',$('#idusuario').prop('value'));
    enviar.append('idtipousuario',$('#idtipousuario').prop('value'));
    enviar.append('iddepartamento',$('#iddepartamento').prop('value'));
    enviar.append('nombre',$('#nombre').prop('value'));
    enviar.append('apellidos',$('#apellidos').prop('value'));
    enviar.append('login',$('#login').prop('value'));
    enviar.append('email',$('#email').prop('value'));
    enviar.append('Imagen',$('#archivoImagen')[0].files[0]);
    enviar.append('password',$('#password').prop('value'));
    enviar.append('codigo_persona',$('#codigo_persona').prop('value'));
    */
    
    $.ajax({
    url:'<?= base_url()?>index.php/acceso/guardar',
    dataType:'json',
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(response){

        if (response.status==2) {
          toast('success',1500,'se registro el usuario');  
             //dataSource.read();
            $("#modalCajaMov").modal('hide');
        location='<?php echo base_url()?>index.php/acceso/usuario/';      

        }else{



        }if (response.status==1) {
          
           toast('error', 1500, 'error'); 

        }
    
    }

    });

  });

  /* $("#generareven").click(function(e){
    e.preventDefault();
    generar();
   }*/
//con el boton onclick me es suficiente le doy click y me llama a esta funcion que me va a generar los codigos alaetorios para los codigos de las personas
function generar(longitud)
{
 long=parseInt(longitud);
 var caracteres="abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
 var contrazeña="";
 for ( i=0; i<long; i++) contrazeña+=caracteres.charAt(Math.floor(Math.random()*caracteres.length));
  $("#codigo_persona").val(contrazeña);

}










    
    /*$("#btn_guardar_pago").on("click",function(){

      $.ajax({
        url:'<?= base_url()?>index.php/acceso/guardar',
        dataType:'json',
        method:'post',
        data:$("#gridform").serialize(),
        success:function(response){
          if (response.status==STATUS_OK) {
          toast('success',2500,'se registro el usuario');  
           
            $("#modalCajaMov").modal('hide');
            location='<?php echo base_url()?>index.php/acceso/usuario/';
        
          }else{

          }
            if (response.status==STATUS_FAIL) {
            toast('error', 1500, 'Faltan ingresar datos.');
          }
          
        }
      });

    });
    */
  </script>