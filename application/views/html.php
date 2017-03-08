<!--
	*****************************************************
	
	This is a template webpage to load views dynamically
	It NEEDS a $body variable with the view to load
	
	Required parameters:
		- $body = view to load between navbar and footer

	Optional parameters:
		- $des = description of webpage
		- $title = title of webpage in browsers
	
	Example call:
		$d['body'] = 'home';
		$this->load->view('html', $d);

	*****************************************************

	Author: J Chiyah
-->

<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$result = $this->ion_auth->get_users_groups()->row();
	if ($result) {
		global $user_group;
		$user_group = $result->id;
	} else {
		//exit('You do not have permission to view this webpage');
		redirect('login', 'refresh');
	}
?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="<?php echo isset($page_description) ? $page_description : ''; ?>">
		<meta name="keywords" content="">
		<meta name="viewport" content="initial-scale=1">

		<title><?php echo isset($page_title) ? $page_title : ''; ?></title>
		
		<script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	</head>
	<body>
		<div id="html">
			<?php $this->load->view('inc/navbar'); ?>
			<div id="html-body"><?php $this->load->view($page_body); ?></div>
			<?php $this->load->view('inc/footer'); ?>
		</div>
		<!-- CodeIgniter does not recognise base_url() method from outside files (e.g. Javascript files)
				thus I defined here a var with that value for later use in external files. -->
		<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/site.js"); ?>" ></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/style.js"); ?>" ></script>
	</body>
</html>