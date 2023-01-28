  <?php
if (!$this->session->has_userdata("nombre_usuario")) {
    # Poner un mensaje de inicio de sesión
    $this->session->set_flashdata('mensaje', 'No puedes acceder al recurso hasta que <strong>inicies sesión</strong>');
    # Y redireccionar al login
    redirect("acceso");
}

?>


  <div class="content-wrapper">
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $usuarios->total;?></h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url()?>index.php/usuario/usuario" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $departamento->total; ?></h3>

                <p>Departamento</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url()?>index.php/departamento/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $tipousuario->total; ?></h3>

                <p>Tipo Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url()?>index.php/acceso/tipousuario" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         <!-- <div class="col-lg-3 col-6">
           
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>-->



          <!-- ./col -->
        </div>
     </div>
    </section>

        <div>
       <canvas id="myChart"></canvas>
    </div>
    
    
   
   
   </div>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
   <script type="text/javascript">


    
     const ctx=document.getElementById('myChart');
     new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['tarde', 'temprano'],
      datasets: [{
        label: 'record asistencia',
        data:["<?php echo $tarde->total;?>","<?php echo $temprano->total;?>"],

        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });





     
   </script>