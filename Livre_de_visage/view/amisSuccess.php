<!-- Bruno Demogue -->
<?php $temp=$context->listOfUsers; ?>

<?php foreach($temp as $value) {?>
	<?php if($value->identifiant!=null && $value->id!=$context->user_id){ ?>
 
		<form id="login" method="POST" action="Livre_de_visage.php">	
			<input type="hidden" name="action" value="login"/>
			<input type="hidden" name="id" value="<?=htmlspecialchars($value->id);?>"/>
			<button class="row amis amisbutton blockcolor " type="submit" >  
				<div class="col-4"> 
			       	<div class="imagecontainer"> 
						<?php if($value->avatar!=null){ ?> 
							<img class="rounded-circle imagecover  " src=<?= htmlspecialchars ($value->avatar); ?> width="100%" height="auto"/> 
						<?php }
						else{ ?>  
							<img class="rounded-circle imagecover  " src="images/profildefault.jpg" width="100%" height="auto"/> 
						<?php } ?>
					</div>  
				</div>  
				<div class="col-8 align-self-center text-left word-wrap"> 
					<?=$value->identifiant;?>
				</div> 					
			</button>   
		</form> 
					 
		
	<?php } ?>
<?php } ?>
