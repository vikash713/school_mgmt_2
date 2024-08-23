<!DOCTYPE html>
<html>
<head>
    <title>DISPLAY</title>
    <style>
        body {
            background-color: #53b6e1;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            background-color: aliceblue;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        .operations a, .operations form {
            display: inline-block;
            margin: 2px;
        }
        .operations a {
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
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
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        .operations form input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><mark>DISPLAYING STUDENT RECORD</mark></h2>
        <table border="3" cellspacing="7">
            <tr>
                <th width="5%">Id</th>
                <th width="10%">First Name</th>
                <th width="10%">Last Name</th>
                <th width="10%">Password</th>
                <th width="10%">Subject</th>
                <th width="10%">Email Id</th>
                <th width="10%">Phone Number</th>
                <th width="10%">Address</th>
                <th colspan="3" width="15%">Operations</th>
            </tr>

            <?php
            include("connection.php");
            error_reporting(0);

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

                if ($fname != "" && $lname != "" && $password != "" && $conpassword != "" && $gender != "" && $email != "" && $phone != "" && $address != "") {
                    $query = "INSERT INTO student (fname, lname, password, cpassword, gender, email, phone, address) VALUES ('$fname', '$lname', '$password', '$conpassword', '$gender', '$email', '$phone', '$address')";
                    $data = mysqli_query($conn, $query);
                    if ($data) {
                        echo "<p>Inserted successfully!</p>";
                    } else {
                        echo "<p>Failed to insert.</p>";
                    }
                } else {
                    echo "<p>Please insert all details.</p>";
                }
            }

            // Handle Update Operation
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $password = $_POST['password'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $sql = "UPDATE student SET fname=?, lname=?, password=?, email=?, phone=?, address=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssi", $fname, $lname, $password, $email, $phone, $address, $id);
                if ($stmt->execute()) {
                    echo "<p>Record updated successfully</p>";
                } else {
                    echo "<p>Error updating record: " . $stmt->error . "</p>";
                }
            }

            // Handle Delete Operation
            if (isset($_POST['delete_id'])) {
                $id = intval($_POST['delete_id']);
                $delete_query = "DELETE FROM student WHERE id = ?";
                if ($stmt = $conn->prepare($delete_query)) {
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        echo "<p>Record deleted successfully!</p>";
                    } else {
                        echo "<p>Failed to delete record: " . $stmt->error . "</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p>Failed to prepare statement: " . $conn->error . "</p>";
                }
            }

            // Fetch student records for display
            $query = "SELECT * FROM student";
            $data = mysqli_query($conn, $query);
            $total = mysqli_num_rows($data);

            if ($total != 0) {
                while ($result = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($result['id']) . "</td>
                        <td>" . htmlspecialchars($result['fname']) . "</td>
                        <td>" . htmlspecialchars($result['lname']) . "</td>
                        <td>" . htmlspecialchars($result['password']) . "</td>
                        <td>" . htmlspecialchars($result['gender']) . "</td>
                        <td>" . htmlspecialchars($result['email']) . "</td>
                        <td>" . htmlspecialchars($result['phone']) . "</td>
                        <td>" . htmlspecialchars($result['address']) . "</td>
                        <td class='operations'>
                            <a href='studentupdate_detail.php?result=" . urlencode(json_encode($result)) . "'>Update</a>
                        </td>
                        <td class='operations'>
                            <a href='studentadd_detail.php'>Add</a>
                        </td>
                        <td class='operations'>
                            <form method='post' action='student_display.php'>
                                <input type='hidden' name='delete_id' value='" . htmlspecialchars($result['id']) . "'>
                                <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='11' style='text-align:center;'>No record found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="http://localhost:8002/school_management_2/welcome.php#">School Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       
</nav>
</body>
</html>