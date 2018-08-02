<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="/"><i class="fa fa-university"></i> REX</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="<?php if(strpos($_SERVER['PHP_SELF'], 'index.php')) echo 'active'; ?>"><a href="/">Home</a></li>
        <li class="<?php if(strpos($_SERVER['PHP_SELF'], 'about.php')) echo 'active'; ?>"><a href="about.php">About Us</a></li>
        <?php if(!isset($_SESSION['log'])) { ?>
          <li class="<?php if(strpos($_SERVER['PHP_SELF'], 'gallery.php')) echo 'active'; ?>"><a href="gallery.php">Gallery</a></li> 
        <?php } ?>
        <li class="<?php if(strpos($_SERVER['PHP_SELF'], 'contact.php')) echo 'active'; ?>"><a href="contact.php">Contact Us</a></li> 
      </ul>
      <?php if(!isset($_SESSION['log'])) {?>
      <ul class="nav navbar-nav navbar-right">
        <li id="signupButton" data-toggle="modal" data-target="#signupModal"><a><i class="fa fa-fw fa-user"></i> Sign Up</a></li>
        <li class="dropdown">
    			<a class="dropdown-toggle" data-toggle="dropdown">
    				<i class="fa fa-fw fa-sign-in"></i> Login <span class="caret"></span>
    			</a>
    			<ul class="dropdown-menu">
    				<li data-toggle="modal" data-target="#clientLoginModal">
              <a><i class="fa fa-fw fa-user"></i> Client Login</a>
            </li>
    				<li data-toggle="modal" data-target="#adminLoginModal">
              <a><i class="fa fa-fw fa-user-secret"></i> Admin Login</a>
            </li>
    			</ul>
    		</li>
      </ul>
      <?php 
        } else {
          include 'components/user-info.php';
        }
      ?>
<!-- 	      <div class="nav navbar-nav navbar-right">
        <li class="btn btn-primary"><i class="fa fa-user"></i> Check Ad.</li>
        <li class="btn btn-primary"><i class="fa fa-sign-in"></i> Post Ad.</li>
      </div> -->
    </div>
  </div>
</nav>
