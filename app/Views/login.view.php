<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - LogIn", ["/assets/css/form_errors.css"]);
?>
<div class="container-raw">
    <div class="components" style="margin-bottom: 5rem;">
            <div class="d-flex justify-content-center">
                <a href="/">
                    <img src="assets/images/sygnet.png" class="img-fluid" alt="Logo" style="width:23rem;">
                </a>
            </div>
            <div>
                <form class="form" method="POST" action="">

                    <div class="form-outline mb-4">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                        <input type="text" name="login" class="form__input" placeholder="Enter your login" required/>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" name="password" class="form__input" placeholder="Enter password" required/>
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="submit" class="btns btn__primary" value="Login"/>
                    </div>

                    <div class="form-outline mb-3">
                        <p class="fw-bold mt-2 pt-1 mb-2">
                        Don t have an account? 
                        </p>
                        <a href="register" style = "text-decoration: none;">
                            <div class="btns btn__secondary">
                                Register instead
                            </div>
                        </a>
                    </div>

                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <a href="#!" class="text-body">Forgot password?</a>
                    </div> -->
            </form>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
