<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Blog</title>
  <link rel="stylesheet" href="blog.css"> <!-- CSS utama untuk blog -->
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>
  <!-- Header -->
  <header class="main-header fade-in fade-delay-1">
    <div class="container">
        <button id="dark-mode-toggle" class="dark-toggle">🌙</button> <!-- Dark Mode Toggle Button -->
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

  <!-- Blog Content -->
  <main>
    <section id="blog">
      <h2>Artikel Terbaru</h2>
      <?php
      $query = "SELECT * FROM posts ORDER BY created_at DESC";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)):
      ?>
        <article class="blog-post fade-in">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <div><img src="<?= htmlspecialchars($row['image']) ?>" alt=""></div>
          <p><?= substr(strip_tags($row['content']), 0, 120) ?>...</p>
          <a href="blog_detail.php?id=<?= $row['id'] ?>">Baca selengkapnya</a>
        </article>
      <?php endwhile; ?>
    </section>
  </main>

  <!-- Panggil theme.js -->
  <script src="theme.js"></script>
</body>
</html>
