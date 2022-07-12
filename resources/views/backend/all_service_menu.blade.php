@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">All Services</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Service</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                @foreach (servicecategory() as $item)
                    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="d-flex align-items-center align-self-start">
                                            <h3 class="mb-0">{{ $item->title }}</h3>
                                            {{-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> --}}
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="icon icon-box-success ">
                                            <?php if ($item->icon) {
                                                $srcs = 'public/backend/image/' . $item->icon;
                                            } else {
                                                $srcs = 'public/backend/default-image.png';
                                            } ?>
                                            <img src="{{ asset($srcs) }}"
                                                style="margin-right:12px; border-radius: 25px; height: 35px;
                                                width: 33px;
                                               padding: 4px; background-color: #fff; margin-right: 2px;">

                                            {{-- <span class="mdi mdi-arrow-top-right icon-item"></span> --}}
                                        </div>
                                    </div>
                                </div>
                                {{-- <h6 class="text-muted font-weight-normal">{{ $item->title }}</h6> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>

    </div>
    <!-- main-panel ends -->
@endsection
