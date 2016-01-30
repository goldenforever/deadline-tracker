<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
		<head>
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	<link rel="apple-touch-icon-precomposed apple-touch-icon" href="apple-touch-icon-precomposed.png">
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
				<title>Deadlines</title>
				<meta name="description" content="">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="css/normalize.min.css">
				<link rel="stylesheet" href="css/main.css">
				<link rel="stylesheet" href="css/jquery-ui.css">
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
			<script src="js/vendor/taffy.js"></script>
			<script src="js/vendor/jquery-2.1.1.js"></script>
			<script src="js/vendor/validate.js"></script>
		</head>
		<body>
				<!--[if lt IE 7]>
						<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
				<![endif]-->
				<div class="main-container">
						<div class="main wrapper clearfix border">

								<article>
									<aside style="border-top-color:#34495e;border-bottom:12px solid #2c3e50;">
											<h2>Add a Deadline</h2>
											<form id="form" action="add.php" method="post">
													<input name="name" style="width:12em;font-size:1.2em;text-align:center;margin-left:0.25em;margin-right:0.25em;margin-bottom:0.5em;" type="text" placeholder="Name"> 	
													<input name="cat" style="width:4em;font-size:1.2em;text-align:center;margin-left:0.25em;margin-right:0.25em;margin-bottom:0.5em;" minval="0.05" maxval="30" step="0.05" type="number" placeholder="CATS"> 	
													<select id="day" style="width:4em;font-size:1.2em;text-align:center;margin-left:0.25em;margin-right:0.25em;margin-bottom:0.5em;" name="day">
														<option style="font-weight:bold;" value="">Day</option>
														<?php for ($day = 1; $day <= 31; $day++) { ?>
														<option value="<?php echo $day; ?>"><?php echo $day; ?></option>
														<?php } ?>
													</select>
													<select id="month" style="width:4em;font-size:1.2em;text-align:center;margin-left:0.25em;margin-right:0.25em;margin-bottom:0.5em;" name="month">
														<option style="font-weight:bold;" value="">Month</option>
														<option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option>
														<option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option>
														<option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option>
													</select>
													<input style="background-color:#ccc;width:12em;font-size:1.2em;text-align:center;margin-left:0.25em;margin-right:0.25em;margin-bottom:0.5em;" type="submit" value="Add!">
											</form>
									</aside>
									<section>
									<?php
										error_reporting(-1);
										ini_set('error_reporting', E_ALL);
										require 'database.php';
										$db = new Database();
										$result = $db->query("SELECT * FROM todos");
										$i = 0;
										while($res = $result->fetchArray(SQLITE3_ASSOC)){
											if(!isset($res['idno'])) continue;
											echo '<div style="position:relative;margin-top:1em;margin-bottom:1em;padding:1.5em;padding-top:0.05em;padding-bottom:0.4em;background-color:rgba(192,168,0,0.5);border-top: 12px solid rgba(192,168,0,0.3);">
													<h2 class="itemname">' . $res['name'] . '</h2>
													<p class="CATS">' . $res['cats'] . ' CATS</p>
													<p class="daysuntil"> </p>
													<p class="date">' . $res['dat'] . '</p>
													<a href="delete.php?id=' . $res['idno'] . '">
														<span style="width:28px;height:28px;background-color:rgba(0,0,0,0.3);color:#fff;text-align:center;position:absolute;top:0;right:0;padding-top:3px;padding-left:1px;font-weight:bold;">x</span>
													</a>
												</div>';
											$i++;
										}
									?>
									</section>
								</article>
						</div> <!-- #main -->
				</div> <!-- #main-container -->

				<script src="js/plugins.js"></script>
				<script src="js/main.js"></script>
		</body>
</html>
