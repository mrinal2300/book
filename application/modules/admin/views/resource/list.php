<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Description</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($resources as $resource) { ?>
    <tr>
      <td><?php echo $resource->id; ?></ts>
      <td><?php echo anchor('admin/resource/view/'.$resource->id, $resource->name); ?></td>
      <td><?php echo $resource->description; ?></td>
      <td><?php echo $resource->created_at; ?></td>
    </tr>	
<?php } ?> 
  </tbody>
</table>

