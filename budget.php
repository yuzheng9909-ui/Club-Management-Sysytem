<?php
include 'db.php';

// Insert
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];

    mysqli_query($conn, "INSERT INTO budget (type, amount, category) 
    VALUES ('$type', $amount, '$category')");
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM budget WHERE id=$id");
}

// Get all budget records
$result = mysqli_query($conn, "SELECT * FROM budget");

// Calculate total income
$income_result = mysqli_query($conn, "SELECT SUM(amount) AS total_income FROM budget WHERE type='Income'");
$income_row = mysqli_fetch_assoc($income_result);
$total_income = $income_row['total_income'] ? $income_row['total_income'] : 0;

// Calculate total expense
$expense_result = mysqli_query($conn, "SELECT SUM(amount) AS total_expense FROM budget WHERE type='Expense'");
$expense_row = mysqli_fetch_assoc($expense_result);
$total_expense = $expense_row['total_expense'] ? $expense_row['total_expense'] : 0;

// Calculate current balance
$current_balance = $total_income - $total_expense;
?>

<a href="index.php">Home</a> |
<a href="members.php">Members</a> |
<a href="events.php">Events</a> |
<a href="attendance.php">Attendance</a> |
<a href="budget.php">Budget</a>
<hr>

<h2>Budget</h2>

<form method="POST">
    Type:
    <select name="type">
        <option value="Income">Income</option>
        <option value="Expense">Expense</option>
    </select>

    Amount:
    <input type="number" step="0.01" name="amount" required>

    Category:
    <input type="text" name="category" required>

    <button type="submit">Add</button>
</form>

<h3>Budget Summary</h3>
<p>Total Income: <?php echo number_format($total_income, 2); ?></p>
<p>Total Expense: <?php echo number_format($total_expense, 2); ?></p>
<p>Current Balance: <?php echo number_format($current_balance, 2); ?></p>

<h3>Budget List</h3>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo number_format($row['amount'], 2); ?></td>
            <td><?php echo $row['category']; ?></td>
            <td>
                <a href="budget.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>