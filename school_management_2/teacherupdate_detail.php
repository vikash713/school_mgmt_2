<?php
error_reporting(E_ALL); // Show all errors for debugging
include("connection.php");

// Fetch the teacher details based on the provided JSON data
if (isset($_GET['data'])) {
    $result = urldecode($_GET['data']); // Decode URL-encoded JSON data
    $data = json_decode($result, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<p>Error decoding JSON data.</p>";
        exit;
    }

    $teacher_id = $data['id'];

    // Fetch teacher data from the database
    $query = "SELECT * FROM teacher WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $teacher_data = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Fetch all courses
    $course_query = "SELECT * FROM course";
    $course_run = mysqli_query($conn, $course_query);

    // Fetch teacher's existing courses
    $teacher_courses_query = "SELECT course_id FROM teachercourse WHERE teacher_id = ?";
    $stmt = $conn->prepare($teacher_courses_query);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $teacher_courses_result = $stmt->get_result();
    $teacher_courses = [];
    while ($row = $teacher_courses_result->fetch_assoc()) {
        $teacher_courses[] = $row['course_id'];
    }
    $stmt->close();
} else {
    echo "<p>No teacher data provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher's Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS styles for the form */
        body {
            background-color: #53b6e1; /* Keeping the same background color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: aliceblue;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
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
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input_feild input[type="text"],
        .input_feild input[type="password"],
        .input_feild input[type="email"],
        .input_feild textarea,
        .input_feild select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .input_feild textarea {
            resize: vertical;
            height: 100px;
        }
        .input_feild input[type="checkbox"] {
            margin-right: 10px;
        }
        .input_feild .terms {
            display: flex;
            align-items: center;
        }
        .input_feild .terms label {
            margin-left: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <form action="teacher_display.php" method="POST">
        <div class="title">Update Teacher Detail</div>
        <div class="form">
            <div class="input_feild">
                <label for="id">Id</label>
                <input type="text" id="id" value="<?php echo htmlspecialchars($teacher_data['id']); ?>" name="id" readonly>
            </div>
            <div class="input_feild">
                <label for="fname">First Name</label>
                <input type="text" id="fname" value="<?php echo htmlspecialchars($teacher_data['fname']); ?>" name="fname">
            </div>
            <div class="input_feild">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" value="<?php echo htmlspecialchars($teacher_data['lname']); ?>" name="lname">
            </div>
            <div class="input_feild">
                <label for="password">Password</label>
                <input type="password" id="password" value="<?php echo htmlspecialchars($teacher_data['password']); ?>" name="password">
            </div>
            <div class="input_feild">
                <label for="conpassword">Confirm Password</label>
                <input type="password" id="conpassword" value="" name="conpassword">
            </div>
            <div class="input_feild">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="">Select</option>
                    <option value="Male" <?php echo ($teacher_data['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($teacher_data['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="input_feild">
                <label for="email">Email Address</label>
                <input type="email" id="email" value="<?php echo htmlspecialchars($teacher_data['email']); ?>" name="email">
            </div>
            <div class="input_feild">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" value="<?php echo htmlspecialchars($teacher_data['phone']); ?>" name="phone">
            </div>
            <div class="input_feild">
                <label for="address">Address</label>
                <textarea id="address" name="address"><?php echo htmlspecialchars($teacher_data['address']); ?></textarea>
            </div>
            <div class="input_feild">
                <label>Course</label>
                <?php
                while ($course = mysqli_fetch_assoc($course_run)) {
                    $checked = in_array($course['course_id'], $teacher_courses) ? 'checked' : '';
                    echo "<input type='checkbox' id='course_" . htmlspecialchars($course['course_id']) . "' name='course[]' value='" . htmlspecialchars($course['course_id']) . "' $checked>";
                    echo "<label for='course_" . htmlspecialchars($course['course_id']) . "'>" . htmlspecialchars($course['course_name']) . "</label><br>";
                }
                ?>
            </div>
            <div class="input_feild terms">
                <label class="check">
                    <input type="checkbox" id="terms" name="terms">
                    <span class="checkmark"></span>
                </label>
                <label for="terms">Agree to terms and conditions</label>
            </div>
            <div class="input_feild">
                <input type="submit" value="Update" class="btn" name="Register">
            </div>
        </div>
    </form>
</div>
</body>
</html>
