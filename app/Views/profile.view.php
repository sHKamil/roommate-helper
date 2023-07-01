<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Schedule", ["/assets/css/schedule.css", "/assets/css/profile.css"]);
echo HtmlFactory::buildNav();
?>

<div class="container-main">
	<div id="component-profile" class="component-form">
        <div class="component-left">
            <div class="avatar">
                <img src="<?php echo $avatar_path ?>" alt="Avatar">
            </div>
            <form class="user-info" method="POST" enctype="multipart/form-data">
                <div class="login">
                    <input type="hidden" name="_method" value="edit">
                    <input type="hidden" name="user_id" value=<?php echo $_SESSION['user_id'] ?>>
                    <div class="form__input" style="display: flex; align-items: center;"><?php echo $_SESSION['user_login'] ?></div>
                </div>
                <div class="user-name">
                    <input class="form__input" type="text" name="user_name" placeholder="Name" value="<?php echo $_SESSION['user_name'] ?>" required>
                </div>
                <div class="user-lastname">
                    <input class="form__input" type="text" name="user_lastname" placeholder="Last name" value="<?php echo $_SESSION['user_lastname'] ?>" required>
                </div>
                <div class="user-email">
                    <input class="form__input" type="text" name="user_email" placeholder="E-mail" value="<?php echo $_SESSION['user_email'] ?>" required>
                </div>
                <div class="user-email">
                    <input class="btn__secondary" type="file" name="file" id="upload-img">
                </div>
                <div class="user-submit">
                    <input class="btns btn__primary" type="submit" value="Save">
                </div>
            </form>
        </div>
	</div>
	<div class="component-group">
        <div class="form_title">Group panel</div>
        <?php
            if(isset($group) && !empty($group))
            {
                echo "
                <form  method='POST'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <div class='group'>
                        <table class='table-group'>
                            <tr>
                                <th>Group name:</th>
                                <td>" . $group['name'] . "</td>                            
                            </tr>
                            <tr>
                                <th>Invite Token:</th>
                                <td>" . $group['token'] . "</td>                            
                            </tr>
                        </table>
                    </div>
                    <div class='leave-btn'> <input type='submit' value='Leave group' class='btns btn__primary'> </div>
                </form>
                    ";
            } else {
                echo "";
            }
        ?>
        <div class="profile-buttons">
            <div class="group-info">
                <p>Don't you have a group?</p>
                <p>Join an existing one or start your own!</p>
            </div>
            <a href="group-create">
                <div class="btns btn__primary">
                    Create Group
                </div>
            </a>
            <a href="group-join">
                <div class="btns btn__primary">
                    Join to group
                </div>
            </a>
            <a href="schedule">
                <div class="btns btn__secondary">
                    Schedule
                </div>
            </a>
        </div>
	</div>
</div>

<?php echo HtmlFactory::buildFooter(['/assets/js/schedule.js','/bootstrap/js/bootstrap.min.js', '/assets/js/clock.js']); ?>
