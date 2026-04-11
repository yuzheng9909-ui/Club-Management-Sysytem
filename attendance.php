<?php
include 'db.php';

// Insert attendance
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $event_id = $_POST['event_id'];

    mysqli_query($conn, "INSERT INTO attendance (member_id, event_id) VALUES ($member_id, $event_id)");
}

// Delete attendance
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM attendance WHERE id=$id");
}

// Get members
$members = mysqli_query($conn, "SELECT * FROM members");

// Get events
$events = mysqli_query($conn, "SELECT * FROM events");

// Get attendance with JOIN
$result = mysqli_query($conn, "
    SELECT attendance.id, members.name, events.event_name
    FROM attendance
    JOIN members ON attendance.member_id = members.id
    JOIN events ON attendance.event_id = events.id
");
?>

<a href="index.php">Home</a> |
<a href="members.php">Members</a> |
<a href="events.php">Events</a> |
<a href="attendance.php">Attendance</a> |
<a href="budget.php">Budget</a>
<hr>

<h2>Attendance</h2>

<form method="POST">
    Member:
    <select name="member_id">
        <?php while ($m = mysqli_fetch_assoc($members)) { ?>
            <option value="<?php echo $m['id']; ?>">
                <?php echo $m['name']; ?>
            </option>
        <?php } ?>
    </select>

    Event:
    <select name="event_id">
        <?php while ($e = mysqli_fetch_assoc($events)) { ?>
            <option value="<?php echo $e['id']; ?>">
                <?php echo $e['event_name']; ?>
            </option>
        <?php } ?>
    </select>

    <button type="submit">Add Attendance</button>
</form>

<h3>Attendance List</h3>

<table border="1" cellpadding="10">
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