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
<div class="box-header with-border">
  <h1 class="box-title">Consulta de Asistencias por Fechas</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <label>Fecha Inicio</label>
    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
  </div>
  <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <label>Fecha Fin</label>
    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
  </div>
  <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label>Empleado</label>
    <select class="form-control" name="idusuario" id="idusuario" required>
      <option value="">No Selected</option>
       <?php foreach($usuario as $row):?>
<option value="<?php echo $row->idusuario;?>"><?php echo $row->nombre_usuario;?></option>
  <?php endforeach;?>
  </select>
    <!--<select class="form-control" id="idcliente" name="idcliente" value="">
           <option value="" selected="selected">seleccione</option>
           
             <?php foreach($usuario as $value){?>
            <option value="<?php echo $value->nombre_usuario;?>">
             </option> 

           <?php }?>
          </select>-->

    <!--<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" value="<?php echo $usuario->nombre ?>" required>
    </select>-->
    <br>
    <button class="btn btn-success" id="enviar" onclick="listar();">
      Listar</button>
  </div>
  <table id="tbllistado_asistencia" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
    	
      <th>Fecha</th>
      <th>Nombres</th>
      <th>Asistencia</th>
      <th>Fecha/Hora</th>
      <th>Código</th>
  
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      
      <th>Fecha</th>
      <th>Nombres</th>
      <th>Asistencia</th>
      <th>Fecha/Hora</th>
      <th>Código</th>
    
    </tfoot>   

  <!--<tbody>
      <?php foreach ($reporte as $value) {?>
        <tr>
        <td><?php echo $value->fecha ?></td>
        <td><?php echo $value->nombre_usuario ?></td>
        <td><?php echo $value->tipo ?></td>
        <td><?php echo $value->fecha_hora ?></td>
        <td><?php echo $value->codigo_persona_as ?></td>
        </tr>
    
     <?php }?>

    </tbody>
   -->
  
  </table>
  </div> 
  <!--<div class="container"></div>-->

</div>
</div>
</div>
</section>


</div>


  <script type="text/javascript">
    
 
function listar(){
var tabla;
var fecha_inicio = $("#fecha_inicio").val();
 var fecha_fin = $("#fecha_fin").val();
 var idusuario = $("#idusuario").val();
$('#tbllistado_asistencia').DataTable({
    "aProcessing": true,//activamos el procedimiento del datatable
    "aServerSide": true,//paginacion y filrado realizados por el server
    dom: 'Bfrtip',//definimos los elementos del control de la tabla
    buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
    ],
    "ajax":
    {
      url:'<?= base_url()?>index.php/reporte/mostrar/',
      data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin, idusuario:idusuario},
      type:"post",
      dataType : "json",
      error:function(e){
        console.log(e.responseText);
      }
    },

    'columns':[
    {data:'fecha'},
    {data:'nombre_usuario'},
    {data:'tipo'},
    {data:'fecha_hora'},
    {data:'codigo_persona_as'}
    ],
    "bDestroy":true,
    "iDisplayLength":10,//paginacion
    "order":[[0,"desc"]]//ordenar (columna, orden)
  });




}



  </script>