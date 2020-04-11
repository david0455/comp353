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
                    if(isset($_POST['submitInsert'])) {
                        $name = $_POST['name'];
                        $age = $_POST['age'];
                        $sex = $_POST['sex'];
                        $address = $_POST['address'];
                        $medicare = $_POST['medicare'];

                        unset($_POST['submitInsert']);
                    

                        $sql = "INSERT INTO zuc_Patients(Name, Age, Sex, Address, MedicareNumber)
                        Values('" . $name . "', '" . $age . "', '" . $sex . "', '" . $address . "', '" . $medicare . "');";

                        if ($conn->query($sql) === FALSE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                     }
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
                    if(isset($_POST['deletePatient'])) {
                        $id = $_POST['id'];

                        unset($_POST['deletePatient']);

                        $sql = "DELETE FROM zuc_Patients where ID = " . $id . ";";
                        
                        if ($conn->query($sql) === FALSE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                     }
                ?>
                </br>
                </br>
                </br>
            </div>
            <!-- <div style="float : left; padding : 20px">
                <h2>Update a Patient</h2>
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
                    <input type="submit" name="submitUpdate" value="Submit">
                </form>

                <?php
                    // if(isset($_POST['submitUpdate'])) {
                    //     unset($_POST['submitUpdate']);

                    //     $name = $_POST['name'];
                    //     $age = $_POST['age'];
                    //     $sex = $_POST['sex'];
                    //     $address = $_POST['age'];
                    //     $medicare = $_POST['medicare'];
                    

                    //     $sql = "INSERT INTO zuc_Patients(Name, Age, Sex, Address, MedicareNumber)
                    //     Values('" . $name . "', '" . $age . "', '" . $sex . "', '" . $address . "', '" . $medicare . "');";

                    //     if ($conn->query($sql) === FALSE) {
                    //         echo "Error: " . $sql . "<br>" . $conn->error;
                    //     }
                    //  }
                ?>
                </br>
                </br>
                </br>
            </div> -->
        </div>

        </br>
        </br>
        </br>
        <hr style="clear: left;">
        <div style="clear: left;">
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
                    
                    $sql = "SELECT d.Name, a.Date, a.Time, a.ClinicName, e.TreatmentName, if(app.IsMissed > 0, \"Yes\", null) as \"IsMissed\"
                                FROM zuc_AssignedTo a
                                LEFT JOIN zuc_Appointments app on app.Date = a.Date and app.Time = a.Time and app.ClinicName = a.ClinicName
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
                    echo "<table><tr><th>Dentist</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Treatment</th><th>Missed App.</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td><td>" . $row["TreatmentName"]. "</td><td>" . $row["IsMissed"]. "</td></tr>";
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