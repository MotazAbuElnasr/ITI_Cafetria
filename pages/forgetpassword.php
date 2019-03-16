<?php
include_once 'classes/db.php';
use \PHPMailer\PHPMailer\Exception;
/* Exception class. */
include 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
include 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
include 'PHPMailer/src/SMTP.php';
$db= new DbManager();
$emailError ="";
$success = 0;
function checkValid($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function generatePassword($length = 15) {
    $characters = '!@#$%^&*()_+0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$valid=true;
if(isset($_POST['submit'])) {
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
        $valid = false;
    } else {
        $email = checkValid($_POST["email"]);
        $userEmail = $db->getUser($email);
        if($userEmail == ""){
            $emailError = "This mail is not registered";
            $valid = false;
        }
    }

    if ($valid){
$mail = new \PHPMailer\PHPMailer\PHPMailer(TRUE);
    try {
        $generatedPassword = generatePassword();
        $db->changePassword($userEmail,md5($generatedPassword));
    $mail->setFrom('iti_cafe@outlook.com', 'ITI Cafe Admin');
    $mail->addAddress($userEmail);
    $mail->Subject = 'Your new password ITI cafe';
    $mail->Body = "Hello, this is ITI cafe team. please use the following password for login then you can change it for later \n
     $generatedPassword";
    $mail->isSMTP();

    /* SMTP server address. */
    $mail->Host = 'smtp-mail.outlook.com';

    /* Use SMTP authentication. */
    $mail->SMTPAuth = TRUE;

    /* Set the encryption system. */
//    $mail->SMTPSecure = 'tls';

    /* SMTP authentication username. */
    $mail->Username = 'iti_cafe@outlook.com';

    /* SMTP authentication password. */
    $mail->Password = 'iti39phpcafe';

    /* Set the SMTP port. */
    $mail->Port = 587;

    /* Finally send the mail. */
    $mail->send();
    $success=1;
}
catch (Exception $e)
{
    echo $e->errorMessage();
}
catch (\Exception $e)
{
    echo $e->getMessage();
}

}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password</title>
    <link rel = "stylesheet" href = "./assets/style/bodyImg.css" >

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body text-center">
                    <h5 class="card-title text-center">Forget password</h5>
                    <form class="form" method="post" action="forgetpassword">
                        <div class="form-label-group text-center">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email">
                            <h6 style="color: red"><?=$emailError?></h6>
                            <? if ($success){ ?>
                            <h6 style="color: green">we have sent you email with instrunctions</h6>
                            <? } ?>

                            <input type="submit" class="btn btn-primary " value="Submit" name="submit">

                        </div>
                    </form>
                    <a href="/"><input style="border-radius:20px" type="button" class="btn btn-primary " value="Log in" name="Home"></a>

                </div>
            </div>
        </div>
    </div>
</div>
</body>