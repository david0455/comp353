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
	
	$queryID = $_GET["queryID"];

	$str = "zuc353_4.player";
	
	$sql = "SELECT * FROM $str";
	$result = $conn->query($sql);

	if(strcmp($queryID, "q1") == 0){	//only query1 will use this block of code
		if ($result->num_rows > 0) {
	    // output data of each row
			echo "<table>";
			echo "<tr>";
			echo "<th>Pid</th>";
			echo "<th>Name</th>";
			echo "<th>Position</th>";
	    	while($row = $result->fetch_assoc()) {
	    		echo "<tr>";
				echo "<td>" . $row["Pid"] . "</td>";
				echo "<td>" . $row["name"] . "</td>";
				echo "<td>" . $row["position"] . "</td>";
				echo "<tr>";
	    	}
	    	echo "</tr>";
			echo "</table>";
		}else {
		    echo "No record found";
		}
	}


	$valueName = $_GET["patients"];
	$sql = "SELECT * FROM zuc353_4.player WHERE 'name' = 'Ronaldo'";
	$result = $conn->query($sql);

	echo "hello";
	//if(strcmp($queryID, "q4") == 0){	//only query4 will use this block of code
		while($row = $result->fetch_assoc()){
			echo "<table>";
			echo "<tr>";
			echo "<th>Pid</th>";
			echo "<td>" . $row["Pid"] . "</td>";
			echo "<th>name</th>";
			echo "<td>" . $row["name"] . "</td>";
			echo "<th>position</th>";
			echo "<td>" . $row["position"] . "</td>";
			echo "</tr>";
			echo "</table>";			
		}
//	}

	$conn->close();

	
	
?> 

