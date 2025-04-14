document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("dark-mode-toggle");
  const body = document.body;

  // Cek jika sebelumnya dark mode aktif
  if (localStorage.getItem("theme") === "dark") {
    body.classList.add("dark-mode");
    if (toggleButton) toggleButton.textContent = "☀️";
  } else {
    if (toggleButton) toggleButton.textContent = "🌙";
  }

  // Event toggle button
  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      body.classList.toggle("dark-mode");

      if (body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
        toggleButton.textContent = "☀️";
      } else {
        localStorage.setItem("theme", "light");
        toggleButton.textContent = "🌙";
      }
    });
  }
});
