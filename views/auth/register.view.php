<div class="text-right mb-[85px]">
  <span class="text-content-body text-text-small">Ja tem uma conta?</span>
  <a href="/login" class="text-accent-brand font-bold text-text-small hover:underline ml-1">Entrar</a>
</div>
<div class="flex flex-col gap-[20px] text-center lg:text-left">
  <h2 class="text-heading font-bold text-content-primary">Criar conta</h2>
</div>
<form action="/register" method="POST" class="flex flex-col gap-[20px] w-full">
  <div class="flex flex-col gap-[4px]">
    <label for="name" class="text-label-medium text-content-body font-medium ml-1">Nome</label>
    <input type="text" name="name"
      class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border border-border-primary focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
      placeholder="Digite seu nome">
  </div>
  <div class="flex flex-col gap-[4px]">
    <label for="email" class="text-label-medium text-content-body font-medium ml-1">E-mail</label>
    <input type="email" name="email"
      class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border border-border-primary focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
      placeholder="Digite seu e-mail">
  </div>
  <div class="flex flex-col gap-[20px]" x-data="{
        show: false,
        showConfirm: false,
        senha: '',
        get forca() {
            let s = 0;
            if(this.senha.length > 7) s += 30; // Tamanho
            if(/[A-Z]/.test(this.senha)) s += 20; // Maiúscula
            if(/[0-9]/.test(this.senha)) s += 20; // Número
            if(/[^A-Za-z0-9]/.test(this.senha)) s += 30; // Especial
            return Math.min(100, s);
        },
        get cor() {
            if(this.forca < 50) return 'bg-accent-red';
            if(this.forca < 80) return 'bg-yellow-500';
            return 'bg-accent-brand';
        },
        get label() {
            if(this.forca < 50) return 'Fraca';
            if(this.forca < 80) return 'Média';
            return 'Forte';
        }
     }">
    <div class="flex flex-col gap-[4px]">
      <label for="password" class="text-label-medium text-content-body font-medium ml-1">Senha</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" x-model="senha" name="password"
          class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border border-border-primary focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
          placeholder="Insira sua senha">
        <button type="button" @click="show = !show"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-content-muted hover:text-accent-brand transition-colors">
          <span class="material-symbols-rounded" x-text="show ? 'visibility' : 'visibility_off'"></span>
        </button>
        <div class="flex flex-col gap-1 mt-1" x-show="senha.length > 0" x-transition>
          <div class="w-full h-1 bg-background-tertiary rounded-full overflow-hidden">
            <div class="h-full transition-all duration-300" :class="cor" :style="'width: ' + forca + '%'"></div>
          </div>
          <span class="text-text-xsmall font-bold text-right" x-text="label"
            :class="cor === 'bg-accent-brand' ? 'text-accent-brand' : (cor === 'bg-accent-red' ? 'text-accent-red' : 'text-yellow-500')"></span>
        </div>
      </div>
    </div>
    <div class="flex flex-col gap-[4px]">
      <label for="password" class="text-label-medium text-content-body font-medium ml-1">Confirmar Senha</label>
      <div class="relative">
        <input :type="showConfirm ? 'text' : 'password'" name="confirm-password"
          class="w-full bg-background-secondary text-content-primary rounded-xl p-[12px] border border-border-primary focus:border-accent-brand outline-none transition-all placeholder-content-placeholder"
          placeholder="Confirme sua senha">
        <button type="button" @click="showConfirm = !showConfirm"
          class="absolute right-4 top-1/2 -translate-y-1/2 text-content-muted hover:text-accent-brand transition-colors">
          <span class="material-symbols-rounded" x-text="showConfirm ? 'visibility' : 'visibility_off'"></span>
        </button>
      </div>
    </div>
  </div>
  <button type="submit"
    class="self-end w-auto flex justify-center items-center gap-1 bg-accent-brand text-background-primary font-bold rounded-xl p-3 mt-2 hover:brightness-110 transition-all shadow-[0_0_15px_rgba(196,241,32,0.3)]">Cadastrar</button>

</form>