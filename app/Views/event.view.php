<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Event", ["/assets/css/form_errors.css"]);
?>
<div class="nav-component">
	<div class="logo">
		<img src="/assets/images/logo_helper6.png" alt="Logo" width="100px">
	</div>
	<div class="nav-buttons">
		<form method="POST" action="">
			<div>
				<input type="hidden" name="_method" value="LOGOUT">
				<button class="btns btn__danger" type="submit">Wyloguj</button>
			</div>
		</form>
		<a class="abtn" href="event/create">
			<div class="btns btn__primary">
				Create Event
			</div>
		</a>
		<a class="abtn" href="group">
			<div class="btns btn__primary">
				My group
			</div>
		</a>
		<a class="abtn" href="supply">
			<div class="btns btn__primary">
				Supply
			</div>
		</a>
	</div>
	<div class="profile">
		<div class="username">
			<div class="username-spacer">
			</div>
			<p>Username</p>
		</div>
		<div class="avatar">
			<img src="/assets/images/avatar.png" alt="Avatar" width="100px">
		</div>
	</div>
</div>

<div class="container-main">
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
                        <input type="date" name="day" class="form__input" required/>
                        Day
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="start" class="form__input" required/>
                        Start
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
                        </div>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="time" name="end" class="form__input" required/>
                        End
                        <div class="error_slot">
                            <?php if(isset($errors) && !empty($errors)) echo $errors ?>
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
            <input type="submit" class="btns btn__danger" value="DELETE">
            <input type="hidden" name="_method" value="delete">
            <?php echo $table; ?>
        </form>
	</div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>
