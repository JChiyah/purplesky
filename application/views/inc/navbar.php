<nav class="nav">
   <a href="<?php echo site_url('index') ?>">
      <img id="logo" src="<?= base_url('assets/img/leidos-logo.png') ?>" alt="Leidos logo" />
   </a>
   <img id="bg" src="<?= base_url('assets/img/triangle.png') ?>" alt="" />
   <div class="row">
      <ul>
         <li><a href="javascript:window.history.go(-1);" class="scroll-button">
               <i class="fa fa-arrow-left" aria-hidden="true"></i>
         </a></li>
         <li><a href="<?php echo site_url('index') ?>">Home</a></li>
         <li><a href="<?php echo site_url('projects') ?>">My Projects</a></li>
         <li><a href="<?php echo site_url('profile') ?>">Profile</a></li>
         <?php echo in_array(2, $_SESSION['access_level']) ? "<li><a href=" . site_url('create-project') . ">Create Project</a></li>" : ""; ?>
         <li><a href="<?php echo site_url('search') ?>">Search</a></li>
      </ul>
      <a id="logout" href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off fa-fw"></i></a>
   </div>
</nav>