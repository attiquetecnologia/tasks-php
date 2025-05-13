<?php
require_once 'config.php';

/* Leia esse artigo para saber mais: https://www.devmedia.com.br/diferenca-entre-os-patterns-po-pojo-bo-dto-e-vo/28162

Arquivo tarefasDB.php contendo funções de banco de dados
Para usar este CRUD:

Crie um banco de dados MySQL com o nome que você definiu em config.php.
Crie uma tabela (por exemplo, usuarios) com uma coluna id (INT, PRIMARY KEY, AUTO_INCREMENT) e outras colunas que você deseja manipular (por exemplo, nome VARCHAR, email VARCHAR).
Salve o arquivo de configuração como config.php e o arquivo com as funções CRUD como crud.php no seu servidor web.
Acesse crud.php através do seu navegador para ver os exemplos de uso em ação.
Lembre-se de adaptar os nomes da tabela e das colunas para o seu caso específico. Este é um exemplo básico, e você pode expandi-lo com funcionalidades como tratamento de erros mais detalhado, paginação para a listagem, validação de dados, etc.

Se tiver alguma dúvida ou precisar de alguma modificação, me diga!
*/

/*
Recebe o nome da tabela e um array associativo $dados onde as chaves são os nomes das colunas e os valores são os dados a serem inseridos.
Cria uma string com os nomes das colunas e outra com os placeholders (:nome_da_coluna).
Prepara a query SQL de INSERT.
Executa a query, passando o array $dados para associar os valores aos placeholders, prevenindo SQL injection.
Retorna true em caso de sucesso e false em caso de erro.
*/
function create($tabela, $dados) {
    global $pdo; // variável global importada do conexao.php
    $campos = implode(", ", array_keys($dados));
    $valores = ":" . implode(", :", array_keys($dados));
    $sql = "INSERT INTO $tabela ($campos) VALUES ($valores)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($dados);
}

/*
Recebe o nome da tabela e o $id do registro a ser lido.
Prepara a query SQL de SELECT com uma cláusula WHERE para buscar pelo id.
Faz o bind do parâmetro :id com o valor fornecido, utilizando PDO::PARAM_INT para garantir que seja tratado como um inteiro.
Executa a query e retorna a primeira linha encontrada como um array associativo (PDO::FETCH_ASSOC).
*/
function read($tabela, $id) {
    global $pdo;
    $sql = "SELECT * FROM $tabela WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/*
Recebe o nome da tabela, o $id do registro a ser atualizado e um array associativo $dados com os novos valores.
Cria dinamicamente a parte da query SET com os nomes das colunas e seus respectivos placeholders.
Prepara a query SQL de UPDATE com a cláusula WHERE para identificar o registro pelo id.
Adiciona o $id ao array $dados para ser usado no bind do placeholder :id.
Executa a query, passando o array $dados.
Retorna true em caso de sucesso e false em caso de erro.
*/
function update($tabela, $id, $dados) {
    global $pdo;
    $campos = "";
    foreach (array_keys($dados) as $campo) {
        $campos .= "$campo = :$campo, ";
    }
    $campos = rtrim($campos, ", ");
    $sql = "UPDATE $tabela SET $campos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $dados['id'] = $id;
    return $stmt->execute($dados);
}

/*
Recebe o nome da tabela e o $id do registro a ser deletado.
Prepara a query SQL de DELETE com uma cláusula WHERE para identificar o registro pelo id.
Faz o bind do parâmetro :id com o valor fornecido.
Executa a query.
Retorna true em caso de sucesso e false em caso de erro.
*/
function delete($tabela, $id) {
    global $pdo;
    $sql = "DELETE FROM $tabela WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/*
Recebe o nome da tabela.
Prepara uma query SQL de SELECT para buscar todos os registros da tabela.
Executa a query e retorna todos os resultados como um array de arrays associativos (PDO::FETCH_ASSOC).
*/
function listAll($tabela) {
    global $pdo;
    $sql = "SELECT * FROM $tabela";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Exemplos de uso:

// Criar um novo registro na tabela 'usuarios'
$novoUsuario = ['nome' => 'João Silva', 'email' => 'joao@email.com'];
if (create('usuarios', $novoUsuario)) {
    echo "Usuário criado com sucesso!<br>";
} else {
    echo "Erro ao criar usuário.<br>";
}

// Ler um registro da tabela 'usuarios' com ID 1
$usuario = read('usuarios', 1);
if ($usuario) {
    echo "Dados do usuário com ID 1: ";
    print_r($usuario);
    echo "<br>";
} else {
    echo "Usuário com ID 1 não encontrado.<br>";
}

// Atualizar o registro com ID 1 na tabela 'usuarios'
$atualizarUsuario = ['nome' => 'João da Silva', 'email' => 'joao.silva@email.com'];
if (update('usuarios', 1, $atualizarUsuario)) {
    echo "Usuário atualizado com sucesso!<br>";
} else {
    echo "Erro ao atualizar usuário.<br>";
}

// Listar todos os registros da tabela 'usuarios'
$usuarios = listAll('usuarios');
if ($usuarios) {
    echo "Lista de usuários:<br>";
    print_r($usuarios);
    echo "<br>";
} else {
    echo "Nenhum usuário encontrado.<br>";
}

// Deletar o registro com ID 1 da tabela 'usuarios'
if (delete('usuarios', 1)) {
    echo "Usuário deletado com sucesso!<br>";
} else {
    echo "Erro ao deletar usuário.<br>";
}
?>