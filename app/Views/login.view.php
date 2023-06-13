<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - LogIn", ["/assets/css/form_errors.css"]);
?>
<div class="container">
    <div class="components" style="margin-bottom: 5rem;">
            <div>
                <a href="/">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </a>
            </div>
            <div>
                <form class="form" method="POST" action="">

                    <div class="form-outline mb-4">
                        <input type="text" name="login" class="form__input" placeholder="Enter your login" required/>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" name="password" class="form__input" placeholder="Enter password" required/>
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $error ?>
                        </div>
                    </div>

                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <a href="#!" class="text-body">Forgot password?</a>
                    </div> -->

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <input type="submit" class="btns btn__primary" value="Login"/>
                </form>
                <p class="fw-bold mt-2 pt-1 mb-2">
                    Don t have an account? 
                </p>
                <a href="register" style = "text-decoration: none;"><idv class="btns btn__secondary">Register</div></a>
                </div>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
