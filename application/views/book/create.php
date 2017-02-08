<?php echo validation_errors(); ?>


<?php echo form_open('book/insert'); ?>

<label for="resource_id">Resource id</label>
<?php echo form_input('resource_id', '' , 'class="form-control"'); ?>
</br>
<label for="date">Booking Date</label>
<?php echo form_input('date', '', 'class="form-control"'); ?>
</br>
<label for="start_time">Start time</label>
<?php echo form_input('start_time', '' , 'class="form-control"'); ?>
</br>
<label for="end_time">End time</label>
<?php echo form_input('end_time', '' , 'class="form-control"'); ?>
</br>

<?php echo form_submit('submit', 'Book' , 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>



<form method="POST" action="/book/insert">
	resourec:
<input name="resource" type="text" value="<?php echo $resource->id; ?>">
</br></br>
date:
<input name="date" type="text">
</br></br>

start time:
<input name="start_time" type="text">
</br></br>
end time:
<input name="end_time" type="text">
</br></br>
<button type="submit">Submit</button>
</form>