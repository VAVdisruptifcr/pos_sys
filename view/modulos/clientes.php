<?php 

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

<div class="content-wrapper">
  <section class="content-header">

    <h1>
      Administrar Clientes
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Clientes</li>
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          Agregar cliente
        </button>
        
      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Documento ID</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Fecha de nacimiento</th>
              <th>Total compras</th>
              <th>Última compra</th>
              <th>Ingreso al sistema</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value){

              echo '<tr>

              <td>'.($key+1).'</td>
              <td>'.$value["nombre"].'</td>
              <td>'.$value["documento"].'</td>
              <td>'.$value["email"].'</td>
              <td>'.$value["telefono"].'</td>
              <td>'.$value["direccion"].'</td>
              <td>'.$value["fecha_nacimiento"].'</td>
              <td>'.$value["compras"].'</td>
              <td>'.$value["ultima_compra"].'</td>
              <td>'.$value["fecha"].'</td>
              
              <td>

                <div class="btn-group">

                  <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i>
                  </button>';

                  if($_SESSION["perfil"] == "Administrador"){

                  echo'<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                    

                  }

                  
                echo'</div>
                
              </td>
              
            </tr>';

            }

            ?>

          </tbody>
          
        </table>

      </div>

    </div>

  </section>
  
</div>



<!-- ========================
MODAL AGREGAR CLIENTE
======================== -->
<!-- Modal -->
<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

      <!-- ======================================
        CABEZA DEL MODAL
      ====================================== -->

        <div class="modal-header" style="background:#39CCCC; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar nuevo cliente</h4>

        </div>

        <div class="modal-body">

        <!-- ======================================
          CUERPO DEL MODAL
        ====================================== -->        

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre del cliente" required>
                
              </div>
              
            </div>

<!-- ENTRADA PARA EL DOCUMENTO OFICIAL CÉDULA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocId" placeholder="Ingresar documento" required>
                
              </div>
              
            </div>  

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar correo electrónico" required>
                
              </div>
              
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTel" placeholder="Ingresar número telefónico" data-inputmask="'mask':'(999)9999-9999'" data-mask required>
                
              </div>
              
            </div>  

            <!-- ENTRADA PARA LA DIRECCIÓN FÍSICA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDir" placeholder="Ingresar direción exacta" required>
                
              </div>
              
            </div>

            <!-- ENTRADA PARA LA FECHA NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoBirthday" placeholder="Ingresar fecha de nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                
              </div>
              
            </div>                     
            
          </div>

        </div>

        <!-- ======================================
          PIE DE "PÁGINA" DEL MODAL
        ====================================== -->      

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-info">Registrar cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>
</div>


<!-- =========================================================================
==============================================================================
MODAL EDITAR CLIENTE
==============================================================================
========================================================================= -->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

      <!-- ======================================
        CABEZA DEL MODAL
      ====================================== -->

        <div class="modal-header" style="background:#39CCCC; color:white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <div class="modal-body">

        <!-- ======================================
          CUERPO DEL MODAL
        ====================================== -->        

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>

                <input type="hidden" id="idCliente" name="idCliente">
                
              </div>
              
            </div>

<!-- ENTRADA PARA EL DOCUMENTO OFICIAL CÉDULA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="editarDocId" id="editarDocId"  required>
                
              </div>
              
            </div>  

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
                
              </div>
              
            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="editarTel" id="editarTel" data-inputmask="'mask':'(999)9999-9999'" data-mask required>
                
              </div>
              
            </div>  

            <!-- ENTRADA PARA LA DIRECCIÓN FÍSICA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="editarDir" id="editarDir" required>
                
              </div>
              
            </div>

            <!-- ENTRADA PARA LA FECHA NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="editarBirthday" id="editarBirthday" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
                
              </div>
              
            </div>                     
            
          </div>

        </div>

        <!-- ======================================
          PIE DE "PÁGINA" DEL MODAL
        ====================================== -->      

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-info">Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente -> ctrEditarCliente();


      ?>
  
    </div>
  </div>
</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente -> ctrEliminarCliente();

?>


