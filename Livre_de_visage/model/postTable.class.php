<?php

require_once "post.class.php";

class postTable {

    //fonction écrite par Demogue Bruno
    public static function setpost($test)
    {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $em->persist($test);
        $em->flush();
        return true;
   }
}



?>
