
@extends('layouts.client.main')
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
                <h2>Blog</h2>
                <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
            </div>
            </div>
        </div>
        </div>
        <nav>
        <div class="container">
            <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('blogs') }}">Blog</a></li>
            <li>{{ $data->title }}</li>
            </ol>
        </div>
        </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container w-75" data-aos="fade-up">
            <div class="img d-flex justify-content-center">
                <img src="{{ asset('storage/'.$data->banner) }}" alt="{{ $data->slug }}" class="w-100">
            </div>

            <div class="d-flex justify-content-center">
                <div class="mt-5 w-100 text-justify">
                    {!! $data->content !!}
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

</main><!-- End #main -->

@endsection
