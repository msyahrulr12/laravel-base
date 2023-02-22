@extends('layouts.client.main')
@section('content')

<main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="page-header d-flex align-items-center" style="background-image: url('');">
    <div class="container position-relative">
        <div class="row d-flex justify-content-center">
        <div class="col-lg-6 text-center">
            <h2>Portfolio Details</h2>
            <p>Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
        </div>
        </div>
    </div>
    </div>
    <nav>
    <div class="container">
        <ol>
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('portofolios.index') }}">Portofolio</a></li>
        <li>{{ $data->title }}</li>
        </ol>
    </div>
    </nav>
</div><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container" data-aos="fade-up">

    <div class="row justify-content-center gy-4 mt-4">

        <div class="col-lg-8">
            <div class="portofolio-image">
                <img src="{{ asset('storage/'.$data->banner) }}" alt="{{ $data->banner }}" class="w-75 d-block mx-auto">
            </div>
            <div class="portfolio-description my-3">
                <h2>{{ $data->title }}</h2>
                <div>
                    {!! $data->content !!}
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-3">
            <div class="portfolio-info">
                <h3>Project information</h3>
                <ul>
                <li><strong>Category</strong> <span>Web design</span></li>
                <li><strong>Client</strong> <span>ASU Company</span></li>
                <li><strong>Project date</strong> <span>01 March, 2020</span></li>
                <li><strong>Project URL</strong> <a href="#">www.example.com</a></li>
                <li><a href="#" class="btn-visit align-self-start">Visit Website</a></li>
                </ul>
            </div>
        </div> --}}

    </div>

    </div>
</section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

@endsection
