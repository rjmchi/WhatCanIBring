		<ol>
			<li>Sign up</li>
			<li>Create an event</li>
			<li>Invite guests</li>
			<li>Make Plans</li>
		</ol>
		<div id="login">
			<h2>Already a member?</h2>
			<h3>Sign in here</h3>
<?php 
			echo form_open('/authentication/login');
			echo form_label('User Name:', 'user_name');
			echo form_input('user_name', set_value('user_name'), 'id="user_name"');
			echo form_label('Password:', 'password');
			echo form_password('password', '', 'id="password"');
			echo "<p>Remember me ";
			echo form_checkbox('remember', 'remember', TRUE);
			echo "</p>";
			echo form_submit('submit', 'Login');
			echo form_close();
?>

			<p><a href="index.php/authentication/forgot_password">Forgot Password?</a></p>
		</div>
		<div id="signup">
			<h2>Create a free account</h2>
<?php 
			echo form_open('/authentication/signup');

			echo form_label('First Name:', 'first_name');
			echo form_input('first_name', set_value('first_name'), 'id="first_name"');

			echo form_label('Last Name:', 'last_name');
			echo form_input('last_name', set_value('last_name'), 'id="last_name"');

			echo form_label('User Name:', 'user_name');
			echo form_input('user_name', set_value('user_name'), 'id="user_name"');
			
			echo form_label('Email Address:', 'email_address');
			echo form_input('email_address', set_value('email_address'), 'id="email_address"');
			
			echo form_label('Password:', 'password');
			echo form_password('password', '', 'id="password"');
			
			echo form_label('Confirm Password:', 'confirmpassword');
			echo form_password('confirmpassword', '', 'id="confirmpassword"');
		
			echo form_submit('submit', 'Sign Up');
			echo form_close();
?>
		</div>
		
		<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if (isset($error))
			{
				echo $error;
			}
		?>
		</div><!-- end errors -->