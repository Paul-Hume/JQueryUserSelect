<?php

// Check if form is submitted
if ($_POST) {

	// Seperate User IDs
	$userIds = explode(',', $_POST['notify']);

	// Remove blank last entry
	$pop = array_pop($userIds);

	// Set Counter
	$i = 0;

	// Process each User ID
	while ($i < count($userIds)) {

		echo 'User ID ' . $userIds[$i] . ' was selected<br>';

		$i++;
	}
}

?>

<!doctype html>
<html>
<head>

	<meta charset="utf-8">
	<title>Select Users</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Select Users on double click and Post.">
	<meta name="author" content="Paul Hume | www.paulhume.co.uk">

	<!-- JS Files-->
	<script src="js/jquery-1.11.1.min.js"></script>


	<script>
		// Set up notify array
  		var notify = [];
  		
  		function addNotify (userId, userName) {
  			
  			// See if the user is already in the notify array
  			var exists = 'No';
  			for ( x=0; x < notify.length; x = x+1) {
  				if (notify[x][0] === userId) {
  					exists = 'Yes';
  				}
  			}

  			// Check if it already exists
  			if (exists == 'No') {
  				// Add it to the list
  				notify.push([userId, userName]);

  				// Clear the notification list and ID's
  				var notifyList = "";
  				var notifyIds = "";

  				// Build a new notification list and ID's
  				for ( x=0; x < notify.length; x = x+1) {
	  				notifyList = notifyList + ' ' + '<span class="label notifyname" onclick="removeNotify(' + notify[x][0] + ');" style="cursor: pointer;">' + notify[x][1] + ' <span class="text-error">X</span> </span>';
	  				notifyIds = notifyIds + notify[x][0] + ',';
	  			}

	  			// Update the displayed list
	  			$('#notifyList').html(notifyList);

	  			// Update the notification ID's
	  			$('#notify').val(notifyIds);
  			} else {
  				alert("You have already selected this user");
  			}
		}

		function removeNotify (userId) {
			// Loop through the list
			for ( x=0; x < notify.length; x = x+1) {

				// Check if the User ID matches
  				if (notify[x][0] === userId) {
  					// Remove the array entry
  					var newArray = notify.splice(x,1);
  					
  					// Clear the notification list and IDs
  					var notifyList = "";
  					var notifyIds = "";

  					// Build new notification list and ID's
		  			for ( x=0; x < notify.length; x = x+1) {
		  				notifyList = notifyList + ' ' + '<span class="label notifyname" onclick="removeNotify(' + notify[x][0] + ');" style="cursor: pointer;">' + notify[x][1] + ' <span class="text-error">X</span> </span>';
		  				notifyIds = notifyIds + notify[x][0] + ',';
		  			}

		  			// Update the displayed list
		  			$('#notifyList').html(notifyList);

		  			// Update the notification ID's
		  			$('#notify').val(notifyIds);
  				}
  			}
		}

  	</script>

  	<!-- Styles -->
  	<style>

  		span.label {
  			padding: 2px;
  			margin-right: 5px;
  			border: 1px solid #666;
  		}

  		span.text-error {
  			color: #b20000;
  			font-size: 0.75em;
  		}

  	</style>
</head>


<body>

<h2>Select User Form </h2>

<form action="" method="post">

	<!-- Create a hidden input field to hold your User ID's -->
	<input type="hidden" id="notify" name="notify" value="">

	<p>
		Please double click your usernames.
	</p>

	<!-- Create the multiple select box to hold User Names -->
	<select name="userlist" multiple style="height: 175px;">
		<option value="">Please select a name ...</option>
		<option value="01" ondblclick="addNotify(01, 'User Name 01');">User Name 01</option>
		<option value="02" ondblclick="addNotify(02, 'User Name 02');">User Name 02</option>
		<option value="03" ondblclick="addNotify(03, 'User Name 03');">User Name 03</option>
		<option value="04" ondblclick="addNotify(04, 'User Name 04');">User Name 04</option>
	</select>

	<!-- Display notify array from JQuery -->
	<div style="margin: 10px 0px;">
		To: <span id="notifyList"></span>
	</div>

	<!-- Submit button -->
	<button type="submit">Submit Form</button>

</form>


</body>
</html>