<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $event_id = $_POST['event_id'];

    mysqli_query($conn, "INSERT INTO attendance (member_id, event_id) VALUES ($member_id, $event_id)");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM attendance WHERE id=$id");
}

$members = mysqli_query($conn, "SELECT * FROM members");
$events = mysqli_query($conn, "SELECT * FROM events");

$result = mysqli_query($conn, "
    SELECT attendance.id, members.name, events.event_name
    FROM attendance
    JOIN members ON attendance.member_id = members.id
    JOIN events ON attendance.event_id = events.id
");
?>
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
    <h3>Attendance Page</h3>

    <p>
        This page is used to track attendance.
    </p>

    <h3>Options</h3>

    <ul class="linkedList">
        <li class="first"><a href="index.php">Home</a></li>
        <li><a href="members.php">Members</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="budget.php">Budget</a></li>
        <li class="last"><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div id="content">

<form method="POST">
    Member:
    <select name="member_id">
        <?php while ($m = mysqli_fetch_assoc($members)) { ?>
            <option value="<?php echo $m['id']; ?>"><?php echo $m['name']; ?></option>
        <?php } ?>
    </select>

    Event:
    <select name="event_id">
        <?php while ($e = mysqli_fetch_assoc($events)) { ?>
            <option value="<?php echo $e['id']; ?>"><?php echo $e['event_name']; ?></option>
        <?php } ?>
    </select>

    <button type="submit">Add Attendance</button>
</form>

<h3>Attendance List</h3>

<table class="clubTable">
        <tr>
        <th>ID</th>
        <th>Member Name</th>
        <th>Event Name</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['event_name']; ?></td>
            <td>
                <a href="attendance.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>

<br class="clear" />

</div>
</div>
</div>