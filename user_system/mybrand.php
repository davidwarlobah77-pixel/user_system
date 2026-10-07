<?php
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="stylesheet" href="mybrand.css">
    <title>Code With Me</title>
</head>
<body>
    <div class="scroll-tracker"></div>
    <h2 class="header1">&lt;</h2>
    <h2 class="header2">/&gt;</h2>

    <div class="highlighters">
        <span class="highlight2">CODE</span>
        <span class="highlight">WITH</span>
        <span class="highlight3">ME</span>
    </div>

    <img src="logo.png" alt="Code With Me logo">
    <nav class="navbar" aria-label="Main navigation">
        <a href="mybrand.php">Home</a>
        <a href="mybrandAbout.php">About</a>
        <a href="mybrandCourses.php">Courses</a>
        <a href="mybrandContact.php">Contact</a>
        <a href="mybrandcodelive.php">Code Live!!</a>
    </nav>

    <nav class="sign" aria-label="Account">
        <span>Hi, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></span>
        <a href="logout.php">Log out</a>
    </nav>

    <main>
        <section class="content">
            <h5 class="title1">INTERACTIVE ONLINE SCHOOL</h5>
            <h2 class="title2">Don't Just Write Code. Write It Live.</h2>
            <p class="title3">Master HTML5, CSS3, layout design, and local databases through bite-sized videos and real-time coding exercises.</p>
            <div class="courses"><a href="mybrandCourses.php"><h3>Explore Courses</h3></a></div>
        </section>

        <h4 class="page">CODE LEARNING MODULES (HTML, CSS, JAVASCRIPT, LOCAL DATABASE)</h4>
        <section class="setup">
            <h5>1. HTML5 MARKUP</h5>
            <p>Master document structures, semantic tags, forms, tables, and web accessibility standards.</p>
        </section>
        <section class="start">
            <h5>2. CSS3 &amp; FLEXBOX LAYOUTS</h5>
            <p>Learn custom styling, responsive media queries, Flexbox alignment, and modern CSS Grid.</p>
        </section>
        <section class="browser">
            <h5>3. JAVASCRIPT</h5>
            <p>Learn how JavaScript makes web pages interactive, from simple behaviors to dynamic interfaces.</p>
        </section>
    </main>

    <script src="mytechbrandsite.js"></script>
</body>
</html>
