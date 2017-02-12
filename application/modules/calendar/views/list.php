<div ng-controller="home">

<div class="row">
	<div class="col-md-2">
		<h4>Resource</h4>







	<div ng-repeat="resource in resources">{{resource.name}} <i class="fa fa-trash" aria-hidden="true"></i></div>


	</div>
	<div class="col-md-10">



<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
<button type="button" class="btn btn-secondary"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
<button type="button" class="btn btn-secondary"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
</div>
<button type="button" class="btn btn-sm btn-secondary">Today</button>

<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
<button type="button" class="btn btn-secondary">Day</button>
<button type="button" class="btn btn-secondary">Week</button>
<button type="button" class="btn btn-secondary">Month</button>
</div>


<hr>

<div class="form-group row">
      <label for="resourcesInput" class="col-sm-2 col-md-1 col-form-label col-form-label-sm">Resources</label>
      <div class="col-sm-10 col-md-11">
		<select class="form-control" multiple="multiple" id="resourcesInput">
			<?php foreach ($calendar_resources as $resource) { ?>
				<option value="<?php echo $resource->id; ?>" selected="selected"><?php echo $resource->name; ?></option>
			<?php } ?>
		</select>
      </div>
    </div>





<hr>

<div ng-include="'/calendar/main_template'"></div>














	</div>
	
</div>
</div>