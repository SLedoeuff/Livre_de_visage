<?php
// Inclusion de la classe utilisateur
require_once "chat.class.php";

class chatTable {
	//fonction écrite par Demogue Bruno
	public static function getChat()
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$chatRepository = $em->getRepository('chat');
		$chat = $chatRepository->findAll();	
		
		return $chat; 
	}
	//fonction écrite par Demogue Bruno
	public static function getLastChat()
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$chatRepository = $em->getRepository('chat');
		$chat = $chatRepository->findOneBy(array(), array('id' => 'DESC'));
		
		return $chat; 
	}
	//fonction écrite par Sacha Le Doeuff
	public static function getLatestChat()
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$chatRepository = $em->getRepository('chat');
		$chat = $chatRepository->findBy(array(), array('id' => 'DESC'), 30);
		
		return $chat; 
	}

	//Sacha Le Doeuff
	//les dernier chat selon l'id du dernier qu'on a afficher
	public static function getLastChatById($myid){
		$em = dbconnection::getInstance()->getEntityManager();
		//$chatRepository = $em->getRepository('chat');

		$qb = $em->createQueryBuilder();
		$qb->select('chat')
   			->from('Chat','chat')
   			->where('chat.id > :myid')
   			->setParameter('myid',$myid);

		//$qb->setParameter('myid',$myid);

		return $qb->getQuery()->getResult();
	}

	//Sacha Le Doeuff
	public static function setChat($chat){

		$em = dbconnection::getInstance()->getEntityManager();
		$em->persist($chat);
		$em->flush();

		return true;
	}

}

?>
