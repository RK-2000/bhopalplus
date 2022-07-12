@extends('backend.layout.main')
@section('contain')
    <style>
        .ck.ck-editor__main {
            color: #000;
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Complaint</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Complaint</li>
                    </ol>
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
                                            <th> Name</th>
                                            <th> Image</th>
                                            <th> Video</th>
                                            <th> Message</th>
                                            <th> Reply admin side</th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= ++$count ?></td>
                                                <td> {{ $item->user->name ? $item->user->name : '-----' }} </td>
                                                </td>
                                                <?php if ($item->image) {
                                                    $src = 'public/backend/complaint/image/' . $item->image;
                                                } else {
                                                    $src = 'public/backend/default-image.png';
                                                } ?>
                                                <td>
                                                    <img src="{{ asset($src) }}" alt="{{ $item->image }}"
                                                        style="width: 80px;
                                                    height: 80px;
                                                    border-radius: 10%;
                                                    background-color: #fff;">
                                                </td>
                                                <?php if ($item->video) { ?>
                                                <td>
                                                    <img src="{{ asset('public/backend/complaint/image/' . $item->video) }}"
                                                        alt="{{ $item->video }}"
                                                        style="width: 80px;
                                                    height: 80px;
                                                    border-radius: 10%;
                                                    background-color: #fff;">
                                                </td>

                                                <?php } else { ?>
                                                <td>-----</td>
                                                <?php } ?>

                                                <td> {{ $item->user_message ? $item->user_message : '-----' }} </td>
                                                <td> {{ $item->admin_rply_message ? $item->admin_rply_message : '-----' }}
                                                </td>

                                                <td>
                                                    @if ($item->status == '1')
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>

                                                <td>
                                                    <button class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-toggle="modal" data-target="#exampleModald-<?= $item->id ?>">
                                                        <i class="mdi mdi-eye"></i></button>
                                                    <a href="{{ route('complaint.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>

                                                {{-- ---------------model start here------- --}}
                                                <div class="modal fade" id="exampleModald-<?= $item->id ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Complaint
                                                                    Info</h5>
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
                                                                                    action="{{ route('complaint.edit', $item->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">

                                                                                            <div class="form-group">
                                                                                                <?php if ($item->image) {
                                                                                                    $src = 'public/backend/complaint/image/' . $item->image;
                                                                                                } else {
                                                                                                    $src = 'public/backend/default-image.png';
                                                                                                } ?>
                                                                                                <label
                                                                                                    for="icon">Image</label>
                                                                                                <img src="{{ asset($src) }}"
                                                                                                    alt=""
                                                                                                    name="icon"
                                                                                                    class="img-rounded"
                                                                                                    id="imguploadsidenew">

                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="col-md-6">

                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="icon">video</label>
                                                                                                @if ($item->video)
                                                                                                    <video
                                                                                                        class="img-rounded"
                                                                                                        controls>
                                                                                                        <source
                                                                                                            src="{{ asset('public/backend/complaint/video/' . $item->video) }}"
                                                                                                            type="video/mp4">
                                                                                                        <source
                                                                                                            src="{{ asset('public/backend/complaint/video/' . $item->video) }}"
                                                                                                            type="video/ogg">
                                                                                                    </video>
                                                                                                @else
                                                                                                    Not Found
                                                                                                @endif
                                                                                            </div>

                                                                                        </div>

                                                                                    </div>


                                                                                    <div class="form-group">
                                                                                        <label for="user_message">User
                                                                                            Message</label>
                                                                                        <textarea class="form-control" cols="30" rows="10" style="color: #000;" disabled>{{ $item->user_message }}</textarea>

                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="user_message">Reply</label>
                                                                                        <textarea name="admin_rply_message" class="form-control" cols="30" rows="10" required>{{ $item->admin_rply_message }}</textarea>

                                                                                    </div>
                                                                                    <center><button type="submit"
                                                                                            class="btn btn-success mr-2">Send</button>
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

        </div>
    </div>
@endsection
