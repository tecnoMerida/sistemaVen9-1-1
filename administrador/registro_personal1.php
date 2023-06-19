<?php
require('../cookie/cookie.php');

session_start();
if (!isset($_SESSION['tipo_rol_id'])) {
  header("Location: ../index.php?error=fuera");
} else {

  if ($_SESSION['tipo_rol_id'] != 1) {
    header('location: ../index.php?error=op');
  } else {
    if ($_POST['usuario'] == $usuario && $_POST['contrasena'] == $clave) {

      extract($_POST);

      // Conexion a la base de datos
      include_once '../config/conexion1.php';

      $personal_usuario = $_SESSION['personal_cedula'];
      $consulta_pers = pg_query($dbconn, "SELECT * FROM public.personal WHERE cedula = $personal_usuario ");
      $regid = pg_fetch_array($consulta_pers);

      $cedula1 = $regid['cedula'];

      $cedula = $_POST['cedula'];
      $p_nombre = $_POST['p_nombre'];
      $s_nombre = $_POST['s_nombre'];
      $p_apellido = $_POST['p_apellido'];
      $s_apelllido = $_POST['s_apelllido'];
      $grado_instruccion_id = $_POST['grado_instruccion_id'];
      $genero_id = $_POST['genero_id'];
      $telefono_celular = $_POST['telefono_celular'];
      $telefono_casa = $_POST['telefono_casa'];
      $correo_electronico = $_POST['correo_electronico'];

?>

      <!-- ********** MEMBRETE SUPERIOR ********* -->
      <?php require_once '../plantillas/superior2.php'; ?>
      <!-- ********** MEMBRETE SUPERIOR ********* -->

      <div class="container body">
        <div class="main_container">
          <!-- ***** Menu Navegacion Panel Derecho ***** -->
          <?php require '../menu/menu_adm.php' ?>
          <!-- ***** /Menu Navegacion Panel Derecho ***** -->
          <!-- ***** Superior menú navegacion ***** -->
          <div class="top_nav">
            <?php require '../menu/menu_top.php' ?>
          </div>
          <!-- ***** /Superior menú navegacion ***** -->

          <!-- *************************************************************************************************** -->
          <!-- ******************************FORMULARIO REGISTRO DE DATOS PERSONALES****************************** -->
          <?php
          require '../formularios/form_registro_personal_estatus.php';
          ?>
          <!-- ***************************************************************************************************** -->
        </div>
      </div>
      <!-- /page content -->


      <!-- ********************************************************************************************** -->



<?php
    }
  }
}
pg_close($dbconn);
?>

<?php require_once '../plantillas/inferior2.php' ?>
