<?php echo validation_errors(); ?>


<?php echo form_open('account/do_login'); ?>

 <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
  </div>


   <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="password" class="form-control" name="password" >
  </div>

  <input type="submit" value="Login"  class="btn btn-primary">
</form>