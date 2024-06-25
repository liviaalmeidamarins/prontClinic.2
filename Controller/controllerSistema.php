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
    
        if ($tipo === 'preencherAnamnese') 
        {
            $cpf = $data['cpf'];
            $ID_Paciente = Conferir_ID_Paciente($cpf);
            $dadosAnamnese = buscarAnamnesePorIDPaciente($ID_Paciente);
            if ($dadosAnamnese) {
                echo json_encode([
                    'sucesso' => true,
                    'QueixaPrincipal' => $dadosAnamnese['QueixaPrincipal'],
                    'UsoMedicacao' => $dadosAnamnese['UsoMedicacao'],
                    'Alergia' => $dadosAnamnese['Alergia'],
                    'Doencas' => $dadosAnamnese['Doencas'],
                    'Cirurgia' => $dadosAnamnese['Cirurgia'],
                    'Sangramento' => $dadosAnamnese['Sangramento'],
                    'Cicatrizacao' => $dadosAnamnese['Cicatrizacao'],
                    'FaltaAr' => $dadosAnamnese['FaltaAr'],
                    'Gestante' => $dadosAnamnese['Gestante'],
                    'Observacoes' => $dadosAnamnese['Observacoes']
                ]);
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Anamnese não encontrada']);
            }
            exit;
        }

        if ($tipo === 'preencherSaudeBucal') {
            $cpf = $data['cpf'];
            $ID_Paciente = Conferir_ID_Paciente($cpf);
            $dadosSaudeBucal = buscarSaudeBucalPorIDPaciente($ID_Paciente);
            if ($dadosSaudeBucal) {
                echo json_encode([
                    'sucesso' => true,
                    'ReacaoAnestesia' => $dadosSaudeBucal['ReacaoAnestesia'],
                    'DorDentes' => $dadosSaudeBucal['DorDentes'],
                    'DorGengiva' => $dadosSaudeBucal['DorGengiva'],
                    'SangramentoGengiva' => $dadosSaudeBucal['SangramentoGengiva'],
                    'GostoRuimBoca' => $dadosSaudeBucal['GostoRuimBoca'],
                    'BocaSeca' => $dadosSaudeBucal['BocaSeca'],
                    'RangerDentes' => $dadosSaudeBucal['RangerDentes'],
                    'DorMaxilar' => $dadosSaudeBucal['DorMaxilar'],
                    'DorOuvido' => $dadosSaudeBucal['DorOuvido'],
                    'UltimoTratamento' => $dadosSaudeBucal['UltimoTratamento'],
                    'Fumante' => $dadosSaudeBucal['Fumante'],
                    'EscovaDentes' => $dadosSaudeBucal['EscovaDentes'],
                    'FioDental' => $dadosSaudeBucal['FioDental']
                ]);
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Saúde Bucal não encontrada']);
            }
            exit;
        }
        
    }
    
     else {
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
        } 
        else if ($tipo === 'Atualizar_Cadastro') 
        {
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
        else if ($tipo === 'Anamnese_form') 
        {    
            $cpf = $_POST['cpf-anamnese'];
            $ID_Paciente = Conferir_ID_Paciente($cpf);
            $QueixaPrincipal = $_POST['queixa-principal'];
            $UsoMedicacao = $_POST['uso-medicacao'] ?? '';
            $Alergia = $_POST['alergia'] ?? '';
            $Doencas = isset($_POST['doencas']) && is_array($_POST['doencas']) ? implode(', ', $_POST['doencas']) : '';
            $Cirurgia = $_POST['cirurgia'] ?? '';
            $Sangramento = $_POST['sangramento'];
            $Cicatrizacao = $_POST['cicatrizacao'];
            $FaltaAr = $_POST['falta-ar'];
            $Gestante = isset($_POST['gestante']) ? (int)$_POST['gestante'] : 0;
            $Observacoes = $_POST['observacoes'] ?? '';
            
            if (empty($QueixaPrincipal)) 
            {
                echo json_encode(["status" => "Queixa_vazia"]);
                exit;
            }
            else
            {
                if (conferirExistenciaAnamnese($ID_Paciente)) 
                {
                    atualizarAnamnese($ID_Paciente, $QueixaPrincipal, $UsoMedicacao, $Alergia, $Doencas, $Cirurgia, $Sangramento, $Cicatrizacao, $FaltaAr, $Gestante, $Observacoes);
                    echo json_encode(["status" => "Anamnese_atualizada"]);
                    exit;
                } 
                else 
                {
                    criarAnamnese($ID_Paciente, $QueixaPrincipal, $UsoMedicacao, $Alergia, $Doencas, $Cirurgia, $Sangramento, $Cicatrizacao, $FaltaAr, $Gestante, $Observacoes);
                    echo json_encode(["status" => "Anamnese_criada"]);
                    exit;
                }
            }
            
            
        }
        else if ($tipo === 'SaudeBucal_form') 
        {
            
            $cpf = $_POST['cpf-saude-bucal'];
            $ID_Paciente = Conferir_ID_Paciente($cpf);
           
            $ReacaoAnestesia = $_POST['reacao-anestesia'];
            $DorDentes = $_POST['dor-dentes'];
            $DorGengiva = $_POST['dor-gengiva'];
            $SangramentoGengiva = $_POST['sangramento-gengiva'];
            $GostoRuimBoca = $_POST['gosto-ruim-boca'];
            $BocaSeca = $_POST['boca-seca'];
            $RangerDentes = $_POST['ranger-dentes'];
            $DorMaxilar = $_POST['dor-maxilar'];
            $DorOuvido = $_POST['dor-ouvido'];
            $UltimoTratamento = $_POST['ultimo-tratamento'] ?: null;
            $Fumante = $_POST['fumante'];
            $EscovaDentes = $_POST['escova-dentes'];
            $FioDental = $_POST['fio-dental'];
        
            if (conferirExistenciaSaudeBucal($ID_Paciente)) 
            {
                
                atualizarSaudeBucal($ID_Paciente, $ReacaoAnestesia, $DorDentes, $DorGengiva, $SangramentoGengiva, $GostoRuimBoca, $BocaSeca, $RangerDentes, $DorMaxilar, $DorOuvido, $UltimoTratamento, $Fumante, $EscovaDentes, $FioDental);
                echo json_encode(["status" => "SaudeBucal_atualizada"]);
            } 
            else 
            {
               
                criarSaudeBucal($ID_Paciente, $ReacaoAnestesia, $DorDentes, $DorGengiva, $SangramentoGengiva, $GostoRuimBoca, $BocaSeca, $RangerDentes, $DorMaxilar, $DorOuvido, $UltimoTratamento, $Fumante, $EscovaDentes, $FioDental);
                echo json_encode(["status" => "SaudeBucal_criada"]);
            }
            exit;
        }
        
    }
}
?>
