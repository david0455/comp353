<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Styling.css">
</head>

<body>
    <header><img style="float : left; height : 35pt; margin-left: 6px; margin-right: 9px;" src="logo.jpeg" alt="Logo" id="logoNav">Dental Clinic</header>
    <!-- <div id="nav">
        <ul>
            <li><img src="logo.jpeg" alt="Logo" id="logo"></li>
            <li><a class="active" href="#home">Home</a></li>
            <li><a href="clinics.php">Clinics</a></li>
            <li><a href="appointments.php">Appointments</a></li>
            <li><a href="patients.php">Patients</a></li>
            <li><a href="staff.php">Staff</a></li>
            <li><a href="bills.php">Bills</a></li>
        </ul>
        <div id="admincontainer">
            <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div> -->

    <div class="data">
</br>
</br>
</br>
            <div class="container">
                <img class="image" style="float: left;width:300px;height:300px;" src="clinic.jpg" alt="clinic" id="logo">
                <div class="overlay">
                    <div class="text"><a style="color:white;" href="clinics.php">Clinics</a></div>
                </div>
            </div>
            <div class="container">
                <img class="image" style="float: left;width:300px;height:300px;" src="appointment.jpg" alt="appointment" id="logo">
                <div class="overlay">
                    <div class="text"><a style="color:white;" href="appointments.php">Appointments</a></div>
                </div>
            </div>
            <div class="container">
                <img class="image" style="float: left;width:300px;height:300px;" src="patients.jpg" alt="patient" id="logo">
                <div class="overlay">
                    <div class="text"><a style="color:white;" href="patients.php">Patients</a></div>
                </div>
            </div>
            <div class="container">
                <img class="image" style="float: left;width:300px;height:300px;" src="staff.jpeg" alt="staff" id="logo">
                <div class="overlay">
                    <div class="text"><a style="color:white;" href="staff.php">Staff</a></div>
                </div>
            </div>
            <div class="container">
                <img class="image" style="float: left;width:300px;height:300px;" src="bills.jpg" alt="billsgo" id="logo">
                <div class="overlay">
                    <div class="text"><a style="color:white;" href="bills.php">Bills</a></div>
                </div>
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