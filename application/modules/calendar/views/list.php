


<div class="row">
	<div class="col-md-2">
		
		<?php echo $side_calendar; ?>


	</div>
	<div class="col-md-10">



<ul class="nav nav-tabs justify-content-end">
  <li class="nav-item">
    <a class="nav-link <?php echo ($this->session->userdata('calendar_type') == 'd') ? 'active' : ''; ?>" href="<?php echo base_url('/?type=d'); ?>">Day</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($this->session->userdata('calendar_type') == 'w') ? 'active' : ''; ?>" href="<?php echo base_url('/?type=w'); ?>">Week</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($this->session->userdata('calendar_type') == 'm') ? 'active' : ''; ?>" href="<?php echo base_url('/?type=m'); ?>">Month</a>
  </li>
</ul>

	<?php echo $this->session->userdata('calendar_type'); ?>
		
		<?php echo $main_calendar; ?>
	</div>
	
</div>



