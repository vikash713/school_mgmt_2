<?php
include "connection.php"; // Include your database connection file

// Check if the student ID is provided in the query string
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch the current details of the student from the database
    $query = "SELECT * FROM form WHERE id = '$student_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    // Check if the student exists
    if (mysqli_num_rows($result) == 0) {
        die("No student found with ID: " . $student_id);
    }

    $student = mysqli_fetch_assoc($result);
} else {
    die("No student ID provided.");
}

// Handle the form submission
if (isset($_POST['Update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if all required fields are filled
    if ($fname != "" && $lname != "" && $password != "" && $conpassword != "" && $gender != "" && $email != "" && $phone != "" && $address != "") {
        // Update the student's details in the database
        $query = "UPDATE form SET fname='$fname', lname='$lname', password='$password', cpassword='$conpassword', gender='$gender', email='$email', phone='$phone', address='$address' WHERE id='$student_id'";
        $data = mysqli_query($conn, $query);

        if ($data) {
            echo "Student updated successfully!";
        } else {
            echo "Failed to update student.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Details</title>
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
</head>
<body>
    <div class="container">
        <form action="displayall.php" method="post">
            <div class="title">Update Student Details</div>
            <div class="form">
                <div class="input_feild">
                    <label for="fname">First Name</label>
                    <input type="text" class="input" name="fname" id="fname" value="<?php echo htmlspecialchars($student['fname']); ?>">
                </div>
                <div class="input_feild">
                    <label for="lname">Last Name</label>
                    <input type="text" class="input" name="lname" value="<?php echo htmlspecialchars($student['lname']); ?>">
                </div>
                <div class="input_feild">
                    <label for="password">Password</label>
                    <input type="password" class="input" name="password" value="<?php echo htmlspecialchars($student['password']); ?>">
                </div>
                <div class="input_feild">
                    <label for="conpassword">Confirm Password</label>
                    <input type="password" class="input" name="conpassword" value="<?php echo htmlspecialchars($student['cpassword']); ?>">
                </div>
                <div class="input_feild">
                    <label for="gender">Gender</label>
                    <select class="selectbox" name="gender">
                        <option value="Male" <?php echo $student['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo $student['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="input_feild">
                    <label for="email">Email Address</label>
                    <input type="email" class="input" name="email" value="<?php echo htmlspecialchars($student['email']); ?>">
                </div>
                <div class="input_feild">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="input" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>">
                </div>
                <div class="input_feild">
                    <label for="address">Address</label>
                    <textarea class="textarea" name="address"><?php echo htmlspecialchars($student['address']); ?></textarea>
                </div>
                <div class="input_feild">
                    <input type="submit" value="Update" class="btn" name="Update">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
