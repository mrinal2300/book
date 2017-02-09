<?php echo validation_errors(); ?>


<?php echo form_open('account/register'); ?>

<label for="fullname">Full name</label>
<?php echo form_input('fullname', set_value('fullname'), 'class="form-control"'); ?>
</br>
<label for="username">Username</label>
<?php echo form_input('username', set_value('username'), 'class="form-control"'); ?>
</br>
<label for="email">Email</label>
<?php echo form_input('email', set_value('email'), 'class="form-control"'); ?>
</br>
<label for="password">Password</label>
<?php echo form_input('password', '' , 'class="form-control"'); ?>

</br>

<?php echo form_submit('submit', 'Register' , 'class="btn btn-primary"'); ?>

<?php echo form_close(); ?>

<?php echo anchor('account/login', 'Login'); ?>