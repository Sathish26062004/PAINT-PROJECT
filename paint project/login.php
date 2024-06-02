<?php
    session_start();
    require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/form.css"/>
    <title>Login</title>
</head>
<body>
   <?php
    include 'header.php';
    ?>
    <main>
        <section id="login" class="form">
            <form  method="post" action="">
                <h1>Log in</h1>
                <p>
                    <label for="username">Username</label>
                    <br>
                    <input required type="text" name="username" id="username" placeholder="Username" />
                </p>
                <p>
                    <label for="password">Password</label>
                    <br>
                    <input required type="password" id="password" name="password" placeholder="Password" />
                </p>
                <p class="center">
                    <input type="submit" class="submit" name="login" placeholder="Submit" value="Submit"/>
                </p>
            </form>
            <p class="center"><a href="signup.php">sign up</a></p>
        </section>
        <?php
            if(isset($_POST['login'])) {
                $query = "SELECT username, user_type FROM login WHERE username='".$_POST['username']."' AND password = '".$_POST['password']."'";
                $result = mysqli_query( $conn, $query);
                if(mysqli_num_rows($result) > 0) {
                    $_SESSION['username'] = $_POST['username'];
                    $row=mysqli_fetch_assoc($result);
                    if($row['user_type']=="paint")
                    {
                        $_SESSION['type'] = 'user';
                    echo "<script> window.location = 'home.php';</script>";
                    }
                    else
                    {
                        $_SESSION['type'] = 'admin';
                        echo "<script> window.location = 'home1.php';</script>";

                    }
                } else {
                    echo "<script>alert('Username or password is incorrect');</script>";
                }
            }
        ?>
    </main>
</body>
</html