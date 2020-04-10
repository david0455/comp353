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
        <li><a href="bills.php">Bills</a></li>
    </ul>
</div>
    <div class="data">
        <h1> I am the admin </h1>

        <form id="foo" method="POST">
            <br>
            <label>Insert Query</label>
            <br>
            <textarea name="query10" rows="5" cols="50"><?php if(isset($_POST['query10'])) {echo htmlentities ($_POST['query10']); }?>
            </textarea>
            <br>
            <input type="submit" value="Send Query" name="anyQuery"/>
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

                if (isset($_POST['anyQuery']) ) {
                    $sql = $_POST['query10'];

                    $result = $conn->query($sql) or die($conn->error);
                    while($row = $result->fetch_assoc()){
                        print("<pre>".print_r($row,true)."</pre>");
                    }
                }
                $conn->close();
            ?>
        </div>

    </div>
</body>

</html>