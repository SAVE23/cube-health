<!DOCTYPE html>
<html>
<head>
<title>Qube Health</title>
<link href="<?php echo base_url().URL_SEPARATOR; ?>assets/css/otp-style.css" type="text/css" rel="stylesheet" />
</head>
<body>

	<div class="container">
		<div class="error"></div>
		<form id="frm-mobile-verification">
			<div class="form-heading">Mobile Number Verification</div>

			<div class="form-row">
				<input type="number" id="mobile" name="mobile" class="form-input"
					placeholder="Enter the 10 digit mobile">
			</div>

			<input type="button" class="btnSubmit" value="Send OTP" onClick="sendOTP();">
		</form>
	</div>

	<script src="<?php echo base_url().URL_SEPARATOR; ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url().URL_SEPARATOR; ?>assets/js/verification.js"></script>
</body>
</html>