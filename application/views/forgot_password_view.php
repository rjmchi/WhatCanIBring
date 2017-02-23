		<div id="login">
			<h3>Forgotten Password</h3>
			<p>Enter your e-mail address and we will send you a new password.</p>
<?php 
			echo form_open('index.php/authentication/email_password');
			echo form_label('email:', 'email_address');
			echo form_input('email_address', set_value('email_address'), 'id="email_address"');
			echo form_submit('submit', 'Submit');
			echo form_close();
?>
		</div>
		
		<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if (isset($message))
			{
				echo $message;
			}
		?>
		</div><!-- end errors -->

