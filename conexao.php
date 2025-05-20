<?php
// Troque por uma conexão mysql
$dbPath = 'meu_banco.db';

try {
    // Troque por uma conexão mysql
    $pdo = new PDO("sqlite:$dbPath");
    
    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Troque por SQLnativo do Mysql
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT,
        email TEXT
    )");

    // 1-Inserção de dados
    /* Crie a instrução para inserir dados na tabela usuário */    
    
    // 2-Apagar Dados
    /* Crie a instrução para excluir dados na tabela usuário */    
    
    // 3-Atualizar dados
    // Crie a string sql para o execute abaixo
    $stmt = $pdo->prepare("?????????");
    $stmt->execute([
        ':nome' => 'Carlos Manuel',
        ':email' => 'carlos@example.com'
    ]);

    // Leitura dos dados
    /* Corrija o bug no código */
    $stmt = $pdo->query("SELECT * FROM ????");
    // $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['nome']} - Email: {$usuario['email']}<br>";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>