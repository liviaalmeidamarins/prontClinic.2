<?php

include 'conexao.php';



    function conferirExistenciaPaciente($cpf) 
    {
        $conecta = conectarBanco();
        if ($conecta) 
        {
            try 
            {
                session_start(); // Iniciar a sessão para acessar as variáveis de sessão
                $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão
    
                $consulta = $conecta->prepare("SELECT * FROM paciente WHERE pac_cpf = :cpf AND id_clinica = :idClinica");
                $consulta->bindParam(':cpf', $cpf);
                $consulta->bindParam(':idClinica', $idClinica);
                $consulta->execute();
                if ($consulta->rowCount() > 0) 
                {
                    return true;
                } 
                else 
                {
                    return false;
                }
            } 
            catch (PDOException $e) 
            {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        } 
        else 
        {
            echo "Falha na conexão com o banco de dados.";
            return false;
        }
    }

function buscarSaudeBucalPorIDPaciente($ID_Paciente) {
    $conecta = conectarBanco();
    if ($conecta) {
        try {
            $consulta = $conecta->prepare("SELECT * FROM saude_bucal WHERE ID_Paciente = :ID_Paciente");
            $consulta->bindParam(':ID_Paciente', $ID_Paciente);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } else {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}



function Conferir_ID_Paciente($cpf) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            session_start(); // Iniciar a sessão para acessar as variáveis de sessão
            $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão

            $consulta = $conecta->prepare("SELECT id_paciente FROM paciente WHERE pac_cpf = :cpf AND id_clinica = :idClinica");
            $consulta->bindParam(':cpf', $cpf);
            $consulta->bindParam(':idClinica', $idClinica);
            $consulta->execute();

            if ($consulta->rowCount() > 0) 
            {
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                return $resultado['id_paciente'];
            } 
            else 
            {
                return false;
            }
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}


function criarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            session_start(); // Iniciar a sessão para acessar as variáveis de sessão
            $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão
            
            // Definir o fuso horário para o horário de Brasília
            date_default_timezone_set('America/Sao_Paulo');
            
            // Obter a data e hora atual no formato 'Y-m-d H:i:s'
            $dataAtualizacao = date('Y-m-d H:i:s');

            $texto = "INSERT INTO paciente(id_clinica, pac_cpf, pac_nome, pac_telefone, pac_email, pac_convenio, pac_nascimento, pac_atualizacao) 
                      VALUES (:idClinica, :cpf, :nome, :telefone, :email, :convenio, :dataNascimento, :dataAtualizacao)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':idClinica', $idClinica);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':convenio', $convenio);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
            $stmt->execute();
            //echo "Paciente criado com sucesso.";
        } 
        catch (PDOException $e) 
        {
            //echo "Erro ao criar paciente: " . $e->getMessage();
        }
    } 
    else 
    {
       // echo "Falha na conexão com o banco de dados.";
    }
}

function atualizarPaciente($cpf, $nome, $telefone, $email, $convenio, $dataNascimento) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            session_start(); // Iniciar a sessão para acessar as variáveis de sessão
            $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão
            
            // Definir o fuso horário para o horário de Brasília
            date_default_timezone_set('America/Sao_Paulo');
            
            // Obter a data e hora atual no formato 'Y-m-d H:i:s'
            $dataAtualizacao = date('Y-m-d H:i:s');

            $texto = "UPDATE paciente
                      SET pac_nome = :nome,
                          pac_telefone = :telefone,
                          pac_email = :email,
                          pac_convenio = :convenio,
                          pac_nascimento = :dataNascimento,
                          pac_atualizacao = :dataAtualizacao
                      WHERE pac_cpf = :cpf AND id_clinica = :idClinica";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':idClinica', $idClinica);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':convenio', $convenio);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
            $stmt->execute();
            //echo "Paciente atualizado com sucesso.";
        } 
        catch (PDOException $e) 
        {
            //echo "Erro ao atualizar paciente: " . $e->getMessage();
        }
    } 
    else 
    {
        // echo "Falha na conexão com o banco de dados.";
    }
}

function buscarPacientePorCPF($cpf) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            session_start(); // Iniciar a sessão para acessar as variáveis de sessão
            $idClinica = $_SESSION['id_clinica']; // Recuperar o ID da clínica da sessão

            $consulta = $conecta->prepare("SELECT * FROM paciente WHERE pac_cpf = :cpf AND id_clinica = :idClinica");
            $consulta->bindParam(':cpf', $cpf);
            $consulta->bindParam(':idClinica', $idClinica);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}

