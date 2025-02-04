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

    document.querySelectorAll('.editar-btn').forEach(button => {
        button.addEventListener('click', function () {
            let aula_cod = this.getAttribute('data-id');
            let aula_tipo = this.getAttribute('data-tipo');  
            let aula_data = this.getAttribute('data-data');  
    
            fetch('../php/get_options.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Falha ao carregar os dados');
                }
                return response.json();
            })
            .then(data => {
                if (data.tipos_aula) {
                    let aulaTipoOptions = '';
                    data.tipos_aula.forEach(tipo => {
                        aulaTipoOptions += `<option value="${tipo}" ${aula_tipo === tipo ? 'selected' : ''}>${tipo}</option>`;
                    });
    
                    Swal.fire({
                        title: 'Editar Aula',
                        html: `
                            <select id="editTipo" class="swal2-input">
                                <option value="">Selecione o tipo</option>
                                ${aulaTipoOptions}
                            </select>
                            <input type="datetime-local" id="editData" class="swal2-input" value="${aula_data}">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Salvar',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            return {
                                aula_cod: aula_cod,
                                aula_tipo: document.getElementById('editTipo').value || aula_tipo,
                                aula_data: document.getElementById('editData').value || aula_data
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('../php/update_aula.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify(result.value)
                            })
                            .then(response => response.json()) // Parseia a resposta como JSON
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Atualizado!', 'A aula foi modificada.', 'success').then(() => location.reload());
                                } else {
                                    Swal.fire('Erro!', data.message || 'Não foi possível atualizar.', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Erro na requisição:', error);
                                Swal.fire('Erro!', 'Ocorreu um erro ao atualizar a aula.', 'error');
                            });
                        }
                    });
                } else {
                    Swal.fire('Erro!', 'Não foi possível carregar os tipos de aula.', 'error');
                }
            })
            .catch(error => {
                console.error('Erro ao carregar os tipos de aula:', error);
                Swal.fire('Erro!', 'Ocorreu um erro ao carregar os tipos de aula.', 'error');
            });
        });
    });
        
    
});
