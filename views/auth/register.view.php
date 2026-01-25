<?php
$error = Core\Session::getFlash('error');
$errors = Core\Session::getFlash('errors') ?? [];
$old = Core\Session::getFlash('old') ?? [];
?>
<div class="text-right mb-[85px]">
  <span class="text-content-body text-text-small">Ja tem uma conta?</span>
  <a href="/login" class="text-accent-brand font-bold text-text-small hover:underline ml-1">Entrar</a>
</div>
<div class="flex flex-col gap-[20px] text-center lg:text-left">
  <h2 class="text-heading font-bold text-content-primary">Criar conta</h2>
</div>
<?php if ($globalError = Core\Session::getFlash('error')) { ?>
  <div class="text-accent-red font-bold text-center mb-4"><?php echo $globalError; ?></div>
<?php } ?>
<form action="/register" method="POST" class="flex flex-col gap-[20px] w-full">
  <div class="flex flex-col gap-[4px]">
    <label for="name" class="text-label-medium text-content-body font-medium ml-1">Nome</label>
    <input type="text" name="name" value="<?php echo $old['name'] ?? '' ?>"
      class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border <?= isset($errors['name']) ? 'border-accent-red' : 'border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
      placeholder="Digite seu nome">
  </div>
  <?php if (isset($errors['name'])) { ?>
    <div class="flex item-center gap-1 mt-[-16px]">
      <span class="material-symbols-rounded text-text-small text-accent-red">cancel</span>
      <span class="flex items-center text-text-medium text-content-body">
        <?php echo $errors['name']; ?>
      </span>
    </div>
  <?php } ?>
  <div class="flex flex-col gap-[4px]">
    <label for="email" class="text-label-medium text-content-body font-medium ml-1">E-mail</label>
    <input type="email" name="email" value="<?php echo $old['email'] ?? '' ?>"
      class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border <?= isset($errors['email']) ? 'border-accent-red' : 'border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
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
  <div class="flex flex-col gap-[20px]" x-data="{
        show: false,
        showConfirm: false,
        senha: '',
        senhaConfirm: '',
        
        calcularScore(texto) {
            let s = 0;
            if(!texto || texto.length === 0) return 0;
            if(texto.length > 7) s += 30;
            if(/[A-Z]/.test(texto)) s += 20;
            if(/[0-9]/.test(texto)) s += 20;
            if(/[^A-Za-z0-9]/.test(texto)) s += 30;
            return Math.min(100, s);
        },
        
        getCor(score) {
            if(score < 50) return 'bg-accent-red';
            if(score < 80) return 'bg-yellow-500';
            return 'bg-accent-brand';
        },
        
        getLabel(score) {
            if(score < 50) return 'Fraca';
            if(score < 80) return 'Média';
            return 'Forte';
        }
     }">
    <div class="flex flex-col gap-[4px]">
      <label for="password" class="text-label-medium text-content-body font-medium ml-1">Senha</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" x-model="senha" name="password"
          class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border <?= isset($errors['password']) ? 'border-accent-red' : 'border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
          placeholder="Insira sua senha">

        <button type="button" @click="show = !show"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-content-muted hover:text-accent-brand transition-colors">
          <span class="material-symbols-rounded" x-text="show ? 'visibility' : 'visibility_off'"></span>
        </button>
      </div>
      <div class="flex flex-col gap-1 mt-1" x-show="senha.length > 0" x-transition>
        <div class="w-full h-1 bg-background-tertiary rounded-full overflow-hidden">
          <div class="h-full transition-all duration-300" :class="getCor(calcularScore(senha))" :style="'width: ' + calcularScore(senha) + '%'"></div>
        </div>
        <span class="text-text-xsmall font-bold text-right" x-text="getLabel(calcularScore(senha))"
          :class="getCor(calcularScore(senha)) === 'bg-accent-brand' ? 'text-accent-brand' : (getCor(calcularScore(senha)) === 'bg-accent-red' ? 'text-accent-red' : 'text-yellow-500')"></span>
      </div>
      <?php if (isset($errors['password'])) { ?>
        <div class="flex item-center gap-1 mt-1">
          <span class="material-symbols-rounded text-text-small text-accent-red">cancel</span>
          <span class="flex items-center text-text-medium text-content-body">
            <?php echo $errors['password']; ?>
          </span>
        </div>
      <?php } ?>
    </div>
    <div class="flex flex-col gap-[4px]">
      <label for="password" class="text-label-medium text-content-body font-medium ml-1">Confirmar Senha</label>
      <div class="relative">
        <input :type="showConfirm ? 'text' : 'password'" x-model="senhaConfirm" name="confirm-password"
          class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border <?= isset($errors['confirm-password']) ? 'border-accent-red' : 'border-border-primary' ?> focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
          placeholder="Confirme sua senha">

        <button type="button" @click="showConfirm = !showConfirm"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-content-muted hover:text-accent-brand transition-colors">
          <span class="material-symbols-rounded" x-text="showConfirm ? 'visibility' : 'visibility_off'"></span>
        </button>

      </div>
      <div class="flex flex-col gap-1 mt-1" x-show="senhaConfirm.length > 0" x-transition>
        <div class="w-full h-1 bg-background-tertiary rounded-full overflow-hidden">
          <div class="h-full transition-all duration-300" :class="getCor(calcularScore(senhaConfirm))" :style="'width: ' + calcularScore(senhaConfirm) + '%'"></div>
        </div>
        <span class="text-text-xsmall font-bold text-right" x-text="getLabel(calcularScore(senhaConfirm))"
          :class="getCor(calcularScore(senhaConfirm)) === 'bg-accent-brand' ? 'text-accent-brand' : (getCor(calcularScore(senhaConfirm)) === 'bg-accent-red' ? 'text-accent-red' : 'text-yellow-500')"></span>
      </div>
    </div>
    <?php if (isset($errors['confirm-password'])) { ?>
      <div class="flex item-center gap-1 mt-[-16px] mb-[-32px]">
        <span class="material-symbols-rounded text-text-small text-accent-red">cancel</span>
        <span class="flex items-center text-text-medium text-content-body">
          <?php echo $errors['confirm-password']; ?>
        </span>
      </div>
    <?php } ?>
  </div>
  <button type="submit"
    class="self-end w-auto flex justify-center items-center gap-1 bg-accent-brand text-background-primary font-bold rounded-xl p-3 mt-2 hover:brightness-110 transition-all shadow-[0_0_15px_rgba(196,241,32,0.3)]">Cadastrar</button>

</form>