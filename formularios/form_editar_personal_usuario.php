            <!-- Seccion Siete -->

            <div class="panel">
                <a class="panel-heading" role="tab" id="headingSeven" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                    <h4 class="panel-title">Usuario</h4>
                </a>
                <div id="collapseSeven" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingSeven">
                    <div class="panel-body">

                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="usuario">Usuario<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese nombre usuario" minlength="6" maxlength="20" value="<?php echo $usuario['usuario']; ?>" title="Llene este campo con el nombre de usuario, para acceder al sistema 'Libro Digital de Novedades 911'" autofocus pattern="[A-Za-z0-9]{6,20}" required="required" readonly/>
                      </div>
                      <div class="col-md-6 col-sm-6">
                                 <p>Usuario: entre 6 y 10 dígitos usando</br>mayúsculas, minúsculas y números</p>
                               </div>
                    </div>

                    <div class="field item form-group">
                      <label class="col-form-label col-md-3 col-sm-3  label-align" for="contrasena">Contraseña<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" name="contrasena" id="contrasena" class="form-control" placeholder="Ingrese contraseña usuario" minlength="6" maxlength="16" value="<?php $usuario['contrasena']; echo '********'; ?>" title="Llene este campo con la contraseña de usuario, para acceder al sistema 'Libro Digital de Novedades 911', entre 6 y 16 dígitos" pattern="[A-Za-z0-9&%$!*+@#]{6,16}" required="required" />
                      </div>
                      <div class="col-md-6 col-sm-6">
                                 <p>Contraseña: entre 6 y 16 dígitos</br>usando mayúsculas, minúsculas,</br>números y & % $ ! * + @ # </p>
                               </div>
                    </div>

                      <?php
                      // Consulta Base de Datos con valor del Rol
                        $rol1 = $usuario['tipo_rol_id'];
                          $result_rol = pg_query($dbconn, "SELECT * FROM tipo_rol WHERE id = $rol1 ");
                          $con_rol = pg_fetch_array($result_rol);
                          if (!$result_rol) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }


                      // Consulta a la Base de Datos
                          $result8 = pg_query($dbconn, "SELECT * FROM tipo_rol");
                          if (!$result8) {
                          echo "Ocurrió un error.\n";
                          exit;
                          }
                      ?>
                    <div class="field item form-group">
                         <label class="col-form-label col-md-3 col-sm-3  label-align">Rol<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6">
                          <select class="form-control" name="tipo_rol_id" title="Seleccione el rol que le corresponde" required>
                            <option value="<?php echo $con_rol['id']; ?>"><?php echo strtoupper($con_rol['tipo_rol']); ?></option>
                            <?php
                              while($registro8=pg_fetch_array($result8))
                              { 
                            ?>
                            <option name="id" value="<?php echo $registro8[0] ?> "><?php echo strtoupper($registro8[1]) ?></option>
                            <?php 
                              }
                            ?>
                          </select>
                      </div>
                    </div>



                    <div class="field item form-group">
                         <label class="col-form-label col-md-3 col-sm-3  label-align">Estatus Usuario<span
                          class="required"><font COLOR="#FF0000">*</font></span></label>
                      <div class="col-md-6 col-sm-6"><p>
                          <?php
                          $eusuario = $usuario['estado_usuario_id'];
                            if ($eusuario == '1'){
                             echo 'Activo:'; ?>
                            <input type="radio" class="flat" name="estado_usuario_id" title="Seleccione Si el Usuario se encuentra activo" id="genderM" value="1" checked required="required" />
                            <?php echo 'Inactivo:'; ?>
                            <input type="radio" class="flat" name="estado_usuario_id" title="Seleccione No el Usuario se encuentra inactivo" id="genderF" value="2" required="required"/>
                            <?php                                 
                                }else{
                            echo 'Activo:'; ?>
                            <input type="radio" class="flat" name="estado_usuario_id" title="Seleccione Si el Usuario se encuentra activo" id="genderM" value="1" required="required"/>
                            <?php echo 'Inactivo:'; ?>
                            <input type="radio" class="flat" name="estado_usuario_id" title="Seleccione No el Usuario se encuentra inactivo" id="genderF" value="2" checked required="required"/>
                            <?php
                                }
                            ?>
                          </p></div>
                      </div>
            
                    <input type="hidden" name="id" id="id" value="<?php echo $usuario['id'];?>" required />
                    <input type="hidden" name="personal_cedula" id="personal_cedula" value="<?php echo $cedula1;?>" required />
                    <input type="hidden" name="fecha_creacion" id="fecha_creacion" value="<?php echo $usuario['fecha_creacion']; ?>" required />
                    <input type="hidden" name="preguntas_seguridad_id" id="preguntas_seguridad_id" value="<?php echo $usuario['preguntas_usuario_id']; ?>" required />

                    <input type="hidden" name="fecha_modificacion" id="fecha_modificacion" value="<?php echo $fecha_modificacion= date ("Y/n/j H:m:s");?>" required />

                    <input type="hidden" name="cedula_usuario" id="cedula_usuario" value="<?php echo $cedula;?>" required />

                    <div class="ln_solid">
                      <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                    <button type='submit' class="btn btn-primary">Actualizar</button>
                    <button type='reset' class="btn btn-success">Limpiar</button>
                        </div>
                      </div>
                    </div></br></br>

                    </div>
                </div>
            </div>

            <!-- Fin Seccion Siete -->