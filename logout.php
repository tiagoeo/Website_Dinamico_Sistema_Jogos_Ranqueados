<?php 
	include(__DIR__.'/vo/websiteVO.php');
    sec_session_start();

    if (!isset($_SESSION['UID']) && empty($_SESSION['UID'])){
		header("Location: index.php");
        exit(); 
	}else{
        unset($_SESSION['UID']);
        unset($_SESSION['NOME']);
        unset($_SESSION['EMAIL']);
        unset($_SESSION['STATUS']);

        $_SESSION = array(); 

        session_unset();

        session_destroy();

        session_write_close();
        
        setcookie(session_name(),'',0,'/');
    }

    header("Location: index.php");
    exit(); 
?>