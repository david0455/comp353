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
            <a id="admin" href="admin.php">Admin</a>
        </div>
    </div>    
    <div class="data">
        <h1>Patient List</h1>
        <p>Get details of all dentists in all the clinics.</p>
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

            $sql = "SELECT Name FROM zuc_Patients";
            $result = $conn->query($sql) or die($conn->error);
            while($row = $result->fetch_assoc()) {
                echo "Name: " . $row["Name"]. "<br>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>