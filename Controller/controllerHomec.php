<?php 
require_once '../model/modelHome.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $nome = $_POST['nome'];  
    $email = $_POST['email'];  
    $senha = $_POST['senha'];
    $senhaRepetida = $_POST['senhaRepetida'];

    $email = strtolower($email);

    error_log("nome: " . $nome);
    error_log("email: " . $email);
    error_log("senha: " . $senha);
    error_log("senhaRepetida: " . $senhaRepetida);

    $erros = [];

    // Verifica se o nome foi preenchido e tem menos de 255 caracteres
    if (empty($nome) || strlen($nome) > 255) 
    {
        $erros['nome'] = "Nome deve ser preenchido e ter no máximo 255 caracteres.";
    }

    // Verifica se o email foi preenchido e é válido
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $erros['email'] = "Email inválido.";
    } 
    elseif (ConferirEmailBancoDeDados($email)) 
    {
        $erros['email'] = "Email já cadastrado.";
    }

   // Verifica se as senhas foram preenchidas e são válidas
    if (empty($senha)) 
    {
        $erros['senha'] = "Senha não pode ser vazia.";
    } 
    elseif ($senha !== $senhaRepetida) 
    {
        $erros['senhaRepetida'] = "As senhas não coincidem.";
    } 
    else 
    {
    // Inicializa um array para armazenar os requisitos faltantes
    $requisitosFaltantes = array();

    if (strlen($senha) < 8) 
    {
        $requisitosFaltantes[] = " pelo menos 8 caracteres."."\n";
    }

    if (strlen($senha) > 60) {
        $requisitosFaltantes[] = "Usar no máximo 60 caracteres.";
    }
 
    if (!preg_match('/[A-Z]/', $senha)) 
    {
        $requisitosFaltantes[] = "uma letra maiúscula."."\n";
    }

    if (!preg_match('/[a-z]/', $senha)) 
    {
        $requisitosFaltantes[] = "uma letra minúscula."."\n";
    }

    if (!preg_match('/\d/', $senha)) 
    {
        $requisitosFaltantes[] = "um número.";
    }

    if (!preg_match('/[\W_]/', $senha)) 
    { // Verifica se há pelo menos um caractere especial
        $requisitosFaltantes[] = "um caractere especial.";
    }

    // Se houver requisitos faltantes, adicionar ao array de erros
    if (!empty($requisitosFaltantes)) 
    {
        $erros['senha'] = "Senha inválida. Você precisa adicionar:\n" . implode("\n", $requisitosFaltantes);
    }
}


    // Se não houver erros, cria a clínica
    if (empty($erros)) 
    {
        echo json_encode(["status" => "cadastro_aceito"]);
        CriarClinica($nome, $email, $senha);
        exit;
    } 
    else 
    {
        echo json_encode(["status" => "erro", "erros" => $erros]);
        exit;
    }
}
?>
