<!doctype html>
<html lang="en">
<?php
// Define page-specific metadata consumed by the reusable head partial.
$pageTitle = 'About Me | Web Developer Portfolio';
$pageDescription = 'Learn more about my background, technical skills, and approach to building clean, responsive websites.';
// Pull in shared <head> content (title, meta description, and CSS include).
include __DIR__ . '/includes/head.php';
?>
<body>
    <!-- Render the global navigation so users can move between sections consistently. -->
    <?php include __DIR__ . '/includes/nav.php'; ?>
    <!-- Main informational copy for the About page. -->
    <main class="info">
        <h1>About Me</h1>
        <p>
            I'm a passionate web developer with a strong focus on building clean,
            responsive, and user-friendly websites. I enjoy turning complex problems
            into simple, elegant solutions using modern web technologies.
        </p>

        <p>
            With experience in HTML, CSS, JavaScript, and modern frameworks, I focus on
            writing maintainable code that performs well across devices and browsers.
            I care deeply about accessibility, performance, and thoughtful design.
        </p>

        <p>
            When I'm not coding, I'm constantly learning new tools, refining my skills,
            and exploring ways to improve both user experience and development workflows.
        </p>
    </main>
    <!-- Load shared JavaScript bundle(s) used by navigation and interactive UI components. -->
    <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
