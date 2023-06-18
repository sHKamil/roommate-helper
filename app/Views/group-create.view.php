<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Group", ["/assets/css/form_errors.css"]);
?>
<div class="container">
    <div class="component" style="margin-bottom: 5rem;">
            <div>
                <form class="form" method="POST" action="">

                    <div class="form-outline mb-4">
                        <input type="hidden" name="_method" value="create">
                        <input type="text" name="name" class="form__input" placeholder="Group name" required/>
                        Name
                    </div>

                    <div class="form-outline mb-4">
                        <input type="text" name="token" class="form__input" placeholder="Invite token" required/>
                        Token
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <input type="submit" class="btns btn__primary" value="Create group"/>
                    </div>

                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <a href="../group" style = "text-decoration: none;">
                            <div class="btns btn__secondary">
                                Group
                            </div>
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
