
@extends('layouts.layout_cliente')

@section('title', 'Home - HappyRootsCR')

@section('content')

  <!-- Slider  -->
<div id="slider-1" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div id="carousel-1" class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('img/slider1.png')}}" alt="Los Angeles" width="1900" height="900"> 
    </div>
    <div id="carousel-2" class="carousel-item">
      <img src="{{ asset('img/slider2.png')}}" alt="Chicago" width="1900" height="900">
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


<!-- Productos   -->

<div id="container-basic" class="container-fluid mt-2">
  <div class="row no-gutters">
    <!-- Columna Izquierda -->
    <div class="col-md-4">
      <div class="p-3">
            <img src="{{ asset('img/imagesocial_1.png')}}" 
                class="img-fluid rounded mb-2" 
                alt="Cinque Terre" 
                style="max-width: 500px; max-height: 500px;">
        <img src="{{ asset('img/image_social.png')}}" class="img-fluid rounded" alt="Cinque Terre">
      </div>
    </div>

    <!-- Columna Central (Slider) -->
    <div class="col-md-4">
      <div class="product-slider position-relative mt-3" style="background-color: #FF007E">
        <div class="product-slides text-center p-2">
          <img src="{{ asset('img/product1.png')}}" class="product-img active" alt="Product 1">
          <img src="{{ asset('img/product2.png')}}" class="product-img" alt="Product 2">
          <img src="{{ asset('img/product3.png')}}" class="product-img" alt="Product 3">
        </div>

        <!-- Botones -->
        <button class="slider-btn prev-btn">
          <span>&larr;</span>
        </button>
        <button class="slider-btn next-btn">
          <span>&rarr;</span>
        </button>
      </div>
   

<div>
  <button type="button" class="btn btn-block mt-3 scrolling-button left-to-right" style="background-color: #FF007E; color: white;">
    <span class="scrolling-text">
      ✨ follow us on tiktok ✨ follow us on tiktok ✨ follow us on tiktok ✨
      ✨ follow us on tiktok ✨ follow us on tiktok ✨ follow us on tiktok ✨
    </span>
  </button>
</div>

<div>
  <button type="button" class="btn btn-block mt-3 scrolling-button right-to-left" style="background-color: #FFFF01; color: #FF007E;">
    <span class="scrolling-text">
      ✨ follow us on facebook ✨ follow us on facebook ✨ follow us on facebook ✨
      ✨ follow us on facebook ✨ follow us on facebook ✨ follow us on facebook ✨
    </span>
  </button>
</div>

<div>
  <button type="button" class="btn btn-block mt-3 scrolling-button left-to-right" style="background-color: #BFFF00; color: #FF007E; font-weight: bold">
    <span class="scrolling-text">
      ✨ follow us on instagram ✨ follow us on instagram ✨ follow us on instagram ✨
      ✨ follow us on instagram ✨ follow us on instagram ✨ follow us on instagram ✨
    </span>
  </button>
</div>



        <div class="image_social4 mt-3">
           <img src="{{ asset('img/image_social.png')}}" class="img-fluid rounded" alt="Cinque Terre" style="height: 375px; width: 100%; object-fit: cover;">
        </div>
    </div>


    
    <!-- Columna Derecha -->
    <div class="col-md-4">
      <div class="p-3">
        <img src="{{ asset('img/image_social.png')}}" class="img-fluid rounded mb-2" alt="Cinque Terre">
        <img src="{{ asset('img/image_social.png')}}" class="img-fluid rounded" alt="Cinque Terre">
      </div>
    </div>
  </div>
</div>


<div class="container-fluid" style="
  background-color: #FFD200;
  background-image: url('img/products_back.png');  
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: center bottom;">

  <h1 class="text-center" style="color: #FF007E; font-family: 'the_fruit_star', sans-serif; font-weight: 900; padding-top: 40px; font-size: 80px;">Products</h1>
  
  <!-- Línea decorativa -->
  <div class="d-flex justify-content-center">
    <div style="width: 250px; height: 4px; background-color: #FF007E; margin-bottom: 5px;"></div>
  </div>

  <div class="row">
    <div class="col-sm-3"></div>
        <div class="col-sm-3 text-center">
        <img src="{{ asset('img/chips1.png')}}" alt="Producto" class="img-destacada">
        </div>
    
    <div class="col-sm-3 text-center">
        <img src="{{ asset('img/chips2.png')}}" alt="Producto" class="img-destacada">
    </div>

        
    <div class="col-sm-3"></div>
  </div>
</div>


<div>
<h1 class="text-left mt-5" style="color: #FF007E; font-family: 'the_fruit_star', sans-serif; font-weight: 900; padding-top: 40px; font-size: 50px; margin-left: 300px;">
  Social
</h1>
<div class="d-flex justify-content-top" style="margin-left: 300px; margin-top: -10px;">
    <div style="width: 100px; height: 4px; background-color: #FF007E; margin-bottom: 5px;"></div>
  </div>

<!-- Contenedor principal -->
<div class="container text-center py-5">
  <!-- Primera fila de imágenes -->
  <div class="row justify-content-center mb-4">
    <div class="col-sm-3">
      <img src="{{ asset('img/social-06.png')}}" class="img-hover img-fluid" alt="Producto 1">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-07.png')}}" class="img-hover img-fluid" alt="Producto 2">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-08.png')}}" class="img-hover img-fluid" alt="Producto 3">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-09.png')}}" class="img-hover img-fluid" alt="Producto 4">
    </div>
  </div>

  <!-- Segunda fila de imágenes -->
  <div class="row justify-content-center">
    <div class="col-sm-3">
      <img src="{{ asset('img/social-10.png')}}" class="img-hover img-fluid" alt="Producto 5">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-11.png')}}" class="img-hover img-fluid" alt="Producto 6">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-12.png')}}" class="img-hover img-fluid" alt="Producto 7">
    </div>
    <div class="col-sm-3">
      <img src="{{ asset('img/social-13.png')}}" class="img-hover img-fluid" alt="Producto 8">
    </div>
  </div>
</div>

</div>



  <!-- Footer -->
<div class="container-fluid" style="
  background-image: url('img/products_back.png');  
  background-repeat: no-repeat;
  background-size: 100% auto;
  background-position: center bottom;
  padding: 40px 20px;
  margin-top: -150px;
">
  <div class="row">
    <div class="col-sm-4 text-center">
      <!-- Aquí puedes poner imagen o contenido -->
      <img src="{{ asset('img/logo happy roots_principal.png')}}" alt="Producto" class="img-fluid img-hover">
    </div>
    <div class="col-sm-8 text-center">
      
    </div>
  </div>
</div>

@endsection