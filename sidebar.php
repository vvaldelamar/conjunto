        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li class="<?php if(isset($active2)){echo $active2;}?>">
                        <a href="expences.php"><i class="fa fa-credit-card"></i> Gastos</a>
                    </li>

                    <li class="<?php if(isset($active3)){echo $active3;}?>">
                        <a href="income_new.php"><i class="fa fa-usd"></i> Ingresos</a>
                    </li>

                    <li class="<?php if(isset($active10)){echo $active10;}?>">
                        <a href="casas.php"><i class="fa fa-home"></i> Casas </a>
                    </li>

                    <li class="<?php if(isset($active8)){echo $active8;}?>">
                        <a href="multas.php"><i class="fa fa-exclamation-triangle"></i> Multas </a>
                    </li>

                    <li class="<?php if(isset($active9)){echo $active9;}?>">
                        <a href="saldos.php"><i class="fa fa-book"></i> Estado de cuenta </a>
                    </li>

                    <li class="<?php if(isset($active4)){echo $active4;}?>">
                        <a href="category_expence.php"><i class="fa fa-align-left"></i> Categoría de gastos</a>
                    </li>

                    <li class="<?php if(isset($active5)){echo $active5;}?>">
                        <a href="category_income.php"><i class="fa fa-align-right"></i> Categoría de ingresos</a>
                    </li>

                    <li class="<?php if(isset($active6)){echo $active6;}?>">
                        <a href="users.php"><i class="fa fa-users"></i> Usuarios</a>
                    </li>

		    <li class="<?php if(isset($active11)){echo $active11;}?>">
                        <a href="camaras.php"><i class="fa fa-video-camera"></i> Camaras</a>
                    </li>

                    <li class="<?php if(isset($active7)){echo $active7;}?>">
                        <a href="settings.php"><i class="fa fa-cog"></i> Configuración</a>
                    </li>


                </ul>
            </div>
        </div><!-- /sidebar menu -->
    </div>
</div> 
     
    <div class="top_nav"><!-- top navigation -->
        <div class="nav_menu">
            <nav>
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="images/profiles/<?php echo $profile_pic;?>" alt=""><?php echo $name;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="profile.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
							<li><a href="https://ingeniero-web.com" target="_blank"><i class="fa fa-info"></i> Soporte</a></li>
                            <li><a href="action/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- /top navigation -->    
