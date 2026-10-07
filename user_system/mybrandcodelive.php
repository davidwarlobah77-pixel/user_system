<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <link rel="stylesheet" href="mybrandcodelive.css">
    <title>Student Code Sandbox</title>
</head>
<body>
    <a href="mybrand.php">Go Back</a>
    <header>
        <h1>Code Sandbox Workspace</h1>
        <button id="run-btn">Execute Code</button>
    </header>
    <div class="workspace">
        <main class="editor-container">
            <div class="code-box">
                <div class="label">HTML (Structure)</div>
                <textarea id="html-code" placeholder="Enter HTML elements here..."><h1>Hello World!</h1>&#10;<p>Type some structural elements to begin editing.</p></textarea>
            </div>
            <div class="code-box">
                <div class="label">CSS (Styling)</div>
                <textarea id="css-code" placeholder="Enter custom style rules here...">h1 {&#10;  color: #38bdf8;&#10;}&#10;p {&#10;  font-size: 18px;&#10;}</textarea>
            </div>
            <div class="code-box">
                <div class="label">JavaScript (Behavior)</div>
                <textarea id="js-code" placeholder="Enter dynamic script behaviors here...">console.log("The runtime preview loaded correctly!");</textarea>
            </div>
        </main>
        <section class="preview-container">
            <iframe id="preview-frame" title="Code preview"></iframe>
        </section>
    </div>
    <script src="mybrandcodelive.js"></script>
</body>
</html>