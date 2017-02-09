<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Last Name</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($resources as $resource) { ?>
    <tr>
      <th><?php echo $resource->name; ?></th>
      <td><?php echo $resource->description; ?></td>
      <td><?php echo $resource->name; ?></td>
      <td><?php echo $resource->name; ?></td>
    </tr>	
<?php } ?> 
  </tbody>
</table>

