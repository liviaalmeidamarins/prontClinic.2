<?php
session_start();

// Defina as variáveis da sessão
$nome = isset($_SESSION['Cli_nome']) ? $_SESSION['Cli_nome'] : '';
$email = isset($_SESSION['Cli_email']) ? $_SESSION['Cli_email'] : '';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProntClinic</title>
    <link rel="icon" href="img/logo-png.png" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <nav>
        <ul>
            <li>
                <a href="#" class="aa">
                    <img src="img/logo-png.png" alt="">
                    <span class="nav-item"></span>
                </a>
            </li>

            <li>
                <a href="#" class="aa icon" id="homeIcon">
                    <i class="bi bi-house-door"></i>
                    
                </a>
            </li>
            <li>
                <a href="#" class="aa icon" id="openModalBtn">
                    <i class="bi bi-pencil-square"></i>
                    
                </a>
            </li>
            <li>
                <a href="#" class="aa icon" id="modal3">
                    <i class="bi bi-gear"></i>
                    
                </a>
            </li>

        </ul>
    </nav>

   <!--    .....Modais.....     -->

    <!-- modal para conferir cpf -->
    <div id="conferirCpfModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeConferirCpfModal">&times;</span>
            <h3 id="titulo-modal-conferir">Conferir CPF</h3>
            <br>
            <form id="CPF_form">
                <div class="formataçao-modal">
                    <input type="hidden" name="tipo" value="CPF_Modal">
                    <br>
                    <label for="cpf-conferir">CPF</label>
                    <input type="text" id="cpf-conferir" class="input-modal1" name="cpf" placeholder="Digite o CPF" required>
                    <span id="mensagemErroCPF" class="text-danger"></span><br>
                    <input type="button" class="btn btn-primary" style="background-color: #D6E88D; border: transparent;" value="Consultar" onclick="ConsultarCPF()">
                </div>
            </form>
        </div>
    </div>

    <!-- modal de cadastro -->
    <div id="ModalCadastro" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalCadastro">&times;</span>
            <h3 id="titulo-modal-cadastro">Cadastro</h3>
            <br>
            <form id="Cadastro_form">
                <div class="formataçao-modal">
                    <input type="hidden" name="tipo" value="Cadastro">
                    <br>
                    <label for="cpf-cadastro">CPF *</label>
                    <input type="text" id="cpf-cadastro" class="input-modal1" name="cpf-cadastro" placeholder="Digite o CPF" required readonly>
                    
                    <label for="nome-cadastro">Nome *</label>
                    <input type="text" id="nome" class="input-modal1" name="nome" placeholder="Digite o nome" required>
                    <span id="mensagemErroNomeCadastro" class="text-danger"></span><br>

                    <label for="telefone-cadastro">Telefone</label>
                    <input type="tel" id="telefone" class="input-modal1" name="telefone" placeholder="(DDD) XXXXX-XXXX">
                    
                    <label for="email-cadastro">E-mail</label>
                    <input type="email" id="email" class="input-modal1" name="email" placeholder="Digite o e-mail">
                    
                    <label for="convenio-cadastro">Convênio</label>
                    <input type="text" id="convenio" class="input-modal1" name="convenio" placeholder="Digite o convênio">
                    
                    <label for="data-nascimento-cadastro">Data de nascimento</label>
                    <input type="date" id="dataNascimento" class="input-modal1" name="dataNascimento">
                    
                    <input type="button" class="btn btn-primary" style="background-color: #D6E88D; border: transparent;" value="Cadastrar novo paciente" onclick="Cadastrar()">
                </div>
            </form>
        </div>
    </div>

     <!-- modal de infromaçoes dos pacientes -->
    <div id="modalInformacoesPaciente" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalInformacoesPaciente">&times;</span>
            <h3>Informações do Paciente</h3>
            <br>
            <form id="Atualizar_cadastro_form">
                <div class="formataçao-modal">
                    <input type="hidden" name="tipo" value="Atualizar_Cadastro">
                    <br>
                    <label for="cpf-atualizar" class="labelModal">CPF *</label>
                    <input type="text" id="cpf-atualizar" class="input-modal1" name="cpf-atualizar" placeholder="Digite o CPF" required readonly>
                    
                    <label for="nome-atualizar" class="labelModal">Nome *</label>
                    <input type="text" id="nome-atualizar" class="input-modal1" name="nome-atualizar" placeholder="Digite o nome" required>
                    <span id="mensagemErro_Atualizar_nome" class="text-danger"></span>
            
                    <label for="telefone-atualizar">Telefone</label>
                    <input type="tel" id="telefone-atualizar" class="input-modal1" name="telefone-atualizar" placeholder="(DDD) XXXXX-XXXX">
                    
                    <label for="email-atualizar">E-mail</label>
                    <input type="email" id="email-atualizar" class="input-modal1" name="email-atualizar" placeholder="Digite o e-mail">
                    
                    <label for="convenio-atualizar">Convênio</label>
                    <input type="text" id="convenio-atualizar" class="input-modal1" name="convenio-atualizar" placeholder="Digite o convênio">
                    
                    <label for="data-nascimento-atualizar">Data de nascimento</label>
                    <input type="date" id="dataNascimento-atualizar" class="input-modal1" name="dataNascimento-atualizar">
                    <span id="mensagemErroCadastroAtualizado" class="text-success"></span><br>
            
                    <input type="button" class="btn btn-primary" style="background-color: #D6E88D; border: transparent;" value="Atualizar cadastro" onclick="Atualizar_Cadastro()">
                </div>
            </form>
            <form id="Anamnese_form">
                <div class="formataçao-modal">
                    <br>
                    <h3>Anamnese</h3>
                    <br>
                    <input type="hidden" name="tipo" value="Anamnese_form">
                    <br>

                    <label for="cpf-anamnese"></label>
                    <input type="hidden" id="cpf-anamnese" class="input-modal1" name="cpf-anamnese" placeholder="Digite o CPF" required readonly>
            
                    <label for="queixa-principal">Queixa principal e história da doença atual? *</label>
                    <textarea id="queixa-principal" class="input-modal1" name="queixa-principal" required></textarea><br>
                    <span id="mensagemErroQueixa" class="text-danger"></span><br>

                    <label for="uso-medicação">Uso de medicação</label>
                    <input type="text" id="uso-medicação" class="input-modal1" name="uso-medicacao" placeholder="Descreva o uso de medicação, se houver"><br>
            
                    <label for="alergia">Alergia</label>
                    <input type="text" id="alergia" class="input-modal1" name="alergia" placeholder="Descreva alergias, se houver"><br>
            
                    <label>Possui as seguintes doenças?</label><br>
                    <div>
                            <input type="checkbox" id="asma" name="doencas[]" value="asma">
                            <label for="asma">Asma</label>
                    </div>
                    <div>
                            <input type="checkbox" id="Cardiaca" name="doencas[]" value="Cardiaca">
                            <label for="Cardiaca">Cardiaca</label>
                    </div>
                    <div>
                    <input type="checkbox" id="diabetes" name="doencas[]" value="diabetes">
                    <label for="diabetes">Diabetes</label>
                    </div>
                    <div>
                            <input type="checkbox" id="Gastrointestinal" name="doencas[]" value="Gastrointestinal">
                            <label for="Gastrointestinal">Gastrointestinal</label>
                    </div>
                    <div>
                            <input type="checkbox" id="hipertensao" name="doencas[]" value="hipertensão">
                            <label for="hipertensao">Hipertensão</label>
                    </div>
            
                    <label for="cirurgia">Passou por alguma cirurgia?</label>
                    <input type="text" id="cirurgia" class="input-modal1" name="cirurgia" placeholder="Descreva cirurgias, se houver">
            
                    <label for="sangramento">Quando se fere seu sangramento é?</label>
                    <select id="sangramento" class="input-modal1" name="sangramento" required>
                        <option value="normal">Normal</option>
                        <option value="excessivo">Excessivo</option>
                    </select><br>
            
                    <label for="cicatrizacao">Cicatrização?</label>
                    <select id="cicatrizacao" class="input-modal1" name="cicatrizacao" required>
                        <option value="normal">Normal</option>
                        <option value="complicada">Complicada</option>
                    </select><br>
            
                    <label for="falta-ar">Sente falta de ar?</label>
                    <select id="falta-ar" class="input-modal1" name="falta-ar" required>
                        <option value="não">Não</option>
                        <option value="raramente">Raramente</option>
                        <option value="frequentemente">Frequentemente</option>
                        <option value="sempre">Sempre</option>
                    </select><br>
            
                    <label for="gestante">Gestante? (quantas semanas)</label>
                    <input type="number" id="gestante" class="input-modal1" name="gestante" value="0">
            
                    <label for="observacoes">Observações</label>
                    <textarea id="observacoes" class="input-modal1" name="observacoes"></textarea><br>

                    <span id="mensagemSucessoAnamnese" class="text-success"></span><br>
                    <input type="button" class="btn btn-primary" style="background-color: #D6E88D; border: transparent;" value="Criar Anamnese" onclick="Criar_Anamnese()">
                </div>
            </form>
            <form id="SaudeBucal_form">
                <div class="formataçao-modal">
                    <br>
                    <h3>Saúde Bucal</h3>
                    <br>
                    <input type="hidden" name="tipo" value="SaudeBucal_form">

                    <label for="cpf-anamnesecpf-saude-bucal"></label>
                    <input type="hidden" id="cpf-saude-bucal" class="input-modal1" name="cpf-saude-bucal" placeholder="Digite o CPF" required readonly>

                    <label for="reacao-anestesia">Reação à anestesia?</label>
                    <select id="reacao-anestesia" class="input-modal1" name="reacao-anestesia" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
                    
                    <label for="dor-dentes">Dor nos dentes?</label>
                    <select id="dor-dentes" class="input-modal1" name="dor-dentes" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="dor-gengiva">Dor na gengiva?</label>
                    <select id="dor-gengiva" class="input-modal1" name="dor-gengiva" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="sangramento-gengiva">Sangramento na gengiva?</label>
                    <select id="sangramento-gengiva" class="input-modal1" name="sangramento-gengiva" required>
                        <option value="não">Não</option>
                        <option value="raramente">Raramente</option>
                        <option value="frequentemente">Frequentemente</option>
                        <option value="sempre">Sempre</option>
                    </select><br>
        
                    <label for="gosto-ruim-boca">Gosto ruim na boca?</label>
                    <select id="gosto-ruim-boca" class="input-modal1" name="gosto-ruim-boca" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="boca-seca">Boca seca?</label>
                    <select id="boca-seca" class="input-modal1" name="boca-seca" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="ranger-dentes">Ranger dos dentes?</label>
                    <select id="ranger-dentes" class="input-modal1" name="ranger-dentes" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="dor-maxilar">Dor no maxilar?</label>
                    <select id="dor-maxilar" class="input-modal1" name="dor-maxilar" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="dor-ouvido">Dor no ouvido?</label>
                    <select id="dor-ouvido" class="input-modal1" name="dor-ouvido" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="ultimo-tratamento">Último tratamento?</label>
                    <input type="date" id="ultimo-tratamento" class="input-modal1" name="ultimo-tratamento">
        
                    <label for="fumante">Fumante?</label>
                    <select id="fumante" class="input-modal1" name="fumante" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <label for="escova-dentes">Escova dentes? (vezes por dia)</label>
                    <input type="number" id="escova-dentes" class="input-modal1" name="escova-dentes" required>
        
                    <label for="fio-dental">Usa fio dental?</label>
                    <select id="fio-dental" class="input-modal1" name="fio-dental" required>
                        <option value="não">Não</option>
                        <option value="sim">Sim</option>
                    </select><br>
        
                    <span id="mensagemSucessoSaudeBucal" class="text-success"></span><br>
                    <input type="button" class="btn btn-primary" style="background-color: #D6E88D; border: transparent;" value="Criar Saúde Bucal" onclick="Criar_SaudeBucal()">
                </div>
            </form>
            
        </div>
    </div>

    <!-- Modal -->
    <div id="minhamodal3" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="titulo-modal3">Configurações</h3>
            <br>
            <form action="" method="post">
                <div class="formataçao-modal">
                    <br>
                    <label for="Nome">Empresa</label>
                    <input type="text" name="nome" id="input-modal3" placeholder="Nome da empresa" value="<?php echo htmlspecialchars($nome); ?>">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="input-modal3" placeholder="Email cadastrado" value="<?php echo htmlspecialchars($email); ?>">
                    <label for="telefone">Telefone</label>
                    <input type="number" name="telefone" id="input-modal3" placeholder="(ddd) xxxxx-xxxx">
                </div>
            </form>

        </div>
    </div>

    <main>
        <div class="frase">
            <h3>Bem-vindo, <?php echo htmlspecialchars($nome); ?> </h3>
        </div>

        <?php
