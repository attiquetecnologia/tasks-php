<?php
// Caminho para o banco de dados SQLite (pode ser relativo ou absoluto)
$dbPath = 'meu_banco.db';

try {
    // Cria (ou abre) a conexão com o banco de dados SQLite
    $pdo = new PDO("sqlite:$dbPath");
    
    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criação de uma tabela exemplo
    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT,
        email TEXT
    )");

    // Inserção de dados
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:nome, :email)");
    $stmt->execute([
        ':nome' => 'João da Silva',
        ':email' => 'joao@example.com'
    ]);

    // Leitura dos dados
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        echo "ID: {$usuario['id']} - Nome: {$usuario['nome']} - Email: {$usuario['email']}<br>";
    }

} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
}
?>