<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Group", ["/assets/css/form_errors.css"]);
echo HtmlFactory::buildNav();
?>
<div class="container">
        <?php
            if(isset($group) && !empty($group))
            {
                echo "
                <div class='components' style='margin-bottom: 5rem;'>
                <form  method='POST'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <table class='table'>
                        <tr>
                            <th>Group name</th>
                            <th>Invite Token</th>
                            <th>Leave Group</th>
                        </tr>
                        <tr>
                            <td>" . $group['name'] . "</td>
                            <td>" . $group['token'] . "</td>
                            <td><input type='submit' value='Leave group' class='btns btn__priamry'></td>
                        </tr>
                    </table>
                </form>
                    ";
            } else {
                echo "<div class='component' style='margin-bottom: 5rem;'>";
            }
        ?>
        <div>
            <a href="group/create">
                <div class="btns btn__primary">
                    Create Group
                </div>
            </a>
            <a href="group/join">
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
<?php echo HtmlFactory::buildFooter(); ?>