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
// Envia o formulário e insere os dados no banco
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
    fetch('../php/get_options.php')
        .then(response => response.json())
        .then(data => {
            // Preencher o select de tipo de aula
            const aulaTipoSelect = document.getElementById('aula_tipo');
            aulaTipoSelect.innerHTML = ""; // Limpa antes de adicionar novas opções
            data.tipos_aula.forEach(tipo => {
                const option = document.createElement('option');
                option.value = tipo;
                option.textContent = tipo;
                aulaTipoSelect.appendChild(option);
            });

            // Preencher o select de instrutores
            const instrutorSelect = document.getElementById('instrutor');
            instrutorSelect.innerHTML = ""; // Limpa antes de adicionar novas opções
            data.instrutores.forEach(instrutor => {
                const option = document.createElement('option');
                option.value = instrutor.cod; // O value agora é o código do instrutor
                option.textContent = instrutor.nome;
                instrutorSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar os dados:', error);
        });
}

// Chama a função para preencher os selects ao carregar a página
window.onload = preencherSelects;






