<dialog id="password_contact_modal" class="modal">
  <div class="modal-box p-[12px] bg-background-primary rounded-2xl max-w-[321px] w-full relative z-10">
    <div class="flex item-center border-b border-border-primary">
      <form method="dialog" class="flex items-center justify-between w-full gap-[4px]">
        <div class="flex-1">
          <h3 class="flex items-center font-bold text-modal-heading text-content-primary ">Visualizar informações</h3>
        </div>
        <button
          class="flex items-center justify-center text-content-muted hover:text-content-primary p-2 rounded-lg transition-colors">
          <span class="material-symbols-rounded">close</span>
        </button>
      </form>
    </div>
    <div class="flex flex-col p-[20px]">
      <form id="decrypt_form" method="post" action="/decrypt">
        <input type="hidden" name="contact_id" id="decrypt_contact_id" value="">
        <div class="flex flex-col gap-[16px]">
          <div class="flex flex-col gap-[4px]" x-data="{showPassword: false}">
            <label for="name" class="text-content-primary text-text-small">Senha</label>
            <div class="relative">
              <input name="password" :type="showPassword ? 'text' : 'password'" placeholder="Digite sua senha"
                class="w-full bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
              <button type="button" @click="showPassword = !showPassword"
                class="absolute right-1 top-1/2 -translate-y-1/2 text-content-muted hover:text-content-primary p-2 rounded-lg transition-colors">
                <span class="material-symbols-rounded" x-text="showPassword ? 'visibility' : 'visibility_off'"></span>
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
        </div>
      </form>
    </div>
    <div class="border-t border-border-primary"></div>
    <div class="flex justify-end pt-[12px] mr-[12px] gap-[12px]">
      <button onclick="document.getElementById('password_contact_modal').close()"
        class="text-content-primary bg-background-tertiary text-text-small hover:text-content-primary p-[12px] rounded-lg transition-colors border border-border-primary">Cancelar</button>
      <button type="submit" form="decrypt_form"
        class="text-content-inverse bg-accent-brand text-text-small hover:text-content-primary p-[12px] rounded-lg transition-colors border border-border-primary">Visualizar</button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop fixed inset-0 z-0 backdrop-blur-sm bg-black/30">
    <button class="cursor-default w-full h-full">close</button>
  </form>
</dialog>