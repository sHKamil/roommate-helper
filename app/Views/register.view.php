<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader('Rhelper - Register',['assets/css/form_errors.css']);
?>
<div class="container">
    <div class="components" style="margin-bottom: 5rem;">
        <div>
            <a href="/">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
            </a>
        </div>
        <form method="POST" action="">
            <div class="form-outline mb-4">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="text" name="login" class="form__input" placeholder="Enter your login" required/>
                <div class='error_slot'>
                    <?php if(isset($errors['login_duplicate'])) echo '<label for="login" class="error_label">'.$errors['login_duplicate']; ?>
                </div>
            </div>
            <div class="form-outline mb-3">
                <input type="password" name="password" class="form__input" placeholder="Enter password" required/>
                <div class='error_slot'>
                    <?php 
                        if(isset($errors['password_min'])) echo '<label for="password" class="error_label">'.$errors['password_min'].'</label><br>'; 
                        if(isset($errors['password_num'])) echo '<label for="password" class="error_label">'.$errors['password_num'].'</label><br>'; 
                        if(isset($errors['password_spec'])) echo '<label for="password" class="error_label">'.$errors['password_spec'].'</label><br>'; 
                    ?>
                </div>
            </div>
            <div class="form-outline mb-3">
                <input type="password" name="repeat_password" class="form__input" placeholder="Repeat password" required/>
                <div class='error_slot'>
                    <?php if(isset($errors['password_repeat'])) echo '<label for="repeat_password" class="error_label">'.$errors['password_repeat'].'</label><br>'; ?>
                </div>
            </div>
            <div class="form-outline mb-3">
                <input type="text" name="name" class="form__input" placeholder="Enter name" required/>
            </div>
            <div class="form-outline mb-3">
                <input type="submit" class="btns btn__primary" value="Register"/>
            </div>
            <div class="form-outline mb-3">
                <p class="fw-bold mt-2 pt-1 mb-2">
                    Do you have an account? 
                </p>
                <a href="login" style = "text-decoration: none;">
                    <div class="btns btn__secondary">Login instead</div>
                </a>
            </div>
        </form>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
