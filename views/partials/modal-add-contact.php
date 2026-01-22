<dialog id="add_contact_modal" class="modal">
  <div class="modal-box p-[12px] bg-background-primary rounded-2xl max-w-[321px] w-full relative z-10">
    <div class="flex item-center border-b border-border-primary">
      <form method="dialog" class="flex items-center justify-between w-full gap-[4px]">
        <div class="flex-1">
          <h3 class="flex items-center font-bold text-modal-heading text-content-primary ">Adicionar contato</h3>
        </div>
        <button class="flex items-center justify-center text-content-muted hover:text-content-primary p-2 rounded-lg transition-colors">
          <span class="material-symbols-rounded">close</span>
        </button>
      </form>
    </div>
    <div class="flex flex-col px-[16px]">
      <div class="p-[20px] flex flex-col items-center justify-center">
        <div
          class="flex items-center p-[8px] mb-[12px] justify-center w-[64px] h-[64px] rounded-xl bg-background-secondary">
          <span class="material-symbols-rounded text-4xl text-content-muted">account_circle</span>
        </div>
        <button
          class="flex items-center gap-[4px] text-content-primary text-text-small hover:text-content-primary p-[8px] rounded-lg transition-colors border border-border-primary">
          <span class="material-symbols-rounded text-icon">add</span>
          Adicionar foto
        </button>
      </div>
      <div class="flex flex-col gap-[16px]">
        <div class="flex flex-col gap-[4px]">
          <label for="name" class="text-content-primary text-text-small">Nome</label>
          <input type="text" placeholder="Nome"
            class="w-full bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
        </div>
        <div class="flex flex-col gap-[4px]">
          <label for="email" class="text-content-primary text-text-small">E-mail</label>
          <input type="text" placeholder="E-mail"
            class="w-full bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
        </div>
        <div class="flex flex-col gap-[4px]">
          <label for="phone" class="text-content-primary text-text-small">Telefone</label>
          <input type="text" placeholder="Telefone"
            class="w-full mb-[20px] bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
        </div>
      </div>
    </div>
    <div class="border-t border-border-primary"></div>
    <div class="flex justify-end pt-[12px] mr-[12px] gap-[12px]">
      <button
        class="text-content-primary bg-background-tertiary text-text-small hover:text-content-primary p-[12px] rounded-lg transition-colors border border-border-primary">Cancelar</button>
      <button
        class="text-content-inverse bg-accent-brand text-text-small hover:text-content-primary p-[12px] rounded-lg transition-colors border border-border-primary">Salvar</button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop fixed inset-0 z-0 backdrop-blur-sm bg-black/30">
    <button class="cursor-default w-full h-full">close</button>
  </form>
</dialog>