<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Status</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($users as $user) { ?>
    <tr>
      <td><?php echo $user->id; ?></td>
      <td><?php echo anchor('admin/user/view/'.$user->id, $user->name); ?></td>
      <td><?php echo $user->email; ?></td>
      <td><?php echo $user->status; ?></td>
      <td><?php echo $user->created_at; ?></td>
    </tr>	
<?php } ?> 
  </tbody>
</table>

