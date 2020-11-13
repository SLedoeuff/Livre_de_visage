<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application 
 *
 */

class mainController
{
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{
		return context::SUCCESS;
	}
	public static function reco($request,$context)
	{
		if(!empty(context::getSessionAttribute("user_id")))
		{
			$context->user_id=context::getSessionAttribute("user_id");
			if(isset ($request['id'])) $context->id=$request['id'];
			else $context->id=$context->user_id;
			$context->setLayout("layout4");
			return true;
		}
		return false;
	}
	public static function login($request,$context)
	{
		if(!mainController::reco($request,$context))
		{
			if (isset ($request['login']) )
			{
				if(empty($request['login']) || empty($request['password']))
				{
					$context->notification = "<div class='row'><div class='col-12  text-center block3'>l'un ou les deux champs sont vide</div></div>" ;
					$context->setLayout("layout");
					return context::ERROR;
				}
				$utilisateur = utilisateurTable::getUserByLoginAndPass($request['login'],$request['password']);
				if($utilisateur == false)
				{
					$context->notification = "<div class='row'><div class='col-12  text-center block3'>Couple identifiant/mot de passe invalide </div></div>";
					$context->setLayout("layout");
					return context::ERROR;
				}
	 			else 
	 			{
					context::setSessionAttribute("identifiant", $request['login']);
					context::setSessionAttribute("user_id",$utilisateur->id);
					$context->user_id=$utilisateur->id;
					$context->id=$utilisateur->id;

					$context->setLayout("layout4");
					$context->notification = "<div class='row'><div class='col-12  text-center block3'>Bienvenue ".context::getSessionAttribute('identifiant').".</div></div>";

					return context::SUCCESS;
				}
			}
			return context::ERROR;
		}
		return context::SUCCESS;
	}

	/*Sacha Le Doeuff*/
	public static function chat($request,$context){
		$context->LeZoo=chatTable::getLatestChat();
		$boule=null;
		$temp=array_reverse($context->LeZoo);
		foreach($temp as $value){
			$boule=$value->id;
		}

		context::setSessionAttribute("idLastMess", $boule);
		return context::SUCCESS;
	}
	/*Sacha Le Doeuff*/
	public static function messChat($request,$context){
		if(isset($request["texteChat"])){
			$idEmet=context::getSessionAttribute('user_id');
			$you=utilisateurTable::getUserById($idEmet);

			$newpost=new post();
			$newpost->texte=$request["texteChat"];
			$newpost->date=new DateTime("now");

			$newchat=new chat();
			$newchat->emetteur=$you;
			$newchat->post=$newpost;


			$passPost=postTable::setpost($newpost);
			if($passPost==false){ return context::ERROR;}
			$passChat=chatTable::setChat($newchat);
			if($passChat==false){ return context::ERROR;}

			$context->qui=context::getSessionAttribute('identifiant');
			$context->quoi=$request["texteChat"];

			return context::SUCCESS;
		}
	}

	/*Sacha Le Doeuff*/
	public static function refreshChat($request,$context){
		
		$test=context::getSessionAttribute('idLastMess');
		if($test==null){return context::ERROR;}
		$lastMess=chatTable::getLastChatById($test);
		$context->newMess=$lastMess;
		$context->moi=context::getSessionAttribute('identifiant'); //pour ignorez mes messages déjà afficher
		$boule=null;
		foreach($context->newMess as $value){
			$boule=$value->id;
		}

		if($boule!=null) {
			if($value->emetteur->identifiant!=$context->moi){
				context::setSessionAttribute("idLastMess", $boule);
				return context::SUCCESS;
			}
		}
		return context::ERROR;
	}
	public static function profil($request,$context)
	{
		$context->actualUser=utilisateurTable::getUserById($context->id);
		
		return context::SUCCESS;
	}
	public static function changestatut($request,$context)	{
		if(isset ($request['updateStatut']))
		{
			mainController::reco($request,$context);
			$context->actualUser=utilisateurTable::getUserById(context::getSessionAttribute("user_id"));
			$context->actualUser->statut=$request['updateStatut'];
			utilisateurtable::setStatut($context->actualUser);
			$context->setLayout("layout4");
			return context::SUCCESS;
		}
		return context::ERROR;
	}
	public static function changeavatar($request,$context)  {
        if(isset ($request['updateavatar']))
        {
            mainController::reco($request,$context);
            $context->actualUser=utilisateurTable::getUserById(context::getSessionAttribute("user_id"));
            $context->actualUser->avatar=$request['updateavatar'];
            utilisateurtable::setAvatar($context->actualUser);
            $context->setLayout("layout4");
            return context::SUCCESS;
        }
        return context::ERROR;
    }
	public static function amis($request,$context)
	{
		$context->listOfUsers=utilisateurTable::getUsers();
		return context::SUCCESS;
	}
	
	public static function newmessage($request,$context)
	{
		if(isset ($request['newmessage']))
		{
			mainController::reco($request,$context);
			$context->actualUser=utilisateurTable::getUserById(context::getSessionAttribute("user_id"));

			$context->test = new post();
			$context->test->texte = $request['newmessage'];
			$context->test->date = new DateTime("now");
			if(isset ($request['newimage']))
			{
				$context->test->image=$request['newimage'];
			}
			$context->test2 = new message();
			$context->test2->emetteur = $context->actualUser;
			$context->test2->destinataire = utilisateurTable::getUserById($context->id);
			$context->test2->parent = $context->test2->emetteur;
			$context->test2->post = $context->test;
			$context->test2->aime = 0;

			postTable::setpost($context->test);
			messageTable::setmessage($context->test2);
			$context->setLayout("layout4");
			return context::SUCCESS;
		}
		return context::ERROR;
	}
	public static function newmessform($request,$context)
	{
		return context::SUCCESS;
	}
	public static function message($request,$context)
	{
		$context->listOfMessFor=utilisateurTable::getUserById($context->id)->messages;
		return context::SUCCESS;
	}
	public static function onemessage($request,$context)
	{
		return context::SUCCESS;
	}

	public static function logout($request,$context)
	{
		session_destroy();		
		$context->notification = "<div class='row'><div class='col-12  text-center block3'> Deconnection reussie.</div></div>";
		$context->setLayout("layout");
		return context::SUCCESS;
	}
	public static function menue($request,$context)
	{
		return context::SUCCESS;
	}
	public static function like($request,$context)
	{
		mainController::reco($request,$context);
		$context->like=messageTable::likeMessageById($request['idmess']);
		return context::SUCCESS;
		
	}
	public static function partage($request,$context)
	{
		mainController::reco($request,$context);

		$context->actualUser=utilisateurTable::getUserById(context::getSessionAttribute("user_id"));

			$context->mess=messageTable::getMessageById($request['idmess']);
			$context->test=$context->mess->post;

			$context->test2 = new message();
			$context->test2->emetteur = $context->actualUser;
			$context->test2->destinataire = utilisateurTable::getUserById($context->id);
			if(isset($context->mess->parent))
			{
				$context->test2->parent = $context->mess->parent;
			}
			else
			{
				$context->test2->parent = $context->mess->emetteur;
			}
			$context->test2->post = $context->test;
			$context->test2->aime = 0;

			messageTable::setmessage($context->test2);
			/*$context->setLayout("layout4");*/

		return context::SUCCESS;
	
	}
	public static function test($request,$context)
	{
		return context::NONE;
	}


}
?>
