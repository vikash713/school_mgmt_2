<?php
session_start();
include "connection.php"; // Ensure this path is correct

if (isset($_POST['Register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if ($fname != "" && $lname != "" && $password != "" && $conpassword != "" && $gender != "" && $email != "" && $phone != "" && $address != "") {
        if ($password === $conpassword) {
            // Check if email already exists
            $email_check_query = "SELECT * FROM form WHERE email='$email'";
            $result = mysqli_query($conn, $email_check_query);
            
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['msg'] = "Email address is already registered.";
            } else {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                // Insert into the database
                $query = "INSERT INTO form (fname, lname, password, email, phone, address, gender) VALUES ('$fname', '$lname', '$hashed_password', '$email', '$phone', '$address', '$gender')";
                $data = mysqli_query($conn, $query);
                
                if ($data) {
                    $_SESSION['msg'] = "Registered successfully!";
                    header("Location:login.php"); // Redirect to login page after successful registration
                    exit();
                } else {
                    $_SESSION['msg'] = "Failed to register.";
                }
            }
        } else {
            $_SESSION['msg'] = "Passwords do not match.";
        }
    } else {
        $_SESSION['msg'] = "Please fill all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP CRUD Operation</title>
  <style>
     body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
    }

    .title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }

    .form {
      display: flex;
      flex-direction: column;
    }

    .input_feild {
      margin-bottom: 15px;
    }

    .input_feild label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #555;
    }

    .input_feild .input,
    .input_feild .textarea,
    .input_feild .selectbox {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ddd;
      box-sizing: border-box;
    }

    .input_feild .input:focus,
    .input_feild .textarea:focus,
    .input_feild .selectbox:focus {
      border-color: #007bff;
      outline: none;
    }

    .textarea {
      resize: vertical;
      min-height: 100px;
    }

    .terms {
      display: flex;
      align-items: center;
    }

    .terms .check {
      position: relative;
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }

    .terms .check input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .terms .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 20px;
      width: 20px;
      background-color: #eee;
      border-radius: 4px;
    }

    .terms .check input:checked ~ .checkmark {
      background-color: #007bff;
    }

    .terms .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    .terms .check input:checked ~ .checkmark:after {
      display: block;
      left: 7px;
      top: 3px;
      width: 5px;
      height: 10px;
      border: solid #fff;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    .terms p {
      margin: 0;
      color: #555;
    }

    .btn {
      background-color: #007bff;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
    function validateForm() {
      const password = document.getElementsByName('password')[0].value;
      const conpassword = document.getElementsByName('conpassword')[0].value;
      if (password !== conpassword) {
        alert('Passwords do not match.');
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
    <div class="container">
        <form action="#" method="post" onsubmit="return validateForm()">
            <div class="title">Registration Form</div>
            <div class="form">
                <div class="input_feild">
                    <label for="fname">First Name</label>
                    <input type="text" class="input" name="fname" id="fname" required>
                </div>
                <div class="input_feild">
                    <label for="lname">User Name</label>
                    <input type="text" class="input" name="lname" required>
                </div>
                <div class="input_feild">
                    <label for="password">Password</label>
                    <input type="password" class="input" name="password" required minlength="6">
                </div>
                <div class="input_feild">
                    <label for="conpassword">Confirm Password</label>
                    <input type="password" class="input" name="conpassword" required minlength="6">
                </div>
                <div class="input_feild">
                    <label for="gender">Subject</label>
                    <select class="selectbox" name="gender" required>
                        <option value="" disabled selected>Select</option>
                        <option value="C">C</option>
                        <option value="C++">C++</option>
                        <option value="Php">Php</option>
                        <option value="Javascript">Javascript</option>
                        <option value="Node JS">Node JS</option>
                    </select>
                </div>
                <div class="input_feild">
                    <label for="email">Email Address</label>
                    <input type="email" class="input" name="email" required>
                </div>
                <div class="input_feild">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="input" name="phone" required pattern="[0-9]{10}">
                </div>
                <div class="input_feild">
                    <label for="address">Address</label>
                    <textarea class="textarea" name="address" required></textarea>
                </div>
                <div class="input_feild terms">
                    <label class="check">
                        <input type="checkbox" name="terms" required>
                        <span class="checkmark"></span>
                    </label>
                    <p>Agree to terms and conditions</p>
                </div>
                <div class="input_feild">
                    <input type="submit" value="Register" class="btn" name="Register">
                </div>
            </form>
            <?php
            if (isset($_SESSION['msg'])) {
                echo '<p>' . $_SESSION['msg'] . '</p>';
                unset($_SESSION['msg']);
            }
            ?>
        </div>
    </body>
</html>
