<?php

require_once "message.class.php";

class messageTable {

    /**
     * Set message
     *
     * @param message $test2
     */
    public static function setMessage($test2)
    {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $em->persist($test2);
        $em->flush();
    }
    public static function likeMessageById($id){
        $em = dbconnection::getInstance()->getEntityManager() ;
        $messageRepository = $em->getRepository('message');

        $message = $messageRepository->findOneBy(array('id' => $id));
        $message->aime=$message->aime+1;

        $em->flush();

        return $message->aime;
    }
    public static function getMessageById($id){
        $em = dbconnection::getInstance()->getEntityManager() ;
        $messageRepository = $em->getRepository('message');

        $message = $messageRepository->findOneBy(array('id' => $id));
        
        return $message;
    }
}




?>
