		<h1><?php echo $event->name;?></h1>
		
		<p>Guest List</p>
		<table>
			<?php foreach ($guests as $guest){?>
				<tr>
					<td><?php echo $guest->first_name;?> <?php echo $guest->last_name;?></td>
					<td><?php echo $guest->email;?></td>
				</tr>
			<?php }	?>
		
		</table>
	
		<h2>Invite Guest</h2>
		<div id="invite">
		<?php
			echo form_open('/myevents/invite');
			
			echo form_label('First Name:', 'first_name');
			echo form_input('first_name', set_value('first_name'), 'id="first_name"');

			echo form_label('Last Name:', 'last_name');
			echo form_input('last_name', set_value('last_name'), 'id="last_name"');

			echo form_label('email:', 'email');
			echo form_input('email', set_value('email'), 'id="email"');

			echo form_label('Message:', 'message');
			echo form_textarea('message', set_value('message'), 'id="message"');

			echo form_submit('submit', 'Invite');
			echo form_close();
		?>
		</div><!-- end invite -->
		<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if (isset($message))
			{
				echo $message;
			}
		?>
		</div><!-- end errors -->
		<div id="categories">
			<h2>Use these categories</h2>
			<?php echo form_open('/myevents/types');?>

			<ul>
				<?php foreach ($types as $type) { ?>
				<?php
					$data['name'] = $type->id;
					$data['id'] = $type->id;
					$data['value'] = 'x';
					$data['checked'] = $type->active;
				?>
					<li><?php echo form_checkbox($data) . $type->typename;?></li>
				<?php } ?>
			</ul>
			<?php echo form_label('New Category:', 'newcat');?>
			<?php echo form_input('newtype', set_value('newcat'), 'id="newcat"');?>
			<?php echo form_submit('submit', 'Update Categories');?>
			<?php echo form_hidden('eventid', $event->id); ?>
			<?php echo form_close();?>
		</div><!-- end categories -->
		<div id="menuitems">
			<h2>Create Menu</h2>
			<p>Use this section to create menu items that your guest can choose from.</p>
		</div><!-- end menuitems -->
