<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/docs.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/bootstrap-social.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
<body class="form_reg_login">
    <div class="container " >
        <form class="form-signin" method="POST" action="<?=base_url('auth/sign_in')?>">
            <h2 class="form-signin-heading">Please sign in</h2>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            <div class="row form_buttons">
                <div class="col-md-6 ">
                     <input class="btn btn-lg btn-warning btn-block" name="submit" type="submit" value="Sign in">
                </div>
                <div class="col-md-6">
                    <a class="btn btn-lg btn-success btn-block" type="submit" href="<?=base_url('auth/register')?>">Register</a>
                </div>
                <div class="col-md-6 social_div">
                     <a class="facebook_connect btn btn-social-icon btn-facebook " type="submit" href=""><i class="fa fa-facebook"></i></a>
                     <a class="twitter_connect btn btn-social-icon btn-twitter " type="submit" href=""><i class="fa fa-twitter"></i></a>
                     <a class="linkedin_connect btn btn-social-icon btn-linkedin " type="submit" href=""><i class="fa fa-linkedin"></i></a>
                </div>
            </div>

        </form>
    </div> 
</body>

