<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Event", ["/assets/css/form_errors.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container-main">
    <div class="component">
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
                            <?php if(isset($errors) && !empty($errors)) echo $errors[0] ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="date" name="day" class="form__input" required/>
                        Day
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors[0] ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="start" class="form__input" required/>
                        Start
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors[0] ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="end" class="form__input" required/>
                        End
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors[0] ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <input type="submit" class="btns btn__primary" value="Add"/>
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
    <div class="component-schedule">
        <form action="" method="post">
            <div class="form_title">Events</div>
            <button id="delete" type="submit" name='_method' value='delete' class="btns btn__danger"><i class="bi bi-trash"></i></button>
            <?php echo $table; ?>
        </form>
	</div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
