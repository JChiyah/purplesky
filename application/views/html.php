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
	//defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8">
		<meta name="description" content=" <?php echo $des ?? '' ?> ">
		<meta name="keywords" content="">
		<meta name="viewport" content="initial-scale=1">

		<title><?php echo $title ?? '' ?></title>
		
		<script src="https://use.fontawesome.com/eedb59a6cd.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	</head>
	<body>
		<?php $this->load->view('inc/navbar'); ?>
		<?php $this->load->view($body); ?>
		<?php $this->load->view('inc/footer'); ?>
	</body>
</html>