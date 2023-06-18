<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Group", ["/assets/css/form_errors.css"]);
?>
<div class="container">
    <div class="component" style="margin-bottom: 5rem;">
        <div>
            <form action="" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <table>
                    <tr>
                        <th>Group name</th>
                        <th>Invite Token</th>
                        <th>Leave Group</th>
                    </tr>
                    <?php
                        if(isset($groups) && !empty($groups))
                        {
                            foreach ($groups as $group) {
                                echo "
                                <tr>
                                    <td>" . $group['name'] . "</td>
                                    <td>" . $group['token'] . "</td>
                                    <td><input type='checkbox' name='id' value=" . $group['id'] . " ></td>
                                </tr>
                                    ";
                            }
                        }
                    ?>
                </table>
                <?php if(isset($groups) && !empty($groups)) echo "<input type='submit' name='id' value class='btns btn__priamry'>"; ?>
            </form>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>