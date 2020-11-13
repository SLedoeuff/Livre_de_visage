<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

	public static function getUserByLoginAndPass($login,$pass)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));
		/*$user = $userRepository->findOneBy(array('identifiant' => $login));*/
		/*$user = $userRepository->findOneBy(array('id' => $login));*/
		
		return $user; 
	}

	//fonction écrite par Sacha Le Doeuff
	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');

		$user = $userRepository->findOneBy(array('id' => $id));
		
		return $user;
	}

	//fonction écrite par Sacha Le Doeuff
	public static function getUsers(){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$userRepository = $em->getRepository('utilisateur');

		$user = $userRepository->findAll();
		
		return $user;
	}


	/**
     * Set statut
     *
     * @param int $actualuser
     */
	public static function setStatut($actualuser)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		

		$em->flush($actualuser);
	}

	/**
     * Set avatar
     *
     * @param int $actualuser
     */
	public static function setAvatar($actualuser)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		

		$em->flush($actualuser);
	}
}

?>