// ... Anamnese ...


function buscarAnamnesePorIDPaciente($ID_Paciente) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $consulta = $conecta->prepare("SELECT * FROM anamnese WHERE ID_Paciente = :ID_Paciente");
            $consulta->bindParam(':ID_Paciente', $ID_Paciente);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}



function criarAnamnese($ID_Paciente, $QueixaPrincipal, $UsoMedicacao, $Alergia, $Doencas, $Cirurgia, $Sangramento, $Cicatrizacao, $FaltaAr, $Gestante, $Observacoes) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $texto = "INSERT INTO anamnese (ID_Paciente, QueixaPrincipal, UsoMedicacao, Alergia, Doencas, Cirurgia, Sangramento, Cicatrizacao, FaltaAr, Gestante, Observacoes) 
                      VALUES (:ID_Paciente, :QueixaPrincipal, :UsoMedicacao, :Alergia, :Doencas, :Cirurgia, :Sangramento, :Cicatrizacao, :FaltaAr, :Gestante, :Observacoes)";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':ID_Paciente', $ID_Paciente);
            $stmt->bindParam(':QueixaPrincipal', $QueixaPrincipal);
            $stmt->bindParam(':UsoMedicacao', $UsoMedicacao);
            $stmt->bindParam(':Alergia', $Alergia);
            $stmt->bindParam(':Doencas', $Doencas);
            $stmt->bindParam(':Cirurgia', $Cirurgia);
            $stmt->bindParam(':Sangramento', $Sangramento);
            $stmt->bindParam(':Cicatrizacao', $Cicatrizacao);
            $stmt->bindParam(':FaltaAr', $FaltaAr);
            $stmt->bindParam(':Gestante', $Gestante, PDO::PARAM_INT);
            $stmt->bindParam(':Observacoes', $Observacoes);
            $stmt->execute();
            //echo "Anamnese criada com sucesso.";
        } 
        catch (PDOException $e)
        {
            echo "Erro ao criar anamnese: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
    }
}

function atualizarAnamnese($ID_Paciente, $QueixaPrincipal, $UsoMedicacao, $Alergia, $Doencas, $Cirurgia, $Sangramento, $Cicatrizacao, $FaltaAr, $Gestante, $Observacoes) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $texto = "UPDATE anamnese 
                      SET QueixaPrincipal = :QueixaPrincipal, UsoMedicacao = :UsoMedicacao, Alergia = :Alergia, Doencas = :Doencas, Cirurgia = :Cirurgia, 
                          Sangramento = :Sangramento, Cicatrizacao = :Cicatrizacao, FaltaAr = :FaltaAr, Gestante = :Gestante, Observacoes = :Observacoes 
                      WHERE ID_Paciente = :ID_Paciente";
            $stmt = $conecta->prepare($texto);
            $stmt->bindParam(':ID_Paciente', $ID_Paciente);
            $stmt->bindParam(':QueixaPrincipal', $QueixaPrincipal);
            $stmt->bindParam(':UsoMedicacao', $UsoMedicacao);
            $stmt->bindParam(':Alergia', $Alergia);
            $stmt->bindParam(':Doencas', $Doencas);
            $stmt->bindParam(':Cirurgia', $Cirurgia);
            $stmt->bindParam(':Sangramento', $Sangramento);
            $stmt->bindParam(':Cicatrizacao', $Cicatrizacao);
            $stmt->bindParam(':FaltaAr', $FaltaAr);
            $stmt->bindParam(':Gestante', $Gestante, PDO::PARAM_INT);
            $stmt->bindParam(':Observacoes', $Observacoes);
            $stmt->execute();
            //echo "Anamnese atualizada com sucesso.";
        } 
        catch (PDOException $e) 
        {
            echo "Erro ao atualizar anamnese: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
    }
}


function conferirExistenciaAnamnese($idPaciente) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $consulta = $conecta->prepare("SELECT * FROM anamnese WHERE id_paciente = :idPaciente");
            $consulta->bindParam(':idPaciente', $idPaciente);
            $consulta->execute();

            if ($consulta->rowCount() > 0) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}

// ... Saude bucal ...



function conferirExistenciaSaudeBucal($ID_Paciente) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $consulta = $conecta->prepare("SELECT * FROM saude_bucal WHERE ID_Paciente = :ID_Paciente");
            $consulta->bindParam(':ID_Paciente', $ID_Paciente);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC) ? true : false;
        } 
        catch (PDOException $e) 
        {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
        return false;
    }
}

