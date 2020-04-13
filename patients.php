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
            <li><a href="staff.php">Dental Staff</a></li>
            <li><a href="bills.php">Bills</a></li>
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

                $sql = "SELECT p.*, if(sum(a.IsMissed) > 0, sum(a.IsMissed), null) as \"Missed Appointments\"
                        FROM zuc_Patients p
                        LEFT JOIN zuc_Appointments a ON p.ID = a.PatientID
                        GROUP BY p.ID;";
                $result = $conn->query($sql) or die($conn->error);
                echo "<table><tr><th>ID</th><th>Name</th><th>Age</th><th>Sex</th><th>Address</th><th>Medicare</th><th>Missed Appointments</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Address"]. "</td><td>" . $row["MedicareNumber"]. "</td><td>" . $row["Missed Appointments"]. "</td></tr>";
                }
                echo "</table><br>";
                $conn->close();
            ?>

            <div style="float : left; padding : 20px;">
                <h2>Add A Patient</h2>
                <form method="post">
                    <label for="name">
                        Patient Name : <input type="text" name="name" id="name" placeholder="Enter a Name">
                    </label>
                    </br>
                    <label for="age">
                        Patient Age : <input type="number" name="age" id="age" placeholder="Enter an Age">
                    </label>
                    </br>
                    <label for="sex">
                        Patient Sex : <input type="text" name="sex" id="sex" placeholder="Enter a Sex">
                    </label>
                    </br>
                    <label for="Name">
                        Patient Address : <input type="text" name="address" id="address" placeholder="Enter an Address">
                    </label>
                    </br>
                    <label for="Name">
                        Patient Medicare : <input type="number" name="medicare" id="medicare" placeholder="Enter a Medicare">
                    </label>
                    </br>
                    <input type="submit" name="submitInsert" value="Submit">
                </form>

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
                    if(isset($_POST['submitInsert'])) {
                        $name = $_POST['name'];
                        $age = $_POST['age'];
                        $sex = $_POST['sex'];
                        $address = $_POST['address'];
                        $medicare = $_POST['medicare'];

                        unset($_POST['submitInsert']);
                    

                        $sql = "INSERT INTO zuc_Patients(Name, Age, Sex, Address, MedicareNumber)
                        Values('" . $name . "', '" . $age . "', '" . $sex . "', '" . $address . "', '" . $medicare . "');";

                        $conn->query($sql) or die($conn->error);
                     }
                     $conn->close();
                ?>
                </br>
            </div>
            <div style="float : left; padding : 20px">
                <h2>Delete a Patient</h2>
                <form method="post">
                    <label for="id">
                        Patient ID : <input type="number" name="id" id="name" placeholder="Enter PatientID">
                    </label>
                    </br>
                    <input type="submit" name="deletePatient" value="Submit">
                </form>

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

                    if(isset($_POST['deletePatient'])) {
                        $id = $_POST['id'];

                        unset($_POST['deletePatient']);

                        $sql = "DELETE FROM zuc_Patients where ID = " . $id . ";";
                        
                        $conn->query($sql) or die($conn->error);
                     }
                    $conn->close();
                ?>
                </br>
                </br>
                </br>
            </div>
            
        </div>

        </br>
        </br>
        </br>
        <hr style="clear: left;">
        <div style="clear: left;">
            <h1>Patient Appointments</h1>
            <form method="post">
                <label for="patientID">
                    Patient ID: <input type="text" name="patientID" id="patientID">
                </label>
                <input type="submit" name="submit" value="Search">
            </form>
            </br>
            </br>

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

                if(isset($_POST['submit'])){
                    $patientID = $_POST['patientID'];
                    
                    $sql = "SELECT a.DentistID, d.Name as Name, app.Date, app.Time, app.ClinicName, e.TreatmentName, if(app.IsMissed > 0, 'Yes', null) as IsMissed
                            FROM zuc_Appointments app
                            LEFT JOIN zuc_AssignedTo a on a.Date = app.Date AND app.Time = a.TIME and app.ClinicName = a.ClinicName and app.PatientID = a.PatientID
                            LEFT JOIN zuc_Dentists d on d.ID = a.DentistID
                            LEFT JOIN zuc_Executes e on e.Date = app.Date AND app.Time = e.TIME and app.ClinicName = e.ClinicName and app.PatientID = e.PatientID
                            where app.patientID = '" . $patientID . "';";

                    $result = $conn->query($sql) or die($conn->error);

                    echo "<table><tr><th>Dentist ID</th><th>Dentist</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Treatment</th><th>Missed App.</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["DentistID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td><td>" . $row["TreatmentName"]. "</td><td>" . $row["IsMissed"]. "</td></tr>";
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
    }
}
</script>

</html>