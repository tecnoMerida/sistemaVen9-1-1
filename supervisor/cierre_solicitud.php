<?php
require('../cookie/cookie.php');

session_start();
if (!isset($_SESSION['tipo_rol_id'])) {
  header("Location: ../index.php?error=fuera");
} else {

  if ($_SESSION['tipo_rol_id'] != 2 && $_SESSION['tipo_rol_id'] != 1) {
    header('location: ../index.php?error=op');
  } else {
    if ($_POST['usuario'] == $usuario && $_POST['contrasena'] == $clave) {

      // Conexion a la base de datos
      include_once '../config/conexion1.php';

      // Consulta al grupo del personal de guardia
      $consulta1 = pg_query($dbconn, "SELECT * FROM public.personal_grupos_guardia WHERE id=(SELECT MAX(id) FROM  personal_grupos_guardia)");
      $reg_01 = pg_fetch_array($consulta1);

      $fecha_inicio = $reg_01['fecha_asig'];
      $personal_guardia = $reg_01['id'];
      $grupos_guardia = $reg_01['grupos_guardia_id'];

      // Consulta al personal de guardia
      $personal_usuario = $_SESSION['personal_cedula'];
      $consulta_pers = pg_query($dbconn, "SELECT * FROM public.personal WHERE cedula = $personal_usuario ");
      $regid = pg_fetch_array($consulta_pers);

      $cedula_personal = $regid['cedula'];

      // Consulta datos del personal de guardia
      $ultimo1 = pg_query($dbconn, "SELECT id, fecha_inicio_g::timestamp::date, grupos_guardia_id, usuario_entrada_id  
      FROM public.guardias
      WHERE usuario_entrada_id = $cedula_personal
      AND fecha_inicio_g::timestamp::date = (SELECT MAX(fecha_inicio_g::timestamp::date) FROM guardias) order by id DESC");
      $reg_id = pg_fetch_array($ultimo1);

      $grupos01 = $reg_id['id'];

?>

      <!-- ***** Membrete ***** -->
      <?php require_once '../plantillas/superior3.php'; ?>
      <!-- ***** Membrete ***** -->

      <div class="container body">
        <div class="main_container">
          <!-- ********** Menu Navegacion Panel Derecho ********* -->
          <?php
          if ($_SESSION['tipo_rol_id'] != 1) {
            require '../menu/menu_sup.php';
          } else {
            require '../menu/menu_adm.php';
          }
          ?>

          <!-- top navigation -->
          <div class="top_nav">
            <?php require '../menu/menu_top.php' ?>
          </div>
          <!-- /top navigation -->
          <!-- /top navigation -->
          <!-- *************************************************************************************************** -->
          <!-- page content -->
          <div class="right_col" role="main">
            <div class="">
              <div class="page-title">
                <div class="title_left">
                  <h4>CONSULTA SOLICITUD</h4>
                </div>
              </div>

              <div class="clearfix"></div>

              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Buscar</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
                            <div class="col-md-8 col-sm-8 ">
                              <p class="text-muted font-13 m-b-30">
                                Realize una busqueda por </p>
                            </div>
                            <!-- ***********************     FIN FORMULARIO BUSQUEDA DE BIENES     **************************** -->
                            <?php
                            /**********************************     FILTRO DE BUSQUEDA      ********************************/

                            if ($buscar == '') {
                              $filtro = "INNER JOIN public.solicitante ON solicitante.id = solicitudes.solicitante_id
  INNER JOIN public.motivo_solicitud ON solicitante.motivo_solicitud_id = motivo_solicitud.id
  WHERE solicitudes.fecha_sol = '$fecha_inicio' AND solicitudes.estatus_solicitud_id = 5 ORDER BY fecha_creacion_sol ASC";
                            } else {
                              if ($buscar != '') {
                                $id = $buscar;
                                $filtro1 = "WHERE id = $id ";
                                $consulta = pg_query($dbconn, "SELECT id, tiempo_apertura_sol, fecha_sol, hora_sol, solicitante_id, fecha_creacion_sol FROM public.solicitudes $filtro1 ");
                                $reg01 = pg_fetch_array($consulta);

                                if ($reg01) {
                                  $id = $reg01['id'];
                                  $filtro = "WHERE id = '$id' ";
                                }
                              }
                            }
                            /********************************     FIN FILTRO BUSQUEDA     ************************************/
                            /********************************     CONSULTA DESPUES DEL FILTRO     ***************************/

                            $consulta_pag = pg_query($dbconn, "SELECT solicitudes.id, solicitudes.tiempo_apertura_sol, solicitudes.fecha_sol, solicitudes.hora_sol, solicitudes.solicitante_id, solicitudes.estatus_solicitud_id, solicitudes.fecha_creacion_sol,
solicitante.p_nombre_sol, solicitante.p_apellido_sol, solicitante.telefono_celular_sol, solicitante.motivo_solicitud_id, solicitante.organismos_solicitud_id,
motivo_solicitud.nombre_motivo
FROM public.solicitudes $filtro");
                            $reg_pag = pg_fetch_array($consulta_pag);

                            $total_rows_pag = pg_fetch_all($consulta_pag);

                            ?>
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Fecha</th>
                                  <th>Hora</th>
                                  <th>Solicitante</th>
                                  <th>Motivo</th>
                                  <th>Acción</th>
                                </tr>
                              </thead>


                              <tbody>
                                <!--  *****************************   TABLA DE FORMULARIO     *************************************  -->

                                <?php
                                if ($total_rows_pag != 0) {

                                  //impresion de los datos.
                                  do {
                                    // MUESTRA LOS VALORES DE LA CONSULTAS

                                    echo "<tr align='center' ><td>" . $reg_pag['id'] . "</td>\n";
                                    echo "<td>" . strtoupper($reg_pag['fecha_sol']) . "</td>\n";
                                    echo "<td>" . strtoupper($reg_pag['hora_sol']) . "</td>\n";
                                    $id_solicitante = $reg_pag['solicitante_id'];
                                    // consulta Tabla de Solicitante
                                    $consulta_org = pg_query($dbconn, "SELECT id, p_nombre_sol, p_apellido_sol, motivo_solicitud_id FROM public.solicitante WHERE id = '$id_solicitante' ");
                                    $reg1 = pg_fetch_array($consulta_org);
                                    echo "<td>" . strtoupper($reg1['p_nombre_sol']) . " " . strtoupper($reg1['p_apellido_sol']) . "</td>\n";
                                    $motivo = $reg1['motivo_solicitud_id'];
                                    // consulta Tabla de Motivos
                                    $consulta_motivo = pg_query($dbconn, "SELECT * FROM public.motivo_solicitud WHERE id = $motivo ");
                                    $reg_motivo = pg_fetch_array($consulta_motivo);
                                    echo "<td>" . strtoupper($reg_motivo['nombre_motivo']) . "</td>\n";
                                    echo "<td><a href=cierre_solicitud1.php?id=" . $reg_pag['id'] . " target='_blank'><button class='btn btn-primary' type='submit' action='' value='EDITAR'>EDITAR</button></a></td>\n";
                                  } while ($reg_pag = pg_fetch_array($consulta_pag));
                                  pg_free_result($consulta_pag);
                                } else {
                                  // si no existen datos muestra mensaje
                                  echo "<tr><br/><td colspan='1'></td>";
                                  echo "<td colspan='4' align='center' ><div class='alert alert-secondary msn1'><strong>No se obtuvieron resultados</strong></div></td>";
                                  echo "<td colspan='1'></td></tr>";
                                }
                                ?>
                              </tbody>
                            </table>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- /page content -->


                <!-- ********************************************************************************************** -->


          <?php
        }
      }
    }

          ?>



          <?php require_once '../plantillas/inferior3.php' ?>