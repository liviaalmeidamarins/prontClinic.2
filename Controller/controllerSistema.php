<?php

require_once '../Model/modelSistema.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Verifica se os dados foram enviados via JSON
    if ($data) {
        $tipo = $data['tipo'];

        if ($tipo === 'preencherCadastro') {
            $cpf = $data['cpf'];
            $dadosPaciente = buscarPacientePorCPF($cpf);
            if ($dadosPaciente) {
                echo json_encode([
                    'sucesso' => true,
                    'nome' => $dadosPaciente['pac_nome'],
                    'telefone' => $dadosPaciente['pac_telefone'],
                    'email' => $dadosPaciente['pac_email'],
                    'convenio' => $dadosPaciente['pac_convenio'],
                    'dataNascimento' => $dadosPaciente['pac_nascimento']
                ]);
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Paciente não encontrado']);
            }
            exit;
        }
    } else {
        // Caso os dados tenham sido enviados via formulário (url-encoded)
        $tipo = $_POST['tipo'];

        if ($tipo === 'CPF_Modal') {
            $cpf = $_POST['cpf'];
            error_log("cpf: " . $cpf);
        
            $cpf = preg_replace('/\D/', '', $cpf);
        
            if (preg_match('/^\d{11}$/', $cpf)) {
                if (conferirExistenciaPaciente($cpf)) {
                    echo json_encode(["status" => "CPF_existente"]);
                    exit;
                } else {
                    echo json_encode(["status" => "CPF_nao_encontrado"]);
                    exit;
                }
            } else {
                echo json_encode(["status" => "CPF_invalido"]);
            }
            exit;
        } else if ($tipo === 'Cadastro') {
            $cpf = $_POST['cpf-cadastro'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $convenio = $_POST['convenio'];
            $dataNascimento = $_POST['dataNascimento'];

            if (!empty($nome)) {
                if (strlen($nome) < 255) {
                    criarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento);
                    echo json_encode(["status" => "Cadastro_feito"]);
                    exit;
                } else {
                    echo json_encode(["status" => "Nome_grande"]);
                    exit;
                }
            } else {
                echo json_encode(["status" => "Nome_vazio"]);
                exit;
            }
        } else if ($tipo === 'Atualizar_Cadastro') {
            $cpf = $_POST['cpf-atualizar'];
            $nome = $_POST['nome-atualizar'];
            $telefone = $_POST['telefone-atualizar'];
            $email = $_POST['email-atualizar'];
            $convenio = $_POST['convenio-atualizar'];
            $dataNascimento = $_POST['dataNascimento-atualizar'];

            if (!empty($nome)) {
                if (strlen($nome) < 255) {
                    atualizarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento);
                    echo json_encode(["status" => "Cadastro_Atualizado"]);
                    exit;
                } else {
                    echo json_encode(["status" => "Nome_grande"]);
                    exit;
                }
            } else {
                echo json_encode(["status" => "Nome_vazio"]);
                exit;
            }
        }
    }
}
?>
