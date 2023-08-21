<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Test
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="euc-jp">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo get_bloginfo();?></title>
    <?php 
    wp_head();
    ?>   
  </head>
   <body <?php body_class(); ?>>
       <!-- section header -->
    <header class="navbar navbar-expand-lg">
        <div class="overlape-belt"></div>
        <div class="container">
            <a class="navbar-brand" href="JavaScript:void(0)">
                <img src="<?php echo get_template_directory_uri();?>/assets/images/logo.webp" alt="logo/webp">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="las la-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                 <?php
                wp_nav_menu(
                    array(
                        
                        'menu_id' => 'primary_navigation',
                        'container' => 'ul',
                        'menu_class' => 'navbar-nav ms-auto align-items-center',
                    )
                );
                ?>
                <!--<ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="JavaScript:void(0)">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="JavaScript:void(0)">about ako</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="JavaScript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">ako expertise</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="JavaScript:void(0)">dubot</a></li>
                            <li><a class="dropdown-item" href="JavaScript:void(0)">d365 bot</a></li>
                            <li><a class="dropdown-item" href="JavaScript:void(0)">stibo bot</a></li>
                            <li><a class="dropdown-item" href="JavaScript:void(0)">helpdesk bot</a></li>
                            <li><a class="dropdown-item" href="JavaScript:void(0)">real estate bot</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="JavaScript:void(0)">how we deliver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="JavaScript:void(0)">inconvo</a>
                    </li>
                </ul>-->
            </div>
        </div>
    </header>