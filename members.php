<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$name = "";
$email = "";
$student_id = "";
$edit_mode = false;

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];

    mysqli_query($conn, "UPDATE members SET name='$name', email='$email', student_id='$student_id' WHERE id=$id");
    echo "<p>Member updated successfully.</p>";
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $student_id = $_POST['student_id'];

    mysqli_query($conn, "INSERT INTO members (name, email, student_id) VALUES ('$name', '$email', '$student_id')");
    echo "<p>Member added successfully.</p>";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM members WHERE id=$id");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_mode = true;

    $result_edit = mysqli_query($conn, "SELECT * FROM members WHERE id=$id");
    $row_edit = mysqli_fetch_assoc($result_edit);

    $name = $row_edit['name'];
    $email = $row_edit['email'];
    $student_id = $row_edit['student_id'];
}

$result = mysqli_query($conn, "SELECT * FROM members");
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="bg">
<div id="outer">

<div id="header">
    <div id="logo">
        <h1><a href="index.php">Club System</a></h1>
    </div>

</div>

<div id="main">

<div id="sidebar">
    <h3>Members Page</h3>

    <p>
        This page is used to manage club members.
    </p>

    <h3>Options</h3>

    <ul class="linkedList">
        <li class="first"><a href="index.php">Home</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="attendance.php">Attendance</a></li>
        <li><a href="budget.php">Budget</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div id="content">

<h2>Members</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">

    Name:
    <input type="text" name="name" value="<?php echo $name; ?>" required>

    Email:
    <input type="email" name="email" value="<?php echo $email; ?>" required>

    Student ID:
    <input type="text" name="student_id" value="<?php echo $student_id; ?>">

    <?php if ($edit_mode) { ?>
        <button type="submit" name="update">Update Member</button>
    <?php } else { ?>
        <button type="submit">Add Member</button>
    <?php } ?>
</form>

<h3>Member List</h3>

<table class="clubTable">
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Student ID</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td>
                <a href="members.php?edit=<?php echo $row['id']; ?>">Edit</a> |
                <a href="members.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>

<br class="clear" />

</div>
</div>
</div>