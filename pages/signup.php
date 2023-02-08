<?php
    $message = '';

    $pdo = include_once '../database/connection.php';

    if(isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $sql = 'SELECT `email` FROM `users` WHERE `email` = :email';
        $stmt = $pdo->prepare($sql);
        $data = [
            ":email" => $email
        ];
        $result = $stmt->execute($data);
        $noRow = $stmt->rowCount();
        if($noRow > 0) {
            $message = "Email is already exist";
        }
        else {
            if($password == $cpassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = 'INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :hash)';
                $stmt = $pdo->prepare($sql);
                $data = [
                    "name" =>$name,
                    "email" => $email,
                    "hash" => $hash
                ];
                
                $stmt->bindValue(':name', $data['name']);
                $stmt->bindValue(':email', $data['email']);
                $stmt->bindValue(':hash', $data['hash']);

                $result = $stmt->execute($data);
                if($result) {
                    echo '
                        <script>
                            alert("signUp successfully. Login now");
                        </script>
                    ';
                }
            }
            else {
                $message = "Password not match";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/loginStyle.css">
  </head>
  <body>
    <div class="container main_box d-flex justify-content-center align-items-center flex-nowrap">
        <div class="parent_box p-2 shadow-sm rounded">
            <div>
                <h2 class="text-center my-5">SignUp</h2>
            </div>
            <div class="input_form mx-2 my-5">
                <form action="#" method="post" autocomplete="off">
                    <div class="inputSize mt-4 d-flex flex-nowrap">
                        <label class="mx-2" for="name"><i class="bi bi-person-circle"></i></label>
                        <input type="text" id="name" name="name" placeholder="Your full name" class="border-0" size="30" required ><br>
                    </div>
                    <div class="inputSize mt-4 d-flex flex-nowrap">
                        <label class="mx-2" for="email"><i class="bi bi-person-circle"></i></label>
                        <input type="email" id="email" name="email" placeholder="Valid Email Id" class="border-0" size="30" required ><br>
                    </div>
                    <div class="inputSize my-4 d-flex flex-nowrap">
                        <label class="mx-2" for="password"><i class="bi bi-shield-lock-fill"></i></label>
                        <input id="password" type="password" name="password" placeholder="Strong Password" maxlength="10" minlength="6" class="border-0" size="30" required>
                    </div>
                    <div class="inputSize my-4 d-flex flex-nowrap">
                        <label class="mx-2" for="cpassword"><i class="bi bi-shield-fill-check"></i></label>
                        <input id="cpassword" type="password" name="cpassword" placeholder="Confirm password" maxlength="10" minlength="6" class="border-0" size="30" required>
                    </div>
                    <?php
                        if($message != '') { 
                            echo '
                            <div>
                                <p class="text-info text-center" style="font-size: 0.8rem;">'.$message.'</p>
                            </div>
                            ';
                        }
                    ?>
                    <div class="d-grid gap-2 mt-2">
                        <button name="signup" type="input" class="btn btn-primary btn-lg" type="button">SignUp</button>
                    </div>
                </form>

                <div class="my-3 text-center mb-5">
                    <a href="../index.html" class="text-decoration-none">Already have an account? login here</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>