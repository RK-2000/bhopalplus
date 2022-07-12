@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Yoga Guide Edit</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Yoga Guide Edit</li>
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
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <form class="forms-sample" action="{{ route('yogaguide.edit', $data->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="yoga_id" value="{{ $data->id }}">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title"
                                                        placeholder="Title" value="{{ $data->title }}" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_time">Date
                                                        Time</label>
                                                    <input type="datetime-local" class="form-control"
                                                        value="{{ $data->date_time }}" name="date_time" required />

                                                </div>

                                                <div class="form-group">
                                                    <label for="google_meet_url">Google
                                                        Meet URL</label>
                                                    <input type="url" class="form-control" name="google_meet_url"
                                                        value="{{ $data->google_meet_url }}" />
                                                </div>
                                                <?php $count = 0; ?>
                                                @foreach ($youtube as $key => $urldata)
                                                    <div class="form-group">
                                                        <label for="youtube">Youtube
                                                            Link
                                                            (<?= ++$count ?>)
                                                        </label>
                                                        <input type="url" class="form-control" name="youtube_link[]"
                                                            value="{{ $urldata->url }}" />

                                                    </div>
                                                @endforeach
                                                <div class="form-group field_wrapper">
                                                </div>
                                                <a href="javascript:void(0);" class="add_button"
                                                    data-id="{{ $data->id }}" title="Add field"><i
                                                        class="mdi mdi-plus-box" style="font-size: 24px;">
                                                    </i></a>

                                                <div class="form-group">
                                                    <label for="contact_address">Contact
                                                        Address</label>
                                                    <input type="text" class="form-control" name="contact_address"
                                                        value="{{ $data->contact_address }}" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="contact_number">Mobile
                                                        Number</label>
                                                    <input type="tel" class="form-control" name="contact_number"
                                                        id="mobile" placeholder="contact number" pattern="[789][0-9]{9}"
                                                        maxlength="10" value="{{ $data->contact_number }}" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="banner_image">Image</label>
                                                    <div class="row">
                                                        @isset($image)
                                                            @foreach ($image as $imagedata)
                                                                <div class="col-md-2">
                                                                    <img src="{{ asset('public/backend/image/yoga/' . $imagedata->name) }}"
                                                                        style="height:61px;" alt="">

                                                                </div>
                                                            @endforeach
                                                        @endisset
                                                    </div>

                                                    <input type="file" name="banner_image[]" id=""
                                                        style="margin-top: 25px; " class="form-control" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_agenda">Description
                                                        (Agenda)
                                                    </label>
                                                    <textarea name="description_agenda" class="form-control" id="description_agenda" cols="30" rows="10"><?= $data->description_agenda ?></textarea>
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
