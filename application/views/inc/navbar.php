<nav>
  <a href="<?php echo site_url('index') ?>">
    <img src="assets/img/leidos-logo.png" alt="Leidos logo" height="75" width = 225>
  </a>

  <table>
    <td>
      <tr>
        <a href="<?php echo site_url('index') ?>">Home</a>
      </tr>
      <tr>
        <a href="">My Projects</a>
      </tr>
      <tr>
        <a href="<?php echo site_url('profile') ?>">Profile</a>
      </tr>
      <tr>
        <a href="">Search</a>
      </tr>
    </td>
  </table>
  <p><?php echo anchor('Auth/logout', 'Logout');?></p>
</nav>
