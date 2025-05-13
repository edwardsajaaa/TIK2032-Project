<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'db.php'; // koneksi database

$success = "";
$error = "";

// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST["name"]);
    $email   = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        $error = "Semua kolom harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid.";
    } else {
        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Pesan berhasil dikirim dan disimpan!";
                // Reset form values
                $name = $email = $message = "";
            } else {
                $error = "Gagal menyimpan ke database: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "Prepare statement gagal: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="contact.css" />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Header -->
  <header class="main-header fade-in fade-delay-1">
    <div class="container">
        <button id="dark-mode-toggle" class="dark-toggle">🌙</button>
        <div class="logo">
            <h1>Edward<span class="dot">.</span></h1>
            <p class="tagline">Developer | Maker | Mahasiswa</p>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
        </nav>
    </div>
  </header>

  <!-- Main -->
  <main>
    <section id="contact" class="fade-in fade-delay-2">
      <h2>Hubungi Saya</h2>
      <p>Silakan isi formulir di bawah ini untuk menghubungi saya:</p>

      <!-- Feedback -->
      <?php if (!empty($success)): ?>
        <div class="message success fade-in"><?= $success ?></div>
      <?php elseif (!empty($error)): ?>
        <div class="message error fade-in"><?= $error ?></div>
      <?php endif; ?>

      <!-- Form -->
      <form id="contactForm" action="contact.php" method="post">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required />

        <label for="message">Pesan:</label>
        <textarea id="message" name="message" rows="5" maxlength="300" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
        <div id="charCount">0 / 300 karakter</div>

        <button type="submit">Kirim</button>
      </form>

      <!-- Loader (untuk future JS interaksi) -->
      <div id="loader" class="hidden">Mengirim pesan...</div>
    </section>
  </main>

  <script>
    const messageField = document.getElementById("message");
    const charCount = document.getElementById("charCount");

    messageField.addEventListener("input", function () {
      const count = messageField.value.length;
      charCount.textContent = `${count} / 300 karakter`;
      charCount.style.color = count > 300 ? "red" : "#666";
    });

    // Hitung ulang saat page reload jika sudah diisi
    window.addEventListener("DOMContentLoaded", () => {
      const count = messageField.value.length;
      charCount.textContent = `${count} / 300 karakter`;
    });
  </script>
  <script src="theme.js"></script>
</body>
</html>
