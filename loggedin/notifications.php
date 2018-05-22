<?php
require 'includes/header.php';
if (isset(_$POST["subject"]))
{
  include("connect.php");
  $subject = mysqli_real_escape_string($con, $_POST["subject"]);
  $message = mysqli_real_escape_string($con, $_POST["message"]);
  $query = "INSERT INTO cobnotifications(notification_id, user_id, email, subject, message) VALUES ('$subject', '$message')"
  mysqli_query($con, $query
  header("Location: generalnotifications.html");

  header("location:notifications.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>COB Admin</title>
	<link rel="stylesheet" type="text/css" href='css/style.css'>
	<link rel="stylesheet" type="text/css" href='css/transfersbymember.css'>
	<script src="https://use.fontawesome.com/5db033aace.js"></script>
	<script
	  src="https://code.jquery.com/jquery-3.2.1.js"
	  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	  crossorigin="anonymous">
	</script>

<script>
	var token = "<?php echo $_SESSION["token"]; ?>";
		var accountNumber="<?php echo $_GET["accountNumber"]; ?>";
	</script>

	<script src="js/menu.js"></script>
	<script src="js/transfersbyaccount.js"></script>
</head>

<body>
	<div id="pageContainer">
		<div id="topBar">
			<?php include 'includes/topbar.php'; ?>
		</div>

		<div id="body">
			<div id="menuBar">
				<?php include 'includes/menu.php'; ?>
			</div>

		<form action="notifications.php" method="POST" id="notifications">

			<div id="content">
			<div id="contentHeader"> Notifications </div>

			<div id="contentBody">
			<p class="indent">Please enter information for your notification. </p>
     </div>

			<div id="contentBody">
				<div id="notificationheader" class="listHeader">
				<div class="created" size="75%">Recipient Email Address</div>
				</div>
				<input id="emailAddress" type="email" name="email" placeholder="user@emailaddress.com" list="defaultEmails" size="64" maxlength="256" multiple>
			</div>

				<datalist id="defaultEmails">
			  <option value="jbond007@mi6.defence.gov.uk">
			  <option value="jbourne@unknown.net">
			  <option value="nfury@shield.org">
			  <option value="tony@starkindustries.com">
			  <option value="hulk@grrrrrrrr.arg">
				</datalist>

				<div id="contentBody">
				<div id="subject" class="listHeader" size ="100% auto !important">
				<div class="created" size="75%">Subject</div>
				</div>
				<input type="text" name="subject" class="subject" id="subject" placeholder="General Notification"autocomplete="on" list="subject" size ="100% auto !important">
				</div>

				<div id="contentBody">
				<div id="notificationheader" class="listHeader">
				<div class="created">Message</div>
				</div>
				<input type="text" id="message" placeholder="Your monthly news and updates from COB Administration and E-PAY"class="form-control mr-sm-2"  name="subjectNotification" size ="100% auto !important" height="50px">
				</div>

				<div id="contentBody">
				<p class="indent">
				<a href="dashboard.php" class="btn btn-danger" role="button"><input type="submit" value="Cancel" name="button"></a>
				<!--	<button type="submit" class="btn btn-success" id="button">Send Message</button> -->
				<input type="submit" value="Submit" name="button">
				</div>
			  </p></div>

						<style>
						input[name=subjectNotification], select {
								width: 100%;
								padding: 150px 20px;
								margin: 8px 0;
								display: inline-block;
								border: 1px solid #ccc;
								border-radius: 4px;
								box-sizing: border-box;
						}

						input[name=email], select {
								width: 100%;
								padding: 12px 20px;
								margin: 8px 0;
								display: inline-block;
								border: 1px solid #ccc;
								border-radius: 4px;
								box-sizing: border-box;
						}

						input[name=subject], select {
								width: 100%;
								padding: 12px 20px;
								margin: 8px 0;
								display: inline-block;
								border: 1px solid #ccc;
								border-radius: 4px;
								box-sizing: border-box;
						}

						<style>
							.btn btn-danger {
									background-color: #098C56;
									border: none;
									color: white;
									padding: 15px 32px;
									text-align: left;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									margin: 4px 2px;
									cursor: pointer;
							}

							.button {
									background-color: #098C56;
									border: none;
									color: white;
									padding: 15px 32px;
									text-align: right;
									text-decoration: none;
									display: inline-block;
									font-size: 16px;
									margin: 4px 2px;
									cursor: pointer;
									float: right;
							}
					</style>

					</div>
					</div>

							</div>
						</div>
					</div>
				</div>

			</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

		</body>
		</html>

		<?php
			include "partials/menu.php"; //include slideout menu
			include "partials/footer.php";//include footer
			include "notifications/fetch.php"; //notifications
			include "notifications/insert.php"; //notifications
			include "notifications/connect.php"; //notifications
			include "notifications/link.js"; //notifications
		?>
