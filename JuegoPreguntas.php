<?php
session_start();

// Cargar las preguntas desde el archivo questions.php
require 'questions.php';

// Inicializar la sesión si es la primera visita
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
    $_SESSION['previous_statement'] = null;
    $_SESSION['previous_answer'] = null;
    $_SESSION['is_correct'] = null;
}

// Seleccionar una nueva pregunta si es una nueva solicitud
if (!isset($_SESSION['current_question']) || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['current_question'] = $questions[array_rand($questions)];
    $_SESSION['answers'] = $_SESSION['current_question']['answers'];
    shuffle($_SESSION['answers']); // Barajar las respuestas
}

$current_question = $_SESSION['current_question'];
$answers = $_SESSION['answers'];

// Procesar la respuesta del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $selected_answer = $_POST['answer'];
    $correct_answer = $current_question['answers'][0];

    $_SESSION['previous_statement'] = $current_question['statement'];
    $_SESSION['previous_answer'] = $selected_answer;
    $_SESSION['is_correct'] = $selected_answer === $correct_answer;

    if ($_SESSION['is_correct']) {
        $_SESSION['score']++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Juego de Preguntas</title>
</head>
<body>
    <h1>Juego de Preguntas</h1>

    <?php if ($_SESSION['previous_statement']): ?>
        <section>
            <h2>Pregunta Anterior</h2>
            <p><strong>Pregunta:</strong> <?= htmlspecialchars($_SESSION['previous_statement']) ?></p>
            <p><strong>Tu respuesta:</strong> <?= htmlspecialchars($_SESSION['previous_answer']) ?></p>
            <p><strong>Resultado:</strong> 
                <span style="color: <?= $_SESSION['is_correct'] ? 'green' : 'red' ?>;">
                    <?= $_SESSION['is_correct'] ? 'Correcta' : 'Incorrecta' ?>
                </span>
            </p>
        </section>
    <?php endif; ?>

    <section>
        <h2>Puntuación: <?= $_SESSION['score'] ?></h2>
    </section>

    <section>
        <h2><?= htmlspecialchars($current_question['statement']) ?></h2>
        <form method="POST">
            <?php foreach ($answers as $answer): ?>
                <label>
                    <input type="radio" name="answer" value="<?= htmlspecialchars($answer) ?>">
                    <?= htmlspecialchars($answer) ?>
                </label><br>
            <?php endforeach; ?>
            <button type="submit">Responder</button>
        </form>
    </section>
</body>
</html>
