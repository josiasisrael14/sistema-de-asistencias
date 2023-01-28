<?php
if (!$this->session->has_userdata("nombre_usuario")) {
    # Poner un mensaje de inicio de sesión
    $this->session->set_flashdata('mensaje', 'No puedes acceder al recurso hasta que <strong>inicies sesión</strong>');
    # Y redireccionar al login
    redirect("acceso");
}

?>

<style type="text/css">
  
 .red{

      background-color:red; !important;
  color: red;
  }


</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="container">

<button class="btn btn-warning"  id="btnagregar" data-toggle="modal" data-target="#modalCajaMov">Agregar</button>
  
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <tr>
      <th><span class="glyphicon glyphicon-pencil"></span></th>
      <th><span class="glyphicon glyphicon-trash"></span></th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Departamento</th>
      <th>Email</th>
      <th>Foto</th>
      <th>Horario</th>
     
    </tr>
    </thead>


    <tbody>
      <?php foreach ($usuario as $value) {?>
        <tr>
      <td><a class="btn btn btn-primary btn-xs btn_modificar_usuarios" data-toggle="modal" data-target="#modalCajaMov" title="modificar" data-id='<?php echo $value->idusuario ?>' href=""><span class="glyphicon glyphicon-pencil"></span></a></td>

       <td><a class="btn btn btn-primary btn-xs btn_eliminar" data-id='<?php echo $value->idusuario ?>' href=""><span class="glyphicon glyphicon-trash"></span></a></td>   
  
      <!--<td><a class="btn btn btn-primary btn-xs" data-toggle="modal" data-target="#modalCajaMov" title="modificar" href="<?php echo base_url()?>index.php/acceso/modificar_usuario/<?php echo $value->idusuario; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>-->
        <td><?php echo $value->nombre_usuario ?></td>
        <td><?php echo $value->apellidos ?></td>
        <td><?php echo $value->nombre ?></td>
        <td><?php echo $value->email ?></td>
<td><img src="<?php echo base_url()?>imagenes1/<?php echo $value->imagen ?> " height='50px' width='50px' ></td>
        <td><?php echo $value->horaentrada ?> -<?php echo $value->horasalida ?> </td>
       
        <!--<td><a class="btn btn btn-primary btn-xs" title="modificar" href=""><span class="glyphicon glyphicon-pencil"></span></a></td>-->
      </tr>
    <?php  }?>
    </tbody>
    
  </table>
</div>

<script type="text/javascript">

   $(document).ready(function(){

    $('#tbllistado').DataTable({

   "aProcessing": true,//activamos el procedimiento del datatable
    "aServerSide": true,//paginacion y filrado realizados por el server
    dom: 'Bfrtip',//definimos los elementos del control de la tabla
    buttons: [
              'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'           
  
    ],



    });

  });
  
$("#btnagregar").click(function(e){
  e.preventDefault();

  $("#modalCajaMov").load('<?= base_url()?>index.php/usuario/nuevo',{});


});


$(".btn_modificar_usuarios").click(function(e){

  e.preventDefault();
  var idusuario=$(this).data('id');

  $("#modalCajaMov").load('<?= base_url()?>index.php/usuario/modificar_usuario/'+idusuario,{});
});

$(".btn_eliminar").click(function(e){
  e.preventDefault();
  var idusuario=$(this).data('id');
  var msg=$(this).data(msg);
   var url='<?= base_url()?>index.php/usuario/eliminar/'+idusuario
   $.confirm({
    title:'Confirmar',
    content:msg,
    buttons:{
    confirm:{
     text:'aceptar',
     btnClass:'btn-blue',
     action:function(){
      $.ajax({
        url:url,
        dataType:'json',
        method:'get',
        success:function(response){
          if (response.status==STATUS_OK) {
            toast('success',1500,'eliminado');
            location='<?php echo base_url()?>index.php/usuario/usuario/';   
            //dataSource.read();
          }

          if (response.status==STATUS_FAIL) {
             toast('error',2000,'error');  
           }
        }
      });
     } 
    },
    cancel:function(){

    }  
    }
   });
});



</script>


<!--box-header-->
<!--centro-->
