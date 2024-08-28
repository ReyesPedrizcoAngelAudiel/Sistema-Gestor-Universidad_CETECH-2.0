document.addEventListener('DOMContentLoaded', () => {
  // Functions to open and close a modal
  function openModal($el) {
      $el.classList.add('is-active');
  }

  function closeModal($el) {
      $el.classList.remove('is-active');
  }

  function closeAllModals() {
      (document.querySelectorAll('.modal') || []).forEach(($modal) => {
          closeModal($modal);
      });
  }

  // Add a click event on buttons to open a specific modal
  (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
      const modal = $trigger.dataset.target;
      const $target = document.getElementById(modal);

      $trigger.addEventListener('click', () => {
          openModal($target);
      });
  });

  // Add a click event on various child elements to close the parent modal
  (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
      const $target = $close.closest('.modal');

      $close.addEventListener('click', () => {
          closeModal($target);
      });
  });

  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
      if (event.key === "Escape") {
          closeAllModals();
      }
  });

  // Cerrar notificacion
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
      const $notification = $delete.parentNode;

      $delete.addEventListener('click', () => {
          $notification.classList.add('hidden'); // Añade la clase 'hidden' en lugar de eliminar directamente
      });

      // Agregar temporizador para cerrar automáticamente después de 3 segundos
      setTimeout(() => {
          $notification.classList.add('hidden'); // Añade la clase 'hidden' en lugar de eliminar directamente
      }, 2000);
  });

    // Agregar evento de clic en botones de eliminar para mostrar el modal de confirmación
    const deleteButtons = document.querySelectorAll('.js-delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const form = document.querySelector('#form-eliminar');
            const modal = document.querySelector('#modal-confirmacion');
            const closeButton = modal.querySelector('.delete');
            const noButton = modal.querySelector('.button.is-info'); // Selecciona el botón "No"

            form.action = this.dataset.action;
            modal.classList.add('is-active');

            // Evento clic en el botón "No" para cerrar el modal sin eliminar el registro
            noButton.addEventListener('click', function (event) {
                event.preventDefault(); // Evita la acción predeterminada del botón (enviar el formulario)
                modal.classList.remove('is-active');
            });

            // Evento clic en el botón de cierre del modal
            closeButton.addEventListener('click', function () {
                modal.classList.remove('is-active');
            });
        });
    });
});
