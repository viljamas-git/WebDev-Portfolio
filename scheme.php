<!doctype html>
<html lang="en">
<?php
// Metadata for the SCS information page.
$pageTitle = 'SCS Scheme | Web Developer Portfolio';
$pageDescription = 'Overview of the Scion Coalition Scheme, Treehouse progress, and background information about Netmatters.';
// Include shared head partial with escaped dynamic title/description.
include __DIR__ . '/includes/head.php';
?>
<body>
    <!-- Keep top-level navigation consistent across all content pages. -->
    <?php include __DIR__ . '/includes/nav.php'; ?>
    <!-- Informational content describing the scheme and related background. -->
    <main class="info">
        <h1>Scion Coalition Scheme</h1>
        <p>
            The Scion Coalition Scheme is an intensive, specially tailored training
            program run by Netmatters to give willing candidates the opportunity to
            enter the industry as web developers.
        </p>
        <p>
            Under the supervision of senior web developers, scions generally aim to
            complete training within six to nine months. The course is intensive and
            the level of learning achieved is extensive in a short space of time.
        </p>
        <h2>Treehouse</h2>
        <p>
            Treehouse is an online learning community featuring videos that cover
            topics from basic HTML to C# programming, iOS development, data analysis,
            and more.
        </p>
        <p>
            By completing courses, users earn points that help track progress and
            show how much they have covered in each area.
        </p>
        <p>
            Track: <a href="https://teamtreehouse.com/xxxxx" rel="noopener noreferrer">teamtreehouse.com/xxxxx</a>
        </p>
        <h2>About Netmatters</h2>
        <ul>
            <li>Established in 2008.</li>
            <li>Norfolk's leading technology company.</li>
            <li>Winner of the Princess Royal Training Award.</li>
            <li>Winner of EDP Skills of Tomorrow Award.</li>
            <li>80+ staff and 2 locations across Norfolk.</li>
            <li>Digital marketing, website and software development, and IT support.</li>
            <li>Broad spectrum of clients, working nationwide.</li>
            <li>Operates to strict company values.</li>
        </ul>
    </main>
    <!-- Shared frontend scripts loaded at the end for improved load performance. -->
    <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
