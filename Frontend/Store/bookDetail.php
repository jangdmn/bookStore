<!doctype html>
<html>

<head>
	<meta name="viewport" content="width = 1050, user-scalable = no" />
	<script type="text/javascript" src="turnjs4/extras/jquery.min.1.7.js"></script>
	<script type="text/javascript" src="turnjs4/extras/modernizr.2.5.3.min.js"></script>
	<link href="../font-awesome/css/all.css" rel="stylesheet" />
	<link rel="stylesheet" href="../Navbar/navbar.css" />
	<link href="https://fonts.googleapis.com/css?family=Unica+One&display=swap" rel="stylesheet">
</head>

<body>
	<div class="topnav">
		<a href="adminBookStore.php"><i class="fa fa-fw fa-arrow-circle-left"></i>&nbsp; zurück</a>
		<div class="titel">book store&nbsp;&nbsp;<i class="fas fa-book"></i></div>
	</div>
	<div class="flipbook-viewport">
		<div class="container">
			<div class="flipbook">
				<?php
				header("Content-type: text/html");
				session_start();
				$pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');
				$stmt = $pdo->prepare("SELECT titel FROM buch");
				$stmt->execute();

				/* $fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
					printf("There were %d Files", iterator_count($fi)); */
				$directory = "../Admin/uploads/" . $_GET["titel"] . "/*";
				$filecount = 0;
				$files = glob($directory);
				if ($files) {
					$filecount = count($files);
				}

				$id = 1;
				while ($filecount > $id) {
					echo "<div style=\"background-image:url(../Admin/uploads/" . $_GET["titel"] . "/" . $id . ".jpg)\"></div>";
					$id++;
				}
				?>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		function loadApp() {

			// Create the flipbook

			$('.flipbook').turn({
				// Width

				width: 1000,

				// Height

				height: 650,

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
			yep: ['turnjs4/lib/turn.js'],
			nope: ['turnjs4/lib/turn.html4.min.js'],
			both: ['css/basic.css'],
			complete: loadApp
		});
	</script>

</body>

</html>