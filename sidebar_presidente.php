        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="<?php if(isset($active1)){echo $active1;}?>">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                       <li class="<?php if(isset($active10)){echo $active10;}?>">
                        <a href="casas.php"><i class="fa fa-home"></i> Casas </a>
                    </li>

                    <li class="<?php if(isset($active9)){echo $active9;}?>">
                        <a href="saldos.php"><i class="fa fa-book"></i> Estado de cuenta </a>
                    </li>

        		    <li class="<?php if(isset($active11)){echo $active11;}?>">
                        <a href="camaras.php"><i class="fa fa-video-camera"></i> Camaras</a>
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
