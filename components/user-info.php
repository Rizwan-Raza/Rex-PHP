<?php if (isset($_SESSION['dp_src'])) {
    $dp = $_SESSION['dp_src'];
  } else {
    $dp = "uploads/users/temp.png";
  }
?>
<ul class="nav navbar-nav navbar-right">
  <?php if ($_SESSION['log'] == "client") { ?>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-fw fa-home"></i> Property <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li class='dropdown-header'>Sell or Buy Properties</li>
        <li><a tabindex="-1" onclick="navTo('buy-property')">
          <i class="fa fa-fw fa-cart-plus"></i> Buy Property
        </a></li>
        <li><a tabindex="-1" onclick="navTo('sell-property')">
          <i class="fa fa-fw fa-ambulance"></i> Sell Property
        </a></li>
        <li><a tabindex="-1" onclick="navTo('my-property')">
          <i class="fa fa-fw fa-user-circle"></i> My Properties
        </a></li>
        <li><a tabindex="-1" onclick="navTo('wishlist')">
          <i class="fa fa-fw fa-heart"></i> Liked Properties
        </a></li>
        <li class="divider"></li>
        <li class='dropdown-header'>Post or See Requirements</li>
        <li><a tabindex="-1" data-toggle="modal" data-target="#postRequirementModal">
          <i class="fa fa-fw fa-plus-square"></i> Post Requirement
        </a></li>
        <li class="dropdown-submenu">
          <a tabindex="-1" class="dropdown-test">
            <i class="fa fa-fw fa-eye"></i> Requested Properties 
            <i class="fa fa-caret-right"></i>
          </a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" data-toggle="modal" data-target="#myRequirementModal">
              <i class="fa fa-fw fa-user"></i> Mine
            </a></li>
            <li><a tabindex="-1" data-toggle="modal" data-target="#yourRequirementModal"><i class="fa fa-fw fa-users"></i> Other&apos;s
            </a></li>
          </ul>
        </li>
      </ul>
    </li>
  <?php } else { ?>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-fw fa-cogs"></i> C.M.S <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li class='dropdown-header'>Filesystem Storage</li>
        <li><a 
          <?php if(strpos($_SERVER['PHP_SELF'], 'cms.php')) { ?> 
          onclick="navTo('fs_prop')" <?php } else { ?> href="cms.php" <?php } ?>>
          <i class="fa fa-fw fa-home"></i> Property Images
        </a></li>
        <li><a 
          <?php if(strpos($_SERVER['PHP_SELF'], 'cms.php')) { ?> 
          onclick="navTo('fs_client')" <?php } else { ?> href="cms.php?tab=fs_c" <?php } ?>>
          <i class="fa fa-fw fa-user"></i> Client Images
        </a></li>
        <li><a 
          <?php if(strpos($_SERVER['PHP_SELF'], 'cms.php')) { ?> 
          onclick="navTo('fs_admin')" <?php } else { ?> href="cms.php?tab=fs_a" <?php } ?>>
          <i class="fa fa-fw fa-user-secret"></i> Admin Images
        </a></li>
        <li class="divider"></li>
        <li class='dropdown-header'>Database Storage</li>
        <li><a 
          <?php if(strpos($_SERVER['PHP_SELF'], 'cms.php')) { ?> 
          onclick="navTo('db_prop')" <?php } else { ?> href="cms.php?tab=db_p" <?php } ?>>
          <i class="fa fa-fw fa-picture-o"></i> Images Table
        </a></li>
      </ul>
    </li>
  <?php } ?>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown">
      <div style="background-image: url('<?php echo $dp; ?>');" class="user-nav user-dp user-dp-sm"></div><?php echo ucwords($_SESSION['fname']);?> <span class="caret"></span>
    </a>
    <div class="dropdown-menu user-info">
      <div class="col-md-4 col-sm-4 col-xs-4">
        <div style="background-image: url('<?php echo $dp; ?>');" class="user-dp user-dp-lg center-block">
          <div class="info" data-toggle="modal" data-target="#profilePictureModal">
            <h4><i class="fa fa-fw fa-camera"></i> Change Photo</h4>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-8">
        <h4><?php echo ucwords($_SESSION['fname'])." ".ucwords($_SESSION['lname']); ?></h4>
        <h5><?php echo $_SESSION['email']; ?></h5>

        <?php if ($_SESSION['log'] == "client") { ?>

          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#clientEditProfileModal"><i class="fa fa-fw fa-pencil"></i> Edit Profile</button>

        <?php } else { ?>

          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adminEditProfileModal"><i class="fa fa-fw fa-pencil"></i> Edit Profile</button>

        <?php } ?>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-fw fa-sign-out"></i> Logout</button>
      </div>
    </div>
  </li>
</ul>
