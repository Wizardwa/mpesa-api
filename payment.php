<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" type="text/css">
	<title>Lipa na mpesa</title>
</head>
<body>
	<form class="payment
	" method="POST" action="stkpush.php">
	<h1 class="heading">Lipa na mpesa</h1>
		<label>Enter phone number</label>
		<br>
		<input type="phone" name="phonenumber" placeholder="254712345678">
		<br>
		<br>
		<label>Amount</label>
		<br>
		<input type="number" name="amount" min="1" max="298000" placeholder="10">
		<br>
		<br>
		<button type="submit" id="stk" >STK push</button>
	</form>
</body>
</html>