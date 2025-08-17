document.addEventListener("DOMContentLoaded", function () {
  /* SLIDER DE PRODUCTOS */
  const images = document.querySelectorAll(".product-img");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");
  let current = 0;

  function showSlide(index) {
      images.forEach((img, i) => {
          img.classList.remove("active");
          if (i === index) img.classList.add("active");
      });
  }

  if (prevBtn) {
      prevBtn.addEventListener("click", () => {
          current = (current - 1 + images.length) % images.length;
          showSlide(current);
      });
  }

  if (nextBtn) {
      nextBtn.addEventListener("click", () => {
          current = (current + 1) % images.length;
          showSlide(current);
      });
  }

  if (images.length > 0) {
      showSlide(current);
  }

  /* DISEÑO DE BOTÓN LOGIN */
  const btnSignIn = document.getElementById('btnSignIn');
  if (btnSignIn) {
      btnSignIn.addEventListener('click', function (e) {
          const form = document.getElementById('loginForm');
          form.submit();
          const btn = e.currentTarget;
          const spinner = btn.querySelector('.spinner-border');
          const btnText = btn.querySelector('.btn-text');
          btn.disabled = true;
          if (spinner) spinner.classList.remove('d-none');
          if (btnText) btnText.textContent = 'Signing In...';
          setTimeout(() => {
              btn.disabled = false;
              if (spinner) spinner.classList.add('d-none');
              if (btnText) btnText.textContent = 'Sign In';
          }, 2000);
      });
  }

  /* PREFIJO DE PAISES */
  const countrySelect = document.getElementById('country');
  if (countrySelect) {
      countrySelect.addEventListener('change', () => {
          const selectedOption = countrySelect.options[countrySelect.selectedIndex];
          const code = selectedOption.getAttribute('data-code') || '+1';
          const phonePrefix = document.getElementById('phonePrefix');
          if (phonePrefix) {
              phonePrefix.textContent = code;
          }
      });
  }

  /* BOTÓN REGISTRO */
  const btnRegister = document.getElementById('btnRegister');
  if (btnRegister) {
      btnRegister.addEventListener('click', function (e) {
          const form = document.getElementById('registerForm');
          form.submit();
          const btn = e.currentTarget;
          const spinner = btn.querySelector('.spinner-border');
          const btnText = btn.querySelector('.btn-text');
          btn.disabled = true;
          if (spinner) spinner.classList.remove('d-none');
          if (btnText) btnText.textContent = 'Loading...';
          setTimeout(() => {
              btn.disabled = false;
              if (spinner) spinner.classList.add('d-none');
              if (btnText) btnText.textContent = 'Register';
          }, 2000);
      });
  }

  /* SELECCIÓN DENTRO WHOLESALE */
  const items = document.querySelectorAll("#menuList .list-group-item");
  if (items.length > 0) {
      items.forEach(item => {
          item.addEventListener("click", function () {
              items.forEach(i => i.classList.remove("active"));
              this.classList.add("active");
          });
      });
  }
});
