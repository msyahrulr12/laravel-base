@extends('layouts.client.main')
@section('content')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Selamat Datang di <span>Laskar Merah Putih Indonesia Brigade III</span> <br> <span>Korwil V Jawa Barat</span></h2>
          <p>Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
            <div class="row">
                <div class="col-sm-6">
                    <img src="{{ asset('storage/1674969542rvJhVJyMDd.png') }}" class="img w-100 h-75" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('storage/167496954311ror8Tzme.png') }}" class="img w-100 h-75" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box border">
              <div class="icon"><i class="bi bi-easel"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Foto Kegiatan</a></h4>
            </div>
          </div>
          <!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box border">
              <div class="icon"><i class="bi bi-gem"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Video Kegiatan</a></h4>
            </div>
          </div>
          <!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box border">
              <div class="icon"><i class="bi bi-geo-alt"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Artikel</a></h4>
            </div>
          </div>
          <!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box border">
              <div class="icon"><i class="bi bi-command"></i></div>
              <h4 class="title"><a href="" class="stretched-link">Informasi Kompi</a></h4>
            </div>
          </div>
          <!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

            <div class="section-header">
            <h2>About Us</h2>
            <p>{{ $about_us->title }}</p>
            </div>
            <div class="content ps-0 ps-lg-5">
                <div>{!! $about_us->description !!}</div>

                <div class="position-relative mt-5">
                    <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                    <a href="{{ asset('storage/'.$about_us->video) }}" class="glightbox play-btn"></a>
                </div>
            </div>
      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Visi & Misi Section ======= -->
    <section id="visi_misi" class="visi_misi sections-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Visi & Misi</h2>
          <p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>
        </div>

        <div class="my-5">
            <img class="w-50 mx-auto d-block" src="{{ asset('storage/'.$vision_mission->banner) }}" alt="{{ $vision_mission->banner }}">
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-6">
                <div class="vision px-2">
                    <h5><strong>Visi</strong></h5>
                    <div>
                        <img class="w-25 h-100" src="{{ asset('storage/'.$vision_mission->vision_banner) }}" alt="{{ $vision_mission->vision_banner }}">
                    </div>
                    <div class="mt-3">
                        {!! $vision_mission->vision_content !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mission px-2">
                    <h5><strong>Misi</strong></h5>
                    <div>
                        <img class="w-25 h-100" src="{{ asset('storage/'.$vision_mission->mission_banner) }}" alt="{{ $vision_mission->mission_banner }}">
                    </div>
                    <div class="mt-3">
                        {!! $vision_mission->mission_content !!}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-between mt-5 g-5">
            <div class="vision">
                <h5><strong>Visi</strong></h5>
                <div>
                    <img class="w-100" src="{{ asset('storage/'.$vision_mission->vision_banner) }}" alt="{{ $vision_mission->vision_banner }}">
                </div>
                <div>
                    {!! $vision_mission->vision_content !!}
                </div>
            </div>
            <div class="mission">
                <h5><strong>Misi</strong></h5>
                <div>
                    <img class="w-100" src="{{ asset('storage/'.$vision_mission->mission_banner) }}" alt="{{ $vision_mission->mission_banner }}">
                </div>
                <div>
                    {!! $vision_mission->vision_content !!}
                </div>
            </div>
        </div> --}}

      </div>
    </section><!-- End Our Services Section -->

    {{-- <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Nulla dolorum nulla nesciunt rerum facere sed ut inventore quam porro nihil id ratione ea sunt quis dolorem dolore earum</p>
        </div>

        <div class="row gx-lg-0 gy-4">

          <div class="col-lg-4">

            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Open Hours:</h4>
                  <p>Mon-Sat: 11AM - 23PM</p>
                </div>
              </div><!-- End Info Item -->
            </div>

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section --> --}}

  </main><!-- End #main -->

@endsection
