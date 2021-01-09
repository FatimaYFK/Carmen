<!DOCTYPE html>
<html>
<head>
    <title>Carmen Kaffee Kontakt ☕</title>
	<style>
body { 
  background: url(img/bg-body.jpg); 
}


	</style>
</head>
<body>

	<center>
		<h4 class="sent-notification"></h4>

		<form id="myForm">
		  <h2>Schreiben Sie hier Ihr Feedback...</h2>

			<label>Name:</label>
			<input id="name" type="text" placeholder="Name">
			<br><br>

			<label>E-mail:</label>
			<input id="email" type="text" placeholder="E-Mail">
			<br><br>

			<label>Betreff:</label>
			<input id="subject" type="text" placeholder="Worum geht es?"> 
			<br><br>

			<p>Nachricht:</p>
			<textarea id="body" rows="5" placeholder="Schrieben Sie hier"></textarea>
			<br><br>

			<button type="button" onclick="sendEmail()" value="Send An Email">Einreichen</button> 
		</form>
	</center>

	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
        function sendEmail() {
            var name = $("#name");
            var email = $("#email");
            var subject = $("#subject");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                $.ajax({
                   url: 'sendEmail.php',
                   method: 'POST',
                   dataType: 'json',
                   data: {
                       name: name.val(),
                       email: email.val(),
                       subject: subject.val(),
                       body: body.val()
                   }, success: function (response) {
                        $('#myForm')[0].reset();
                        $('.sent-notification').text("Wir haben Ihr Nachricht eingereicht.");
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>

</body>
</html>