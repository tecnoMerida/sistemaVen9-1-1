                  <div id="step-1">
                        <h2 class="StepTitle">Solicitud</h2>
                  
<!-- ****************************************************************************************************** -->                    
<!-- ////////////////////////////////    SOLICITUDES    /////////////////////////////////////////////////// -->

<!-- ****************************************************************************************************** -->
                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align"></label>
                      <div class="col-md-6 col-sm-6">
                        <strong>Los campos que contengan (<font COLOR="#FF0000">*</font>) son de asignación obligatoria</strong>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Hora de apertura de la Solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="tiempo_apertura_sol">Tiempo de Apertura:<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="time" class="form-control" name="tiempo_apertura_sol" id="tiempo_apertura_sol" placeholder="Tiempo de apertura" required value="<?php echo $tiempo_apertura= date ('H:m:s');?>" title="Llene este campo con la hora de apertura de la solicitud" />
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Fecha de la solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="fecha_sol">Fecha Solicitud:<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="date" class="form-control" name="fecha_sol" id="fecha_sol" placeholder="Fecha solicitud" value="<?php echo $fecha_solicitud= date ("Y-n-j");?>" title="Llene este campo con la fecha de solicitud" required/>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Hora de la Llamada de la Solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="hora_sol">Hora de Solicitud:<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="time" class="form-control" name="hora_sol" id="hora_sol" placeholder="Ingrese hora solicitud" value="<?php echo $hora_sol= date ('H:m:s');?>" required title="Llene este campo con la hora de llamada de solicitud" />
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Hora de cierre de la Solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="hora_cierre_sol">Hora de Cierre:<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="time" class="form-control" name="hora_cierre_sol" id="hora_cierre_sol" placeholder="Ingrese hora cierre" required title="Llene este campo con la hora de cierre de la solicitud" />
                      </div>
                    </div>

                    </div>
<!-- ******** STEP 2 *********-->                      
                    <div id="step-2">
                        <h2 class="StepTitle">Solicitante</h2>
                    
<!-- ************************************************************************************************** -->

<!-- ////////////////////////////////    SOLICITANTE  ///////////////////////////////////////////////// -->

<!-- ************************************************************************************************** -->
                    <div class="field item form-group"><!-- // número de telefono de quien realiza la llamada // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="telefono_celular_sol">Número de Teléfono:<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <input type="text" name="telefono_celular_sol" id="telefono_celular_sol" class="form-control" title="Llene este campo con el número de teléfono de quien realiza la llamada (agregando código de area o compañía de servicio)" placeholder="Número teléfono" maxlength="14" required='required' data-validate-length-range="14,14" data-inputmask="'mask' : '(999) 999-9999'" pattern="[0-9() -]{11,14}">
                      </div>
                      <div class="col-md-6 col-sm-6">
                          <p>Ej: (424) 765-4321</p>
                        </div>
                    </div>

                    <div class="field item form-group"><!-- // nombre y apellido de la persona que llama // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="p_nombre_sol">Nombre Solicitante:<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-3 col-sm-3">
                        <input type="text" name="p_nombre_sol" id="p_nombre_sol" class="form-control" placeholder="Nombre solicitante" minlength="2" maxlength="40" value="" title="Llene este campo con nombre y apellido de quien realiza la llamada" pattern="[A-Za-z -]{2,40}" required />
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <input type="text" id="p_apellido_sol" name="p_apellido_sol" class="form-control" placeholder="Apellido solicitante" minlength="2" maxlength="40" value="" title="Llene este campo con nombre y apellido de quien realiza la llamada" pattern="[A-Za-z -]{2,40}" required />
                      </div>
                    </div>

                      <?php /********* Seleccion del Organismo que Realiza la llamada de Solicitud ***********/
                      // Consulta a la Base de Datos
                          $result = pg_query($dbconn, "SELECT * FROM organismos_solicitud");
                          if (!$result) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                      ?>
                    <div class="field item form-group">
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="organismos_solicitud_id">Organismo:</label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="organismos_solicitud_id" id="organismos_solicitud_id" title="Seleccione si la llamada recibida es por uno de los organos de servicio o seguridad del estado" >
                            <option>--Seleccione--</option>
                            <?php
                              while($registro=pg_fetch_array($result))
                              { 
                            ?>
                            <option name="id" value="<?php echo $registro[0] ?> "><?php echo strtoupper($registro[1]); ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                    </div>

					         <?php /********* Seleccion del Motivo de la llamada de Solicitud ***********/
                      		// Consulta a la Base de Datos Tabla Motivos por Grupo
                          $result44 = pg_query($dbconn, "SELECT * FROM motivo_solicitud_grupo ORDER BY id");
                          if (!$result44) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }

                      ?>
                    <div class="field item form-group">
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="motivo_solicitud_id">Motivo:<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="motivo_solicitud_id" id="motivo_solicitud_id" title="Seleccione este campo con el motivo de la solicitud" required>
                            <option value="">--Seleccione--</option>
                            <?php
                							while($registro44=pg_fetch_array($result44))
                              {
                                $grupo = strtoupper($registro44[0]);
                              	?>
	                              <optgroup label="<?php echo $registro44[1] ?>" value="<?php echo $grupo ?>">
	                        <?php 
	                        // Consulta a la Base de Datos Tabla Motivos Solicitud     	
                          $result45 = pg_query($dbconn, "SELECT * FROM motivo_solicitud WHERE motivo_grupo_id = '$registro44[0]' ORDER BY id ");
                          if (!$result45) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                              while($registro45=pg_fetch_array($result45))
                              { 
                            ?>

                            <option name="id" value="<?php echo $registro45['id'] ?> "><?php echo strtoupper($registro45[1]); ?></option>
                            <?php 
                              }
                              ?>
                              </optgroup>
                          <?php
                          }
                            ?>
                          </select>
                      </div>
                    </div>

                    </div>
