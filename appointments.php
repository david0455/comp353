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
        <a id="admin" onclick="isAdmin()">Admin</a>
        </div>
    </div>
        <div class="data">
            <h1>Dental Clinics</h1>
            <p>Get details of all dentists in all the clinics.</p>
            <button type="button" id="q1">List of dentist</button>
            <span id="query1"> </span>

            <form id="foo">
                <input id="bar" name="bar" type="text" value="" />
                <input type="submit" value="Query1" />
            </form>
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