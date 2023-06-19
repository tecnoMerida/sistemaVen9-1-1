<?php
require('../cookie/cookie.php');

session_start();
  if(!isset($_SESSION['tipo_rol_id'])){
                header ("Location: ../index.php?error=fuera");
        }else{
        
            if($_SESSION['tipo_rol_id'] != 2 && $_SESSION['tipo_rol_id'] != 1){
                header('location: ../index.php?error=op');
            }else {
                if ($_POST['usuario'] == $usuario && $_POST['contrasena'] == $clave) {

// Conexion a la base de datos
include_once '../config/conexion1.php';

// Consulta al grupo del personal de guardia
$consulta1 = pg_query($dbconn, "SELECT * FROM public.personal_grupos_guardia WHERE id=(SELECT MAX(id) FROM  personal_grupos_guardia)");
$reg_01= pg_fetch_array($consulta1);

$personal_guardia = $reg_01['id'];
$grupos_guardia = $reg_01['grupos_guardia_id'];

// Consulta al personal de guardia
$personal_usuario = $_SESSION['personal_cedula'];
$consulta_pers = pg_query($dbconn,"SELECT * FROM public.personal WHERE cedula = $personal_usuario ");
$regid= pg_fetch_array($consulta_pers);

$cedula_personal = $regid['cedula'];

//$consulta2 = pg_query($dbconn, "SELECT * FROM public.personal_datos WHERE personal_grupos_guardia_id =$personal_guardia");
//$reg_02= pg_fetch_array($consulta2);

//$cedula_sup = $reg_02['personal_cedula_sup'];
//$cedula_aux = $reg_02['personal_cedula_aux'];

// Consulta datos del personal de guardia
//$ultimo1 = pg_query($dbconn,"SELECT id, fecha_inicio_g, grupos_guardia_id, usuario_entrada_id FROM public.guardias WHERE (usuario_entrada_id = $cedula_sup OR usuario_entrada_id = $cedula_aux) AND fecha_inicio_g=(SELECT MAX(fecha_inicio_g) FROM  guardias)");
//$reg_id= pg_fetch_array($ultimo1);

$ultimo1 = pg_query($dbconn,"select id, fecha_inicio_g::timestamp::date, grupos_guardia_id, usuario_entrada_id  
FROM public.guardias
WHERE usuario_entrada_id = $cedula_personal
AND fecha_inicio_g::timestamp::date = (SELECT MAX(fecha_inicio_g::timestamp::date) FROM guardias) order by id DESC");
$reg_id= pg_fetch_array($ultimo1);

$grupos01 = $reg_id['id'];
//$cedula_personal = $reg_id['usuario_entrada_id'];
?>

<!-- ***** Membrete ***** -->
<?php require_once '../plantillas/superior2.php'; ?>
<!-- ***** Membrete ***** -->

    <div class="container body">
      <div class="main_container">
<!-- ********** Menu Navegacion Panel Derecho ********* -->
      <?php 
      if ($_SESSION['tipo_rol_id'] != 1) {
          require '../menu/menu_sup.php';        
      }else{
        require '../menu/menu_adm.php';
      }
      ?>

        <!-- top navigation -->
        <div class="top_nav">
          <?php require '../menu/menu_top.php' ?>
        </div>
        <!-- /top navigation -->
<!-- *************************************************************************************************** -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h4>NUEVA SOLICITUD</h4>
              </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registrar</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

<!-- ***********************************  INICIO SECCION DE MENSAJES ************************************** -->
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-6" align="center">
              <?php
                  if ($_GET[msg] == "1") {
              echo '<div class="alert alert-danger alert-dismissible msn1">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>El Registro ya Existe!!!</strong></div>';
              } 
              if ($_GET[msg] == "2") {
              echo '<div class="alert alert-success alert-dismissible msn1">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Bienes registrado con EXITO!!!</strong></div>';

              }
              elseif ($_GET[msg] == "3") {
              echo '<div class="alert alert-secondary alert-dismissible msn1">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Bienes NO registrado</strong></div>';
              }
             
              ?>                
                </div>
                    <div class="col-md-3 col-sm-3"></div>

                <br/><br/><br/><br/>
<!-- ****************************** Fin seccion de mensajes ********************************************* -->                
                    <!-- Smart Wizard -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Solicitud<br />
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Solicitante<br />
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Detalles<br />
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Ubicación<br />
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-5">
                            <span class="step_no">5</span>
                            <span class="step_descr">
                                              Atención<br />
                                          </span>
                          </a>
                        </li>
                      </ul>
<!-- ********* STEP 1 ********* -->
                  <div>
                    <form class="" action="../insertar_guardia.php?ac=1" method="post" id="demo-form" data-parsley-validate>

                            <!-- ***************************************** -->

                            <?php require '../formularios/form_registro_nueva_solicitud.php'; ?>

                            <!-- ***************************************** -->
                            
                    </form>
                  </div>
                    </div>
                    <!-- End SmartWizard Content -->

  
                  </div>
                </div>
              </div>
            </div>


<!-- ***************************************************************************************************** -->
          </div>
        </div>
        <!-- /page content -->


<!-- ********************************************************************************************** -->

        <!-- footer content -->
        <footer>
          <?php require '../menu/footer.php' ?>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <?php 
                  }
          }
}

 ?>
 
<script language="javascript" src="../js/jquery-1.2.6.min.js"></script>
    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/combo1.js"></script>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>

    <!-- jquery.inputmask -->
    <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>



  </body>
</html>