<!-- ********* STEP 3 ********* -->
                      <div id="step-3">
                        <h2 class="StepTitle">Detalles</h2>

<!-- ************************************************************************************************* -->

<!-- /////////////////////////////////  ATENCION DE SOLICITUD   /////////////////////////////////////  -->

<!-- ************************************************************************************************* -->
                      <div class="field item form-group"><!-- //      direccion donde ocurre el evento   //    -->
                        <label class="col-form-label col-md-3 col-sm-3  label-align" for="direccion_solicitud">Dirección<span class="required"><font COLOR="#FF0000">*</font></span></label>
                        <div class="col-md-6 col-sm-6">
                          <textarea type="text" name="direccion_solicitud" id="direccion_solicitud" class="resizable_textarea form-control" placeholder="Dirección del hecho de la solicitud" minlength="8" maxlength="400" title="Llene este campo con dirección exacta del lugar del evento" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{8,400}" required ></textarea>
                        </div>
                      </div>

                      <div class="field item form-group"><!-- //       detalles de la novedad           //  -->
                        <label class="col-form-label col-md-3 col-sm-3  label-align" for="detalles_solicitud">Detalles<span class="required"><font COLOR="#FF0000">*</font></span></label>
                        <div class="col-md-6 col-sm-6">
                          <textarea type="text" name="detalles_solicitud" id="detalles_solicitud" class="resizable_textarea form-control" placeholder="Detalles de la solicitud" minlength="8" maxlength="500" title="Llene este campo con detalles del evento" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{8,500}" required ></textarea>
                        </div>
                      </div>

                      <div class="field item form-group"><!-- //     procedimiento realizado de la novedad   //  -->
                        <label class="col-form-label col-md-3 col-sm-3  label-align" for="procedimiento_solicitud">Procedimiento<span class="required"><font COLOR="#FF0000">*</font></span></label>
                        <div class="col-md-6 col-sm-6">
                          <textarea type="text" name="procedimiento_solicitud"  id="procedimiento_solicitud" class="resizable_textarea form-control" placeholder="Procedimiento en el sitio de la solicitud" minlength="8" maxlength="500" title="Llene este campo con el procedimiento realizado por los funcionarios en el lugar del evento" required pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{8,500}" required ></textarea>
                        </div>
                      </div> 

                    <div class="field item form-group"><!-- //    numeros de fallecidos en caso de haber    //   -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="num_fallecidos">Fallecidos<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="number" name="num_fallecidos" id="num_fallecidos" class="form-control" placeholder="Nº fallecidos" required min="0" max="999" step="1" data-validate-minmax="0,999" title="Llene este campo con el número de fallecidos en caso de existir" />
                      </div>
                      <div class="col-md-3 col-sm-3">
                      <STRONG><u>Nota:</u> Llenar el campo con ceros en caso de no existir fallecidos, lesionados o heridos</STRONG>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- //    numeros de lesionados en caso de haber    //   -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="num_lesionados">Lesionados<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="number" name="num_lesionados" id="num_lesionados" class="form-control" placeholder="Nº lesionados" required min="0" max="999" step="1" data-validate-minmax="0,999" title="Llene este campo con el numero de lesionados en caso de existir" />
                      </div>
                    </div>   

                    <div class="field item form-group"><!-- //   numeros de lesionados en caso de haber  //    -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="num_heridos">Heridos<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="number" name="num_heridos" id="num_heridos" class="form-control" placeholder="Nº heridos" required min="0" max="999" step="1" data-validate-minmax="0,999" title="Llene este campo con el numero de heridos en caso de existir" />
                      </div>
                    </div>

                    </div>
