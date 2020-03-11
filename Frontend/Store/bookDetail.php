<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta name="viewport" content="width = 1050, user-scalable = no" />
	<script type="text/javascript" src="../../turnjs4/extras/jquery.min.1.7.js"></script>
	<script type="text/javascript" src="../../turnjs4/extras/modernizr.2.5.3.min.js"></script>
</head>

<body>

	<div class="flipbook-viewport">
		<div class="container">
			<div class="flipbook">
				<?php
				header("Content-type: text/html");
				/* 	session_start();
				$pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');


				$sql = "SELECT titel FROM buch";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(); */

				$directory = "../Admin/uploads/" . $_GET["titel"] . "";
				$filecount = 0;
				$files = glob($directory . "*");
				if ($files) {
					$filecount = count($files);
				}

				$id = 1;
				while ($filecount > $id) {
					echo "<div style=\"background-image:url(../Admin/uploads/" . $_GET["titel"] . "/" . $id . ".jpg)\"></div>";
					$id++;
				}
				?>
				<!-- 
				<div style="background-image:url(../Admin/uploads//1.jpg)"></div>
				<div style="background-image:url(../Admin/uploads/secondTestTitel/2.jpg)"></div>
				<div style="background-image:url(../Admin/uploads/secondTestTitel/3.jpg)"></div>
				<div style="background-image:url(../Admin/uploads/secondTestTitel/4.jpg)"></div> -->
			</div>
		</div>
	</div>


	<script type="text/javascript">
		function loadApp() {

			// Create the flipbook

			$('.flipbook').turn({
				// Width

				width: 922,

				// Height

				height: 600,

				// Elevation

				elevation: 50,

				// Enable gradients

				gradients: true,

				// Auto center this flipbook

				autoCenter: true

			});
		}

		// Load the HTML4 version if there's not CSS transform

		yepnope({
			test: Modernizr.csstransforms,
			yep: ['../../turnjs4/lib/turn.js'],
			nope: ['../../turnjs4/lib/turn.html4.min.js'],
			both: ['css/basic.css'],
			complete: loadApp
		});
	</script>

</body>

</html>