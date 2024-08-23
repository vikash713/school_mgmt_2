<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Course Details</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
  // Example PHP to fetch course details
  $result = $_GET['result'];
  $data = json_decode($_GET['result'], true);

  // You can add your DB connection and fetching logic here if necessary
?>
<div class="container">
  <form action="./course_display.php" method="POST">
    <div class="title">UPDATE COURSE DETAILS</div>
    <div class="form">
      <div class="input_feild">
        <label for="course_id">Course ID</label>
        <input type="text" value="<?php echo $data['course_id']; ?>" class="input" name="course_id" id="course_id" readonly>
      </div>
      <div class="input_feild">
        <label for="course_name">Course Name</label>
        <input type="text" value="<?php echo $data['course_name']; ?>" class="input" name="course_name" id="course_name">
      </div>
      <div class="input_feild">
        <label for="course_duration">Course Duration</label>
        <input type="text" value="<?php echo $data['course_duration']; ?>" class="input" name="course_duration" id="course_duration">
      </div>
      <div class="input_feild">
        <input type="submit" value="Update Course" class="btn" name="Update_Course">
      </div>
    </div>
  </form>
</div>
</body>
</html>
