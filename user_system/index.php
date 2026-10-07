<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: mybrand.php");
    exit();
}
$mode = ($_GET['mode'] ?? '') === 'login' ? 'login' : 'signup';
$message = $_SESSION['auth_message'] ?? '';
unset($_SESSION['auth_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
  <meta name="theme-color" content="#0b111e">
  <title>Access Code With Me</title>
    <style>
    :root {
      color-scheme: dark;
      --ink: #e9f5fb;
      --muted: #9bb0c2;
      --cyan: #00d2ff;
      --panel: #101a2a;
      --line: #26394f;
        }
    * { box-sizing: border-box; }
    body {
      min-height: 100vh;
      margin: 0;
      background-color: #0b111e;
      background-image: radial-gradient(ellipse at 18% 22%, rgba(0, 210, 255, .12), transparent 34%), linear-gradient(135deg, transparent 0 72%, rgba(52, 137, 142, .08) 72% 72.2%, transparent 72.2%);
      color: var(--ink);
      font-family: "Trebuchet MS", "Lucida Sans Unicode", sans-serif;
    }
    .auth-shell { min-height: 100vh; display: grid; grid-template-rows: auto 1fr; }
    .topbar { display: flex; align-items: center; justify-content: space-between; padding: 24px clamp(22px, 7vw, 96px); }
    .wordmark { color: var(--ink); font-size: 18px; font-weight: 800; text-decoration: none; }
    .wordmark span { color: var(--cyan); }
    .topbar-note { color: var(--muted); font-size: 13px; }
    .auth-layout { width: min(1060px, calc(100% - 40px)); margin: 20px auto 70px; display: grid; grid-template-columns: 1fr minmax(340px, 430px); align-items: center; gap: clamp(36px, 8vw, 112px); }
    .intro { padding: 20px 0; }
    .eyebrow { margin: 0 0 18px; color: var(--cyan); font: 700 12px/1.4 Consolas, monospace; letter-spacing: 2px; text-transform: uppercase; }
    .intro h1 { max-width: 520px; margin: 0; font-size: clamp(42px, 6vw, 68px); line-height: .99; }
    .intro h1 span { color: var(--cyan); }
    .intro-copy { max-width: 420px; margin: 24px 0 0; color: var(--muted); font-size: 16px; line-height: 1.7; }
    .code-mark { margin-top: 42px; color: #6d879d; font: 14px Consolas, monospace; }
    .code-mark strong { color: var(--cyan); font-weight: 400; }
    .auth-panel { padding: 32px; border: 1px solid var(--line); border-radius: 10px; background: rgba(16, 26, 42, .94); box-shadow: 0 24px 70px rgba(0, 0, 0, .25); }
    .auth-panel h2 { margin: 0; font-size: 25px; }
    .panel-copy { margin: 9px 0 22px; color: var(--muted); font-size: 13px; line-height: 1.6; }
    .mode-tabs { display: grid; grid-template-columns: 1fr 1fr; gap: 4px; margin: 0 0 24px; padding: 4px; border: 1px solid #203148; border-radius: 7px; background: #0b1422; }
    .mode-tabs a { padding: 10px 8px; border-radius: 4px; color: var(--muted); font-size: 13px; text-align: center; text-decoration: none; }
    .mode-tabs a[aria-current="page"] { background: #183047; color: var(--cyan); }
    .message { margin: 0 0 18px; padding: 11px 12px; border: 1px solid rgba(0, 210, 255, .28); border-radius: 5px; background: rgba(0, 210, 255, .07); color: #bfefff; font-size: 13px; line-height: 1.5; }
    .field { margin: 0 0 16px; }
    .field label { display: block; margin-bottom: 7px; color: #dce9f2; font-size: 12px; font-weight: 700; }
    .field input { width: 100%; height: 44px; padding: 0 12px; border: 1px solid #31445a; border-radius: 5px; outline: none; background: #0a1320; color: var(--ink); font: inherit; font-size: 14px; }
    .field input:focus { border-color: var(--cyan); box-shadow: 0 0 0 3px rgba(0, 210, 255, .12); }
    .submit-button { width: 100%; min-height: 46px; margin-top: 5px; border: 0; border-radius: 5px; background: var(--cyan); color: #06121c; cursor: pointer; font: 800 14px "Trebuchet MS", sans-serif; }
    .submit-button:hover { background: #63e4ff; }
    .terms { margin: 17px 0 0; color: #8196a9; font-size: 11px; line-height: 1.6; text-align: center; }
    @media (max-width: 760px) {
      .topbar { padding: 20px; }
      .topbar-note { font-size: 11px; }
      .auth-layout { width: min(460px, calc(100% - 32px)); margin: 8px auto 38px; grid-template-columns: 1fr; gap: 20px; }
      .intro { padding: 16px 0 0; }
      .intro h1 { font-size: clamp(38px, 12vw, 54px); }
      .intro-copy { margin-top: 14px; font-size: 14px; }
      .code-mark { display: none; }
      .auth-panel { padding: 24px; }
    }
    </style>
</head>
<body>
  <div class="auth-shell">
    <header class="topbar">
      <a class="wordmark" href="index.php"><span>&lt;/&gt;</span> CODE WITH ME</a>
      <span class="topbar-note">Interactive online school</span>
    </header>
    <main class="auth-layout">
      <section class="intro">
        <p class="eyebrow">Learn by building</p>
        <h1>Write code.<br><span>Make it live.</span></h1>
        <p class="intro-copy">Your workspace for HTML, CSS, JavaScript, and hands-on web development lessons starts here.</p>
        <p class="code-mark"><strong>&lt;code&gt;</strong> your next idea <strong>&lt;/code&gt;</strong></p>
      </section>
      <section class="auth-panel" aria-labelledby="form-title">
        <h2 id="form-title"><?= $mode === 'signup' ? 'Create your account' : 'Welcome back' ?></h2>
        <p class="panel-copy"><?= $mode === 'signup' ? 'Join the learning space and start building.' : 'Log in to continue to your learning space.' ?></p>
        <nav class="mode-tabs" aria-label="Account options">
          <a href="index.php?mode=signup" <?= $mode === 'signup' ? 'aria-current="page"' : '' ?>>Create account</a>
          <a href="index.php?mode=login" <?= $mode === 'login' ? 'aria-current="page"' : '' ?>>Log in</a>
        </nav>
        <?php if ($message !== ''): ?>
          <p class="message" role="status"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <?php if ($mode === 'signup'): ?>
          <form action="process.php" method="POST">
            <input type="hidden" name="action" value="signup">
            <div class="field">
              <label for="reg-username">Username</label>
              <input type="text" id="reg-username" name="username" autocomplete="username" minlength="3" maxlength="50" required>
            </div>
            <div class="field">
              <label for="reg-email">Email address</label>
              <input type="email" id="reg-email" name="email" autocomplete="email" maxlength="254" required>
            </div>
            <div class="field">
              <label for="reg-password">Password</label>
              <input type="password" id="reg-password" name="password" autocomplete="new-password" minlength="8" required>
            </div>
            <button class="submit-button" type="submit">Create account</button>
          </form>
          <p class="terms">Already registered? <a href="index.php?mode=login" style="color: var(--cyan)">Log in</a></p>
        <?php else: ?>
          <form action="process.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="field">
              <label for="login-username">Username or email</label>
              <input type="text" id="login-username" name="username" autocomplete="username" required>
            </div>
            <div class="field">
              <label for="login-password">Password</label>
              <input type="password" id="login-password" name="password" autocomplete="current-password" required>
            </div>
            <button class="submit-button" type="submit">Log in to your account</button>
          </form>
          <p class="terms">New here? <a href="index.php?mode=signup" style="color: var(--cyan)">Create an account</a></p>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>
</html>
