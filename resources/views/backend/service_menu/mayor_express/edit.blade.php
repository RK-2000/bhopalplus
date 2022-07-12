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
                <h3 class="page-title">Mayor Express Edit</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mayor Express Edit</li>
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

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="forms-sample"
                                                    action="{{ route('mayor_express.edit', $item->id) }}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="description">Discription</label>
                                                        <textarea id="ckeditor" class="form-control @error('description') is-invalid @enderror" name="description"
                                                            value="{{ old('description') }}"><?= $item->description ?></textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="number">Status</label>
                                                        <select name="status" class="form-control">
                                                            <option value="1"
                                                                {{ 1 == $item->status ? 'selected' : '' }}>
                                                                Active</option>
                                                            <option value="0"
                                                                {{ 0 == $item->status ? 'selected' : '' }}>
                                                                Inactive
                                                            </option>
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
            </div>


        </div>
    </div>
@endsection
