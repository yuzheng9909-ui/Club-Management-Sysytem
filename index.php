<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Club Management System</h1>

<a href="index.php">Home</a> |
<a href="members.php">Members</a> |
<a href="events.php">Events</a> |
<a href="attendance.php">Attendance</a> |
<a href="budget.php">Budget</a> |
<a href="logout.php">Logout</a>
<hr>

<p>Welcome to the system!</p>

<ul>
    <li><a href="members.php">Members</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="attendance.php">Attendance</a></li>
    <li><a href="budget.php">Budget</a></li>
</ul>
