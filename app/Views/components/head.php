<div class="head bg-<?=$headColor?> px-8 w-full">
    <div class="container max-w-[112rem] w-full h-20 mx-auto flex items-center">
        <a href="/"><img src="/img/logo.png" alt="Logo" class="h-20"></a>
        <?php if (isset($headTitle)) : ?>
            <div class="text-white ml-5">
                <?=$headTitle?>
            </div>
        <?php endif; ?>
    </div>
</div>