document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const loader = document.getElementById("loader");
    const messageField = document.getElementById("message");
    const charCount = document.getElementById("charCount");
    const maxChars = 300;
  
    // Validasi form
    function validateForm() {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const message = messageField.value.trim();
  
      if (name === "" || email === "" || message === "") {
        alert("Semua kolom harus diisi!");
        return false;
      }
  
      const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!email.match(emailPattern)) {
        alert("Masukkan email yang valid!");
        return false;
      }
  
      if (message.length > maxChars) {
        alert(`Pesan tidak boleh lebih dari ${maxChars} karakter!`);
        return false;
      }
  
      return true;
    }
  
    // Event submit
    form.addEventListener("submit", function (e) {
      e.preventDefault();
  
      if (!validateForm()) return;
  
      loader.classList.remove("hidden");
  
      setTimeout(() => {
        loader.classList.add("hidden");
        form.innerHTML = `<p>Terima kasih telah menghubungi saya! Pesan Anda telah terkirim.</p>`;
        form.style.textAlign = "center";
      }, 1500);
    });
  
    // Karakter Count
    messageField.addEventListener("input", function () {
      const count = messageField.value.length;
      charCount.textContent = `${count} / ${maxChars} karakter`;
  
      if (count > maxChars) {
        charCount.style.color = "red";
      } else {
        charCount.style.color = "#666";
      }
    });
  });
  