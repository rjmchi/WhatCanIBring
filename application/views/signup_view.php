		<h1>Event Signup for <?php echo $event->name;?></h1>
		<h2><?php echo $event->location;?></h2>
		<h3><?php echo $event->datetime;?></h3>
		<table>
			<tr>
				<th>Name</th>
				<th>Item</th>
				<th>Dish</th>
				<th></th>
				<th></th>
			</tr>
			<?php 
				$odd=false;
				$rownum = 0;
				$options[0] = 'Please Select';
				foreach ($types as $type)
				{
					$options[$type->id] = $type->typename;
				}
			?>

			<?php foreach ($guests as $guest) { ?>
				<tr class="<?php echo ($odd)?'odd':'even'; ?>">
					<?php 
						$attributes = array('class' => 'signup', 'name'=> 'signup_' . $guest->id);
					
						echo form_open('/signup/update', $attributes);
						echo form_hidden('guestid', $guest->id);
						echo form_hidden('rownum', $rownum);
					?>
					<td><?php echo $guest->first_name . ' ' . $guest->last_name;?></td>
					<td><?php echo form_dropdown('items', $options, 'large');?></td>
					<td><?php echo form_input('dish');?></td>
					<td><?php echo form_submit('submit', 'Update');?></td>
					<td><a href="">Add Another Item</a></td>
					<?php echo form_close();?>
					
				</tr>
				<?php $odd = !$odd;?>
				<?php $rownum++;?>
			<?php } ?>
		
		</table>

		<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if (isset($message))
			{
				echo $message;
			}
		?>
		</div><!-- end errors -->
