<?php ob_start(); ?>

<div class="flex flex-col items-center justify-center h-full text-center p-8">
   
        <span class="material-symbols-rounded text-6xl text-accent-red">error</span>
        <h1 class="text-3xl font-bold text-heading">404</h1>
        <p class="text-content-body text-lg">
            Ops! A página que você está procurando não foi encontrada.
        </p>
        <a href="/" class="mt-4 px-6 py-3 bg-accent-brand text-content-inverse font-bold rounded-xl hover:brightness-110 transition-all shadow-[0_0_15px_rgba(196,241,32,0.3)]">
            Voltar para o Início
        </a>
</div>

<?php
$content = ob_get_clean();
require __DIR__.'/template/app.php';
?>
