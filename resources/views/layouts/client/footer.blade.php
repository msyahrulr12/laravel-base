<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-12 col-md-12 footer-info">
          <a href="{{ route('home') }}" class="logo my-5">
            <span class="pb-5" style="line-height: 1.5em;">
                Laskar Merah Putih Indonesia Brigade III <br>
                Korwil V Jawa Barat
            </span>
          </a>
          <div class="social-links d-flex mt-5 mb-2 my-5">
            @foreach ($social_media as $socialMedia)
            <a href="{{ $socialMedia->link }}" target="_blank" class="{{ $socialMedia->name }}"><i class="{{ $socialMedia->icon }}"></i></a>
            @endforeach
          </div>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            {!! $contact_us->address !!}
            <strong>Phone:</strong> {{ $contact_us->phone_number }}<br>
            <strong>Email:</strong> {{ $contact_us->email }}<br>
            <strong>
                <a href="{{ route('admin.login') }}" class="text-primary" style="font-size: 1.6em;">--LOGIN--</a>
            </strong>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Hanasti.Tech</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/client/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/client/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/client/js/main.js') }}"></script>
</body>

</html>
