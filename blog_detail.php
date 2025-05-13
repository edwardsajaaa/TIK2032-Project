<?php
include 'db.php';

// Cek apakah ID ada di URL
if (!isset($_GET['id'])) {
  die("ID artikel tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Ambil data artikel berdasarkan ID
$query = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $query);

// Cek apakah artikel ditemukan
if (mysqli_num_rows($result) === 0) {
  die("Artikel tidak ditemukan.");
}

$artikel = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($artikel['title']) ?></title>
  <link rel="stylesheet" href="blog.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet" />
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
          <li><a href="blog.php" class="active">Blog</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Artikel Detail -->
  <main>
    <section id="blog" style="margin-top: 2em;">
      <article class="blog-post fade-in">
        <h2><?= htmlspecialchars($artikel['title']) ?></h2>
        <div>
          <img src="<?= htmlspecialchars($artikel['image']) ?>" alt="" />
        </div>
        <p><?= nl2br(htmlspecialchars($artikel['content'])) ?></p>
        <a href="blog.php" style="display: inline-block; margin-top: 2em;">← Kembali ke Blog</a>
      </article>
    </section>
  </main>

  <!-- Include theme.js untuk dark mode -->
  <script src="theme.js"></script>
</body>
</html>
