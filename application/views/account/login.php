<?php echo validation_errors(); ?>


<?php echo form_open('account/login'); ?>

<label for="username">Username</label>
<?php echo form_input('username', set_value('username'), 'class="form-control"'); ?>
</br>
<label for="password">Password</label>
<?php echo form_input('password', '' , 'class="form-control"'); ?>
</br>
<?php echo form_submit('submit', 'Login' , 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>

<?php echo anchor('account/register', 'Register'); ?>