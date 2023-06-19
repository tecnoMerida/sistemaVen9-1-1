<?php
require('cookie/cookie.php');

session_start();
  if(!isset($_SESSION['tipo_rol_id'])){
                header ("Location: index.php?error=fuera");
        }else{
        
            if($_SESSION['tipo_rol_id'] != 3){
                header('location: administrador/principal.php?error=no');
            }else {
                if ($_POST['usuario'] == $usuario && $_POST['contrasena'] == $clave) {

// ZONA HORARIA
date_default_timezone_set('America/Caracas');

// Traer datos por metodo POST
	$accion = $_GET['ac'];
	extract($_POST);

// Conexion con la base de datos
require_once 'config/conexion1.php';

//	if(isset ($_POST)){

	switch ($accion) {
        case 1: // Accion 1 -- Control de Bienes
/***************************************    INICIO CASE 1   ****************************************/
if(isset($_POST)){ // Asigna valores a variables provenientes de POST
            $fecha_creacion = date ("Y/n/j H:m:s");
            $personal_cedula = $_POST['cedula_personal'];
            $grupo_personal_id = $_POST['grupo_personal_id'];

            $materiales_id = '';
                if (isset ($_POST['materiales_recibe'])){
                foreach( $_POST['materiales_recibe'] as $id ){
                    $formato1 = $formato1.' '.$id;
                }
                $materiales_id = implode(', ', $_POST['materiales_recibe']);
            }

            $materiales_recibe = $materiales_id;

            // Asigna valores a variables requeridas en la tabla de bitacora
          $nombre_esquema = 'Control de Bienes Entrada Guardia';
          $nombre_tabla = 'control_bienes';
          $proceso = 'Insertar';
          $valor_nuevo = ''.$_POST['grupo_personal_id'].', '.$materiales_recibe.''; 

            // Inserta nuevo registro en tabla "control_bienes"
        $control_pg = "INSERT INTO public.control_bienes(fecha_creacion, grupo_personal_id, materiales_recibe) VALUES ('$fecha_creacion','$grupo_personal_id','$materiales_recibe')";

        $result = pg_query($dbconn, $control_pg) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error()); 

            // Inserta nuevo registro en tabla "bitacora"
            $bitacora_obs_pg = "INSERT INTO public.bitacora(usuario_aplicacion, nombre_esquema, nombre_tabla, proceso, valor_nuevo, fecha_operacion) VALUES ('$personal_cedula','$nombre_esquema','$nombre_tabla','$proceso','$valor_nuevo','$fecha_creacion')";

        if(pg_query($dbconn, $bitacora_obs_pg) or die ("Upps Fallo conexion con la Tabla Control de Bienes")){ 
        ?>
          <script type="text/javascript">
            alert(" Control de bienes registrado con EXITO!!!");
            window.location="despachador/apertura_guardia.php"
           </script>
        <?php
          }else{ 
            header("Location: despachador/control_bienes_e.php");
          }
    }
/***************************************    FIN BREAK 1   ****************************************/
        break;
        case 2: // Accion 2 -- Apertura Guardia
/***************************************    INICIO CASE 2   ****************************************/
if(isset($_POST)){ // Asigna valores a variables provenientes de POST
                $fecha_inicio_g = date ("Y/n/j H:m:s");
                $apertura_g = strtoupper($_POST['apertura_g']);
                $grupos_guardia_id = $_POST['grupos_guardia_id'];
                $usuario_entrada_id = $_POST['usuario_entrada_id'];
                $control_bienes_id = $_POST['control_bienes_id'];

                // Asigna valores a variables requeridas en la tabla de bitacora
                $nombre_esquema = 'Apertura de guardia';
                $nombre_tabla = 'guardias';
                $proceso = 'Insertar';
                $valor_nuevo = ''.$_POST['grupos_guardia_id'].', '.$_POST['apertura_g'].'';                
                
                //INSERTAMOS nuevo registro en la table "guardias"
        $registro_pg = "INSERT INTO public.guardias(fecha_inicio_g, apertura_g, grupos_guardia_id, usuario_entrada_id, control_bienes_id) VALUES ('$fecha_inicio_g','$apertura_g','$grupos_guardia_id','$usuario_entrada_id','$control_bienes_id')";

        $result = pg_query($dbconn, $registro_pg) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());           
            // Inserta nuevo registro en tabla "bitacora"
        $bitacora_obs_pg = "INSERT INTO public.bitacora(usuario_aplicacion, nombre_esquema, nombre_tabla, proceso, valor_nuevo, fecha_operacion) VALUES ('$usuario_entrada_id','$nombre_esquema','$nombre_tabla','$proceso','$valor_nuevo','$fecha_inicio_g')";

        if(pg_query($dbconn, $bitacora_obs_pg) or die ("Upps Fallo conexion con la Tabla Apertura Guardia")){ 

            ?>
                <script type="text/javascript">
                    alert(" Apertura de guardia registrada con EXITO!!!");
                    window.location="despachador/principal.php"
                </script>
                     <?php 
            }else{
                header("Location: despachador/apertura_guardia.php?msg=1");
            }
        }
/***************************************    FIN BREAK 2   ****************************************/
        break;

	default:
	# code ...
	break;
	}
//}
                      }
          }
}
 pg_close($dbconn); 
?>