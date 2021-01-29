<?php
    require 'database.php'

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':email', $_POST['email']);

        if($stmt->execute()){
            $message = 'Successfully created new user';
        }else{
            $message = 'Error while creating user';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="../SavingSimple/assets/css/style.css"/>
    </head>    

    <body>
        <header>
            <a href="../">SAVINGSIMPLE</a> 
        </header>
        <form action="signup.php" method="post">
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="password" name="confirm_password" placeholder="Confirm your password">
            <input type="submit" value="SIGN UP">
        </form>

        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
    </body>
</html>