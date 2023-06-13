<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - LogIn", ["/assets/css/form_errors.css"]);
?>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <a href="/">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </a>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="">
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Sign in</p>
                    </div>

                    <!-- Login input -->
                    <div class="form-outline mb-4">
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="Enter your login" required/>
                        <label class="form-label" for="login">Login</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required/>
                        <label class="form-label" for="password">Password</label>
                        <div class="error_slot">
                            <?php if(isset($error)) echo $error ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" name="checkbox" />
                        <label class="form-check-label" for="checkbox">
                            Remember me
                        </label>
                        </div>
                        <a href="#!" class="text-body">Forgot password?</a>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <input type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Login"/>
                        <p class="small fw-bold mt-2 pt-1 mb-0">
                            Don t have an account? 
                            <a href="register" class="link-danger">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php echo HtmlFactory::buildFooter(); ?>