<div ng-controller="bookingForm" class="col-md-6">
<form method="POST" action="/book/test">
<input name="resource" type="hidden" value="<?php echo $resource->id; ?>">
<div class="form-group">
    <label for="dateInput">Date</label>
    <input type="date" name="date" class="form-control" id="dateInput">
</div>
<div class="form-group">
    <label for="startTime">Start Time</label>
    <input type="time" name="startTime" class="form-control" id="startTime">
</div>
<div class="form-group">
    <label for="endTime">End Time</label>
    <input type="time" name="endTime" class="form-control" id="endTime">
</div>
<div class="form-group">
    <label for="startTime">test</label>
    <input type="text" ng-model="textBox">
</div>
<div class="form-group">
<label for="repeat">Repeat</label>
<select class="form-control" id="repeat" ng-model="repeat">
  <option value="noRepeat">No repeat</option>
  <option value="daily">Daily</option>
  <option value="weekly">Weekly</option>
  <option value="monthly">Monthly</option>
  <option value="anually">Anually</option>
</select>
</div>
<div ng-switch="repeat">
	<div ng-switch-when="daily|monthly|anually" ng-switch-when-separator="|">
<label for="every">Every</label>
<select class="form-control" id="every">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
<div class="form-group">
    <label for="endDateInput">End Date</label>
    <input type="date" name="date" class="form-control" id="endDateInput">
</div>
</div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>