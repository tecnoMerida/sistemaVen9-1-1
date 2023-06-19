<!-- ////////////////////////////////         MENU PANEL DERECHO          ///////////////////////////////-->
<style>
  .SLDN{
    width: 30px;
height: 30px;
/*border-image-outset: 20px;*/
border-radius: 60%;
z-index:1;

}

#title_menu{
  font-size:10; 
  border: 0; 
  font-family:Copperplate Gothic;
  text-align: center;
  margin-top: -30px;
}

#principal1{
  font-size: 10;
  color: #ffffff;
  border: 0;
  font-family:Copperplate Gothic;
  text-align: center;
  margin-top: -5px;
}

 </style> 
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div id="principal1" align="center">
            <a href="../../administrador/principal.php" class="site_title" title="Ir a la página principal del sistema"><small><span> &nbsp Principal</span></small></a>
            </div>

          <div  id="title_menu" align="center">
              <a href="../../administrador/principal.php" class="site_title" title="Ir a la página principal del sistema"><small><span>Libro Digital Novedades 911</span></small></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../../images/SLDN_911.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php   echo "".$_SESSION['usuario']."";?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> Administrador <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                  <li><a><i class="fa fa-sitemap"></i> Herramienta Sistema <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a>Personal<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="../../administrador/consulta_registro_personal.php">Nuevo Personal</a>
                            </li>
                            <li><a href="../../administrador/consulta_personal.php">Consulta Personal</a>
                            </li>
                          </ul>
                        </li>
                        <li><a>Registro de Grupo<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="../../administrador/organismo.php">Nuevo Organismo</a>
                            </li>
                            <li><a href="../../administrador/grupos.php">Nuevo Grupo</a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-archive"></i> Módulo Administrativo <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../administrador/registro_bienes.php">Nuevo Bienes</a></li>
                      <li><a href="../../administrador/inventario_bienes.php">Inventario Bienes</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Módulo Seguridad <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../administrador/novedades_guardia.php">Novedades Guardia</a></li>
                      <li><a href="../../administrador/registro_eventos.php">Registro de Eventos</a></li>
                      <li><a href="../../administrador/estadisticas.php">Estadísticas</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-info-circle
                    "></i> Ayuda <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../administrador/manual.php">Manual Usuario</a></li>
                      <li><a href="../../administrador/contacto.php">Contactos</a></li>
                    </ul>
                  </li>
                  <li><a href="../../administrador/calendario.php"><i class="fa fa-calendar"></i> Calendario <span class="label label-success pull-right"></span></a>
                  </li>

<!--                  <li><a href="../cookie/logout.php"><i class="fa fa-sign-out"></i> Cerrar Sesión <span class="label label-success pull-right"></span></a>
                  </li>-->

                </ul>
                </li>
                <li><a><i class="fa fa-users"></i> Supervisor <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                <li><a><i class="fa fa-sitemap"></i> Solicitudes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../supervisor/nueva_solicitud.php">Nueva Solicitud</a></li>
                      <li><a href="../../supervisor/consulta_solicitud.php">Consulta 171</a></li>
                    </ul>
                  </li>

                <li><a><i class="fa fa-archive"></i> Observaciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../supervisor/nueva_observacion.php">Nueva Observación</a></li>
                      <li><a href="../../supervisor/observaciones_personal.php">Observaciones Personal</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Módulo Seguridad <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../supervisor/novedades_guardia.php">Novedades Guardia</a></li>
                      <li><a href="../../supervisor/estadisticas_dia.php">Estadísticas</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-info-circle
                    "></i> Ayuda <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../supervisor/manual_sup.php">Manual Usuario</a></li>
<!--                      <li><a href="../supervisor/contactos.php">Contactos</a></li>-->
                    </ul>
                  </li>
                  <li><a href="../../supervisor/calendario.php"><i class="fa fa-calendar"></i> Calendario <span class="label label-success pull-right"></span></a>
                  </li>

                    </ul>
                </li>
                <li><a><i class="fa fa-users"></i> Despachador <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                <li><a><i class="fa fa-sitemap"></i> Solicitudes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../despachador/nueva_solicitud.php">Nueva Solicitud</a></li>
                      <li><a href="../../despachador/consulta_solicitud.php">Consulta 171</a></li>
                    </ul>
                  </li>

                <li><a><i class="fa fa-archive"></i> Observaciones <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../despachador/nueva_observacion.php">Nueva Observación</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Módulo Seguridad <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../despachador/novedades_guardia.php">Novedades Guardia</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-info-circle
                    "></i> Ayuda <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../../despachador/manual.php">Manual Usuario</a></li>
<!--                      <li><a href="../despachador/contactos.php">Contactos</a></li>-->
                    </ul>
                  </li>
                  <li><a href="../../despachador/calendario.php"><i class="fa fa-calendar"></i> Calendario <span class="label label-success pull-right"></span></a>
                  </li>

                    </ul>
                </li>
            </ul>

              </div>
              <!-- ******** Seccion LIVE ON ********* -->
              <div class="menu_section">
                <ul class="nav side-menu">                              
                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" class="cerrar" title="Logout" href="../cookie/logout.php">
                <span class="fa fa-power-off" aria-hidden="true"></span>
                Cerrar Sesión<span class="glyphicon glyphicon" aria-hidden="true"></span>
                <span class="fa fa-power-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>