<?php include('header.php'); ?>

<main>
    <h1>Lista de tarefas</h1>
    <table border="1" width="100%">
    <tr>
        <th>#ID</th><th>Nome</th><th>Previsão</th><th>Ações</th>
    </tr>
    <?php
    // Lista de tarefas simulada
    $tarefas = [
        ["id" => 1, "nome" => "Comprar mantimentos", "previsao" => "2025-04-02"],
        ["id" => 2, "nome" => "Estudar PHP", "previsao" => "2025-04-03"],
        ["id" => 3, "nome" => "Revisar código", "previsao" => "2025-04-05"],
        ["id" => 4, "nome" => "Enviar relatório", "previsao" => "2025-04-06"],
        ["id" => 5, "nome" => "Marcar reunião", "previsao" => "2025-04-07"]
    ];

    // Iteração da lista
    foreach ($tarefas as $tarefa) {
        echo "<tr>
                <td>#{$tarefa['id']}</td>
                <td>{$tarefa['nome']}</td>
                <td>{$tarefa['previsao']}</td>
                <td><a href='editar.php?id={$tarefa['id']}'>Editar</a> | <a href='deletar.php?id={$tarefa['id']}'>Excluir</a></td>
              </tr>";
    }
    ?>
</table>

</main>

<php? include 'footer.php' ?>