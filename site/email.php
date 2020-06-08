<?php
    $page = 'email';
    require_once 'header.php';
?>
<html>
    <body>
        <form class= "card centered wide" id= "frm_user_data" action= "">
			<?php
				$valid_action = true;
				if (isset($_GET['action']))
				{
					if ($_GET['action'] == 'resend_email')
						$html = '<pre>Email Address: <input type= "email" name= "email"></pre>
								<pre><input type= "submit" value= "Resend Verification Link" name= "submit"></pre>';
					else
						$valid_action = false;
				}
				else
					$valid_action = false;

				if (!$valid_action)
				{
					$html = '<pre>An Email that contains a link to verify your account</pre>
					<pre>has been sent to your email address</pre>
					<pre>If you did not recieve it click <a href= "./email.php?action=resend_email">here</a></pre>';
				}
				print($html);
			?>
        </form>
    </body>
</html>