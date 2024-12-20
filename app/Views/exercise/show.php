<?php
ob_start();

$headColor = "purple";

require_once __DIR__ . "/../components/head.php";
?>

<div class="list space-y-4 max-w-[112rem] flex flex-col mx-auto my-4">
    <?php if (empty($exercises)) : ?>
    <h1 class="text-center text-4xl mt-10">No exercises found.</h1>
    <?php endif; ?>

    <?php foreach ($exercises as $exercise) : ?>
        <?php
        if ($exercise->status->id > 1) {
            $title = $exercise->name;
            $exerciseId = $exercise->id;
            require __DIR__ . "/../components/exercise.php";
        }
        ?>
    <?php endforeach; ?>
</div>

<?php
$pageContent = ob_get_clean();
require_once __DIR__ . "/../gabarit.php";