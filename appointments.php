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
            <li><a class="active" href="#appointments">Appointments</a></li>
            <li><a href="patients.php">Patients</a></li>
            <li><a href="staff.php">Staff</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" href="admin.php">Admin</a>
        </div>
    </div>
    <div class="data">
        <h1>Dentist List</h1>

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

                $sql = "SELECT zuc_Dentists.*, zuc_WorksAt.ClinicName FROM zuc_Dentists LEFT JOIN zuc_WorksAt ON zuc_Dentists.ID = zuc_WorksAt.StaffID;";
                $result = $conn->query($sql) or die($conn->error);

                echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Specialization</th><th>Clinic Name</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Specialization"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
                }
                echo "</table><br>";

                $conn->close();
            ?>
        </div>

        <form id="foo" method="POST">
            <label>Select a starting week and ending week: </label>
            <table>
                <tr>
                    <th>Starting Week</th>
                    <th>Ending Week</th>
                </tr>
                <tr>
                    <th><input type="date" name="weekstart"/></th>
                    <th><input type="date" name="weekend"/></th>
                </tr>
            </table>
            <br>
            <br>
            <label>Enter a dentist name to check his appointments: </label>
            <input id="dentistname" name="dentistname" type="text"/>
            <br>
            <input type="submit" value="Query2" name="query2"/>
            <label>(Requires Starting Week, Ending Week and Dentist Name)</label>
            <br>
            <br>
            <label>Enter clinic name: </label>
            <input name="clinicname" type="text"/>
            <br>
            <input type="submit" value="Query3" name="query3"/>
            <label>(Requires Starting Week and Clinic Name)</label>
        </form>

        <br>
        <br>

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

                if (isset($_POST['query2'])) {
                    $dentistname = $_POST['dentistname'];

                    if (isset($_POST['weekstart']) && isset($_POST['weekend'])) {
                        $weekstart = $_POST['weekstart'];
                        $weekend = $_POST['weekend'];
                    }
    
                    $sql = "SELECT Name, ID, Date, Time, ClinicName
                            FROM zuc_AssignedTo
                            LEFT JOIN  zuc_Patients ON PatientID = ID
                            WHERE DentistID = (
                                                SELECT ID
                                                FROM zuc_Dentists 
                                                WHERE Name = '" . $dentistname . "'
                                            )
                            AND Date BETWEEN '" . $weekstart . "' AND '" . $weekend . "'";
    
                    $result = $conn->query($sql) or die($conn->error);
    
                    echo "<table><tr><th>Name</th><th>ID</th><th>Date</th><th>Time</th><th>Clinic Name</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Name"] ."</td><td>". $row["ID"] ."</td><td>". $row["Date"] ."</td><td>". $row["Time"] ."</td><td>". $row["ClinicName"] . "</td></tr>";
                    }
                    echo "</table>";
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

</html>