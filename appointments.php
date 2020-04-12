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
            <li><a href="staff.php">Dental Staff</a></li>
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
                
                $conn->close();
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
                <label for="fetchpatientid">
                    Patient ID : <input type="number" name="fetchpatientid" id="fetchpatientid" placeholder="Enter a Name">
                </label>
                </br>
                <input type="submit" name="fetchtreatment" value="Submit">
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

                if(isset($_POST['fetchtreatment'])) {
                    $fetchdate = $_POST['fetchdate'];
                    $fetchtime = $_POST['fetchtime'];
                    $fetchclinicname = $_POST['fetchclinic'];
                    $fetchpatientid = $_POST['fetchpatientid'];
                    
                $sql = "SELECT e.TreatmentName as Name, t.Price as Price FROM zuc_Executes e
                LEFT JOIN zuc_Treatments t ON e.TreatmentName = t.Name
                WHERE e.Date = '" . $fetchdate . "' AND e.Time = '" . $fetchtime . "' AND e.ClinicName = '" . $fetchclinicname . "'
                AND e.PatientID = '" . $fetchpatientid . "';";

                $result = $conn->query($sql) or die($conn->error);

                echo "<table><tr><th>Treatment</th><th>Price</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Name"]. "</td><td>" . $row["Price"]. "</td></tr>";
                }
                echo "</table><br>";

                }
                $conn->close();
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
                    Treatments : </br><textarea name="addtreatment" id="addtreatment" rows="3" cols="50"></textarea>
                </label>
                </br>
                <label for="addstaff">
                    Dental Staff ID : <input type="text" name="addstaff" id="addstaff" placeholder="Enter a Staff ID">
                </label>
                </br>
                <label for="adddentist">
                    ----------------------------------------------------
                    </br>
                    OPTIONAL Dentist ID : <input type="text" name="adddentist" id="adddentist" placeholder="Enter a Dentist ID">
                </label>
                </br>
                <input type="submit" name="addApp" value="Submit">
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

                if(isset($_POST['addApp'])) {
                    $adddate = $_POST['adddate'];
                    $addtime = $_POST['addtime'];
                    $addclinicname = $_POST['addclinicname'];
                    $addpatientid = $_POST['addpatientid'];
                    $addstaff = $_POST['addstaff'];
                    $adddentistid = $_POST['adddentist'];
                    $listOfTreatments = explode (",", $_POST['addtreatment']);
                    

                    $sql = "INSERT INTO zuc_Appointments(Date, Time, ClinicName, PatientID, IsMissed)
                            Values('" . $adddate . "', '" . $addtime . "', '" . $addclinicname . "', '" . $addpatientid . "', '0');";
                    
                    $conn->query($sql) or die($conn->error);

                    for ($i = 0; $i < sizeof($listOfTreatments); $i++) {
                        $sql = "INSERT INTO zuc_Executes(TreatmentName, DentalStaffID, Date, Time, ClinicName, PatientID)
                                    Values('" . $listOfTreatments[$i] . "', '" . $addstaff . "','" . $adddate . "', '" . $addtime . "', '" . $addclinicname . "', '" . $addpatientid . "');";
                                
                        $conn->query($sql) or die($conn->error);
                    }
                    
                    if ($adddentistid != null) {
                        $sql = "INSERT INTO zuc_AssignedTo(Date, Time, ClinicName, PatientID, DentistID)
                                Values('" . $adddate . "', '" . $addtime . "','" . $addclinicname . "', '" . $addpatientid . "', '" . $adddentistid . "');";

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
                                    date = '" . $adddate . "' and time = '" . $addtime . "' and clinicName = '" . $addclinicname . "' and patientID = '" . $addpatientid . "')
                                    ) as Amount, 0 as IsPaid
                                from zuc_Appointments
                                where date = '" . $adddate . "' and time = '" . $addtime . "' and clinicName = '" . $addclinicname . "' and patientID = '" . $addpatientid . "';";
                                
                    $conn->query($sql) or die($conn->error);

                    for ($i = 0; $i < sizeof($listOfTreatments); $i++) {
                        $sql = "INSERT INTO zuc_Billing(Date, Time, ClinicName, PatientID, TransactionNumber, TreatmentName)
                        Values('" . $adddate . "', '" . $addtime . "', '" . $addclinicname . "', '" . $addpatientid . "', (select max(transactionNumber) from zuc_Bills), '" . $listOfTreatments[$i] . "');";
                        
                        $conn->query($sql) or die($conn->error);
                    }
                }
                $conn->close();
            ?>
        </div>

        <div style="float : left; padding : 20px;">
            <h2>Delete an Appointment</h2>
            <form method="post">
                <label for="deldate">
                    Date : <input type="date" name="deldate" id="deldate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="deltime">
                    Time : <input type="time" name="deltime" id="deltime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="delclinicname">
                    Clinic Name : <input type="text" name="delclinicname" id="delclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="delpatientid">
                    Patient ID : <input type="number" name="delpatientid" id="delpatientid" placeholder="Enter a Patient ID">
                </label>
                </br>
                <input type="submit" name="deleteApp" value="Submit">
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

                if(isset($_POST['deleteApp'])) {
                    $deldate = $_POST['deldate'];
                    $deltime = $_POST['deltime'];
                    $delclinicname = $_POST['delclinicname'];
                    $delpatientid = $_POST['delpatientid'];

                    $sql = "DELETE FROM zuc_AssignedTo
                    WHERE Date='" . $deldate . "' AND Time='" . $deltime . "' AND ClinicName='" . $delclinicname . "' AND PatientID='" . $delpatientid . "'";

                    $conn->query($sql) or die($conn->error);
             
                    $sql = "DELETE FROM zuc_Billing
                    WHERE Date='" . $deldate . "' AND Time='" . $deltime . "' AND ClinicName='" . $delclinicname . "' AND PatientID='" . $delpatientid . "'";

                    $conn->query($sql) or die($conn->error);

                    $sql = "DELETE FROM zuc_Executes
                            WHERE Date='" . $deldate . "' AND Time='" . $deltime . "' AND ClinicName='" . $delclinicname . "' AND PatientID='" . $delpatientid . "'";

                    $conn->query($sql) or die($conn->error);
                    
                    $sql = "DELETE FROM zuc_Bills
                    WHERE Date='" . $deldate . "' AND Time='" . $deltime . "' AND ClinicName='" . $delclinicname . "' AND PatientID='" . $delpatientid . "'";

                    $conn->query($sql) or die($conn->error);

                    $sql = "DELETE FROM zuc_Appointments
                            WHERE Date='" . $deldate . "' AND Time='" . $deltime . "' AND ClinicName='" . $delclinicname . "' AND PatientID='" . $delpatientid . "'";

                    $conn->query($sql) or die($conn->error);
                }
                $conn->close();
            ?>
        </div>

        <div style="float : left; padding : 20px;">
            <h2>Update An Appointment</h2>
            <form method="post">
                <label for="updatepatientid">
                    Patient ID : <input type="number" name="updatepatientid" id="updatepatientid" placeholder="Enter a Patient ID">
                </label>
                <h3>Old Values</h3>
                <label for="olddate">
                    Old Date : <input type="date" name="olddate" id="olddate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="oldtime">
                    Old Time : <input type="time" name="oldtime" id="oldtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="oldclinicname">
                    Old Clinic Name : <input type="text" name="oldclinicname" id="oldclinicname" placeholder="Enter a Clinic Name">
                </label>
            
                <br>
                <h3>New Values</h3>

                <label for="newdate">
                    New Date : <input type="date" name="newdate" id="newdate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="newtime">
                    New Time : <input type="time" name="newtime" id="newtime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="newclinicname">
                    New Clinic Name : <input type="text" name="newclinicname" id="newclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <input type="submit" name="updateApp" value="Submit">                 
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

                if(isset($_POST['updateApp'])) {
                    $updatepatientid = $_POST['updatepatientid'];
                    
                    $olddate = $_POST['olddate'];
                    $oldtime = $_POST['oldtime'];
                    $oldclinicname = $_POST['oldclinicname'];

                    $newdate = $_POST['newdate'];
                    $newtime = $_POST['newtime'];
                    $newclinicname = $_POST['newclinicname'];

                    //turned on cascading
                    $sql = "UPDATE zuc_Appointments
                    SET Date='" . $newdate . "', Time='" . $newtime . "', ClinicName='" . $newclinicname . "'
                    WHERE Date='" . $olddate . "' AND Time='" . $oldtime . "' AND ClinicName='" . $oldclinicname . "' AND PatientID='" . $updatepatientid . "'";

                    $conn->query($sql) or die($conn->error);
                }
                $conn->close();
            ?>
        </div>

        <div style="float : left; padding : 20px;">
        <h2>Schedule Dentist For Appointment</h2>
            <form method="post">
                <label for="dentdate">
                    Date : <input type="date" name="dentdate" id="dentdate" placeholder="Enter a Date">
                </label>
                </br>
                <label for="denttime">
                    Time : <input type="time" name="denttime" id="denttime" placeholder="Enter a Time">
                </label>
                </br>
                <label for="dentclinicname">
                    Clinic Name : <input type="text" name="dentclinicname" id="dentclinicname" placeholder="Enter a Clinic Name">
                </label>
                </br>
                <label for="dentpatientid">
                    Patient ID : <input type="number" name="dentpatientid" id="dentpatientid" placeholder="Enter a Patient ID">
                </label>
                </br>
                <label for="dentdentistid">
                    Dentist ID : <input type="number" name="dentdentistid" id="dentdentistid" placeholder="Enter a Patient ID">
                </label>
                </br>
                <input type="submit" name="addappdentist" value="Submit">
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

                if(isset($_POST['addappdentist'])) {
                    $dentdate = $_POST['dentdate'];
                    $denttime = $_POST['denttime'];
                    $dentclinicname = $_POST['dentclinicname'];
                    $dentpatientid = $_POST['dentpatientid'];
                    $dentdentistid = $_POST['dentdentistid'];
                
                    $sql = "INSERT INTO zuc_AssignedTo(Date, Time, ClinicName, PatientID, DentistID)
                                Values('" . $dentdate . "', '" . $denttime . "','" . $dentclinicname . "', '" . $dentpatientid . "', '" . $dentdentistid . "');";

                    $conn->query($sql) or die($conn->error);
                 }
                 $conn->close();
            ?>
        </div>
 
        <hr style="clear: left;">
        <div>
            <h2>Dentist Schedule</h2>
            <form method="POST">
                <label for="daystart">
                    Start Date : <input type="date" name="daystart" id="daystart">
                </label>
                </br>
                <label for="daystend">
                    End Date: <input type="date" name="dayend" id="dayend">
                </label>
                <br>
                <label for="dentistID">
                    Dentist ID : <input type="number" name="dentistID" id="dentistID"/>
                </label>
                <br>
                <input type="submit" value="Submit" name="query2"/>
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
                        $dentistID = $_POST['dentistID'];
                        $daystart = $_POST['daystart'];
                        $dayend = $_POST['dayend'];
        
                        $sql = "SELECT Name, ID, Date, Time, ClinicName
                                FROM zuc_AssignedTo
                                LEFT JOIN  zuc_Patients ON PatientID = ID
                                WHERE DentistID = '" . $dentistID . "'
                                AND Date BETWEEN '" . $daystart . "' AND '" . $dayend . "'";
        
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