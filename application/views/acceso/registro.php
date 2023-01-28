


<script src="https://kit.fontawesome.com/74a6435741.js" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css" />



<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
<?php 
 //include '../ajax/asistencia.php' ?>
    <div name="movimientos" id="movimientos">
    </div> 



  <div class="lockscreen-logo">
    <a href="#"><b>SISTEMA ASISTENCIA</b> </a>
  </div>
  <!-- User name -->
  <!--<div class="lockscreen-name">ASISTENCIA</div>-->

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url()?>imagenes1/madre_jairo.jpg" heigth="50px" width="50px" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form id="enviar" class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" name="codigo_persona" id="codigo_persona" placeholder="ID de asistencia" required>

       <!-- <div class="input-group-btn">
       <button id="guardar" class="btn btn-primary" ><i class="fa fa-arrow-right text-muted"></i></button>

        </div>-->
       
       
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Ingresa tu ID de asistencia

  </div>

  <div class="text-center">
   <!--<div class="input-group-btn">-->
  <button id="guardar" class="btn btn-danger" value="entrada" >entrada</button>
  <button id="salida" class="btn btn-danger" value="salida" >salida</button>

        <!--</div>-->
  </div>
 <!-- <div class="lockscreen-footer text-center">
    <a href="../admin/">Iniciar Sesión</a>
  </div>-->

<!--<?php if(isset($mensaje)){?>


<div class="form-outline mb-4">
 <div class="alert alert-danger" role="alert"><center><?php echo $mensaje ?></center></div>
 </div>
<?php }?>-->


  <a href="<?php echo base_url()?>index.php/acceso/index">volver a login</a>
  <div id="container"></div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js"></script>

<script type="text/javascript">
  $("#guardar").click(function(e){
  
    e.preventDefault();

    $.ajax({
      url:'<?= base_url()?>index.php/acceso/asistencia_g',
      dataType:'json',
      method:'post',
      data:$("#enviar").serialize(),
      success:function(response){




      if (response.status==2) {
        //console.log(response[i].codigo_persona_as)
      var nombre_usuarioss = (response[0].nombre_usuarioss);
      var fecha_hora = (response[0].fecha_hora);
       var tipo = (response[0].tipo);

    alertify.alert("<h3>"+ nombre_usuarioss +"&nbsp;"+ fecha_hora + "&nbsp;"+ tipo+"</h3>");
     $('#codigo_persona').val('');  

    //alert(codigo_persona_as);

   /*  Swal.fire({
html: `<h3 class="text-center"><div class="alert alert-success">
<?php "<script>codigo_persona_as </script>"; ?>
</div></h3>
    `,
   
    text:"cerrar",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: "OK",
  

})
      
 .then(resultado => {
        if (resultado.value) {

    location='<?php echo base_url()?>index.php/acceso/cerrarsesionregistro/';       

            // Hicieron click en "Sí"
          //$this->session->sess_destroy();   

        } else {
            // Dijeron que no
            console.log("*NO se elimina la venta*");
        }
    });


*/


      
      }else{

        if (response.status==1) {

      /* var container=document.getElementById('container');
container.innerHTML='<h3 class="text-center"><div class="alert alert-success"> CODIGO NO ENCONTRADO </div></h3>';
*/
alertify.alert("<h2>"+"CODIGO NO ENCONTRADO"+"</h2>" );

$('#codigo_persona').val('');  

         /*alert("codigo no encontrado");*/


        }

      }


        if(response.status==0){
       alertify.alert("USUARIO REGISTRO ASISTENCIA");
        $('#codigo_persona').val('');  
         // $("#mensaje").html(response);

        }
      



      }
    });
  });


$("#salida").click(function(e){
  
    e.preventDefault();

    $.ajax({
      url:'<?= base_url()?>index.php/acceso/asistencia_salida',
      dataType:'json',
      method:'post',
      data:$("#enviar").serialize(),
      success:function(response){
      if (response.status==2) {
       /*alert(" registrado salida");*/
       var usuarios = (response[0].usuarios);
      var fecha_horas = (response[0].fecha_horas);
       var tipos = (response[0].tipos);

    alertify.alert("<h3>"+ usuarios +"&nbsp;"+ fecha_horas + "&nbsp;"+tipos+"</h3>");
     $('#codigo_persona').val('');  

  
      }else{

        if (response.status==1) {

        // alert("error");
  /*var container=document.getElementById('container');
container.innerHTML='<h3 class="text-center"><div class="alert alert-success">CODIGO NO ENCONTRADO </div></h3>';*/


      alertify.alert("<h2>"+"CODIGO NO ENCONTRADO"+"</h2>" );



       $('#codigo_persona').val('');  

    
     

        }



      }


           if(response.status==0){
       alertify.alert("USUARIO REGISTRO ASISTENCIA");
        $('#codigo_persona').val('');  
         // $("#mensaje").html(response);

        }

      }
    });
  });









</script>