<?php include __DIR__.'/partials/modal-add-contact.php'; ?>
<?php include __DIR__.'/partials/modal-edit-contact.php'; ?>
<?php include __DIR__.'/partials/modal-password-contact.php'; ?>
<div class="flex flex-col h-full">
  <div class="flex justify-between items-center mb-6">
    <div class="flex-1 flex items-center justify-between gap-2">
      <h2 class="text-heading font-bold text-content-primary">Lista de contatos</h2>
      <input type="text" placeholder="Pesquisar"
        class="w-1/2 mr-3 bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
    </div>
    <div class="flex gap-3">
      <button onclick="document.getElementById('add_contact_modal').showModal()"
        class="flex items-center gap-[4px] p-[12px] bg-background-tertiary text-content-primary font-bold rounded-lg text-sm hover:brightness-110 transition-all">
        <span class="material-symbols-rounded text-lg">add</span>
        Adicionar contato
      </button>
      <button onclick="document.getElementById('password_contact_modal').showModal()" class="p-[12px] border border-primary rounded-xl">
        <span class="material-symbols-rounded text-lg text-content-primary">lock</span>
      </button>
    </div>
  </div>

  <div class="flex flex-1 gap-4 overflow-hidden mt-[32px]">
    <div
      class="flex flex-col items-center gap-3 p-5 rounded-[20px] bg-accent-brand overflow-y-auto hide-scrollbar h-fit max-h-full">
      <a href="/" class="text-background-primary font-bold text-label-small hover:scale-125 transition-transform <?= $letraSelecionada === '#' ? 'scale-150' : '' ?>">#</a>
      <?php foreach (range('A', 'Z') as $letra) { ?>
        <a href="/?letra=<?= $letra ?>"
          class="text-background-primary opacity-60 font-bold text-label-small hover:opacity-100 hover:scale-125 transition-all <?= $letraSelecionada === $letra ? '!opacity-100 scale-150' : '' ?>">
          <?= $letra ?>
        </a>
      <?php } ?>
    </div>
    <div class="flex-1 overflow-y-auto pr-2 ml-[48px] mt-[-15px]">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr>
            <th class="py-3 pl-4 uppercase mb-[29px]"><?= $letraSelecionada === '#' ? '' : $letraSelecionada ?></th>
          </tr>
          <tr class="text-content-primary opacity-40 text-label-small border-b border-border-primary">
            <th class="py-3 pl-4 uppercase">Nome</th>
            <th class="py-3 uppercase">E-mail</th>
            <th class="py-3 uppercase">Telefone</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-border-primary/50">
          <tr class="group hover:bg-background-tertiary transition-colors">
            <td class="py-4 pl-4 flex items-center gap-3">
              <div
                class="w-[44px] h-[44px] rounded-lg bg-accent-brand/20 flex items-center justify-center text-accent-brand font-bold text-xs">
                R</div>
              <span class="text-content-body font-text-medium">Rafael Zendron</span>
            </td>
            <td class="py-4 text-content-body text-text-medium">rafael@exemplo.com</td>
            <td class="py-4 text-content-body text-text-medium">(47) 99999-9999</td>
            <td class="py-4 pr-4 text-right flex items-center justify-between">
              <div class="flex items-center gap-2 justify-end w-full">
                <button
                  onclick="document.getElementById('edit_contact_modal').showModal()"
                  class="flex items-center gap-[4px] text-content-primary p-[8px] border border-border-primary rounded-lg text-label-medium hover:text-accent-brand transition-colors"><span
                    class="material-symbols-rounded text-icon">edit</span>Editar</button>
                <button
                  onclick="document.getElementById('password_contact_modal').showModal()"
                  class="flex items-center gap-[4px] text-content-primary p-[8px] border border-border-primary rounded-lg hover:text-accent-brand transition-colors"><span
                    class="material-symbols-rounded text-icon">lock</span></button>
                <button
                  class="flex items-center gap-[4px] text-content-primary p-[8px] border border-border-primary rounded-lg hover:text-accent-red transition-colors ml-2"><span
                    class="material-symbols-rounded text-icon">delete</span></button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- <div class="flex flex-col items-center justify-center h-full gap-8 animate-fade-in-up">
  <div class="relative flex items-center justify-center w-[200px] h-[200px] rounded-full bg-background-tertiary/30">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
      class="w-[100px] h-[100px] text-content-muted opacity-50">
      <path
        d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47v-14.25a.75.75 0 00-1-.707 9.735 9.735 0 00-3.25-.555 9.707 9.707 0 00-5.25 1.533v16.103z" />
    </svg>
  </div>

  <div class="text-center flex flex-col gap-2">
    <p class="text-text-medium text-content-body">Nenhum contato foi encontrado</p>
    <p class="text-text-small text-content-muted">Comece adicionando novos contatos à sua lista.</p>
  </div>

  <button onclick="document.getElementById('add_contact_modal').showModal()"
    class="flex items-center gap-2 px-6 py-3 bg-accent-brand text-background-primary font-bold rounded-xl hover:brightness-110 transition-all shadow-[0_0_20px_rgba(196,241,32,0.3)]">
    <span class="material-symbols-rounded">add</span>
    Adicionar novo contato
  </button>
</div> -->