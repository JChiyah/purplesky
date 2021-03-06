<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	if (!isset($_SESSION['access_level']) || !$_SESSION['access_level']) {
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
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
		<script>
		window.addEventListener("load", function(){
		window.cookieconsent.initialise({
		  "palette": {
		    "popup": {
		      "background": "#C0C0C0",
     		  "text": "#1f1646"
		    },
		    "button": {
		      "background": "#0389ff"
		    }
		  },
		  "theme": "classic",
		  "position": "bottom-left",
		  "content": {
		    "message": "This website uses cookies to ensure you get the best experience. By continuing to use this website, you agree the use of cookies",
		    "dismiss": "ACCEPT AND CLOSE"
		  }
		})});
		</script>
	</head>
	<body>
		<div id="html">
			<?php $this->load->view('inc/navbar'); ?>
			<div id="html-body">

				<?php $this->load->view($page_body); ?>
					
			</div>
			<?php $this->load->view('inc/footer'); ?>
		</div>
		<!-- CodeIgniter does not recognise base_url() method from outside files (e.g. Javascript files)
				thus I defined here a var with that value for later use in external files. -->
		<script type="text/javascript">var baseurl = "<?php print base_url(); ?>";</script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/site.js"); ?>" ></script>
		<script type="text/javascript" src="<?php echo base_url("assets/js/style.js"); ?>" ></script>
	</body>
</html>