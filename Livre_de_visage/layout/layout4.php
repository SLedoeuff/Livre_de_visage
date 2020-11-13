<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Livre de visage</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" type="image/jpg" href="images/icone.jpg">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" > 
		<link rel="stylesheet" type="text/css" href="css/style3.css">
	</head>
	<body>

	<noscript><div class="TERRORISTECONTAINER"><div class="TERRORISTE"><H1>D'OU TU DESACTIVE LE JS LA HO, C PA BIEN</H1></div></div></noscript>

		<div class="container">
		<?php include($nameApp."/view/loginSuccess.php"); ?> 
		<?php include($nameApp."/view/menue".$context->executeAction("menue", $_REQUEST).".php"); ?>

			<div class="row">
				<div id="bandeau" class="col-12 bandeau">
					<?= $context->notification ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-3 " >
					<div class="row">
						<div id="statut" class="col-12 block3 blockcolor">
							<?php include($nameApp."/view/profil".$context->executeAction("profil", $_REQUEST).".php"); ?> 
						</div>
					</div>
					<div class="row d-none d-md-inline">
	                    <?php include($nameApp."/view/chat".$context->executeAction("chat", $_REQUEST).".php"); ?> 
					</div>
				</div>
				<div class="col-12 col-md-6 block3">
					<?php include($nameApp."/view/newmessform".$context->executeAction("newmessform", $_REQUEST).".php"); ?> 
					<span id="listofmessage" > 
						<?php include($nameApp."/view/message".$context->executeAction("message", $_REQUEST).".php"); ?>  
					</span>

				</div>
				<div class="d-none d-md-inline col-md-3 scrolable block3">
					<?php include($nameApp."/view/amis".$context->executeAction("amis", $_REQUEST).".php"); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12 block3">
					<div class="row">
						<div class="col-12 block3 blockcolor text-center">
							Sacha Le Doeuff and Bruno Demogue
						</div>
					</div>
				</div>
			</div> 		
		</div>
	</body>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/bootstrap/bootstrap.min.js" ></script>
	<script type="text/javascript" src="js/resize.js"></script>
</html>
