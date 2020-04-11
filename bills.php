<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Styling.css">
</head>

<body>
    <header>Dental Clinic</header>
    
    <div id="nav">
        <ul>
            <li><img src="logo.jpeg" alt="Logo" id="logo"></li>
            <li><a href="Main.php">Home</a></li>
            <li><a href="clinics.php">Clinics</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="patients.php">Patients</a></li>
            <li><a href="staff.php">Staff</a></li>
            <li><a class="active"ref="#bills">Bills</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div>

    <div class="data">
        <h1>Bills List</h1>
        <div>
        <?php
            $servername = "zuc353.encs.concordia.ca";
            $username = "zuc353_4";
            $password = "potatoal";
            $dbname = "zuc353_4";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //Bills
            $sql = "SELECT TransactionNumber, Date, Time, ClinicName, PatientID, Amount, if(IsPaid = 1, 'Yes', 'No') as IsPaid FROM zuc_Bills;";
            $result = $conn->query($sql) or die($conn->error);
            echo "<table><tr><th>TransactionNumber</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Patient ID</th><th>Amout</th><th>Is Paid</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["TransactionNumber"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td><td>" . $row["PatientID"]. "</td><td>" . $row["Amount"]. "</td><td>" . $row["IsPaid"]. "</td></tr>";
            }
            echo "</table><br>";
            echo "<hr>";

            echo "<h2>Unpaid Bills</h2>";
            $sql = "SELECT b.TransactionNumber, b.Amount, p.ID, p.Name, b.Date, b.Time, b.ClinicName
            FROM zuc_Bills b
            LEFT JOIN zuc_Patients p ON p.ID = b.PatientID
            WHERE IsPaid = 0;";
            $result = $conn->query($sql) or die($conn->error);
            echo "<table><tr><th>TransactionNumber</th><th>Amount</th><th>Patient ID</th><th>Patient Name</th><th>Date</th><th>Time</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["TransactionNumber"]. "</td><td>" . $row["Amount"]. "</td><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table><br>";
            ?>

            <hr>

            <h2>Update A Bill</h2>
            <form method="post">
                <label for="transaction">
                    Transaction Number : <input type="number" name="transaction" id="transaction" placeholder="Enter a Transaction">
                </label>
                </br>
                <input type="submit" name="updatebill" value="Submit">
            </form>
            </div>

            <?php
                if(isset($_POST['updatebill'])) {
                    $transaction = $_POST['transaction'];
            
                    $sql = "UPDATE zuc_Bills
                            SET IsPaid = 1 WHERE TransactionNumber = '" . $transaction . "';";
                    $conn->query($sql) or die($conn->error);
                 }
                 $conn->close();
            ?>
            
        </div>
    </div>
</body>
</html>

<script>
function isAdmin() {
    var person = prompt("Please enter your password");
    if (person == "password") {
        window.location.href = "admin.php";
    } else {
        alert("Incorrect password. Redirect to Home Page");
        window.location.href = "Main.php";
    }
}
</script>


</html>