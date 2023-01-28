<?php
if (!$this->session->has_userdata("nombre_usuario")) {
    # Poner un mensaje de inicio de sesión
    $this->session->set_flashdata('mensaje', 'No puedes acceder al recurso hasta que <strong>inicies sesión</strong>');
    # Y redireccionar al login
    redirect("acceso");
}

?>

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
      <th><span class="glyphicon glyphicon-trash"></span></th>  
      <th><span class="glyphicon glyphicon-pencil"></span></th>
      
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>fecha/registro</th>
      <th>idusuario</th>
    </tr>
    </thead>


    <tbody>
      <?php foreach ($tipousuario as $value) {?>
        <tr>
         <td><a class="btn btn btn-primary btn-xs btn_eliminar" data-id="<?php echo $value->idtipousuario ?>" title="eliminar" href=""><span class="glyphicon glyphicon-trash"></span></a></td>

        <td><a class="btn btn btn-primary btn-xs btn_modificar" data-toggle="modal" data-target="#modalCajaMov" data-id="<?php echo $value->idtipousuario ?>" title="modificar" href=""><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><?php echo $value->nombre ?></td>
        <td><?php echo $value->descripcion ?></td>
        <td><?php echo $value->fechacreada ?></td>
        <td><?php echo $value->idusuario ?></td>
      </tr>
    <?php  }?>
    </tbody>
    
  </table>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#tbllistado').DataTable();

  });
  
$("#btnagregar").click(function(e){
  e.preventDefault();

  $("#modalCajaMov").load('<?= base_url()?>index.php/acceso/nuevotipousuario',{});


});

$(".btn_modificar").click(function(e){
 e.preventDefault();
 var idtipousuario=$(this).data('id');
$("#modalCajaMov").load('<?= base_url()?>index.php/acceso/modificar_tipousuario/'+idtipousuario,{});


});

$(".btn_eliminar").click(function(e){
  e.preventDefault();
  var idtipousuario=$(this).data('id');
  var msg=$(this).data(msg);
   var url='<?= base_url()?>index.php/acceso/eliminar_tipousuario/'+idtipousuario
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
            location='<?php echo base_url()?>index.php/acceso/tipousuario/';   
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
