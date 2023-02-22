@extends('layouts.client.main')
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
          <div class="container position-relative">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-6 text-center">
                <h2>Dokumentasi</h2>
                <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
              </div>
            </div>
          </div>
        </div>
        <nav>
          <div class="container">
            <ol>
              <li><a href="{{ route('home') }}">Beranda</a></li>
              <li><a href="{{ route('documentations.index') }}">Dokumentasi</a></li>
              <li>{{ $data->title }}</li>
            </ol>
          </div>
        </nav>
      </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container w-75" data-aos="fade-up">
            <div class="img d-flex justify-content-center">
                @if (in_array($data->file_type, ['png', 'jpg', 'jpeg']))
                    <img src="{{ asset('storage/'.$data->file) }}" alt="{{ $data->filename }}" class="w-50">
                @elseif (in_array($data->file_type, ['mp4', 'mkv']))
                    <video width="1024" height="768" controls>
                        <source src="{{ asset('storage/'.$data->file) }}" alt="{{ $data->filename }}" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                    </video>
                @endif
            </div>

            <div class="font-weight-bold mt-5">
                <h5><b>{{ $data->title }}</b></h5>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <div class="w-100 text-justify">
                    {!! $data->description !!}
                </div>
            </div>
            <!-- End Content Blog -->

            <div class="mt-5">
                <h6>Author : <span><strong><i>{{ $data->created_by }}</i></strong></span></h6>
                <small>{{ $data->created_at->format('M d, Y') }}</small>
            </div>
            <!-- End Author -->

        </div>
    </section><!-- End Blog Section -->

</main>
@endsection
