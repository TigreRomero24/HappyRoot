<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 4 solamente -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="{{ asset('img/logo happy roots_principal.png')}}" type="image/web_icon">
  <link rel="stylesheet" href="{{ asset('css/style.css')}}"> <!-- Tu CSS personalizado -->
  <title>@yield('title')</title>
</head>
<body>

<!-- Header -->
<header class="header-web text-white p-2">
  <div class="container">
    <div class="row align-items-center">

      <!-- Columna 1: Logo -->
      <div class="col-md-3 text-left text-md-left mb-3 mb-md-0">
        <img href="{{ route('index')}}" src="{{ asset('img/logo happy roots_principal.png')}}" alt="Logo CRFarmProducts" class="logo-grande active">
      </div>

      <!-- Columna 2: Menú -->
      <div class="col-md-6 text-center">
        <div class="menu-toggle d-md-none" onclick="document.querySelector('nav').classList.toggle('active')">☰</div>
        <nav class="nav-links">
          <a href="{{ route('index')}}" class="nav-link-custom">home</a>
          <a href="about.html" class="nav-link-custom">about us</a>
          <a href="products.html" class="nav-link-custom">products</a>
          <a href="contact.html" class="nav-link-custom">contact</a>
        </nav>
      </div>

      <!-- Columna 3: My Account -->
      <div class="col-md-3 text-center text-md-right mt-3 mt-md-0">
        <a href="{{ route('dashboard-client.profile')}}" class="text-decoration-none d-inline-flex align-items-center justify-content-center my-account-link">
          <img src="{{ asset('img/login_ico.png')}}" alt="login icon" style="width: 30px; height: 30px;" class="mr-2">
          <span style="font-size: 20px; color: white; letter-spacing: 3px;">my account</span>
        </a>
      </div>

    </div>
  </div>

<div class="frase-barra">
  <div class="frase-slider">
    <span>Crunchy and natural 😋 HappyRoots cassava chips are the perfect snack!</span>
    <span>Craving? 😏 HappyRoots cassava chips are the perfect answer 🥳</span>
    <span>Every bite is pure energy 💥 with HappyRoots cassava chips 😋</span>
    <span>Satisfy your hunger with HappyRoots cassava chips, full of flavor! 🌟</span>
    <span>Snack on HappyRoots cassava chips, packed with crunch and taste! 😍</span>
    
    <!-- Duplicado para efecto continuo -->
    <span>Crunchy and natural 😋 HappyRoots cassava chips are the perfect snack!</span>
    <span>Craving? 😏 HappyRoots cassava chips are the perfect answer 🥳</span>
    <span>Every bite is pure energy 💥 with HappyRoots cassava chips 😋</span>
    <span>Satisfy your hunger with HappyRoots cassava chips, full of flavor! 🌟</span>
    <span>Snack on HappyRoots cassava chips, packed with crunch and taste! 😍</span>
  </div>
</div>

</header>
<body>
<div style="height: 30px;"></div>

 <!-- Espacio de Cuerpo -->

<div class="container-fluid">
     <!-- Columna Izquierda -->
<div class="row">
  <div class="col-sm-3 border rounded shadow p-3 ml-5">
    <div class="row">
            <div class="container my-4">
    <h1 class="container-fluid text-center account-title">Account data</h1>

            <div class="row align-items-center">
                <div class="col-auto text-center">
                    <img src="{{ asset('img/empresas/logo_crfarm.png') }}" alt="Company Logo" width="150" height="150" class="img-fluid border rounded shadow p-2">
                </div>
                <div class="col d-flex justify-content-between align-items-center" style="max-width: 600px;">
                <div>
                    <h5 class="mb-1 mt-3">Company Name: <strong>Happy Roots</strong></h5>
                    <p class="mb-0 mt-3">Email: <a href="mailto:info@happyroots.com">info@happyroots.com</a></p>
                    <div>
                        <a href="{{ route('logout') }}" class="btn btn-danger mt-2">Log Out</a>
                    </div>
                </div>
                
                </div>
            </div>

            <hr style="border: none; height: 2px; background-color: #ccc;">

