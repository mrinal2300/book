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