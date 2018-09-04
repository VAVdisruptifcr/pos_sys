<header class="main-header">
	
	<!-- ==========================
	LOGOTIPO
	========================== -->
	<a href="" class="logo">
			
	<!-- logo mini -->
	<span class="logo-mini">
		
		<img src="view/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px" alt="">

	</span>

	<!-- Logo normal -->

	<span class="logo-lg">
		
		<img src="view/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px" alt="">

	</span>

	</a>

	<!-- =========================
	BARRA DE NAVEGACIÓN O SIDEBAR
	========================= -->
	<nav class="navbar navbar-static-top" role="navigation">

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>

      	</a>

      	<!-- Perfil de Usuario -->
      <div class="navbar-custom-menu">
        
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">

          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">

          		<?php 

          		if($_SESSION["foto"] != ""){

          			echo '<img class="user-image" src="'.$_SESSION["foto"].'">';

          		}else{

          			echo '<img class="user-image" src="view/img/usuarios/default/anonymous.png">';

          		}

          		?>

				<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>

          	</a>

	          	<!-- CAJA DROPDOWN TOGGLE-->
			<ul class="dropdown-menu">

				<li class="user-body">

					<div class="pull-right">

						<a href="salir" class="btn btn-default btn-flat">Salir</a>
						
					</div>
					
				</li>
				
			</ul>

          </li>
          
        </ul>
      </div>
		
	</nav>

</header>