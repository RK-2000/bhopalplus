@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Yoga Guide</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Yoga Guide</li>
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
                                            <th> Date Time </th>
                                            <th> Discription </th>
                                            <th> Image </th>
                                            <th> Contact Address </th>
                                            <th> Contact No. </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= ++$count ?></td>
                                                <td> {{ $item->title ? $item->title : 'Not data' }} </td>
                                                <td> {{ $item->date_time ? $item->date_time : 'Not data' }} </td>
                                                <td> {{ $item->description_agenda ? $item->description_agenda : 'Not data' }}
                                                </td>
                                                <td style="position: relative;">
                                                    @foreach ($item->imageyoga as $imagedata)
                                                        <a href="{{ route('yogaguide.imagedelete', $imagedata->id) }}"
                                                            class="mdi mdi-delete"
                                                            style="background-color: #ccc;  margin-top: -7px;
                                                            border-radius: 25px;  color: red; position:absolute;">
                                                        </a>

                                                        <img src="{{ asset('public/backend/image/yoga/' . $imagedata->name) }}"
                                                            style="height: 63px;
                                                            width: 40px !important;
                                                            border-radius: 10% !important;
                                                            background-color: #fff;
                                                            padding: 2px;"
                                                            alt="">
                                                    @endforeach
                                                </td>
                                                <td> {{ $item->contact_address ? $item->contact_address : 'Not data' }}
                                                </td>
                                                <td> {{ $item->contact_number ? $item->contact_number : 'Not data' }}
                                                </td>
                                                <td>

                                                    <a href="{{ route('yogaguide.edit.path', $item->id) }}"
                                                        class="btn btn-warning btn-sm"> <i
                                                            class="mdi mdi-lead-pencil"></i></a>
                                                    <a href="{{ route('yogaguide.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>
                                                {{-- ---------------model start here------- --}}

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
                            <h5 class="modal-title" id="exampleModalLabel">Yoga Guide Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="{{ route('yogaguide.create') }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Title" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_time">Date Time</label>
                                                    <input type="datetime-local" class="form-control" name="date_time"
                                                        placeholder="Date time" required />

                                                </div>

                                                <div class="form-group">
                                                    <label for="google_meet_url">Google Meet URL</label>
                                                    <input type="url" class="form-control" name="google_meet_url" />
                                                </div>
                                                <div class="form-group field_wrapper">
                                                    <label for="youtube">Youtube Link</label>
                                                    <input type="url" class="form-control" name="youtube_link[]"
                                                        value="" />
                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i
                                                            class="mdi mdi-plus-box" style="font-size: 24px;">
                                                        </i></a>
                                                </div>

                                                <div class="form-group">
                                                    <label for="contact_address">Contact Address</label>
                                                    <input type="text" class="form-control" name="contact_address" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact_number">Mobile Number</label>
                                                    <input type="tel" class="form-control" name="contact_number"
                                                        id="mobile" placeholder="contact number"
                                                        pattern="[789][0-9]{9}" maxlength="10" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="banner_image">Image</label>
                                                    <input type="file" name="banner_image[]" id=""
                                                        class="form-control" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_agenda">Description (Agenda)</label>
                                                    <textarea name="description_agenda" class="form-control" id="description_agenda" cols="30" rows="10"></textarea>
                                                </div>

                                                <center><button type="submit"
                                                        class="btn btn-primary mr-2">Submit</button>
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
        </div>
    </div>
@endsection
