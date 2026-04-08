<head>
    <!-- Basic document metadata and responsive viewport configuration. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Escape page variables to avoid HTML injection in metadata/title contexts. -->
    <title><?= htmlspecialchars($pageTitle ?? 'Web Developer Portfolio', ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription ?? 'Portfolio website showcasing web development projects, coding examples, and professional background.', ENT_QUOTES, 'UTF-8'); ?>">
    <!-- Global stylesheet for shared site layout and component styling. -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