function criarSaudeBucal($ID_Paciente, $ReacaoAnestesia, $DorDentes, $DorGengiva, $SangramentoGengiva, $GostoRuimBoca, $BocaSeca, $RangerDentes, $DorMaxilar, $DorOuvido, $UltimoTratamento, $Fumante, $EscovaDentes, $FioDental) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $stmt = $conecta->prepare("INSERT INTO saude_bucal (ID_Paciente, ReacaoAnestesia, DorDentes, DorGengiva, SangramentoGengiva, GostoRuimBoca, BocaSeca, RangerDentes, DorMaxilar, DorOuvido, UltimoTratamento, Fumante, EscovaDentes, FioDental) 
                                       VALUES (:ID_Paciente, :ReacaoAnestesia, :DorDentes, :DorGengiva, :SangramentoGengiva, :GostoRuimBoca, :BocaSeca, :RangerDentes, :DorMaxilar, :DorOuvido, :UltimoTratamento, :Fumante, :EscovaDentes, :FioDental)");
            $stmt->bindParam(':ID_Paciente', $ID_Paciente);
            $stmt->bindParam(':ReacaoAnestesia', $ReacaoAnestesia);
            $stmt->bindParam(':DorDentes', $DorDentes);
            $stmt->bindParam(':DorGengiva', $DorGengiva);
            $stmt->bindParam(':SangramentoGengiva', $SangramentoGengiva);
            $stmt->bindParam(':GostoRuimBoca', $GostoRuimBoca);
            $stmt->bindParam(':BocaSeca', $BocaSeca);
            $stmt->bindParam(':RangerDentes', $RangerDentes);
            $stmt->bindParam(':DorMaxilar', $DorMaxilar);
            $stmt->bindParam(':DorOuvido', $DorOuvido);
            $stmt->bindParam(':UltimoTratamento', $UltimoTratamento);
            $stmt->bindParam(':Fumante', $Fumante);
            $stmt->bindParam(':EscovaDentes', $EscovaDentes);
            $stmt->bindParam(':FioDental', $FioDental);
            $stmt->execute();
        } 
        catch (PDOException $e) 
        {
            echo "Erro ao criar saúde bucal: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
    }
}

function atualizarSaudeBucal($ID_Paciente, $ReacaoAnestesia, $DorDentes, $DorGengiva, $SangramentoGengiva, $GostoRuimBoca, $BocaSeca, $RangerDentes, $DorMaxilar, $DorOuvido, $UltimoTratamento, $Fumante, $EscovaDentes, $FioDental) 
{
    $conecta = conectarBanco();
    if ($conecta) 
    {
        try 
        {
            $stmt = $conecta->prepare("UPDATE saude_bucal SET ReacaoAnestesia = :ReacaoAnestesia, DorDentes = :DorDentes, DorGengiva = :DorGengiva, SangramentoGengiva = :SangramentoGengiva, GostoRuimBoca = :GostoRuimBoca, BocaSeca = :BocaSeca, RangerDentes = :RangerDentes, DorMaxilar = :DorMaxilar, DorOuvido = :DorOuvido, UltimoTratamento = :UltimoTratamento, Fumante = :Fumante, EscovaDentes = :EscovaDentes, FioDental = :FioDental
                                       WHERE ID_Paciente = :ID_Paciente");
            $stmt->bindParam(':ID_Paciente', $ID_Paciente);
            $stmt->bindParam(':ReacaoAnestesia', $ReacaoAnestesia);
            $stmt->bindParam(':DorDentes', $DorDentes);
            $stmt->bindParam(':DorGengiva', $DorGengiva);
            $stmt->bindParam(':SangramentoGengiva', $SangramentoGengiva);
            $stmt->bindParam(':GostoRuimBoca', $GostoRuimBoca);
            $stmt->bindParam(':BocaSeca', $BocaSeca);
            $stmt->bindParam(':RangerDentes', $RangerDentes);
            $stmt->bindParam(':DorMaxilar', $DorMaxilar);
            $stmt->bindParam(':DorOuvido', $DorOuvido);
            $stmt->bindParam(':UltimoTratamento', $UltimoTratamento);
            $stmt->bindParam(':Fumante', $Fumante);
            $stmt->bindParam(':EscovaDentes', $EscovaDentes);
            $stmt->bindParam(':FioDental', $FioDental);
            $stmt->execute();
        } 
        catch (PDOException $e) 
        {
            echo "Erro ao atualizar saúde bucal: " . $e->getMessage();
        }
    } 
    else 
    {
        echo "Falha na conexão com o banco de dados.";
    }
}

?>
