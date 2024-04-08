<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
?>

<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    
        <a class="navbar-brand brand-logo-large" href="index.php?c=dashboard"><img src="public/assets/images/logo.png" alt="logo" />
    </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
       
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
               
            </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="public/assets/images/thao.png" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">
                            <?= getSessionUserName()?>
                        </p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                   
                    <div class="dropdown-divider"></div>
                    <form action="index.php?c=login&m=logout" method="post">
                        <button class="dropdown-item" type="submit" name ="btnLogout">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Signout 
                        </button>
                    </form>
                    
                </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
           
            
            <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
          
        </ul>
        
    </div>
</nav>