document.getElementById('logout').addEventListener('click', () => {
    Swal.fire({
        title: "Você deseja sair?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, sair",
        confirmButtonColor: "#007BFF",
        backdrop: `rgba(0, 0, 0, 0.5)`
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('logout.php', {
                method: 'POST'
            })
                .then(response => {
                    if (response.ok) {
                        window.location.href = "login.php";
                    }
                })
        }
    });
});

// Abre o modal quando clicar no botão "Participar"
document.querySelectorAll('.criar-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.getElementById('inscricaoModal').style.display = "block";
    });
});

// Fecha o modal ao clicar no 'x'
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('inscricaoModal').style.display = "none";
});

// Fecha o modal se o usuário clicar fora da área de conteúdo do modal
window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('inscricaoModal')) {
        document.getElementById('inscricaoModal').style.display = "none";
    }
});

// Envia o formulário e insere os dados no banco
document.getElementById('formAula').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio tradicional do formulário

    // Captura os dados do formulário
    const aula_tipo = document.getElementById('aula_tipo').value;
    const aula_data = document.getElementById('aula_data').value;
    const instrutor_cod = document.getElementById('instrutor').value; // Pega o código do instrutor

    // Envia os dados via fetch para o PHP
    fetch('../php/create_aula.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            aula_tipo: aula_tipo,
            aula_data: aula_data,
            instrutor: instrutor_cod // Passa o código do instrutor
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Aula cadastrada com sucesso!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then(() => {
                location.reload(); // Atualiza a página para mostrar a nova aula
            });
            
        } else {
            alert('Erro ao cadastrar aula!');
        }
    })
    .catch(error => {
        alert('Erro ao se comunicar com o servidor.');
    });

    // Fecha o modal após o envio do formulário
    document.getElementById('inscricaoModal').style.display = "none";
});


// Função para preencher os selects com os dados do banco
function preencherSelects() {
    fetch('get_options.php') // Requisição para o PHP
        .then(response => response.json()) // Converte a resposta para JSON
        .then(data => {
            // Preencher o select de tipo de aula
            const aulaTipoSelect = document.getElementById('aula_tipo');
            aulaTipoSelect.innerHTML = ""; // Limpa antes de adicionar novas opções

            if (data.tipos_aula.length === 0) {
                aulaTipoSelect.innerHTML = "<option value=''>Nenhum tipo de aula encontrado</option>";
            } else {
                // Adiciona as opções de tipo de aula
                data.tipos_aula.forEach(tipo => {
                    const option = document.createElement('option');
                    option.value = tipo;
                    option.textContent = tipo;
                    aulaTipoSelect.appendChild(option);
                });
            }

            // Preencher o select de instrutores
            const instrutorSelect = document.getElementById('instrutor');
            instrutorSelect.innerHTML = ""; // Limpa antes de adicionar novas opções

            if (data.instrutores.length === 0) {
                instrutorSelect.innerHTML = "<option value=''>Nenhum instrutor encontrado</option>";
            } else {
                // Adiciona as opções de instrutores
                data.instrutores.forEach(instrutor => {
                    const option = document.createElement('option');
                    option.value = instrutor.cod; // O value agora é o código do instrutor
                    option.textContent = instrutor.nome;
                    instrutorSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Erro ao carregar os dados:', error);
        });
}

// Chama a função para preencher os selects quando a página carregar
window.onload = preencherSelects;


document.querySelectorAll('.inscrever-btn').forEach(button => {
    button.addEventListener('click', function() {
        const aulaId = this.getAttribute('data-aula-id');
        
        // Pergunta se o aluno quer se inscrever
        Swal.fire({
            icon: "question",
            title: 'Quer se inscrever nesta aula?',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
        }).then(result => {
            if (result.isConfirmed) {
                // Requisição para atualizar a inscrição no banco
                fetch('../php/inscrever_aula.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ aulaId: aulaId }) // Envia o ID da aula
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Exibe a mensagem de sucesso
                        Swal.fire('Sucesso!', data.message, 'success').then(() => {
                            // Desabilita o botão ou muda seu texto
                            button.disabled = true;
                            button.textContent = 'Inscrição realizada';
                            location.reload(); // Recarga a página ou atualiza a interface
                        });
                    } else {
                        // Exibe erro caso falhe
                        Swal.fire('Erro!', data.message, 'error');
                    }
                })
                .catch(error => {
                    // Exibe erro se não conseguir fazer a requisição
                    Swal.fire('Erro!', 'Houve um problema ao tentar se inscrever.', 'error');
                });
            }
        });
    });
});








