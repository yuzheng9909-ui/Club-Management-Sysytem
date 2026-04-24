<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$event_name = "";
$event_date = "";
$edit_mode = false;

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];

    mysqli_query($conn, "UPDATE events SET event_name='$event_name', event_date='$event_date' WHERE id=$id");
    echo "<p>Event updated successfully.</p>";
} 
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];

    mysqli_query($conn, "INSERT INTO events (event_name, event_date) VALUES ('$event_name', '$event_date')");
    echo "<p>Event added successfully.</p>";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM events WHERE id=$id");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_mode = true;

    $result_edit = mysqli_query($conn, "SELECT * FROM events WHERE id=$id");
    $row_edit = mysqli_fetch_assoc($result_edit);

    $event_name = $row_edit['event_name'];
    $event_date = $row_edit['event_date'];
}

$result = mysqli_query($conn, "SELECT * FROM events");
?>

<a href="index.php">Home</a> |
<a href="members.php">Members</a> |
<a href="events.php">Events</a> |
<a href="attendance.php">Attendance</a> |
<a href="budget.php">Budget</a> |
<a href="logout.php">Logout</a>
<hr>

<h2>Events</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">

    Event Name:
    <input type="text" name="event_name" value="<?php echo $event_name; ?>" required>

    Event Date:
    <input type="date" name="event_date" value="<?php echo $event_date; ?>" required>

    <?php if ($edit_mode) { ?>
        <button type="submit" name="update">Update Event</button>
    <?php } else { ?>
        <button type="submit">Add Event</button>
    <?php } ?>
</form>

<h3>Event List</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['event_name']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td>
                <a href="events.php?edit=<?php echo $row['id']; ?>">Edit</a> |
                <a href="events.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
