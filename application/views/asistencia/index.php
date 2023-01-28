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

<!--<button class="btn btn-warning"  id="btnagregar" data-toggle="modal" data-target="#modalCajaMov">Agregar</button>-->
  
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <tr>
      
      <th>Codigo</th>
      <th>Nombres</th>
      <th>Area</th>
      <th>Fecha Hora</th>
      <th>Asistencia</th>
      <th>Puntual</th>
     <!-- <th>Fecha</th>-->
    </tr>
    </thead>


    <tbody>
      <?php foreach ($asistencia as $value) {?>
        <tr>

        
        <td><?php echo $value->codigo_persona_as ?></td>
        <td><?php echo $value->nombre_usuario ?></td>
        <td><?php echo $value->nombre ?></td>
        <td><?php echo $value->fecha_hora ?></td>
        <td><?php echo $value->tipo ?></td>
        <td><?php echo $value->TardeTemprano ?></td>
        <!--<td><?php echo $value->fecha ?></td>-->
      <!--<td><a class="btn btn btn-primary btn-xs" title="modificar" href=""><span class="glyphicon glyphicon-pencil"></span></a></td>-->
      </tr>
    <?php }?>
    </tbody>
    
  </table>
</div>

<script type="text/javascript">
  
 $(document).ready(function(){

    $('#tbllistado').DataTable();

  });


</script>