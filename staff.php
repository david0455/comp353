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
            <li><a class="active" href="#staff">Staff</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" href="admin.php">Admin</a>
        </div>
    </div>
    <div class="data">
        <h1>Staff List</h1>
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

            //DENTISTS
            $sql = "SELECT zuc_Dentists.*, zuc_WorksAt.ClinicName FROM zuc_Dentists LEFT JOIN zuc_WorksAt ON zuc_Dentists.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'LaCite Medical';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h2>Dentists</h2>";
            echo "<h3>LaCite Medical</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Specialization</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Specialization"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table><br>";

            $sql = "SELECT zuc_Dentists.*, zuc_WorksAt.ClinicName FROM zuc_Dentists LEFT JOIN zuc_WorksAt ON zuc_Dentists.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'South Shore Dental';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h3>South Shore Dental</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Specialization</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Specialization"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table><br>";

            $sql = "SELECT zuc_Dentists.*, zuc_WorksAt.ClinicName FROM zuc_Dentists LEFT JOIN zuc_WorksAt ON zuc_Dentists.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'Greenfield Dental';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h3>South Shore Dental</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Specialization</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["Specialization"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table><br>";

            echo "<hr>";

            //ASSISTANTS
            $sql = "SELECT zuc_DentalAssistants.*, zuc_WorksAt.ClinicName FROM zuc_DentalAssistants LEFT JOIN zuc_WorksAt ON zuc_DentalAssistants.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'LaCite Medical';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h2>Dental Assistants</h2>";
            echo "<h3>LaCite Medical</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table>";

            $sql = "SELECT zuc_DentalAssistants.*, zuc_WorksAt.ClinicName FROM zuc_DentalAssistants LEFT JOIN zuc_WorksAt ON zuc_DentalAssistants.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'South Shore Dental';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h3>South Shore Dental</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table>";

            $sql = "SELECT zuc_DentalAssistants.*, zuc_WorksAt.ClinicName FROM zuc_DentalAssistants LEFT JOIN zuc_WorksAt ON zuc_DentalAssistants.ID = zuc_WorksAt.StaffID WHERE zuc_WorksAt.ClinicName = 'Greenfield Dental';";
            $result = $conn->query($sql) or die($conn->error);
            echo "<h3>Greenfield Dental</h3>";
            echo "<table><tr><th>ID</th><th>Name</th><th>Sex</th><th>Age</th><th>Clinic Name</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Name"]. "</td><td>" . $row["Sex"]. "</td><td>" . $row["Age"]. "</td><td>" . $row["ClinicName"]. "</td></tr>";
            }
            echo "</table>";
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>