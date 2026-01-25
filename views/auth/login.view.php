
<?php
$errors = Core\Session::getFlash('errors') ?? [];
$success = Core\Session::getFlash('success');
$old = Core\Session::getFlash('old') ?? [];
?>
<div class="text-right mb-[190px]">
  <span class="text-content-body text-text-small">Não tem uma conta?</span>
  <a href="/register" class="text-accent-brand font-bold text-text-small hover:underline ml-1">Registre-se</a>
</div>
<div class="flex flex-col gap-[20px] text-center lg:text-left">
  <h2 class="text-heading font-bold text-content-primary">Acessar conta</h2>
</div>
<?php if ($success) { ?>
  <div class="text-center text-accent-brand font-bold text-text-small mb-[20px]"><?= $success ?></div>
<?php } ?>
<form action="/login" method="POST" class="flex flex-col gap-[20px] w-full">
  <div class="flex flex-col gap-[4px]">
    <label for="email" class="text-label-medium text-content-body font-medium ml-1">E-mail</label>
    <input type="email" name="email" value="<?= $old['email'] ?? '' ?>"
      class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border<?= isset($errors['email']) ? ' border-accent-red' : ' border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
      placeholder="Digite seu e-mail">
   
    </div>
     <?php if (isset($errors['email'])) { ?>
      <div class="flex item-center gap-1 mt-[-16px]">
        <span class="material-symbols-rounded text-text-small text-accent-red">cancel</span>
        <span class="flex items-center text-text-medium text-content-body">
          <?php echo $errors['email']; ?>
        </span>
      </div>
    <?php } ?>
    <div class="flex flex-col gap-[4px]" x-data="{show:false}">
      <label for="password" class="text-label-medium text-content-body font-medium ml-1">Senha</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password"
          class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border<?= isset($errors['password']) ? ' border-accent-red' : ' border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
          placeholder="Insira sua senha">
        
        <button type="button" @click="show = !show"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-content-muted hover:text-accent-brand transition-colors">
          <span class="material-symbols-rounded" x-text="show ? 'visibility' : 'visibility_off'"></span>
        </button>
      </div>
      <?php if (isset($errors['password'])) { ?>
          <div class="flex item-center gap-1 mt-[-16px]">
            <span class="material-symbols-rounded text-text-small text-accent-red">cancel</span>
            <span class="flex items-center text-text-medium text-content-body">
              <?php echo $errors['password']; ?>
            </span>
          </div>
        <?php } ?>
    </div>
    <button type="submit"
      class="self-end w-auto flex justify-center items-center gap-1 bg-accent-brand text-background-primary font-bold rounded-xl p-3 mt-2 hover:brightness-110 transition-all shadow-[0_0_15px_rgba(196,241,32,0.3)]">Entrar</button>

</form>