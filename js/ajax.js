var reload;

$(document).ready(function(){
	$("#logout_button").on("click",function(e){
		e.preventDefault();
		logout();
	});

	$("#formupdatestatut").submit(function(e){
		e.preventDefault();
		changestatut();
	});

	$("#formupdateavatar").submit(function(e){
		e.preventDefault();
		changeavatar();
	});

	$("#formnewmessage").submit(function(e){
		e.preventDefault();
		newmessage($(this).find("#formreftoid").val());
	});

	$(".formlike").submit(function(e){
		e.preventDefault();
		like($(this).find("#idmess").val());
	});

	reload=setInterval(refreshChat, 10000);

	$("#formMessage").submit(function(e){
		e.preventDefault();
		if($("#texteChat").val() != ""){ envoiChat(); }
	});

	$("#chat").on("click",function(){
		$("#topChat").empty().append("Chatbox");
	});

});

function logout()
{
	$.ajax({
		type:"POST",
		url:"Livre_de_visage_Ajax.php?action=logout",
		cache:false,
		dataType: "html",
		success:function(resultat){
			$("body").empty().append(resultat);
			$("body").prepend("<div class='row'><div class='col-12  text-center block2'> Deconnection reussie.</div></div>");
		}
	});
};

function changestatut()
{
	$.ajax({
		type:"POST",
		url:"Livre_de_visage_Ajax.php?action=changestatut",
		data: $("#updateStatut").serialize(),
		cache:false,
		dataType: "html",
		success:function(resultat){
			$("#bandeau").empty().prepend("<div class='row'><div class='col-12  text-center block2'> Changement de statut éffectué  </div></div>");
			$("#actualstatut").empty().prepend("\""+$("#updateStatut").val()+"\"");
			$("#updateStatut").val("");
		}
	});
};

function changeavatar()
{
    $.ajax({
        type:"POST",
        url:"Livre_de_visage_Ajax.php?action=changeavatar",
        data: $("#updateavatar").serialize(),
        cache:false,
        dataType: "html",
        success:function(resultat){
            $("#bandeau").empty().prepend("<div class='row'><div class='col-12  text-center block2'> Changement d'avatar éffectué  </div></div>");
            $("#actualavatar").empty().prepend("<img class='imagecover rounded-circle' src='"+$("#updateavatar").val()+"'' width='150' height='150' />");
			$("#updateavatar").val("");
        }
    });
};



function newmessage(id)
{
	$.ajax({
		type:"POST",
		url:"Livre_de_visage_Ajax.php?action=newmessage&id="+id,
		data: $("#formnewmessage").serialize(),
		cache:false,
		dataType: "html",
		success:function(resultat){
            $("#bandeau").empty().prepend("<div class='row'><div class='col-12  text-center block2'> Message posté  </div></div>");
			$("#listofmessage").prepend(resultat);
			$("#newmessage").val("");
			$("#newimage").val("");
		}
	});
};

function like(id)
{
    $.ajax({
        type:"POST",
        url:"Livre_de_visage_Ajax.php?action=like&idmess="+id,
        cache:false,
        dataType: "html",
        success:function(resultat){
            $("#bandeau").empty().prepend("<div class='row'><div class='col-12  text-center block2'> Like éffectué  </div></div>");
            $("#nblike"+id).empty().prepend(resultat);
        }
    });
};

//Sacha Le Doeuff
function envoiChat(){
    $.ajax({
        type:"POST",
        url:"Livre_de_visage_Ajax.php?action=messChat",
        data : $("#texteChat").serialize(),
        cache:false,
        dataType:"html",
        timeout:5000,
        success: function(retour){
            $("#chatBox").append(retour);
            $("#texteChat").val("");
        },
        error: function(){
            $("#notif_error_ban").empty().prepend("<div id='notif_band'> wtf ca marche pas. Déso on répare. </div>");
        }
    });
};

//Sacha Le Doeuff
function refreshChat(){
    $.ajax({
        type:"POST",
        url:"Livre_de_visage_Ajax.php?action=refreshChat",
        success: function(retour){
            $("#chatBox").append(retour);
            if(retour!=""){
		    	 $("#topChat").empty().append("Chatbox <font color='red'>[NEW]</font>");
		    }
        }
    });
};