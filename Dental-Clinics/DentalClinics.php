 <!DOCTYPE html>
<html>
	<head>
		<title>COMP 353 - Main Project</title>
		<style>
			table,th,td {
			  border : 1px solid black;
			  border-collapse: collapse;
			}
			th,td {
			  padding: 5px;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			function sendquery1(elem) {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
						document.getElementById("query1").innerHTML = this.responseText;
		            }
		        }
		        xmlhttp.open("GET", "connection.php?queryID="+elem, true);
		        xmlhttp.send();
			}

			function showPatientAPT(value, elem) {
			  	var xhttp;  
			 	if (value == "") {
			 	   document.getElementById("query4").innerHTML = "";
			   	   return;
			  	}
			  	xhttp = new XMLHttpRequest();
			  	xhttp.onreadystatechange = function() {
			    	if (this.readyState == 4 && this.status == 200) {
			      		document.getElementById("query4").innerHTML = this.responseText;
			    	}
				};
			  	xhttp.open("GET", "connection.php?queryID="+elem+"&value="+value, true);
			  	xhttp.send();
			}
		</script>
	</head>

	<body>
		<h1>Dental Clinics</h1>
		<p>Get details of all dentists in all the clinics.</p>
		<button type="button" onclick="sendquery1(this.id)" id="q1">List of dentist</button>
		<span id="query1"> </span> 


		<p>Get details of all appointments for a given dentist for a specific week.</p>
		<form action="" accept-charset=utf-8>
			<select name="customers" onclick="showDentist(this.value, this.id)">
			    <option value="">Select a dentist:</option>
			    <option value="Ronaldo">Ronaldo</option>
			    <option value="Messi ">Messi</option>
			    <option value="Neymar">Neymar</option>
		  	</select>
		</form> 
		<button type="button" onclick="sendquery(this.id)" id="2">Click Me!</button> 
		<span id="query2"> </span>



		<p>Get details of all appointments at a given clinic on a specific date.</p> 
		<button type="button" onclick="sendquery(this)" id="3">Click Me!</button> 
		<span id="query3"> </span>




		<p>Get details of all appointments of a given patient.</p> 
		<form action="" accept-charset=utf-8>
			<select name="patients"">
			    <option value="">Select a patient:</option>
			    <option value="Ronaldo">Ronaldo</option>
			    <option value="Messi ">Messi</option>
			    <option value="Neymar">Neymar</option>
		  	</select>

		  	<button type="submit" onclick="showPatientAPT(, this.id)" id="q4">Click Me!</button> 
		</form> 
		
		<span id="query4"> </span>




		<p>Get the number of missed appointments for each patient (only for patients who have missed at least 1 appointment).</p> 
		<button type="button" onclick="sendquery(this)" id="5">Click Me!</button> 
		<span id="query5"> </span>

		<p>Get details of all the treatments made during a given appointment.</p> 
		<button type="button" onclick="sendquery(this)" id="6">Click Me!</button> 
		<span id="query6"> </span>
		
		<p>Get details of all unpaid bills. </p> 
		<button type="button" onclick="sendquery(this)" id="">Click Me!</button> 
		<span id="query7"> </span>

		<?php include('connection.php'); ?>
	</body>
</html> 