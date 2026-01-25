<?php $errors = flash('errors') ?>
<?php include __DIR__.'/partials/modal-add-contact.php'; ?>
<?php include __DIR__.'/partials/modal-edit-contact.php'; ?>
<?php include __DIR__.'/partials/modal-password-contact.php'; ?>
<div class="flex flex-col h-full">
  <div class="flex justify-between items-center mb-6">
    <div class="flex-1 flex items-center justify-between gap-2">
      <h2 class="text-heading font-bold text-content-primary">Lista de contatos</h2>
      <form action="/" method="get" class="w-1/2 mr-3">
        <input type="text" name="search" placeholder="Pesquisar" value="<?= $_GET['search'] ?? '' ?>"
          class="w-full bg-background-secondary placeholder:text-content-placeholder p-[12px] border border-primary rounded-lg focus:border-accent-brand outline-none transition-all">
      </form>
    </div>
    <div class="flex gap-3">
      <button onclick="openAddContactModal()"
        class="flex items-center gap-[4px] p-[12px] bg-background-tertiary text-content-primary font-bold rounded-lg text-sm hover:brightness-110 transition-all">
        <span class="material-symbols-rounded text-lg">add</span>
        Adicionar contato
      </button>
      <?php if ($unlocked) { ?>
        <button onclick="lockData()"
          class="flex items-center gap-[4px] p-[12px] bg-background-tertiary text-content-primary font-bold rounded-lg text-sm hover:brightness-110 transition-all">
          <span class="material-symbols-rounded text-lg">lock</span>
        </button>
      <?php } else { ?>
        <button onclick="openPasswordContactModal()"
          class="flex items-center gap-[4px] p-[12px] bg-background-tertiary text-content-primary font-bold rounded-lg text-sm hover:brightness-110 transition-all">
          <span class="material-symbols-rounded text-lg">lock_open</span>
        </button>
      <?php } ?>
    </div>
  </div>

  <div class="flex flex-1 gap-4 overflow-hidden mt-[32px]">
    <div
      class="flex flex-col items-center gap-3 p-5 rounded-[20px] bg-accent-brand overflow-y-auto hide-scrollbar h-fit max-h-full">
      <a href="/"
        class="text-background-primary font-bold text-label-small hover:scale-125 transition-transform <?= $letraSelecionada === '#' ? 'scale-150' : '' ?>">#</a>
      <?php foreach (range('A', 'Z') as $letra) { ?>
        <a href="/?letra=<?= $letra ?>"
          class="text-background-primary opacity-60 font-bold text-label-small hover:opacity-100 hover:scale-125 transition-all <?= $letraSelecionada === $letra ? '!opacity-100 scale-150' : '' ?>">
          <?= $letra ?>
        </a>
      <?php } ?>
    </div>
    <div class="flex-1 overflow-y-auto pr-2 ml-[48px] mt-[-15px]">
      <?php if (empty($contacts)) { ?>
        <div class="flex flex-col items-center justify-center h-full text-content-muted">
          <span class="material-symbols-rounded">person_search</span>
          <p>Nenhum contato encontrado</p>
        </div>
      <?php } else { ?>
        <?php
        $hasContacts = false;
          foreach ($contacts as $initial => $list) {
              if ($letraSelecionada !== '#' && $initial !== $letraSelecionada) {
                  continue;
              }
              $hasContacts = true;
              ?>
          <div class="mb-4">
            <h3 class="py-3 pl-4 text-accent-brand font-bold text-xl border-b border-border-primary mb-2">
              <?= $initial ?>
            </h3>
            <table class="w-full text-left border-collapse">
              <tbody class="divide-y divide-border-primary/50">
                <thead>
                  <tr>
                    <th class="py-4 pl-4 text-content-body/40 text-text-medium uppercase flex items-center gap-3 w-[40%]">Nome</th>
                    <th class="py-4 text-content-body/40 text-text-medium uppercase w-[30%] select-none tracking-widest">Email</th>
                    <th class="py-4 text-content-body/40 text-text-medium uppercase w-[20%] select-none tracking-widest">Telefone</th>
                    <th class="py-4 pr-4 text-right"></th>
                  </tr>
                </thead>
                <?php foreach ($list as $contact) { ?>
                  <tr class="group hover:bg-background-tertiary transition-colors">
                    <td class="py-4 pl-4 flex items-center gap-3 w-[40%]">
                      <div
                        class="w-[44px] h-[44px] rounded-lg bg-border-primary flex items-center justify-center overflow-hidden">
                        <?php if ($contact['image_path'] && $contact['image_path'] !== 'default.png') { ?>
                          <img src="/<?= $contact['image_path'] ?>" alt="<?= $contact['name'] ?>">
                        <?php } else { ?>
                          <span class="text-content-muted font-bold"><?= $initial ?></span>
                        <?php } ?>
                      </div>
                      <span class="text-content-body font-text-medium"><?= $contact['name'] ?></span>
                    </td>
                    <td class="py-4 text-content-body text-text-medium w-[30%] select-none tracking-widest">
                      <?php if ($unlocked ?? false) { ?>
                        <?= $contact['email'] ?>
                      <?php } else { ?>
                        ••••••••••••
                      <?php } ?>
                    </td>
                    <td class="py-4 text-content-body text-text-medium w-[20%] select-none tracking-widest">
                      <?php if ($unlocked ?? false) { ?>
                        <?= $contact['phone'] ?>
                      <?php } else { ?>
                        ••••••••••••
                      <?php } ?>
                    </td>
                    <td class="py-4 pr-4 text-right">
                      <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button onclick='openModal(<?= json_encode($contact) ?>)'
                          class="p-2 hover:bg-accent-brand/20 rounded-lg text-content-primary hover:text-accent-brand transition-colors">
                          <span class="material-symbols-rounded text-icon">edit</span>
                        </button>
                        <button onclick="deleteContact(<?= $contact['id'] ?>)"
                          class="p-2 hover:bg-accent-brand/20 rounded-lg text-content-primary hover:text-accent-brand transition-colors">
                          <span class="material-symbols-rounded text-icon">delete</span>
                        </button>
                        <?php if ($unlocked ?? false) { ?>
                        <button onclick="lockData()"
                          class="p-2 hover:bg-accent-brand/20 rounded-lg text-content-primary hover:text-accent-brand transition-colors">
                          <span class="material-symbols-rounded text-icon">lock</span>
                        </button>
                        <?php } else { ?>
                        <button onclick="document.getElementById('password_contact_modal').showModal()"
                          class="p-2 hover:bg-accent-brand/20 rounded-lg text-content-primary hover:text-accent-brand transition-colors">
                          <span class="material-symbols-rounded text-icon">lock_open</span>
                        </button>
                        <?php } ?>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
        <?php if (! $hasContacts) { ?>
          <div class="p-10 text-center text-content-muted">
            Nenhum contato encontrado com a letra
            <strong><?= $letraSelecionada ?></strong>
          </div>
        <?php } ?>
      <?php } ?>

    </div>
  </div>
</div>

<script>
  function openAddContactModal() {
    document.getElementById('add_contact_modal').showModal();
  }
  function openModal(contact) {
    document.getElementById('edit_contact_modal').showModal();
    document.getElementById('edit_id').value = contact.id;
    document.getElementById('edit_name').value = contact.name;
    document.getElementById('edit_email').value = contact.email;
    document.getElementById('edit_phone').value = contact.phone;
    
    const preview = document.getElementById('edit_preview');
    const icon = document.getElementById('edit_icon');
    if (preview && icon) {
      preview.classList.add('hidden');
      icon.classList.remove('hidden');
    }
    if (contact.image_path && contact.image_path !== 'default.png') {
      if (preview && icon) {
        icon.classList.add('hidden');
        preview.classList.remove('hidden');
        preview.src = '/' + contact.image_path;
      }
    }
    const delInput = document.getElementById('delete_id_input');
    if (delInput) delInput.value = contact.id;
    edit_contact_modal.showModal();
  }
  function deleteContact(id) {
    if (confirm('Tem certeza que deseja excluir este contato?')) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '/contatos/delete';
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'id';
      input.value = id;
      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }
  }
  function updateImagePreview(input, imgId, iconId) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById(imgId).src = e.target.result;
        document.getElementById(imgId).classList.remove('hidden');
        document.getElementById(iconId).classList.add('hidden');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  function openPasswordContactModal(id = null) {
    document.getElementById('decrypt_contact_id').value = id || '';
    document.getElementById('password_contact_modal').showModal();
  }
  function lockData(){
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/contatos/lock';
    document.body.appendChild(form);
    form.submit();
  }
  <?php if (isset($errors['password'])) { ?>
    document.addEventListener('DOMContentLoaded', function() {
     openPasswordContactModal();
    });
  <?php } ?>

</script>