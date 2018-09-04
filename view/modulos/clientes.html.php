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
        
        <table class="table table-bordered table-striped dt-responsive tablas">

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

            <tr>

              <td>1</td>
              <td>Ronaldo Carmona</td>
              <td>1-0459-0345</td>
              <td>rcarmona@gmail.com</td>
              <td>(506) 2569-4302</td>
              <td>Puntarenas Centro, Calle 11 con Av. Centenario</td>
              <td>13-5-83</td>
              <td>15</td>
              <td>2018-8-11 14:25:01</td>
              <td>2018-8-11 14:25:01</td>
              
              <td>

                <div class="btn-group">

                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  
                </div>
                
              </td>
              
            </tr>

          </tbody>
          
        </table>

      </div>

    </div>

  </section>
  
</div>

<!-- ========================
MODAL AGREGAR CATEGORIA
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

          <h4 class="modal-title">Agregar nueva categoría</h4>

        </div>

        <div class="modal-body">

        <!-- ======================================
          CUERPO DEL MODAL
        ====================================== -->        

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresar categoría" required>
                
              </div>
              
            </div>
            
          </div>

        </div>

        <!-- ======================================
          PIE DE "PÁGINA" DEL MODAL
        ====================================== -->      

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-info" data-dismiss="modal">Registrar la nueva categoría</button>

        </div>

      </form>

    </div>

  </div>
</div>