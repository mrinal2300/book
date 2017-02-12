<!DOCTYPE html>
<html lang="en" ng-app="booking">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Book</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>


 <nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <?php echo anchor('/', 'Calender', array('class'=>'nav-link')); ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bookings</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <?php echo anchor('book/new', 'New booking', array('class'=>'dropdown-item')); ?>
              <?php echo anchor('book/my', 'My booking', array('class'=>'dropdown-item')); ?>
              
            </div>
          </li>
          <li class="nav-item">
            <?php echo anchor('account/report', 'Report', array('class'=>'nav-link')); ?>
          </li>
          <li class="nav-item">
            <?php echo anchor('account/search', 'Search', array('class'=>'nav-link')); ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <?php echo anchor('admin/resource', 'Resources', array('class'=>'dropdown-item')); ?>
              <?php echo anchor('book/my', 'Users', array('class'=>'dropdown-item')); ?>
            </div>
          </li>
        </ul>
         <ul class="navbar-nav my-2 my-lg-0">

         <?php if(!$this->session->userdata('user_id')){ ?>
         <li class="nav-item">
            <?php echo anchor('account/login', 'Login', array('class'=>'nav-link')); ?>
          </li>
         <?php } else { ?>
           <li class="nav-item">
            <?php echo anchor('account/settings', 'Settings', array('class'=>'nav-link')); ?>
          </li>
          <li class="nav-item">
            <?php echo anchor('account/logout', 'Logout', array('class'=>'nav-link')); ?>
          </li>
         <?php } ?>
         </ul>
        
      </div>
    </nav>



<div class="container-fluid">
      
 
