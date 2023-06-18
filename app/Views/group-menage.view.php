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
                        if(isset($group) && !empty($group))
                        {
                            echo "
                            <tr>
                                <td>" . $group['name'] . "</td>
                                <td>" . $group['token'] . "</td>
                                <td><input type='submit' value class='btns btn__priamry'></td>
                            </tr>
                                ";
                        }
                    ?>
                </table>
            </form>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>