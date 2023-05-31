<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader('Rhelper - Register',['assets/css/form_errors.css']);
?>
<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="">
                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0">Sign up</p>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="Enter your login" />
                        <label class="form-label" for="login">Login</label>
                        <div class='error_slot'>
                            <?php if(isset($errors['login'])) echo '<label for="login" class="error_label">'.$errors['login']; ?>
                        </div>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                        <label class="form-label" for="password">Password</label>
                        <div class='error_slot'>
                            <?php 
                                if(isset($errors['password_min'])) echo '<label for="password" class="error_label">'.$errors['password_min'].'</label><br>'; 
                                if(isset($errors['password_num'])) echo '<label for="password" class="error_label">'.$errors['password_num'].'</label><br>'; 
                                if(isset($errors['password_spec'])) echo '<label for="password" class="error_label">'.$errors['password_spec'].'</label><br>'; 
                            ?>
                        </div>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" name="repeat_password" class="form-control form-control-lg" placeholder="repeat password" />
                        <label class="form-label" for="repeat_password">Repeat password</label>
                        <div class='error_slot'>
                            <?php if(isset($errors['password_repeat'])) echo '<label for="repeat_password" class="error_label">'.$errors['password_repeat'].'</label><br>'; ?>
                        </div>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter lastname" />
                        <label class="form-label" for="name">Name</label>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <input type="submit" class="btn btn-primary btn-lg" value="Register"/>
                        <p class="small fw-bold mt-2 pt-1 mb-0">
                            Do you have an account? 
                            <a href="login" class="link-danger">Login instead</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
<?php echo HtmlFactory::buildFooter(); ?>
