<h1>Welcome <?php echo $this->session->userdata('username'); ?> !</h1>

<?php echo anchor('account/logout', 'Logout'); ?>