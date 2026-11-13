<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coming Soon </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style>
/* Flex col */
.flex-col-c-sb{
 background-color:#ffffff !important;
}

/* Center */
.flex-col-c-sb .flex-col-c h3.txt-center{
 color:#5a5a5a;
}

/* Center */
.flex-col-c-sb .flex-col-c p.txt-center{
 color:#5a5a5a;
}


.bg-g1{
 
 background-color:#ffffff !important;
 transform:translatex(0px) translatey(0px);
}

/* Flex col */
.flex-col-c-sb{
 
 background-color:#ffffff;
 transform:translatex(0px) translatey(0px);
}

/* Flex */
.flex-col-c-sb .flex-col-c .flex-c-m{
background: linear-gradient(145deg, #007bff, #0056b3); /* Light gradient */
    color: #ffffff;
    padding: 14px 28px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease, transform 0.2s ease;
}

/* Flex (hover) */
.flex-col-c-sb .flex-col-c .flex-c-m:hover{
background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}
.how-btn::before {
   background: linear-gradient(145deg, #0056b3, #003c82);
    transform: translateY(-2px);
}

    a {
        color: #ffffff;
       text-decoration: none;
    }
</style>
</head>
<body>
	
	
	<div class="bg-g1 size1 flex-w flex-col-c-sb p-l-15 p-r-15 p-t-55 p-b-35 respon1">
		<span></span>
		<div class="flex-col-c p-t-50 p-b-50">
			<h3 class="l1-txt1 txt-center p-b-10">
				Coming Soon
			</h3>
<br>
			<p class="txt-center l1-txt2 p-b-60">
				Our Website Is Under Maintenance 
			</p>
            
		

		<button class="flex-c-m s1-txt2 size3 how-btn" 
    onclick="window.location.href = 'https://wa.me/<?= $settings['whatsapp_number'] ?>';">
    Contact Us
</button>

		</div>

		<span class="s1-txt3 txt-center">
		
		</span>
		
	</div>


		</div>
	</div>

	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/moment.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			// Set Endtime here
			// Endtime must be > current time
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York", can be empty
			// go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
