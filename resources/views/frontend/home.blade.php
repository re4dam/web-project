@extends('frontend.master')

@section('content')

    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box">
                  <h1>
                    Mau Berkemah? <br>
                    <span>
                      Kita Sedia!
                    </span>
                  </h1>
                  <p>
                    Nikmati pengalaman berkemah yang tak terlupakan dengan perlengkapan berkualitas dari kami. Mulai dari sepatu yang nyaman hingga peralatan tenda untuk tidur, kami menyediakan semua yang Anda butuhkan untuk petualangan alam terbuka. Rasakan keindahan alam dengan penuh kenyamanan dan keamanan.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box">
                  <h1>
                    Keamanan Anda <br>
                    <span>
                      Tanggung Jawab Kita
                    </span>
                  </h1>
                  <p>
                    Prioritas utama kami adalah memastikan keselamatan Anda selama berkemah. Dengan peralatan berkualitas tinggi dan standar keamanan terbaik, Anda bisa menikmati petualangan tanpa khawatir. Bergabunglah dengan kami dan alami kenyamanan dan keamanan maksimal di setiap perjalanan Anda.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box">
                  <h1>
                    Perlengkapan Terbaik <br>
                    <span>
                      Untuk Petualangan Anda
                    </span>
                  </h1>
                  <p>
                    Kami menyediakan perlengkapan berkemah terbaik yang dirancang untuk memberikan kenyamanan dan kemudahan selama perjalanan Anda. Dengan inovasi terbaru dan material berkualitas, setiap produk kami menjamin pengalaman berkemah yang lebih baik. Mulailah petualangan Anda dengan perlengkapan terbaik dari kami.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <div class="container idicator_container">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img_container">
            <div class="img-box">
              <img src="images/tempo/about-us.jpg" alt="" />
            </div>
          </div>
        </div>
        <div class="col-md-6 px-0">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Who Are We?
            </h2>
          </div>
          <p style="text-align: justify;">
            Selamat datang di CempakaCamping! Kami menyediakan penyewaan peralatan berkemah berkualitas untuk memastikan petualangan alam Anda nyaman dan aman. Dari tenda hingga peralatan memasak, kami siap memenuhi kebutuhan berkemah Anda. Bergabunglah dengan kami dan nikmati pengalaman berkemah yang menyenangkan.
          </p>
        </div>


        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
  <section class="bags_section layout_padding d-flex justify-content-center align-items-center full-height">
    <div class="col-md-10">
      <div class="best-list">
        <h1>Top Product Categories</h1>
        <br><br>
        <div class="best-cards">
          <div class="best-card">
              <img src="{{ asset($sepatu->img_path) }}" alt="Product Image">
              <div class="card-content">
                  <h2 class="card-title">{{ $sepatu->nama_produk }}</h2>
                  <p class="card-description" style="font-size: 18px">{{ $sepatu->deskripsi }}</p>
                  <p class="card-price">Rp.{{ number_format($sepatu->harga,0,'','.') }},00/hari</p>
              </div>
          </div>
          <div class="best-card">
              <img src="{{ asset($tas->img_path) }}" alt="Product Image">
              <div class="card-content">
                  <h2 class="card-title">{{ $tas->nama_produk }}</h2>
                  <p class="card-description" style="font-size: 18px">{{ $tas->deskripsi }}</p>
                  <p class="card-price">Rp.{{ number_format($tas->harga,0,'','.') }},00/hari</p>
              </div>
          </div>
          <div class="best-card">
            <img src="{{ asset($tenda->img_path) }}" alt="Product Image">
              <div class="card-content">
                <h2 class="card-title">{{ $tenda->nama_produk }}</h2>
                <p class="card-description" style="font-size: 18px">{{ $tenda->deskripsi }}</p>
                <p class="card-price">Rp.{{ number_format($tenda->harga,0,'','.') }},00/hari</p>
              </div>
          </div>
        </div>
        <a href="{{ route('produk') }}" class="btn btn-primary" style="font-size:25px">Book Now!</a>
      </div>
    </div>
  </section>

  
  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container ">
      <div class="heading_container heading_center">
        <h2>
          Testimoni Klien Kita
        </h2>
      </div>
      <div id="carouselClientControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="img-box">
                <img src="{{ asset('images/tempo/guy1.jpg') }}" alt="">
                
              </div>
              <div class="detail-box">
                <h4>
                  Alexander Pranata
                </h4>
                <p>
                "Pelayanan yang ramah dan profesional! Rental Alat Kemah memberikan solusi terbaik untuk petualangan alam saya. Saya tidak ragu untuk merekomendasikan mereka kepada siapa pun yang ingin mendapatkan pengalaman berkemah yang tak terlupakan."
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="box">
              <div class="img-box">
                <img src="{{ asset('images/tempo/guy2.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h4>
                  Michael Surya
                </h4>
                <p>
                "Rental Alat Kemah ini memang juara! Saya memilih mereka karena rekomendasi teman, dan saya tidak kecewa. Alat-alatnya bersih, terawat, dan nyaman digunakan. Terima kasih sudah membuat liburan saya luar biasa!"
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="box">
              <div class="img-box">
                <img src="{{ asset('images/tempo/guy3.jpg') }}" alt="">
              </div>
              <div class="detail-box">
                <h4>
                  Jonathan Setiawan
                </h4>
                <p>
                "Saya sangat senang dengan pelayanan dari Rental Alat Kemah ini. Peralatan yang disediakan sangat lengkap dan berkualitas. Pengalaman berkemah saya menjadi lebih menyenangkan berkat mereka!"
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#carouselClientControls" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselClientControls" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

@endsection