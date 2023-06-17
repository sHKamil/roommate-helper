<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Event", ["/assets/css/form_errors.css"]);
?>
<div class="container">
    <div class="component" style="margin-bottom: 5rem;">
            <div>
                <form class="form" method="POST" action="">

                    <div class="form-outline mb-4">
                        <input type="hidden" name="_method" value="create">
                        <input type="text" name="name" class="form__input" placeholder="Event name" required/>
                        Name
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" name="content" class="form__input" placeholder="Enter content" required/>
                        Content
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="date" name="date" class="form__input" required/>
                        Day
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="hour" class="form__input" required/>
                        Hour
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="duration" class="form__input" required/>
                        Duration
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <input type="submit" class="btns btn__primary" value="Dodaj"/>
                    </div>

                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <a href="../schedule" style = "text-decoration: none;">
                            <div class="btns btn__secondary">
                                Schedule
                            </div>
                        </a>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
