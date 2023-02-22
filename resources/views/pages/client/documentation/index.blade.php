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
              <li>Dokumentasi</li>
            </ol>
          </div>
        </nav>
      </div><!-- End Breadcrumbs -->

    <div class="container-fluid">
        <div class="px-lg-5">

            <div class="row my-5">

                @foreach ($datas as $data)
                    <!-- Gallery item -->
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="bg-white rounded shadow-sm w-100">
                            @if (in_array($data->file_type, ['png', 'jpg', 'jpeg']))
                                <img src="{{ asset('storage/'.$data->file) }}" alt="{{ $data->filename }}" class="img-fluid card-img-top">
                            @elseif (in_array($data->file_type, ['mp4', 'mkv']))
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/'.$data->file) }}" alt="{{ $data->filename }}" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                                </video>
                            @endif
                            <div class="p-4">
                            <h5> <a href="#" class="text-dark">{{ $data->title }}</a></h5>
                            <p class="small text-muted mb-0">{!! Illuminate\Support\Str::limit($data->description, 100) !!}</p>
                            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">{{ strtoupper($data->file_type) }}</span></p>
                                {{-- <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div> --}}
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ route('documentations.show', $data->id) }}" class="btn btn-primary w-100">Detail Dokumentasi</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                @endforeach


                {{-- <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-2.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Blorange</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">PNG</span></p>
                        <div class="badge badge-primary px-3 rounded-pill font-weight-normal">Trend</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-3.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">And She Realized</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                        <div class="badge badge-warning px-3 rounded-pill font-weight-normal text-white">Featured</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-4.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">DOSE Juice</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPEG</span></p>
                        <div class="badge badge-success px-3 rounded-pill font-weight-normal">Hot</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-5.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Pineapple</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">PNG</span></p>
                        <div class="badge badge-primary px-3 rounded-pill font-weight-normal">New</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-6.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Yellow banana</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                        <div class="badge badge-warning px-3 rounded-pill font-weight-normal text-white">Featured</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-7.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Teal Gameboy</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPEG</span></p>
                        <div class="badge badge-info px-3 rounded-pill font-weight-normal">Hot</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-8.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Color in Guatemala.</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">PNG</span></p>
                        <div class="badge badge-warning px-3 rounded-pill font-weight-normal text-white">Featured</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-1.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Red paint cup</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                        <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-2.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">PNG</span></p>
                        <div class="badge badge-primary px-3 rounded-pill font-weight-normal">Trend</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-3.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPG</span></p>
                        <div class="badge badge-warning px-3 rounded-pill font-weight-normal text-white">Featured</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="bg-white rounded shadow-sm"><img src="https://bootstrapious.com/i/snippets/sn-gallery/img-4.jpg" alt="" class="img-fluid card-img-top">
                    <div class="p-4">
                    <h5> <a href="#" class="text-dark">Lorem ipsum dolor</a></h5>
                    <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">JPEG</span></p>
                        <div class="badge badge-success px-3 rounded-pill font-weight-normal">Hot</div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- End --> --}}

            </div>
            {{-- <div class="py-5 text-right"><a href="#" class="btn btn-dark px-5 py-3 text-uppercase">Show me more</a></div> --}}
        </div>
    </div>

</main>
@endsection
