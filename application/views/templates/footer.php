
</div>
    

<!-- javascripts -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
=======
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="<?php echo base_url('assets/js/tether.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<?php if(isset($js)) { ?>
<?php foreach ($js as $js_foot_file) { ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/'.trim($js_foot_file).'.js'); ?>"></script>
<?php } ?>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/app.js'); ?>"></script>
<!-- // javascripts -->
</body>
</html>