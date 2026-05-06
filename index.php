<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<link href="style.css" rel="stylesheet" type="text/css" />

<div id="bg">
    <div id="outer">
        <div id="header">
            <div id="logo">
                <h1>
                    <a href="index.php">Club System</a>
                </h1>
            </div>

        </div>

        <div id="main">
            <div id="sidebar">
                <h3>System Options</h3>
                <p>
                    This system helps club officers organize members, events, attendance, and budget information in one place.
                </p>

                <h3>Main Features</h3>
                <ul class="linkedList">
                    <li class="first"><a href="members.php">Members</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="attendance.php">Attendance</a></li>
                    <li><a href="budget.php">Budget</a></li>
                    <li class="last"><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div id="content">
                <div id="box1">
                    <h2>Welcome to the Club Management System</h2>

                    <p>
                        The Club Management System is a web-based system for managing a student club.
                        It allows users to manage members, events, attendance, and budget information.
                    </p>

                    <div class="buttonRow">
                        <a class="featureButton" href="members.php">Members</a>
                        <a class="featureButton" href="events.php">Events</a>
                        <a class="featureButton" href="attendance.php">Attendance</a>
                        <a class="featureButton" href="budget.php">Budget</a>
                    </div>
                </div>

               
            </div>

            <br class="clear" />
        </div>
    </div>

    <div id="copyright">
        &copy; Club Management System
    </div>
</div>