<div class="container my-4">
  <ul class="list-group" id="menuList">
    <li class="list-group-item {{ Route::is('') ? 'active' : ''}}">
      <i href="orders.html" class="fas fa-shopping-cart mr-2"></i> Orders
            <!-- Indicador justo debajo de Orders -->
      <div class="current-page-indicator">
        <i class="fas fa-arrow-right"></i> New Order
      </div>
    </li>
      <a href="{{ route('client.profile') }}" class="list-group-item {{ Route::is('client.profile') ? 'active' : ''}}">
        <i class="fas fa-user-edit mr-2"></i> Edit My Information
      </a>
    <div   class="list-group-item">
      <i class="fas fa-headset mr-2"></i> Support
    </li>
  </ul>
</div>
            </div>
    </div>
  </div>

    @yield('content')

</body>


      <!-- Footer -->

<div class="container-fluid py-5 " style="background-color: #00D3FF; margin-top: -5px;">
  <div class="row justify-content-center align-items-center text-center text-md-left">

     <!-- Columna 1: Logo (al final visualmente) -->
    <div class="col-md-2 order-md-last">
      <img src="{{ asset('img/logo happy roots_principal.png')}}" 
           alt="Logo" 
           class="img-fluid mx-auto d-block" 
           style="max-width: 225px;">
    </div>

    <!-- Columna 2 -->
    <div class="col-md-2">
      <ul class="list-unstyled mb-0">
        <li><a href="#" class="footer-link">Products</a></li>
        <li><a href="#" class="footer-link">Legal notice</a></li>
      </ul>
    </div>

    <!-- Columna 3 -->
    <div class="col-md-2">
      <ul class="list-unstyled mb-0">
        <li><a href="#" class="footer-link">Contact</a></li>
        <li><a href="#" class="footer-link" style="letter-spacing: 2px;">Terms and conditions</a></li>
      </ul>
    </div>

    <!-- Columna 4 -->
    <div class="col-md-2">
      <ul class="list-unstyled mb-0">
        <li><a href="#" class="footer-link">Privacity</a></li>
        <li><a href="#" class="footer-link">Site map</a></li>
      </ul>
    </div>

    <!-- Columna 5 -->
    <div class="col-md-2">
      <ul class="list-unstyled mb-0">
        <li><a href="#" class="footer-link">My account</a></li>
        <li><a href="#" class="footer-link">Country/region</a></li>
      </ul>
    </div>

   
  </div>

<div id="footer_1" class="row">
  <div class="col-sm-3"></div>
        <div class="col-sm-3" style="margin-left: auto; text-align: right;">
        <img src="{{ asset('img/letsbeafriends.png')}}" alt="Descripción" style="max-width: 20%; height: auto;">
        </div>

  <div class="col-sm-3">
    <h1 id="friends-title">Let's be friends!</h1>

    
<div class="input-group">
  <input 
    type="email" 
    class="form-control col-md-6 col-12" 
    placeholder="Your email"
  >
  <div class="input-group-append">
        <button class="btn subscribe-btn">Subscribe</button>
  </div>
</div>

  </div>
  <div class="col-sm-3">
  
  <!-- Social Icons -->   

<div class="container my-4">
  <div class="row justify-content-start">
    <div class="col-auto">
      <a href="https://www.instagram.com" target="_blank" class="social-icon">
        <i class="fab fa-instagram fa-2x" style="color: white;"></i>
      </a>
    </div>
    <div class="col-auto">
      <a href="https://www.facebook.com" target="_blank" class="social-icon">
        <i class="fab fa-facebook fa-2x" style="color: white;"></i>
      </a>
    </div>
    <div class="col-auto">
      <a href="https://www.tiktok.com" target="_blank" class="social-icon">
        <i class="fab fa-tiktok fa-2x" style="color: white;"></i>
      </a>
    </div>
  </div>
</div>


  </div>
</div>


</div>
      <!-- fin del Footer -->
      <script src="{{ asset('js/main.js')}}"></script>
</html>