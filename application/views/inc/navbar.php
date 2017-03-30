<nav class="nav" id="nav-mobile">
   <a href="<?php echo site_url('index') ?>">
      <img id="logo" src="<?= base_url('assets/img/leidos-logo.png') ?>" alt="Leidos logo" />
   </a>
   <img id="bg" src="<?= base_url('assets/img/triangle.png') ?>" alt="" />
   <div class="row">
      <ul>
         <li><a href="javascript:window.history.go(-1);" class="scroll-button">
               <i class="fa fa-arrow-left" aria-hidden="true"></i>
         </a></li>
         <li>
            <a href="<?php echo site_url('index') ?>"<?php echo $page_body == 'home' ? ' class="active"' : ''; ?>>Home</a>
         </li>
         <li>
            <a href="<?php echo site_url('projects') ?>"<?php echo $page_body == 'projects' ? ' class="active"' : ''; ?>>My Projects</a>
         </li>
         <li>
            <a href="<?php echo site_url(strtolower($_SESSION['name'])) ?>"<?php echo $page_body == 'profile' ? ' class="active"' : ''; ?>>Profile</a>
         </li>
         <?php if(in_array(2, $_SESSION['access_level'])) : ?>
               <li>
                  <a href="<?= site_url('create-project') ?>"<?php echo $page_body == 'create-project' ? ' class="active"' : ''; ?>>Create Project</a>
               </li>
         <?php endif ?>
         <li>
            <a href="<?php echo site_url('search') ?>"<?php echo $page_body == 'search' ? ' class="active"' : ''; ?>>Search</a>
         </li>
      </ul>
      <a id="logout" href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off fa-fw"></i></a>
      <span>Welcome, <?= ucwords(explode('.', $_SESSION['name'])[0]) ?></span>
   </div>
</nav>
