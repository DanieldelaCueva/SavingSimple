<?php
    session_start();
    
    require 'database.php'

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email, $_POST['email']');
        $records->execute;
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php-login');
        } else {
            $message = 'Email or password are incorrect';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="../SavingSimple/assets/css/style.css"/>
    </head>    

    <body>
        <header>
            <a href="../">SAVINGSIMPLE</a> 
        </header>
        <form action="login.php" method="post">
            <input type="text" name="email" placeholder="Enter your email">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="submit" value="LOGIN">
        </form>
        <h4><a href="signup.html">New to SavingSimple? Sign up here</a></h4>
        <?php if(!empty($message)): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
    </body>
</html>