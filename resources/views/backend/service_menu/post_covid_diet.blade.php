@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Post Covid Diet </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post Covid Diet</li>
                    </ol>
                    <button type="button" style="float: right;" data-toggle="modal" data-target="#exampleModal"
                        class="btn btn-social-icon btn-outline-twitter"><i class="mdi mdi-library-plus"></i></button>

                </nav>
            </div>
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="position: fixed; right: 9px; top: 74px; z-index: 99;">
                        <strong>
                            <?php $count = 0; ?>
                            @foreach ($errors->all() as $error)
                                <p><?= ++$count ?>. {{ $error }}</p>
                            @endforeach
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="position: fixed; right: 9px; top: 74px; z-index: 99;">
                        <strong>
                            <p> {{ session()->get('success') }}
                            <p>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="color:#fff;">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-lg-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Bordered table</h4> --}}

                            <div class="table-responsive .table-bordered">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Title </th>
                                            <th> Image </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= ++$count ?></td>
                                                <td> {{ $item->title }} </td>
                                                <?php if ($item->image) {
                                                    $src = 'public/backend/image/postcoviddiet/' . $item->image;
                                                } else {
                                                    $src = 'public/backend/default-image.png';
                                                } ?>
                                                <td>
                                                    <img src="{{ asset($src) }}" alt="{{ $item->icon }}"
                                                        style="width: 50px;
                                                    height: 50px;
                                                    border-radius: 100%;
                                                    background-color: #fff;">
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-toggle="modal" data-target="#exampleModald-<?= $item->id ?>">
                                                        <i class="mdi mdi-lead-pencil"></i></button>
                                                    <a href="{{ route('post_covid_diet.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>
                                                {{-- ---------------model start here------- --}}
                                                <div class="modal fade" id="exampleModald-<?= $item->id ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"> Post Covid
                                                                    Diet Edit</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 grid-margin stretch-card">
                                                                        <div class="card">
                                                                            <div class="card-body">

                                                                                <form class="forms-sample"
                                                                                    action="{{ route('post_covid_diet.edit', $item->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label for="title">Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="title"
                                                                                            value="<?= $item->title ?>"
                                                                                            id="title"
                                                                                            placeholder="Title" required />
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <?php if ($item->icon) {
                                                                                            $srcs = 'public/backend/image/postcoviddiet/' . $item->image;
                                                                                        } else {
                                                                                            $srcs = 'public/backend/default-image.png';
                                                                                        } ?>
                                                                                        <label for="icon">Image</label>
                                                                                        <img src="{{ asset($srcs) }}"
                                                                                            alt="" width="120"
                                                                                            height="120" name="icon"
                                                                                            class="img-rounded"
                                                                                            id="imguploadsidenew">
                                                                                        <input type="file"
                                                                                            class="file-upload-browse"
                                                                                            style="padding-top: 6px;"
                                                                                            onchange="document.getElementById('imguploadsidenew').src = window.URL.createObjectURL(this.files[0])"
                                                                                            name="icon"
                                                                                            accept="image/*|file_extension/.jpeg,.jpg, .png,"
                                                                                            class="form-control @error('icon') is-invalid @enderror">

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="exampleSelectStatus">Status</label>
                                                                                        <select class="form-control"
                                                                                            name="status"
                                                                                            id="exampleSelectStatus">
                                                                                            <option value="1"
                                                                                                <?= $item->capacity == 1 ? 'active' : '' ?>>
                                                                                                Active</option>
                                                                                            <option value="0"
                                                                                                <?= $item->capacity == 0 ? 'active' : '' ?>>
                                                                                                Inactive</option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <center><button type="submit"
                                                                                            class="btn btn-primary mr-2">Update</button>
                                                                                    </center>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ---------------model start here------- --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Post Covid Diet Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="{{ route('post_covid_diet.create') }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        id="exampleInputUsername1" placeholder="Title" required />
                                                </div>
                                                <div class="form-group">

                                                    <div class="form-group">
                                                        <label>Image upload <small style="color: red;">*</small></label>
                                                        <div class="input-group col-md-12">
                                                            <?php
                                                            $src = 'public/backend/default-image.png';
                                                            ?>
                                                            <img id="imguploadside" src="{{ asset($src) }}"
                                                                alt=""width="120" height="120"
                                                                name="icon" class="img-rounded">

                                                            <input type="file" class="file-upload-browse"
                                                                style="padding-top: 6px;" id="imgInp"
                                                                onchange="document.getElementById('imguploadside').src = window.URL.createObjectURL(this.files[0])"
                                                                name="icon"
                                                                accept="image/*|file_extension/.jpeg,.jpg, .png,"
                                                                class="form-control @error('icon') is-invalid @enderror"
                                                                value="{{ old('icon') }}" autocomplete="icon" autofocus
                                                                required />
                                                            @error('icon')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <center><button type="submit"
                                                        class="btn btn-primary mr-2">Submit</button></center>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
