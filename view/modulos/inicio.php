<div class="content-wrapper">
  <section class="content-header">

    <h1>
      Tablero
      <small>Panel de control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>

  </section>

  <section class="content">

    <div class="row">

    <?php 

    if($_SESSION["perfil"] == "Administrador"){

      include "inicio/cajas-superiores.php";     

    }

    ?>
      
    </div> 

    <div class="row">

      <div class="col-lg-12">

        <?php 

        if($_SESSION["perfil"] == "Administrador"){

          include "reportes/grafico-ventas.php";

        }

        ?>
        
      </div>

      <div class="col-lg-6">

        <?php

        if($_SESSION["perfil"] == "Administrador"){

          include "reportes/productos-mas-vendidos.php";

        }

        ?>
        
      </div>

      <div class="col-lg-6">

        <?php 

        if($_SESSION["perfil"] == "Administrador"){

          include "inicio/productos-recientes.php";

        }

        ?>
        
      </div>

      <div class="col-xs-12">

        <?php 

          if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

            echo '<div class="box-header">

                    <div class="box box-success">
                      
                      <h1 >Bienvenido ' . $_SESSION["nombre"].'</h1>

            </div>';

          }

        ?>
        
      </div>
      
    </div>   

  </section>
  
</div>
