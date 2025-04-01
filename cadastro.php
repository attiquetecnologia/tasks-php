

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
</head>
<body>
    <?php require 'menu.php'; ?>
    <h1>Tela de Cadastro</h1>
    <form method="get">
        <label>Nome da tarefa</label>
        <input type="text" name="tarefa_nome" placeholder="Nome da Tarefa"/>
        <br>
        <label>Previsao</label>
        <input type="datetime-local" name="tarefa_previsao" placeholder="Previsão"/>
        <br>
        <label>Nome da tarefa</label>
        <textarea name="tarefa_previsao" ></textarea>
        <br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>