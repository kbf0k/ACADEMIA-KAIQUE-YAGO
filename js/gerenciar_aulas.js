document.addEventListener("DOMContentLoaded", function () {
    // Excluir aula
    document.querySelectorAll('.excluir-btn').forEach(button => {
        button.addEventListener('click', function () {
            let aula_cod = this.getAttribute('data-id');

            Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não pode ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../php/delete_aula.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ aula_cod: aula_cod })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Excluída!', 'A aula foi removida.', 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Erro!', 'Não foi possível excluir.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Editar aula
    document.querySelectorAll('.editar-btn').forEach(button => {
        button.addEventListener('click', function () {
            let aula_cod = this.getAttribute('data-id');

            Swal.fire({
                title: 'Editar Aula',
                html: `
                    <input type="text" id="editTipo" class="swal2-input" placeholder="Novo tipo">
                    <input type="datetime-local" id="editData" class="swal2-input" placeholder="Nova data">
                `,
                showCancelButton: true,
                confirmButtonText: 'Salvar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    return {
                        aula_cod: aula_cod,
                        aula_tipo: document.getElementById('editTipo').value,
                        aula_data: document.getElementById('editData').value
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../php/update_aula.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(result.value)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Atualizado!', 'A aula foi modificada.', 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Erro!', 'Não foi possível atualizar.', 'error');
                        }
                    });
                }
            });
        });
    });
});
