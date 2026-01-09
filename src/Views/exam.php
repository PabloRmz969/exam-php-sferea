<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/styles.css">


    <title><?= htmlspecialchars($title ?? 'Examen Sferea') ?></title>
</head>

<body>
    <h1><?= htmlspecialchars($title ?? 'Examen Sferea') ?></h1>

    <?php if (!empty($topics)): ?>
        <?php foreach ($topics as $t): ?>
            <div class="card">
                <h2><?= htmlspecialchars($t["title"]) ?></h2>
                <p><?= htmlspecialchars($t["def"]) ?></p>
                <p><b>Código:</b></p>
                <pre><?= htmlspecialchars($t["code"]) ?></pre>
                <p><a href="/run?e=<?= urlencode($t["id"]) ?>">Ejecutar</a></p>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p>No hay temas cargados.</p>
    <?php endif; ?>
</body>

</html>