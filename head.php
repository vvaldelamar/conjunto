<?php
    session_start();

    include "config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
        exit;
    }
?>
<?php 
    $id=mysqli_real_escape_string($con,(strip_tags($_SESSION['user_id'],ENT_QUOTES)));
    $query=mysqli_query($con,"SELECT * from user where id=$id");
    while ($row=mysqli_fetch_array($query)) {
        $status = $row['status'];
        $is_deleted = $row['is_deleted'];
        $name = $row['name'];
        $email = $row['email'];
        $profile_pic = $row['profile_pic'];
        $is_admin = $row['is_admin'];
    }

    $website = "website";
    $querycoin = mysqli_query($con,"select * from configuration where name='$website' ");
    if ($r = mysqli_fetch_array($querycoin)) {
        $website_name=$r['val'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title." ".$website_name; ?> </title>

 	<link rel="icon" type="image/jpg" href="terminal.ico.png"/>
        <!-- Bootstrap -->
        <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="css/nprogress/nprogress.css" rel="stylesheet">
	<!-- CORE -->
	<link href="css/nprogress/nprogress.css" rel="stylesheet">
          <!-- iCheck -->
       <link href="css/AdminLTE.min.css" rel="stylesheet">
       <link href="css/core.css" rel="stylesheet">
       <link href="css/styles.css" rel="stylesheet">
       <link href="css/color.css" rel="stylesheet">
       <!-- Datatables -->

  

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>


	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
        <link href="css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      
        <!-- jQuery custom content scroller -->
        <link href="css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- Custom Theme Style -->
        <link href="css/custom.min.css" rel="stylesheet">
        <!--Google -->
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- MICSS button[type="file"] -->
        <link rel="stylesheet" href="css/micss.css">
		<style>
			.right_col{
				min-height:750px;
			}
    
        </style>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                          <a href="#" class="site_title"><i class="fa fa-cubes"></i> <span><?php echo $website_name;?></span></a>
                        </div>
                        <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                                <div class="profile clearfix">
                                    <div class="profile_pic">
                                      <!--  <img src="images/profiles/<?php echo $profile_pic;?>" alt="<?php echo $name;?>" class="img-circle profile_img">-->
                                    </div>
                                    <div class="profile_info">
                                        <span>Bienvenido,</span>
                                        <h2><?php echo $name;?></h2>
                                    </div>
                                </div>
                            <!-- /menu profile quick info -->

                        <br />
