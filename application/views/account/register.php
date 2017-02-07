<?php echo validation_errors(); ?>


<?php echo form_open('account/register'); ?>


 <div class="form-group">
    <label for="username">Full name</label>
    <input type="text" class="form-control" name="name">
  </div>

 <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

   <div class="form-group">
    <label for="username">Email address</label>
    <input type="text" class="form-control" name="email">
  </div>


   <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control" name="password" >
  </div>

  <input type="submit" value="Register"  class="btn btn-primary">
</form>

<?php echo anchor('account/login', 'Login'); ?>