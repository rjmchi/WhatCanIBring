		<h1>My Events</h1>
		<h2>Manage Your Events</h2>
		<ul>
		<?php
			if ($events)
			{
				foreach($events as $event)
				{
		?>
					<li>
						<?php echo anchor('/myevents/manage/'.$event->name, $event->name);?>
						<?php echo anchor('/myevents/signup/'.$event->name, 'View Signup Sheet');?>
					</li>
		<?php
				}
			}
			else
			{
				echo "<li>No events found</li>";
			}
		?>
		</ul>
		<h2>Create a new event</h2>
		<div id="newevent">
		<?php
			echo form_open('myevents/create');
			echo form_label('Event Name:', 'event_name');
			echo form_input('event_name', set_value('event_name'), 'id="event_name"');
			echo form_label('Location:', 'location');
			echo form_input('location', set_value('location'), 'id="location"');
			echo form_label('date: (yyyy-mm-dd)', 'date');
			echo form_input('date', set_value('date'), 'id="date"');
			echo form_label('time: (hh:mm)', 'time');
			echo form_input('time', set_value('time'), 'id="time"');
			echo form_label('Message:', 'message');
			echo form_textarea('message', set_value('message'), 'id="message"');
			echo form_submit('submit', 'Create');
			echo form_close();
		?>
		</div><!-- end newevent -->

		<div class="errors">
		<?php echo validation_errors(); ?>
		<?php
			if (isset($message))
			{
				echo $message;
			}
		?>
		</div><!-- end errors -->
