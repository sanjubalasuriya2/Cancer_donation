<link rel="stylesheet" type="text/css" href="index.css">

<?php 

include ('db/db.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer();

	$mail->isSMTP();

	$mail->Host = "smtp.gmail.com";

	$mail->SMTPAuth = true;

	$mail->SMTPSecure = "tls";

	$mail->Port = "587";

	$mail->Username = "savelifefoundationsl2@gmail.com";

	$mail->Password = "ywwelcmgxovhzxbp";


$email = $_POST["email1"];

$nic = $_POST["nic1"];
$amount = $_POST["amount1"];

$name = "/^[A-Z][a-zA-Z]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";





if(empty($email) || empty($nic) ){


    

    ?>
<script>
swal({
    title: "error!",
    text: "Fill all Feilds!",
    icon: "error",
    button: "close!",
});
</script>

<?php 

    exit();
}else{
    
    
    
    if(!preg_match($emailValidation,$email)){
        ?>
<script>
swal({
    title: "error!",
    text: "Emai is Invalid!",
    icon: "error",
    button: "close!",
});
</script>

<?php 
        exit();
    }
    

    

$sql3 = "SELECT id FROM members WHERE nic = '$nic' LIMIT 1";
$check_query = mysqli_query($con, $sql3);
$count_emp = mysqli_num_rows($check_query);



if($count_emp > 0){

    $res=mysqli_query($con,"SELECT * FROM `members` WHERE nic='$nic'");  
    while($row=mysqli_fetch_array($res))
    {
        
        $m_id = $row['m_id'];
        
        
        
    }




    $sql2 = "INSERT INTO `donations` (`id`, `key_id`, `status`, `amount`) 
    VALUES (NULL, '$m_id', 'member', '$amount')";

    $run_query2 = mysqli_query($con,$sql2);


 //Email subject
 $mail->Subject = "Save Life Foundation";
 //Set sender email
     $mail->setFrom('savelifefoundationsl2@gmail.com');
 //Enable HTML
     $mail->isHTML(true);
 //Attachment
     //$mail->addAttachment('img/attachment.png');
 //Email body
 $mail->Body = "<!DOCTYPE html>
 <html lang='en'>
   <head>
     <meta charset='UTF-8' />
     <meta http-equiv='X-UA-Compatible' content='IE=edge' />
     <meta name='viewport' content='width=device-width, initial-scale=1.0' />
   </head>
   <body style='border: solid 2px #bd0000; padding: 10px'>
     <div style='text-align: center;
     color: #bd0000;
     background-color: #fff;
     align-items: center;
     padding-left: 25%;
     padding-right: 25%;
     font-size: 30px;'>
       <h1 style='font-size: 40px'>Save Life Cancer Foundation</h1>
     </div>
     <div style='text-align: center; 
     padding: 40px; 
     color: #000000;'>
       <center>
         <hr style='width: 50%'/>
         <h3 style='padding: 20px'>Hi Amal,</h3>
         <p>Congratulations...</p>
         <p>You renewed your membership now in Save Life Cancer Foundation.</p>
         <p>Your membership valid for 1 year</p>
         <h3>Thank You...!</h3>
         <hr style='width: 50%'/>
       </center>
     </div>
   </body>
 </html>";
 //Add recipient
     $mail->addAddress($email);
 //Finally send email
     if ( $mail->send() ) {
         ?>
<script>
swal({
    title: "Success!",
    text: "You clicked the button!",
    icon: "success",

});
setTimeout(function() {
    window.location = "member.php";
}, 2000);
</script>
<?php
     }else{
         echo "Message could not be sent. Mailer Error: ";
     }
 //Closing smtp connection
     $mail->smtpClose();
 

    



    exit();
}



else{


    ?>
<script>
swal({
    title: "error!",
    text: "You are not register",
    icon: "error",
    button: "close!",
});
setTimeout(function() {
    window.location = "member.php";
}, 3000);
</script>
<?php


}
    
}
    

?>