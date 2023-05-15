<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Panel Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../BootstrapPanelAdmin/template/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../BootstrapPanelAdmin/template/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../BootstrapPanelAdmin/template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../BootstrapPanelAdmin/template/images/administradorweb.png" />
</head>

<body>
<?php
  // Incluir el archivo obtener_datos.php para obtener los datos de la base de datos
  include 'obtener_datos.php';
  ?>
  <div class="container-scroller">
    <!-- partial:../BootstrapPanelAdmin/template/partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <!--<li class="nav-item ms-0 me-5 d-lg-flex d-none">
                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
              </li>-->
            </ul>
            
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Admin</span>
                    <span class="online-status"></span>
                    <img src="../BootstrapPanelAdmin/template/images/faces/administrador.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <!--<a class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i>
                        Settings
                      </a>-->
                      <a class="dropdown-item" href="../Login/iniciosesion.php">
                        <i class="mdi mdi-logout text-primary"></i>
                        Cerrar Sesión
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
              
              <li class="nav-item">
                  <a href="../PantallaAdmin/pantalla_admin.php" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Tablas</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="../BootstrapPanelAdmin/template/docs/documentation.php" class="nav-link">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Documentación</span></a>
              </li>
            </ul>
        </div>
      </nav>
    </div>
        <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                      <h4 class="card-title">Socios</h4>
                      <!--<p class="card-description">
                          Add class <code>.table</code>
                      </p>-->
                      <div class="table-responsive">
                          <table class="table">
                          <thead>
                              <tr>
                              <th>Nombre y Apellidos</th>
                              <th>Correo</th>
                              <th>Teléfono</th>
                              <th>DNI</th>
                              <th>Contraseña</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                              // Mostrar información de la tabla Socios
                              if ($result_Socios->num_rows > 0) {
                                  while ($row = $result_Socios->fetch_assoc()) {
                                      echo "<tr>";
                                      echo "<td>" . $row["nombre_apellidos"] . "</td>";
                                      echo "<td>" . $row["correo"] . "</td>";
                                      echo "<td>" . $row["telefono"] . "</td>";
                                      echo "<td>" . $row["dni"] . "</td>";
                                      echo "<td>" . $row["contraseña"] . "</td>";
                                      echo "<td><a href='?eliminar_socio=" . $row["dni"] . "'>Eliminar</a></td>";
                                      echo "</tr>";
                                  }
                              } else {
                                  echo "<tr><td colspan='6'>No se encontraron registros en la tabla Socios</td></tr>";
                              }
                            ?>
                          </tbody>
                          </table>
                      </div>
                      </div>
                  </div>
            </div>
              
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Actividades
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal" style="margin-left: 68%;">Agregar actividad</button>
                      </h4>
                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>Nombre de Actividad</th>
                                      <th>Hora de Actividad</th>
                                      <th>Acciones</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  // Mostrar información de la tabla Actividades
                                  if ($result_Actividades->num_rows > 0) {
                                      while ($row = $result_Actividades->fetch_assoc()) {
                                          echo "<tr>";
                                          echo "<td>" . $row["nombre_actividad"] . "</td>";
                                          echo "<td>" . $row["hora_actividad"] . "</td>";
                                          echo "<td>";
                                          echo "<a href='obtener_datos.php?editar_actividad=" . urlencode($row["nombre_actividad"]) . "' data-toggle='modal' data-target='#editActivityModal'>Editar</a> | ";
                                          echo "<a href='obtener_datos.php?eliminar_actividad=" . urlencode($row["nombre_actividad"]) . "'>Eliminar</a>";
                                          echo "</td>";
                                          echo "</tr>";
                                      }
                                  } else {
                                      echo "<tr><td colspan='3'>No se encontraron registros en la tabla Actividades</td></tr>";
                                  }
                                  ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Modal EDICION ACTIVIDAD -->
          <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editActivityModalLabel">Editar actividad</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form method='POST' action='obtener_datos.php' class='bg-white text-primary'>
                          <div class="modal-body" style='text-align: center;'>
                              <input type='hidden' name='editar_actividad' value='<?php echo isset($nombreActividad) ? htmlspecialchars($nombreActividad) : ""; ?>'>
                              <label for='nombre_actividad' style='font-size: 20px; font-weight: bold;'>Nombre de Actividad</label><br>
                              <input type='text' id='nombre_actividad' name='nuevo_nombre_actividad' value='<?php echo isset($actividad) ? htmlspecialchars($actividad['nombre_actividad']) : ""; ?>' style='font-size: 18px; padding: 5px; text-align: center;'><br><br>
                              <label for='hora_actividad' style='font-size: 20px; font-weight: bold;'>Hora de Actividad</label><br>
                              <input type='text' id='hora_actividad' name='nueva_hora_actividad' value='<?php echo isset($actividad) && is_array($actividad) && isset($actividad['hora_actividad']) ? htmlspecialchars($actividad['hora_actividad']) : ""; ?>' style='font-size: 18px; padding: 5px; text-align: center;'><br><br>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <input type='submit' value='Guardar' style='font-size: 20px; padding: 10px 20px;' class='btn btn-primary'>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
          

          <!-- Modal AGREGAR ACTIVIDAD -->
          <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="addActivityModalLabel">Agregar nueva actividad</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form method='POST' action='obtener_datos.php' class='bg-white text-primary'>
                          <div class="modal-body" style='text-align: center;'>
                              <input type='hidden' name='agregar_actividad' value='1'>
                              <label for='nombre_actividad' style='font-size: 20px; font-weight: bold;'>Nombre de Actividad</label><br>
                              <input type='text' id='nombre_actividad' name='nuevo_nombre_actividad' style='font-size: 18px; padding: 5px; text-align: center; border: 1px solid #ccc;'><br><br>
                              <label for='hora_actividad' style='font-size: 20px; font-weight: bold;'>Hora de Actividad</label><br>
                              <input type='text' id='hora_actividad' name='nueva_hora_actividad' style='font-size: 18px; padding: 5px; text-align: center; border: 1px solid #ccc;'><br><br>
                          </div>
                          <div class="modal-footer" style='justify-content: flex-end;'>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" style='font-size: 20px; padding: 10px 20px;'>Cerrar</button>
                              <input type='submit' value='Agregar' style='font-size: 20px; padding: 10px 20px;' class='btn btn-primary ml-auto'>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
    

              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                            <h4 class="card-title">Inscripciones</h4>
                                <!--<p class="card-description">
                                  Add class <code>.table</code>
                              </p>-->
                            <div class="table-responsive pt-3">
                            <table class="table table-dark">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>DNI</th>
                                      <th>Nombre de Actividad</th>
                                      <th>Fecha de Inscripción</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                              <?php
                                  // Mostrar información de la tabla Inscripciones
                                  if ($result_Inscripciones->num_rows > 0) {
                                      while ($row = $result_Inscripciones->fetch_assoc()) {
                                          echo "<tr>";
                                          echo "<td>" . $row["id"] . "</td>";
                                          echo "<td>" . $row["dni"] . "</td>";
                                          echo "<td>" . $row["nombre_actividad"] . "</td>";
                                          echo "<td>" . $row["fecha_inscripcion"] . "</td>";
                                          echo "<td><a href='?eliminar_inscripcion=" . $row["id"] . "'>Eliminar</a></td>";
                                          echo "</tr>";
                                      }
                                  } else {
                                      echo "<tr><td colspan='5'>No se encontraron registros en la tabla Inscripciones</td></tr>";
                                  }
                                ?>
                              </tbody>
                          </table>

                            </div>
                      </div>
                  </div>
              </div>
            
            
        <!-- content-wrapper ends -->
        <!-- partial:../BootstrapPanelAdmin/template/partials/_footer.html -->
        <footer class="footer">
          <div class="footer-wrap">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href=# target="_blank">AZURE.com </a>2023</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href=# target="_blank"> AZURE</a> Admin</span>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../BootstrapPanelAdmin/template/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../BootstrapPanelAdmin/template/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
