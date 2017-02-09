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
      <th><?php echo $resource->id; ?></th>
      <th><?php echo anchor('admin/resource/view/'.$resource->id, $resource->name); ?></th>
      <td><?php echo $resource->description; ?></td>
      <td><?php echo $resource->created_at; ?></td>
    </tr>	
<?php } ?> 
  </tbody>
</table>

