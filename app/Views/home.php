<?php
ob_start();
?>
<div class="banner p-8 bg-purple mb-8">
    <img src="img/logo.png" alt="LOGO" class="mb-10 block mx-auto">
    <h1 class="text-white text-7xl leading-tight tracking-[1.1rem] text-center">Exercise<br>Looper</h1>
</div>
<div class="buttons flex justify-center space-x-10 flex-wrap">
    <div><a href="/exercises/answering" class="button bg-purple">TAKE AN EXERCISE</a></div>
    <div><a href="/exercises/new" class="button bg-orange">CREATE AN EXERCISE</a></div>
    <div><a href="/exercises" class="button bg-green">MANAGE AN EXERCISE</a></div>
</div>
<?php
$pageContent = ob_get_clean();
require_once "gabarit.php";