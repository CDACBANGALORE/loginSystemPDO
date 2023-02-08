<?php
    $pdo = include_once '../database/connection.php';
    try {
        if(isset($_POST['login'])) {
            $email = $_POST['email'];
            $userPassword = $_POST['password'];
    
            $sql = "SELECT * FROM `users` WHERE `email` = :email";
            $stmt = $pdo->prepare($sql);
            $data = [
                ':email' => $email
            ];
            $stmt->execute($data);
            if($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($userPassword, $row['password'])) {
                    unset($row['password']);
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    header('Location: home.php');
                }
                else {
                    echo "password not match";
                }
            }
            else {
                echo "email failed";
            }
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    
?>