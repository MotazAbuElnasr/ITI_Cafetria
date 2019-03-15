<?php
include_once 'classes/db.php';
$db= new DbManager();
$emailError ="";
if(isset($_POST['submit'])){
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = checkValid($_POST["email"]); 
    }
    if($valid) 
        $db->getUsers($email);
}
function checkValid($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php
use \PHPMailer\PHPMailer\Exception;
/* Exception class. */
include 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
include 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
include 'PHPMailer/src/SMTP.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer(TRUE);


try {
    $mail->setFrom('cafeowner1@outlook.com', '
    ');
    $mail->addAddress('cafeowner1@outlook.com', 'owner');
    $mail->Subject = 'Force';
    $mail->Body = 'There is a great disturbance in the Force.';
    /* SMTP parameters. */
    /* Tells PHPMailer to use SMTP. */
    $mail->isSMTP();

    /* SMTP server address. */
    $mail->Host = 'smtp-mail.outlook.com';

    /* Use SMTP authentication. */
    $mail->SMTPAuth = TRUE;

    /* Set the encryption system. */
//    $mail->SMTPSecure = 'tls';

    /* SMTP authentication username. */
    $mail->Username = 'ownerone@outlook.com';

    /* SMTP authentication password. */
    $mail->Password = 'OWNER123';

    /* Set the SMTP port. */
    $mail->Port = 587;


    /*Recipients */
    $mail->setAddress($email , $email);

    //content
    // $mail->isHTML(ture);
    // $mail->Subject= 'Forget Password';
    // $mail->Body= "Hi $email your password is {$row['password]}" ;

    /* Finally send the mail. */
    // $mail->send();
    // echo 'Your Password has been sent on your Email';
}
catch (Exception $e)
{
    echo $e->errorMessage();
}
catch (\Exception $e)
{
    echo $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
        </div>
        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
    </form>
</body>
</html>