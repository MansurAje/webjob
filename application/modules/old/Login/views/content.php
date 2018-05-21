    <title>Signin SKDU Online</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">

<style type="text/css">
  .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
                <center>
                   <?php if($this->session->flashdata('login_error') OR form_error('username_username') == TRUE OR form_error('password') == TRUE) { ?>
                      <div class="alert alert-danger">*Username atau password salah !!</div>
                  <?php } ?>
                </center>
            <hr>
                <h1 class="text-center login-title">Sign in to continue</h1>
            <hr>
            <div class="account-wall">
                <img class="profile-img" src="<?php echo base_url();?>assets/images/photoLogin.png?sz=120"
                    alt="">
                <form class="form-signin" method="post" action="<?php echo site_url('Login/proses');?>">
                <input type="text" name="username_vUsername" class="form-control" placeholder="NIP" autofocus>
                <input type="password" name="passwords" class="form-control" placeholder="Password">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <!-- <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label> -->
                <!-- <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span> -->
                </form>
            </div>
            <!-- <a href="#" class="text-center new-account">Create an account </a> -->
        </div>
    </div>
</div>