<?php echo anchor('account/login', 'Login'); ?>

<?php foreach ($resources as $resource) { ?>
<p><a href="book/create/<?php echo $resource->id; ?>">gdjahsgd<?php echo $resource->name; ?></a></p>
<?php } ?>