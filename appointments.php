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
            <li><a href="bills.php">Bills</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div>
    <div class="data">
        <h1>Appointment List</h1>

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

                $sql = "SELECT a.PatientID, p.Name as PatientName, a.Date, a.Time, a.ClinicName, if(a.IsMissed > 0, \"Yes\", null) as IsMissed, e.DentalStaffID, d.Name as StaffName, e.TreatmentName
                        FROM zuc353_4.zuc_Appointments a
                        LEFT JOIN zuc_Patients p on a.PatientID = p.ID
                        LEFT JOIN zuc_Executes e on e.Date = a.Date and e.Time = a.Time and e.ClinicName = a.ClinicName and e.PatientID = a.PatientID
                        LEFT JOIN zuc_DentalStaff d on e.DentalStaffID = d.ID;";
                $result = $conn->query($sql) or die($conn->error);

                echo "<table><tr><th>Patient ID</th><th>Patient Name</th><th>Date</th><th>Time</th><th>Clinic Name</th><th>Missed App.</th><th>Dental Staff ID</th><th>Staff Name</th><th>Treatment Name</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["PatientID"]. "</td><td>" . $row["PatientName"]. "</td><td>" . $row["Date"]. "</td><td>" . $row["Time"]. "</td><td>" . $row["ClinicName"]. "</td><td>" . $row["IsMissed"]. "</td><td>" . $row["DentalStaffID"]. "</td><td>" . $row["StaffName"]. "</td><td>" . $row["TreatmentName"]. "</td></tr>";
                }
                echo "</table><br>";
            ?>
        </div>
        
        <br>

        <hr>


        <div>
            <h2>Fetch Treatments</h2>
            <form method="post">
                <label for="fetchdate">
                    Date : <input type="date" name="fetchdate" id="fetchdate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="fetchtime">
                    Time : <input type="time" name="fetchtime" id="fetchtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="fetchclinic">
                    Clinic Name : <input type="text" name="fetchclinic" id="fetchclinic" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="patientname">
                    Patient Name : <input type="text" name="patientname" id="patientname" placeholder="Enter a Name">
                </label>
                </br>
                <input type="submit" name="fetchtreatment" value="Submit">
                </br> 

                <?php
                if(isset($_POST['fetchtreatment'])) {
                    $date = $_POST['fetchdate'];
                    $time = $_POST['fetchtime'];
                    $clinicname = $_POST['fetchclinic'];
                    $patientname = $_POST['patientname'];
                    
                $sql = "SELECT e.TreatmentName as Name, t.Price as Price FROM zuc_Executes e
                LEFT JOIN zuc_Treatments t ON e.TreatmentName = t.Name
                WHERE e.Date = '" . $date . "' AND e.Time = '" . $time . "' AND e.ClinicName = '" . $clinicname . "'
                AND e.PatientID = (
                                    SELECT ID
                                    FROM zuc_Patients
                                    WHERE Name = '" . $patientname . "'
                                  );";

                $result = $conn->query($sql) or die($conn->error);

                echo "<table><tr><th>Treatment</th><th>Price</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td></tr>";
                }
                echo "</table><br>";

                }
            ?>
                         
        </div>
        
        <br>

        <hr>


        <div style="float : left; padding : 20px;">
            <h2>Add an Appointment</h2>
            <form method="post">
                <label for="adddate">
                    Date : <input type="date" name="adddate" id="adddate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="addtime">
                    Time : <input type="time" name="addtime" id="addtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="addclinicname">
                    Clinic Name : <input type="text" name="addclinicname" id="addclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="addpatientid">
                    Patient ID : <input type="number" name="addpatientid" id="addpatientid" placeholder="Enter a Patient ID">
                </label>
                </br>
                <label for="addtreatment">
                    Treatment : <input type="text" name="addtreatment" id="addtreatment" placeholder="Enter a Treatment">
                </label>
                </br>
                </br>
                OPTIONAL
                <label for="addstaff">
                    Staff ID : <input type="text" name="addstaff" id="addstaff" placeholder="Enter a Staff ID">
                </label>
                </br>
                <input type="submit" name="addApp" value="Submit">
            </form>

            <?php
                if(isset($_POST['addApp'])) {
                    $date = $_POST['adddate'];
                    $time = $_POST['addtime'];
                    $clinicname = $_POST['addclinicname'];
                    $patientid = $_POST['addpatientid'];
                    $treatmentName = $_POST['addtreatment'];
                    $staff = $_POST['addstaff'];
                

                    $sql = "INSERT INTO zuc_Appointments(Date, Time, ClinicName, PatientID, IsMissed)
                            Values('" . $date . "', '" . $time . "', '" . $clinicname . "', '" . $patientid . "', '0');";
                    
                    $conn->query($sql) or die($conn->error);
                    
                    if ($staff != null) {
                        $sql = "INSERT INTO zuc_Executes(TreatmentName, DentalStaffID, Date, Time, ClinicName, PatientID)
                                Values('" . $treatmentName . "', '" . $staff . "','" . $date . "', '" . $time . "', '" . $clinicname . "', '" . $patientid . "');";

                        $conn->query($sql) or die($conn->error);
                    } else {
                        $sql = "INSERT INTO zuc_Executes(TreatmentName, Date, Time, ClinicName, PatientID)
                                Values('" . $treatmentName . "', '" . $date . "', '" . $time . "', '" . $clinicname . "', '" . $patientid . "');";

                        $conn->query($sql) or die($conn->error);
                    }

                    $sql = "INSERT INTO zuc_Bills(Date, Time, ClinicName, PatientID, TransactionNumber, Amount, IsPaid)
                            select 
                                zuc_Appointments.Date, 
                                zuc_Appointments.Time, 
                                zuc_Appointments.ClinicName, 
                                zuc_Appointments.PatientID, 
                                (select max(transactionNumber) + 1 from zuc_Bills) as TransactionNumber,
                                (select sum(price) as Amount 
                                    from zuc_Treatments 
                                    where name in (select treatmentName from zuc_Executes where
                                    date = '" . $date . "' and time = '" . $time . "' and clinicName = '" . $clinicname . "' and patientID = '" . $patientid . "')
                                    ) as Amount, 0 as IsPaid
                                from zuc_Appointments
                                where date = '" . $date . "' and time = '" . $time . "' and clinicName = '" . $clinicname . "' and patientID = '" . $patientid . "';";
                                
                    $conn->query($sql) or die($conn->error);

                    $sql = "INSERT INTO zuc_Billing(Date, Time, ClinicName, PatientID, TransactionNumber, TreatmentName)
                    Values('" . $date . "', '" . $time . "', '" . $clinicname . "', '" . $patientid . "', (select max(transactionNumber) from zuc_Bills), '" . $treatmentName . "');";
                    
                    $conn->query($sql) or die($conn->error);

                 }
            ?>
        </div>

        <div style="float : left; padding : 20px;">
            <h2>Delete an Appointment</h2>
            <form method="post">
                <label for="date">
                    Date : <input type="date" name="date" placeholder="Enter a Date">
                </label>
                </br>
                <label for="time">
                    Time : <input type="time" name="time" placeholder="Enter a Time">
                </label>
                </br>
                <label for="clinicname">
                    Clinic Name : <input type="text" name="clinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="patientid">
                    Patient ID : <input type="number" name="patientid" id="address" placeholder="Enter a Patient ID">
                </label>
                </br>
                <input type="submit" name="deleteApp" value="Submit">
            </form>

            <?php
                if(isset($_POST['deleteApp'])) {
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $clinicname = $_POST['clinicname'];
                    $patientid = $_POST['patientid'];
                

                    $sql = "DELETE FROM zuc_Appointments
                            WHERE Date='" . $date . "' AND Time='" . $time . "' AND ClinicName='" . $clinicname . "' AND PatientID='" . $patientid . "'";

                    if ($conn->query($sql) === FALSE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->query($sql) or die($conn->error);
                 }
            ?>
        </div>

        <div style="float : left; padding : 20px;">
            <h2>Update An Appointment</h2>
            <h3>Old Values</h3>
            <form method="post">
                <label for="olddate">
                    Old Date : <input type="date" name="olddate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="time">
                    Old Time : <input type="time" name="oldtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="clinicname">
                    Old Clinic Name : <input type="text" name="oldclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="patientid">
                    Old Patient ID : <input type="number" name="oldpatientid" id="address" placeholder="Enter a Patient ID">
                </label>
            
            <br>
            <h3>New Values</h3>

                <label for="date">
                    New Date : <input type="date" name="newdate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="time">
                    New Time : <input type="time" name="newtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="clinicname">
                    New Clinic Name : <input type="text" name="newclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="patientid">
                    New Patient ID : <input type="number" name="newpatientid" id="address" placeholder="Enter a Patient ID">
                </label>
                </br>
                <input type="submit" name="updateApp" value="Submit">                 
            </form>

            <?php
                if(isset($_POST['updateApp'])) {
                    $olddate = $_POST['olddate'];
                    $oldtime = $_POST['oldtime'];
                    $oldclinicname = $_POST['oldclinicname'];
                    $oldpatientid = $_POST['oldpatientid'];

                    $newdate = $_POST['newdate'];
                    $newtime = $_POST['newtime'];
                    $newclinicname = $_POST['newclinicname'];
                    $newpatientid = $_POST['newpatientid'];

                    $sql = "UPDATE zuc_Appointments
                            SET Date='" . $newtime . "' AND Time='" . $newtime . "' AND ClinicName='" . $newclinicname . "' AND PatientID='" . $newpatientid . "'
                            WHERE Date='" . $olddate . "' AND Time='" . $oldtime . "' AND ClinicName='" . $oldclinicname . "' AND PatientID='" . $oldpatientid ."'";
                    
                    if ($conn->query($sql) === FALSE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->query($sql) or die($conn->error);
                 }
            ?>
        </div>
 
        <hr style="clear: left;">
        <div>
            <h2>Dentist Schedule</h2>
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
                <label>Enter a dentist name to check his schedule: </label>
                <input id="dentistname" name="dentistname" type="text"/>
                <br>
                <input type="submit" value="Submit" name="query2"/>
            </form>

            <br>
            <br>

            <div>
                <?php
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
                    $conn->close();
                ?>
            </div>
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