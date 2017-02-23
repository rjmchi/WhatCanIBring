		<h1>My Profile</h1>
		<div id="profile">
		<?php
			echo form_open('index.php/authentication/update_profile');
			
			echo form_label('First Name:', 'first_name');
			echo form_input('first_name', $profile->first_name, 'id="first_name"');

			echo form_label('Last Name:', 'last_name');
			echo form_input('last_name', $profile->last_name, 'id="last_name"');
			
			echo form_label('email:', 'email');
			echo form_input('email', $profile->email, 'id="email"');
			
			echo form_label('Change Password:', 'password');
			echo form_password('password', '', 'id="password"');
			
			echo form_submit('submit', 'Update Profile');
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
