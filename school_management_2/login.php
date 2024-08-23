<?php
session_start();
include "connection.php"; // Make sure the path is correct

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != "" && $password != "") {
        $query = "SELECT * FROM form WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['fname']; // Set user session
                header("Location:welcome.php"); // Redirect to a welcome page after successful login
                exit();
            } else {
                $_SESSION['msg'] = "Invalid email or password.";
            }
        } else {
            $_SESSION['msg'] = "Error retrieving user data.";
        }
    } else {
        $_SESSION['msg'] = "Please enter both email and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* Reset some default styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8e2de2, #4a00e0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 450px;
            text-align: center;
            box-sizing: border-box;
        }

        .container h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 26px;
            font-weight: bold;
            background: -webkit-linear-gradient(#00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .container label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
            color: #555;
        }

        .container input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .container input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .button-container input[type="submit"] {
            width: 48%;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button-container input[type="submit"].login-submit {
            background-color: #4CAF50;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button-container input[type="submit"].login-submit:hover {
            background-color: #45a049;
        }

        .button-container input[type="submit"].register-btn {
            background-color: #2196F3;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .button-container input[type="submit"].register-btn:hover {
            background-color: #0b79d0;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>School Admin Login</h2>
        <form action="#" method="post">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <div class="button-container">
                <input type="submit" value="Login" class="login-submit" name="Login">
                <input type="button" value="Register" class="register-btn" onclick="window.location.href='register.php';">
            </div>

            <?php
            if (isset($_SESSION['msg'])) {
                echo '<p class="error-message">' . $_SESSION['msg'] . '</p>';
                unset($_SESSION['msg']);
            }
            ?>
        </form>
    </div>
</body>
</html>
