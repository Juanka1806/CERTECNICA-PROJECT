
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
    
      Dotación Empleados
    
       </h1>

      <ol class="breadcrumb">
        
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li>Administradores</li>
      
      <li class="active">Lista de Administradores</li>
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
               <a href="#addDotacion" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Empleado</th>
                  <th>Talla Camisa</th>
                  <th>Talla Calzado</th>
                  <th>Talla Chaqueta</th>
                  <th>Talla Pantalon </th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  <?php
                   $conexion=mysqli_connect("localhost","root","","apsystem");               
                   $SQL="SELECT * FROM dotacion";
                   $dato = mysqli_query($conexion, $SQL);
                   
                   if($dato -> num_rows >0){
                       while($fila=mysqli_fetch_array($dato)){
                      ?>
                        <tr>
                          <td><?php echo $fila['EMPLEADO']; ?></td>
                          <td><?php echo $fila['TALLA_CAMISA']; ?></td>
                          <td><?php echo $fila['TALLA_CALZADO']; ?></td>
                          <td><?php echo $fila['TALLA_CHAQUETA']; ?></td>
                          <td><?php echo $fila['TALLA_PANTALON']; ?></td> 
                          <td>
                          <a class='btn btn-success btn-sm editar btn-flat' href="edit_dotacion.php?id=<?php echo $fila['id']?> "><i class="fa fa-edit">  Editar</i></a>
                          <a class='btn btn-danger btn-sm editar btn-flat' href="eliminar_dotacion.php?id=<?php echo $fila['id']?> "><i class="fa fa-trash" aria-hidden="true"> Eliminar</i>
                        </td>
                        </tr>
                      <?php
                    }
                  ?>
                  <?php
}else{
    ?>
    <tr class="text-center">
    <td colspan="16">No existen registros</td>
    </tr>
    <?php
}
?>   </tbody>
  </table>
     </div>
           </div>
        </div>
      </div>
</section>   
  </div>
  <?php include 'modal_add_dotacion.php' ?>  
  <?php include '../admin/includes/admin_modal.php'; ?>
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
    url: 'dotacion_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
    $('#dotacion_id').val(response.id);
    $('')
    }
  });
}
</script>

</body>

</html>