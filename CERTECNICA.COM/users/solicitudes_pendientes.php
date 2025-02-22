
<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>

  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Solicitudes  de Permiso
      </h1>
      <ol class="breadcrumb">
       
      <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li>Empleado</li>
        
        <li class="active">Solicitud de permisos </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
    <body>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="#addsolicitud" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <th>NUMERO DE SOLICITUD</th>
                  <th>MOTIVO</th>
                  <th>DESCRIPCIÓN</th>
                  <th>FECHA INICIO</th>
                  <th>APROBACIÓN GESTION HUMANA</th>
                  <th>APROBACIÓN JEFE </th>
                  <th>APROBACIÓN DIRECTOR ADMINISTRATIVO</th>
                  <th>Acciones</th>     
                </thead>
                <tbody>
                  <?php
                  $id = $_SESSION['employees'];
                 $leaves = mysqli_query($conn,"SELECT * FROM solicitudes WHERE id_user = $id  AND aprobacion_GH = 'Pendiente' OR estado_JF = 'Pendiente'");
                 if($leaves){
                   $numrow = mysqli_num_rows($leaves);
                   if($numrow!=0){
                     $cnt=1;
                     while($row1 = mysqli_fetch_array($leaves)){
                       $datetime1 = new DateTime($row1['fecha_inicio']);
                       $datetime2 = new DateTime($row1['fecha_fin']);
                       $interval = $datetime1->diff($datetime2);
                       ?>
                       <tr>
                       <td><?php echo $cnt ?></td>
                       <td><?php echo $row1['Motivo']?></td>
                       <td><?php echo $row1['descripcion']?></td>
                       <td><?php echo $datetime1->format('Y/m/d  h:i:s ')?> <b> Hasta </b><?php echo $datetime2->format('Y/m/d/ h:i:s')?></td>
                       <td><?php echo $row1['aprobacion_GH']?></td>
                       <td><?php echo $row1['estado_JF']?></td>
                       <td><?php echo $row1['estado_DA']?></td>  
                         
                       <td><a class='btn btn-success btn-sm editar btn-flat' href="ver_solicitud_user.php?id=<?php echo $row1['id']?>"><i class="fa fa-eye" aria-hidden="true"></i> Ver Solicitud</a>
                       <td><a class='btn btn-danger btn-sm editar btn-flat' href="eliminar_solicitud.php?id=<?php echo $row1['id']?>"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancelar Solicitud</a>
                     </tr>
                    <?php
                    $cnt++; }
                   } else {
                     echo"<tr class='text-center'><td colspan='12'>YOU DON'T HAVE ANY LEAVE HISTORY! PLEASE APPLY TO VIEW YOUR STATUS HERE!</td></tr>";
                   }
                 }
                 else{
                   echo "Query Error : " .  " SELECT descripcion, aprobacion_GH FROM solicitudes WHERE id='".$_SESSION['employees']."'" . "<br>" . mysqli_error($conn);;
                 }
             ?>
              </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    </body>                        
    </section>   
</div>
<?php include 'includes/scripts.php'; ?>
<?php include 'modal_solicitud.php'; ?>
</body>
</html>

