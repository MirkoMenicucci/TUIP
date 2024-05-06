<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require '.\vendor\autoload.php';
 require '..\site\session.php';

send_mail($_POST['email'],$_POST['subject'],$_POST['message'],$_POST['urlAttuale']);

function send_mail($email, $oggetto, $messaggio, $path_allegato = null, $urlAttuale = null){
    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = "smtps.aruba.it"; //indirizzo del server di posta in uscita
        $mail->SMTPDebug = 0;
        $mail->Port = 465; //porta del server di posta in uscita
 	    $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = false;
	    $mail->SMTPSecure = 'ssl'; //tls o ssl informarsi presso il provider del vostro server di posta
        $mail->Username = "info@tuip.it"; //la vostra mail
        $mail->Password = "#Tuip2022"; //password per accedere alla vostra mail
        $mail->Priority    = 1; //(1 = High, 3 = Normal, 5 = low)
        $mail->setFrom('info@tuip.it', 'Tuip'); //impostazione del mittente
        $mail->AddAddress($email);
        //$mail->AddCC('info@tuip.it');
        $mail->IsHTML(true); 
        $mail->Subject  =  $oggetto;
        $mail->Body     =  $messaggio;
        $mail->AltBody  =  "";
        $mail->AddAttachment($path_allegato);
        if(!$mail->Send()){
            return false;
        }
        else{
            header("Location: {$_POST['urlAttuale']}?invio=success");
            return true;
            
        }
        //echo !extension_loaded('openssl')?"Not Available":"Available";
}
?>