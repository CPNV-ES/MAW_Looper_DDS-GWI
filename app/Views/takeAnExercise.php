<?php
ob_start();

$headColor = "purple";

require_once "components/head.php";
?>

<div class="list space-y-4 max-w-[112rem] flex flex-col mx-auto my-4">
    <?php for($i = 0; $i < 10; $i++): ?>
        <?php
            $title = $i;
            $exerciseId = $i;
            require "components/exercise.php";
        ?>
    <?php endfor; ?>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";