<!-- Sacha Le doeuff -->
<div class="block3 blockcolor" id="chat">
	<div id="poigneChat" class="col-12" >
		<p id="topChat" class="poigne">Chatbox</p><hr>
	</div>
    <div class="word-wrap block3" id="chatBox">
    <?php
        $temp = $context->LeZoo;
        $zoo = array_reverse($temp);

        foreach($zoo as $value){
            if($value->emetteur!=null
                &&$value->post!=null
                &&$value->emetteur->identifiant!=null
                &&$value->post->texte!=null){ ?>

                <div class="text-left">
                    <?= htmlspecialchars($value->emetteur->identifiant); ?> dit: 
                </div>

                <div class="text-right">
                    <?= htmlspecialchars($value->post->texte); ?>
                </div>

                </br>
            <?php $res=$value->id; }
        } ?>

        </div>
    <div class="col-12" >
        <form id="formMessage" class="lineheight90" method="POST" action="Livre_de_visage.php" enctype="multipart/form-data" >
        <input type="hidden" name="action" value="messChat"/>  
            <div class="row"> 
                <input class="offset-1 col-7 block3" type="text" name="texteChat" id=texteChat maxlength="2000">      
                <button class="col-3 text-center block3 whitehovergrey fa fa-pencil" type="submit" id="envoiMess" name="envoiMess" ></button>   
            </div>
            
        </form>

    </div>
</div>