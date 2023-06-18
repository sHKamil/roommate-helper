<?php

use app\Services\HtmlFactory;

echo HtmlFactory::buildHeader("Rhelper - Group", ["/assets/css/form_errors.css"]);
?>
<div class="container">
    <div class="component" style="margin-bottom: 5rem;">
        <div>
            <a href="event/create">
                <div class="btns btn__primary">
                    Create Event
                </div>
            </a>
            <a href="group/create">
                <div class="btns btn__primary">
                    Create Group
                </div>
            </a>
            <a href="group/create">
                <div class="btns btn__primary">
                    Join to group
                </div>
            </a>
            <a href="group/menage">
                <div class="btns btn__primary">
                    My groups
                </div>
            </a>
        </div>
    </div>
</div>
<?php echo HtmlFactory::buildFooter(); ?>