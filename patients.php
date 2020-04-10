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
            <li><a class="active" href="#patients">Patients</a></li>
            <li><a href="staff.php">Staff</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div>    
    <div class="data">
        <h1>Patient List</h1>
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

            $sql = "SELECT p.*, sum(a.IsMissed) as \"Missed Appointments\"
                    FROM zuc_Patients p
                    LEFT JOIN zuc_Appointments a ON p.ID = a.PatientID
                    GROUP BY p.ID;";
            $result = $conn->query($sql) or die($conn->error);
            echo "<table><tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Address</th><th>Medicare</th><th>Missed Appointments</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Address"]. "</td><td>" . $row["MedicareNumber"]. "</td><td>" . $row["Missed Appointments"]. "</td></tr>";
            }
            echo "</table><br>";
            ?>
        </div>

        <div>
            <h1>Patient Appointments</h1>
            <form method="post">
                <label for="medicare">
                    Patient Medicare Number : <input type="text" name="medicare" id="medicare">
                </label>
                <input type="submit" name="submit" value="Search">
            </form>
        </br>
        </br>

            <?php
                if(isset($_POST['submit'])){
                    $medicare = $_POST['medicare'];
                    
                    $sql = "SELECT d.Name, a.Date, a.Time, a.ClinicName, e.TreatmentName
                                FROM zuc_AssignedTo a
                                LEFT JOIN zuc_Dentists d ON ID = DentistID
                                LEFT JOIN zuc_Executes e ON a.Date = e.Date 
                                                AND e.Time = a.Time
                                                AND e.ClinicName = a.ClinicName 
                                                AND e.PatientID = a.PatientID
                                WHERE a.PatientID = (
                                                    SELECT ID
                                                    FROM zuc_Patients
                                                    WHERE MedicareNumber = " . $medicare . "
                                                     );
                                ";
                    $result = $conn->query($sql) or die($conn->error);
                    echo "<table><tr><th>Dentist</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Treatment</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td><td>" . $row["TreatmentName"]. "</td></tr>";
                    }
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