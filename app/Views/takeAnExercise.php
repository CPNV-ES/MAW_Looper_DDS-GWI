<?php
ob_start();

$headColor = "purple";

require_once "components/head.php";
?>

<div class="list space-y-4 max-w-[112rem] flex flex-col mx-auto my-4">
    <?php foreach ($exercises as $exercise) : ?>
        <?php
        if ($exercise->statusId > 1) {
            $title = $exercise->name;
            $exerciseId = $exercise->id;
            require "components/exercise.php";
        }
        ?>
    <?php endforeach; ?>
</div>

<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";