require_once('../Model/modelSistema.php');

// Verificar se o usuário está autenticado e possui id_clinica na sessão
if (isset($_SESSION['id_clinica'])) {
    $idClinica = $_SESSION['id_clinica'];
    
    // Verificar se há um termo de pesquisa
    $termoPesquisa = isset($_GET['search']) ? $_GET['search'] : '';

    // Obter a lista de pacientes da clínica atual
    $pacientes = listarPacientesPorClinica($idClinica, $termoPesquisa);

    // Exibir a caixa de pesquisa
    echo '<form method="GET" action="" class="search-box">';
    echo '<input type="text" name="search" placeholder="Nome ou CPF" class="search-text" value="' . htmlspecialchars($termoPesquisa) . '">';
    echo '<a href="#" class="search-btn" onclick="this.closest(\'form\').submit();">';
    echo '<img src="img/search.svg" alt="lupa" height="20" width="20">';
    echo '</a>';
    echo '</form>';


    // Verificar se há pacientes retornados
    // Verificar se há pacientes retornados
    if ($pacientes) {
        // Iterar sobre os pacientes e exibir as informações dentro de cards
        foreach ($pacientes as $paciente) {
            echo '<div class="card" style="background-color: #D6E88D; width: 30%; height: 15%px; display: flex; align-items: left; justify-content: space-between; padding: 6px; 
            border: none; cursor: pointer;" onclick="preencherCampos(\'' . $paciente['pac_cpf'] . '\')">';
    
            $dataFormatada = date('d/m/Y', strtotime($paciente['pac_atualizacao']));
            echo '<div>'; 
            echo '<h4 class="card-title" style="color: white;"><b>' . $paciente['pac_nome'] . '</b></h6>';
            echo '<p class="card-text"><nome class"estilo" style="color: white;">CPF: </nome> <strong>' . $paciente['pac_cpf'] . '</strong></p>';
            echo '<p class="card-text"><nome class"estilo" style="color: white;">Ultima visita: </nome> <strong>' . $dataFormatada . '</strong></p>';
            echo '</div>'; 
            
            // Você pode manter o espaço entre os cards com uma margem ou usando <br> como no seu exemplo
            echo '</div>'; // fechar card
            echo '<br>'; // espaço entre os cards (opcional)
            
        }
    } else {
        echo "<p>Nenhum paciente encontrado.</p>";
    }
} else {
    echo "<p>Sessão inválida ou não autenticada.</p>";
}
?>
    </main>




    <script src="js/bootstrap.min.js"></script>
    <script src="js/app.js"></script>
    <script>



        document.getElementById('openModalBtn').addEventListener('click', function(event) 
        {
            event.preventDefault(); // Evita o comportamento padrão do link
            document.getElementById('conferirCpfModal').style.display = 'block';
        });
    
        // Função para fechar os modais
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    
        document.getElementById('closeConferirCpfModal').addEventListener('click', function() 
        {
            closeModal('conferirCpfModal');
        });
    
        document.getElementById('closeModalCadastro').addEventListener('click', function() 
        {
            closeModal('ModalCadastro');
        });
    
        document.getElementById('closeModalInformacoesPaciente').addEventListener('click', function() 
        {
            closeModal('modalInformacoesPaciente');
            location.reload();
        });
    
        window.addEventListener('click', function(event) 
        {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        });
    
    // iniciar pagina

    function preencherCampos(cpf) 
    {

        document.getElementById('cpf-atualizar').value = cpf;
        document.getElementById('cpf-anamnese').value = cpf;
        document.getElementById('cpf-saude-bucal').value = cpf;
        
        preencherCadastro(cpf);
        preencherAnamnese(cpf);
        preencherSaudeBucal(cpf);
        
        document.getElementById('modalInformacoesPaciente').style.display = 'block';
    }
       
    // ... Cadastro ...


    function ConsultarCPF() 
        {
            console.log("Enviando formulário...");
            $.ajax({
            type: "POST",
            url: "../Controller/controllerSistema.php",
            data: $("#CPF_form").serialize(),
            success: function(response) 
            {
            console.log("Resposta recebida:", response);
            var resposta = JSON.parse(response);
            var cpf = $("#cpf-conferir").val().replace(/\D/g, '');

            if (resposta.status === 'CPF_nao_encontrado') {
                closeModal('conferirCpfModal');
                document.getElementById('cpf-cadastro').value = cpf;
                document.getElementById('cpf-anamnese').value = cpf;
                document.getElementById('ModalCadastro').style.display = 'block';
            } else if (resposta.status === 'CPF_existente') {
                closeModal('conferirCpfModal');
                document.getElementById('cpf-atualizar').value = cpf;
                document.getElementById('cpf-anamnese').value = cpf;
                document.getElementById('cpf-saude-bucal').value = cpf;
                preencherCadastro(cpf);
                preencherAnamnese(cpf);
                preencherSaudeBucal(cpf);
                document.getElementById('modalInformacoesPaciente').style.display = 'block';
            } else if (resposta.status === 'CPF_invalido') {
                $("#mensagemErroCPF").text("O CPF deve conter 11 dígitos.");
            }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        function Cadastrar() 
        {
            console.log("Enviando formulário...");
            $.ajax({
                type: "POST",
                url: "../Controller/controllerSistema.php",
                data: $("#Cadastro_form").serialize(),
                success: function(response) {
                    console.log("Resposta recebida:", response); // Debug: log the response to the console
                    var resposta = JSON.parse(response);
                    if (resposta.status === 'Cadastro_feito') 
                    {
                        closeModal('ModalCadastro');   
                        location.reload();             
                    } 
                    else if (resposta.status === 'Nome_vazio') 
                    {
                        $("#mensagemErroNomeCadastro").text("O nome é obrigatorio");
                    } 
                    else if (resposta.status === 'Nome_grande') 
                    {
                        $("#mensagemErroNomeCadastro").text("O nome deve ter no maximo 255 letras");
                    }
                },
                error: function(xhr, status, error) 
                {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    
        function Atualizar_Cadastro() 
        {
            console.log("Enviando formulário...");
            $.ajax({
                type: "POST",
                url: "../Controller/controllerSistema.php",
                data: $("#Atualizar_cadastro_form").serialize(),
                success: function(response) {
                    console.log("Resposta recebida:", response); // Debug: log the response to the console
                    var resposta = JSON.parse(response);
    
                    // Limpar mensagens anteriores
                    $("#mensagemErro_Atualizar_nome").text("");
                    $("#mensagemErroCadastroAtualizado").text("");
                    
                    if (resposta.status === 'Cadastro_Atualizado') 
                    {
                        $("#mensagemErroCadastroAtualizado").text("O cadastro foi atualizado");                
                    } 
                    else if (resposta.status === 'Nome_vazio') 
                    {
                        $("#mensagemErro_Atualizar_nome").text("O nome é obrigatório");
                    } 
                    else if (resposta.status === 'Nome_grande') 
                    {
                        $("#mensagemErro_Atualizar_nome").text("O nome deve ter no máximo 255 letras");
                    }
                },
                error: function(xhr, status, error) 
                {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    
        

        async function preencherCadastro(cpf) 
        {
            console.log("Preenchendo cadastro...");
            try {
                const response = await fetch('../Controller/controllerSistema.php', 
                {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ tipo: 'preencherCadastro', cpf: cpf })
                });
                const dados = await response.json();
                console.log("Dados recebidos para preenchimento:", dados);

                if (dados.sucesso) 
                {
                    document.getElementById('nome-atualizar').value = dados.nome;
                    document.getElementById('telefone-atualizar').value = dados.telefone;
                    document.getElementById('email-atualizar').value = dados.email;
                    document.getElementById('convenio-atualizar').value = dados.convenio;
                    document.getElementById('dataNascimento-atualizar').value = dados.dataNascimento;
                } 
                else 
                {
                    console.error('Erro ao preencher cadastro:', dados.erro);
                }
            }
            catch (error) 
            {
                console.error('Erro ao preencher cadastro:', error);
            }
        }

        // ... Anamnese ...

        async function preencherAnamnese(cpf) 
        {
            console.log("Preenchendo anamnese...");
            try 
            {
                const response = await fetch('../Controller/controllerSistema.php', 
                {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ tipo: 'preencherAnamnese', cpf: cpf })
                });
                const dados = await response.json();
                console.log("Dados recebidos para preenchimento:", dados);

                if (dados.sucesso) 
                {
                    document.getElementById('queixa-principal').value = dados.QueixaPrincipal;
                    document.getElementById('uso-medicação').value = dados.UsoMedicacao;
                    document.getElementById('alergia').value = dados.Alergia;

                    const doencas = dados.Doencas.split(', ');
                    document.querySelectorAll('input[name="doencas[]"]').forEach((checkbox) => 
                    {
                        if (doencas.includes(checkbox.value)) 
                        {
                            checkbox.checked = true;
                        } 
                        else 
                        {
                            checkbox.checked = false;
                        }
                    });

                    document.getElementById('cirurgia').value = dados.Cirurgia;
                    document.getElementById('sangramento').value = dados.Sangramento;
                    document.getElementById('cicatrizacao').value = dados.Cicatrizacao;
                    document.getElementById('falta-ar').value = dados.FaltaAr;
                    document.getElementById('gestante').value = dados.Gestante;
                    document.getElementById('observacoes').value = dados.Observacoes;
                } 
                else 
                {
                    console.error('Erro ao preencher anamnese:', dados.erro);
                }
            } 
            catch (error) 
            {
                console.error('Erro ao preencher anamnese:', error);
            }
        }


    
        function Criar_Anamnese() 
        {
                console.log("Enviando formulário...");
                $.ajax(
                {
                    type: "POST",
                    url: "../Controller/controllerSistema.php",
                    data: $("#Anamnese_form").serialize(),
                    success: function(response) 
                    {
                    try {
                            if (response) 
                            {
                                var resposta = JSON.parse(response);
                                if (resposta.status === 'Anamnese_criada') 
                                {
                                    $("#mensagemSucessoAnamnese").text("Anamnese foi criado");
                                } 
                                else if (resposta.status === 'Anamnese_atualizada') 
                                {
                                    $("#mensagemSucessoAnamnese").text("Anamnese foi atualizado");
                                } 
                                else if (resposta.status === 'Queixa_vazia') 
                                {
                                    $("#mensagemErroQueixa").text("A queixa é obrigatoria");
                                }  
                                else 
                                {
                                    console.error("Erro ao criar anamnese:", resposta);
                                }
                            } 
                            else 
                            {
                                console.error("Resposta vazia recebida.");
                            }
                        } 
                        catch (e)
                        {
                            console.error("Erro ao analisar resposta JSON:", e, response);
                        }
                    },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        // ... Saude bucal ...

async function preencherSaudeBucal(cpf) 
{
    console.log("Preenchendo saúde bucal...");
    try {
        const response = await fetch('../Controller/controllerSistema.php', 
        {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ tipo: 'preencherSaudeBucal', cpf: cpf })
        });
        const dados = await response.json();
        console.log("Dados recebidos para preenchimento:", dados);

        if (dados.sucesso) 
        {
            document.getElementById('reacao-anestesia').value = dados.ReacaoAnestesia;
            document.getElementById('dor-dentes').value = dados.DorDentes;
            document.getElementById('dor-gengiva').value = dados.DorGengiva;
            document.getElementById('sangramento-gengiva').value = dados.SangramentoGengiva;
            document.getElementById('gosto-ruim-boca').value = dados.GostoRuimBoca;
            document.getElementById('boca-seca').value = dados.BocaSeca;
            document.getElementById('ranger-dentes').value = dados.RangerDentes;
            document.getElementById('dor-maxilar').value = dados.DorMaxilar;
            document.getElementById('dor-ouvido').value = dados.DorOuvido;
            document.getElementById('ultimo-tratamento').value = dados.UltimoTratamento;
            document.getElementById('fumante').value = dados.Fumante;
            document.getElementById('escova-dentes').value = dados.EscovaDentes;
            document.getElementById('fio-dental').value = dados.FioDental;
        } 
        else 
        {
            console.error('Erro ao preencher saúde bucal:', dados.erro);
        }
    } 
    catch (error) 
    {
        console.error('Erro ao preencher saúde bucal:', error);
    }
}
        
        function Criar_SaudeBucal() 
        {
            console.log("Enviando formulário...");
            $.ajax({
                type: "POST",
                url: "../Controller/controllerSistema.php",
                data: $("#SaudeBucal_form").serialize(),
                success: function(response) 
                {
                    try 
                    {
                        if (response) 
                        {
                            var resposta = JSON.parse(response);
                            if (resposta.status === 'SaudeBucal_criada') 
                            {
                                $("#mensagemSucessoSaudeBucal").text("Saúde Bucal criada com sucesso.");
                            } else if (resposta.status === 'SaudeBucal_atualizada') 
                            {
                                $("#mensagemSucessoSaudeBucal").text("Saúde Bucal atualizada com sucesso.");
                            } 
                            else 
                            {
                                console.error("Erro ao criar saúde bucal:", resposta);
                            }
                        } 
                        else 
                        {
                            console.error("Resposta vazia recebida.");
                        }
                    } 
                    catch (e) 
                    {
                        console.error("Erro ao analisar resposta JSON:", e, response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }


    </script>
</body>

</html>