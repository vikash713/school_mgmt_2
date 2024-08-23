<?php
error_reporting(E_ALL); // Show all errors for debugging
include("connection.php");

// Handle Add Operation
if (isset($_POST['Add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $courses = isset($_POST['course']) ? $_POST['course'] : []; // Handle multiple courses

    if ($fname && $lname && $password && $conpassword && $gender && $email && $phone && $address) {
        // Insert into student
        $query = "INSERT INTO student (fname, lname, password, cpassword, gender, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssss", $fname, $lname, $password, $conpassword, $gender, $email, $phone, $address);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $student_id = $stmt->insert_id;

            // Insert into studentcourse
            foreach ($courses as $course_id) {
                $course_query = "INSERT INTO studentcourse (student_id, course_id) VALUES (?, ?)";
                $course_stmt = $conn->prepare($course_query);
                $course_stmt->bind_param("ii", $student_id, $course_id);
                $course_stmt->execute();
            }
            // echo "<p>Inserted successfully!</p>";
        } else {
            echo "<p>Failed to insert.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Please insert all details.</p>";
    }
}

// Handle Update Operation
if (isset($_POST['Register'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $courses = isset($_POST['course']) ? $_POST['course'] : []; // Handle multiple courses

    // Update student
    $sql = "UPDATE student SET fname=?, lname=?, password=?, email=?, phone=?, address=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $fname, $lname, $password, $email, $phone, $address, $id);
    $stmt->execute();

    // Delete existing courses
    $delete_query = "DELETE FROM studentcourse WHERE student_id=?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Insert new courses
    foreach ($courses as $course_id) {
        $query = "INSERT INTO studentcourse (student_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id, $course_id);
        $stmt->execute();
    }

    // echo "<p>Record updated successfully</p>";
}

// Handle Delete Operation
if (isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $delete_query = "DELETE FROM student WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // echo "<p>Record deleted successfully!</p>";
    } else {
        echo "<p>Failed to delete record: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch student records for display with course names
$query = "SELECT s.id, s.fname, s.lname, s.password, s.gender, s.email, s.phone, s.address, GROUP_CONCAT(c.course_name SEPARATOR ', ') AS course_names
          FROM student s
          LEFT JOIN studentcourse sc ON s.id = sc.student_id
          LEFT JOIN course c ON sc.course_id = c.course_id
          GROUP BY s.id";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Student's Records</title>
    <style>
        body {
            background-color: #53b6e1;
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
            max-width: 1200px;
            background-color: aliceblue;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            overflow-x: auto;
            margin-top: 5px;
            margin-bottom: 40px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .operations a, .operations form {
            display: inline-block;
            margin: 2px;
        }
        .operations a {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
        }
        .operations a:hover {
            background-color: #0056b3;
        }
        .operations form input[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            background-color: #dc3545;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
        }
        .operations form input[type="submit"]:hover {
            background-color: #c82333;
        }
        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            text-align: center;
        }
        .add-button a {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
        }
        .add-button a:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-button a {
            padding: 10px 20px;
            background-color: #e0e0e0;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            font-weight: bold; 
        }
        .back-button a:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="back-button">
            <a href="./welcome.php">Back</a>
        </div>
        <h2>Displaying Student's Records</h2>
        <div class="add-button">
            <a href="studentadd_detail.php">Add New Record</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th width="5%">Id</th>
                    <th width="10%">First Name</th>
                    <th width="10%">Last Name</th>
                    <th width="10%">Password</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Email Id</th>
                    <th width="10%">Phone Number</th>
                    <th width="10%">Address</th>
                    <th width="20%">Course Name</th>
                    <th colspan="2" width="15%">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total != 0) {
                    while ($result = mysqli_fetch_assoc($data)) {
                        // Encode data for update
                        $student_data = [
                            'id' => $result['id'],
                            'fname' => $result['fname'],
                            'lname' => $result['lname'],
                            'password' => $result['password'],
                            'gender' => $result['gender'],
                            'email' => $result['email'],
                            'phone' => $result['phone'],
                            'address' => $result['address'],
                            'course_names' => $result['course_names']
                        ];
                        $encoded_data = urlencode(json_encode($student_data));
                        echo "<tr>
                            <td>" . htmlspecialchars($result['id']) . "</td>
                            <td>" . htmlspecialchars($result['fname']) . "</td>
                            <td>" . htmlspecialchars($result['lname']) . "</td>
                            <td>" . htmlspecialchars($result['password']) . "</td>
                            <td>" . htmlspecialchars($result['gender']) . "</td>
                            <td>" . htmlspecialchars($result['email']) . "</td>
                            <td>" . htmlspecialchars($result['phone']) . "</td>
                            <td>" . htmlspecialchars($result['address']) . "</td>
                            <td>" . htmlspecialchars($result['course_names']) . "</td>
                            <td class='operations'>
                                <form method='get' action='studentupdate_detail.php'>
                                    <input type='hidden' name='data' value='" . $encoded_data . "'>
                                    <input type='submit' value='Edit'>
                                </form>
                            </td>
                            <td class='operations'>
                                <form method='post' action='student_display.php'>
                                    <input type='hidden' name='delete_id' value='" . htmlspecialchars($result['id']) . "'>
                                    <input type='submit' value='Delete'>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
