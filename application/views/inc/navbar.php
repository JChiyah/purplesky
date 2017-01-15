<nav class="nav">
   <a href="<?php echo site_url('index') ?>">
      <img id="logo" src="assets/img/leidos-logo.png" alt="Leidos logo" height="75" width = 225>
   </a>
   <div id="gradient"></div>
   <div class="row">
      <ul>
         <li><a href="<?php echo site_url('index') ?>">Home</a></li>
         <li><a href="<?php echo site_url('index') ?>">My Projects</a></li>
         <li><a href="<?php echo site_url('profile') ?>">Profile</a></li>
         <?php global $user_group; if ($user_group == 1 || $user_group == 2) 
            { echo "<li><a href=" . site_url('create-project') . ">New Project</a></li>"; } ?>
         <li><a href="<?php echo site_url('search') ?>">Search</a></li>
      </ul>
      <a id="logout" href="<?=  base_url('auth/logout')?>"><i class="fa fa-power-off fa-fw"></i> Logout</a>
   </div>
</nav>