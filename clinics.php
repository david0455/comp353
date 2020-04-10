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
        <li><a class="active" href="#clinics">Clinics</a></li>
        <li><a href="appointments.php">Appointments</a></li>
        <li><a href="patients.php">Patients</a></li>
        <li><a href="staff.php">Staff</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div>
    <div class="data">
        <h1>Clinic List</h1>

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

                $sql = "SELECT * FROM zuc353_4.zuc_Clinics;";
                $result = $conn->query($sql) or die($conn->error);

                echo "<table><tr><th>Clinic Name</th><th>Location</th>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Location"] . "</td></tr>";
                }
                echo "</table><br>";

                $conn->close();
            ?>
        </div>

        <form id="foo" method="POST">
            <label>Select a starting week: </label>
            <input type="date" name="weekstart"/>
            <br>
            <br>
            <label>Enter clinic name: </label>
            <input name="clinicname" type="text"/>
            <br>
            <input type="submit" value="Submit" name="query3"/>
        </form>

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
                
                if (isset($_POST['query3'])) {
                    $clinicname = $_POST['clinicname'];
                    $weekstart = $_POST['weekstart'];

                    $sql = "SELECT p.*, a.Date, a.Time, a.ClinicName, a.IsMissed
                            FROM zuc_Appointments as a
                            LEFT JOIN zuc_Patients as p on PatientID = ID
                            WHERE ClinicName = '". $clinicname . "'
                            AND Date = '" . $weekstart . "'";

                    $result = $conn->query($sql) or die($conn->error);

                    echo "<table><tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Address</th><th>Medicare</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Missed Appointment</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Age"] . "</td><td>" . $row["Sex"] . "</td><td>" . $row["Address"] . "</td><td>" . $row["MedicareNumber"] . "</td><td>" . $row["Date"] . "</td><td>" . $row["Time"] . "</td><td>" . $row["ClinicName"] . "</td><td>" . $row["IsMissed"] . "</td></tr>";
                    }
                    echo "</table><br>";
                }

                $conn->close();
            ?>
        </div>

    </div>
</body>

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