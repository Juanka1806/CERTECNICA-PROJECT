
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
          INFORMACIÓN CORPORATIVA
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Empleado</li>
        <li class="active">Información Corporativa Empleado</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="#addEmpleado" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Empleado</th>
                  <th>Cargo</th>
                  <th>Area</th> 
                  <th>Correo Corporativo</th>
                  <th>Creado en</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php    
                  $sql= "SELECT * FROM  informacion_empleado ";
                    $query = $conn->query($sql);
                    while($fila = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $fila['empleado']; ?></td>
                          <td><?php echo $fila['cargo']; ?></td>
                          <td><?php echo $fila['area']; ?></td>
                          <td><?php echo $fila['correo_corporativo']; ?></td>
                          <td><?php echo $fila['created_on'] ?></td>
                          <td>
                            <a class='btn btn-success btn-sm editar btn-flat' href="editar_empleado.php?id=<?php echo $fila['id']?> "><i class="fa fa-edit">  Editar</i></a>
                            <a class='btn btn-primary btn-sm editar btn-flat' href="ver_empleado.php?id=<?php echo $fila['id']?> "><i class="fa fa-eye" aria-hidden="true"></i>
  Ver</i></a>
                            <a class='btn btn-warning btn-sm crear btn-flat' href="crear_beneficiario.php?id=<?php echo $fila['id']?> "><i class="fa fa-users">  Beneficiario</i></a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
  <?php include 'modal_inf_empleado.php' ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'empleado_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('#edit_cargo_val').val(response.cargo).html(response.description);
    }
  });
}
</script>
</body>

</html>