<!-- ********* STEP 4 ********* -->
                      <div id="step-4">
                        <h2 class="StepTitle">Ubicación</h2>

<!-- ************************************************************************************************* -->

<!-- ///////////////////////////////////  ATENCION DE SOLICITUD   ///////////////////////////////////  -->

<!-- ************************************************************************************************* -->
       
<?php 
// Creación y/o formación de la consulta.
$result3 = pg_query($dbconn, "SELECT * FROM public.estados WHERE id = 14 ");
    if (!$result3) {
        echo "Ocurrió un error.\n";
        exit;
        }
?>
                   <div class="field item form-group"><!-- // Seleccion del Municipio donde ocurrio el evento //-->
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="cboEstado">Estado<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="estados" id="cboEstado" title="Selecciones Estado en que sucede el evento de solicitud" required>
                            <option value=''>-Seleccione Estado-</option>
                    <?php
                 // Validar el estatus de ejecución de la consulta.
                        while($row = pg_fetch_array($result3)){
                            echo "<option value='".$row['id']."'>".$row['nombre_estado']."</option>";
                            }

                    ?>
                          </select>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Seleccion del Municipio donde ocurrio el evento //-->
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="cboMunicipio">Municipio<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="municipios" id="cboMunicipio" title="Selecciones municipio en que sucede el evento de solicitud" required>
                              <option value=''>-Seleccione Municipio-</option>

                          </select>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Seleccion del Parroquia donde ocurrio el evento //-->
                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="cboParroquia">Parroquia<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                        <div class="col-md-6 col-sm-6">
                        <select class="form-control" name="parroquias_id" id="cboParroquia" title="Seleccione parroquia en que sucede el evento de solicitud" required>
                          <option value="">-Seleccione Parroquia-</option>
                        </select>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- // Seleccion del Sector donde ocurrio el evento //-->
                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="cboSectores">Sector<span
                          class="required"><font COLOR="#FF0000">*</font></span></label> 
                        <div class="col-md-6 col-sm-6">
                        <select class="form-control" name="sector_sol" id="cboSectores" title="Seleccione sector en que sucede el evento de solicitud" required>
                          <option value="">-Seleccione Sector-</option>
                        </select>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- //       ingreso un Lugar o Sitio de Referencia    //-->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="punto_referencia_sol">Punto Referencia<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="varchar" name="punto_referencia_sol" id="punto_referencia_sol" class="form-control" placeholder="Lugar o sitio referencia" minlength="2" maxlength="40" title="Llene este campo con lugar o sitio de referencia" pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð -]{2,40}" required />
                      </div>
                    </div>

                      <?php /********* Seleccion el estatus de la Solicitud ***********/
                      // Consulta a la Base de Datos
                          $result5 = pg_query($dbconn, "SELECT * FROM estatus_solicitud");
                          if (!$result5) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                      ?>
                    <div class="field item form-group"><!-- // Seleccion del Estatus de la Solicitud //-->
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="estatus_solicitud_id">Estatus<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="estatus_solicitud_id" id="estatus_solicitud_id" title="Llene este campo con la situación de la solicitud" required>
                            <option value="">--Seleccione--</option>
                            <?php
                              while($registro5=pg_fetch_array($result5))
                              { 
                            ?>
                            <option name="id" value="<?php echo $registro5[0] ?> "><?php echo strtoupper($registro5[1]); ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                    </div>

                    </div>
<!-- ********** STEP 5 ********** -->                      
                      <div id="step-5">
                        <h2 class="StepTitle">Atención</h2>

<!-- ************************************************************************************************* -->

<!-- ///////////////////////////////////////    SOLICITUD ATENCION    //////////////////////////////// -->

<!-- ************************************************************************************************* -->
                  <?php
                  $consulta_op = pg_query($dbconn, "SELECT * FROM public.personal WHERE grupo_guardia_id =$grupos_guardia AND estatus_personal_id = 1 AND organismos_id = 9");
                  if (!$consulta_op) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                  ?>
                    <div class="field item form-group"><!-- // nombre del operador que recibe la llamada // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="operador_solicitud">Operador<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="operador_solicitud" id="operador_solicitud" title="Llene este campo con nombre del Operador que recibe la solicitud" required>
                            <option value="">--Seleccione--</option>
                            <?php
                              while($reg_operador=pg_fetch_array($consulta_op))
                              { 
                            ?>
                            <option name="id" value="<?php echo $reg_operador['cedula'] ?> "><?php echo strtoupper($reg_operador['p_nombre']); echo " "; echo strtoupper($reg_operador['p_apellido']); ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                    </div>

                  <?php
                  $consulta_desp = pg_query($dbconn, "SELECT * FROM public.personal WHERE grupo_guardia_id =$grupos_guardia AND estatus_personal_id = 1 AND (organismos_id = 3 OR organismos_id = 2 OR organismos_id = 1)");
                  if (!$consulta_desp) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                  ?>
                    <div class="field item form-group"><!-- // nombre del despachador que atiende de la novedad // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="despachador_solicitud">Despachador<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="despachador_solicitud" id="despachador_solicitud" title="Llene este campo con nombre de despachador de unidades de la llamada de solictitud" required>
                            <option value="">--Seleccione--</option>
                            <?php
                              while($reg_despachador=pg_fetch_array($consulta_desp))
                              { 
                            ?>
                            <option name="id" value="<?php echo $reg_despachador['cedula'] ?> "><?php echo strtoupper($reg_despachador['p_nombre']);  echo " "; echo strtoupper($reg_despachador['p_apellido']); ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                    </div>

                    <div class="field item form-group"><!-- //  tiempo de respuesta de la Solicitud  // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="tiempo_respuesta_sol">Tiempo de Respuesta<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-2 col-sm-2">
                        <b>hora</b>
                        <input type="number" class="form-control" name="tiempo_respuesta_sol" id="tiempo_respuesta_sol" required min="0" max="12" step="1" data-validate-minmax="0,12" title="Rellene este campo con Horas de tiempo de respuesta" />
                      </div>

                      <div class="col-md-2 col-sm-2">
                      <b>minuto</b>
                        <input type="number" class="form-control" name="tiempo_respuesta_sol1" id="tiempo_respuesta_sol1" required min="0" max="59" step="1" data-validate-minmax="0,59" title="Rellene este campo con Minutos de tiempo de respuestas" />
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <STRONG><b><u>Nota:</u> Llenar el campo con ceros en caso de no <br/>haber transcurrido tiempo mayor a una hora</b></STRONG>
                      </div>
                    </div>

                      <?php /********* Seleccion del Organismo que Realiza la llamada de Solicitud ***********/
                      // Consulta a la Base de Datos
                          $result6 = pg_query($dbconn, "SELECT * FROM organismos_solicitud");
                          if (!$result6) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                      ?>
                    <div class="field item form-group"><!-- // Organismos participantes en la Solicitud  //-->
                         <label class="col-form-label col-md-3 col-sm-3  label-align" for="organismos_solicitud_id">Organismo en Sitio:<span class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select name="organismos_solicitud_id" id="organismos_solicitud_id" class="select2_multiple form-control" multiple="multiple" title="Organismo presente el el lugar del evento" required>
                            <option value="">--Seleccione--</option>
                            <?php
                              while($registro6=pg_fetch_array($result6))
                              { 
                                
                            ?>
                            <option name="id" value="<?php echo $registro6[0] ?> "><?php echo strtoupper($registro6[1]); ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <STRONG><b><u>Nota:</u> Presione CTRL + CLICK con el mouse, para seleccionar varios organismos</b></STRONG>
                      </div>
                    </div>
  
                    <div class="field item form-group"><!-- // Llamada recibida es de algun trabajor o Funcionario Publico // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="funcionario">Funcionario<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <div id="" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione si llamada recibida o solicitud, es de Funcionario Público">
                              <input type="radio" name="funcionario" value="1" class="flat" checked="checked" required > &nbsp; SI&nbsp;
                            </label>
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione si llamada recibida o solicitud, No es Funcionario Público">
                              <input type="radio" name="funcionario" value="0" class="flat" required > &nbsp; NO&nbsp;
                            </label>
                          </div>
                    </div>
                  </div>

                    <div class="field item form-group"><!-- // Llamada recibida es de algun trabajor o amigo de la institucion 171/911 // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="amigo171">Amigo 171<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <div id="" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione si llamada recibida o solicitud, es amigo de la Institución 171">
                              <input type="radio" name="amigo171" value="1" class="flat" checked="checked" required > &nbsp; SI&nbsp;
                            </label>
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione si llamada recibida o solicitud, No es amigo de la Institución 171">
                              <input type="radio" name="amigo171" value="0" class="flat" required > &nbsp; NO&nbsp;
                            </label>
                          </div>
                    </div>
                    </div>

                    <div class="field item form-group"><!-- // Motos en sitio de solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="motos">Motos<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-3 col-sm-3">
                        <div id="" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione este campo Si hubo presencia de motos en el sitio">
                              <input type="radio" name="motos" value="1" class="flat" checked="checked" required > &nbsp; SI&nbsp;
                            </label>
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione este campo No hubo presencia de motos en el sitio">
                              <input type="radio" name="motos" value="0" class="flat" required > &nbsp; NO&nbsp;
                            </label>
                          </div>
                    </div>
                          <div class="col-md-2 col-sm-2">
                           <input type="number" name="num_motos" class="form-control" placeholder="Nº Motos" min="0" max="999" step="1" data-validate-minmax="0,999" title="Llene este campo con el número de motos en el sitio en caso de existir" required>
                          </div>
                          <div class="col-md-1 col-sm-1"></div>
                          <div class="col-md-3 col-sm-3">
                            <STRONG><b><u>Nota:</u> Llene los campo de Motos y Vehículos con cero en caso de no existir</b></STRONG>
                          </div>                    
                    </div>

                    <div class="field item form-group"><!-- // Vehiculos en sitio de solicitud // -->
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="vehiculos">Vehículos<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-3 col-sm-3">
                        <div id="" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione este campo Si hubo presencia de Vehículos en el sitio">
                              <input type="radio" name="vehiculos" value="1" class="flat" checked="checked" required > &nbsp; SI&nbsp;
                            </label>
                            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" title="Seleccione este campo No hubo presencia de Vehículos en el sitio">
                              <input type="radio" name="vehiculos" value="0" class="flat" required > &nbsp; NO&nbsp;
                            </label>
                          </div>
                    </div>
                          <div class="col-md-2 col-sm-2">
                           <input type="number" name="num_vehiculos" class="form-control" placeholder="Nº Vehículos" min="0" max="999" data-validate-minmax="0,999" title="Llene este campo con el número de vehículos en el sitio en caso de existir" required>   
                            </div>                   
                    </div>
                                            
                   <div><!-- //     Registro de fecha tomada por en sistema      //     -->
                         <input type="hidden" name="guardias_id" id="guardias_id" value="<?php echo $grupos01;?>" required />
                   </div>
                   <div><!-- //     Registro de fecha tomada por en sistema      //     -->
                         <input type="hidden" name="cedula_personal" id="cedula_personal" value="<?php echo $cedula_personal;?>" required />
                   </div>

           
                    <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                    <button type='submit' class="btn btn-primary">Guardar</button>
                    <button type='reset' class="btn btn-success">Limpiar</button>
                        </div>
                      </div>
                    
                      </div>