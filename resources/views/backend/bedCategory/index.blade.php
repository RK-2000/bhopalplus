@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Beds Category </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Beds Category</li>
                    </ol>
                    <button type="button" style="float: right;" data-toggle="modal" data-target="#exampleModal"
                        class="btn btn-social-icon btn-outline-twitter"><i class="mdi mdi-library-plus"></i></button>

                </nav>
            </div>
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
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
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Bordered table</h4> --}}

                            <div class="table-responsive .table-bordered">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Title </th>
                                            <th> Available </th>
                                            <th> Capacity </th>
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
                                                <td> {{ $item->available }} </td>
                                                <td> {{ $item->capacity }} </td>
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
                                                    <a href="{{ route('beds.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>
                                                {{-- ---------------model start here------- --}}
                                                <div class="modal fade" id="exampleModald-<?= $item->id ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Bads
                                                                    Category</h5>
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
                                                                                    action="{{ route('beds.edit', $item->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="exampleInputUsername1">Title</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="title"
                                                                                            value="<?= $item->title ?>"
                                                                                            id="exampleInputUsername1"
                                                                                            placeholder="Title" required />
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="Available">Available</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="available"
                                                                                            value="<?= $item->available ?>"
                                                                                            id="Available"
                                                                                            placeholder="Available"
                                                                                            required />
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="Capacity">Capacity</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="capacity"
                                                                                            value="<?= $item->capacity ?>"
                                                                                            id="Capacity"
                                                                                            placeholder="Capacity"
                                                                                            required />
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
                            <h5 class="modal-title" id="exampleModalLabel">Bads Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="{{ route('beds.create') }}"
                                                method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                        id="exampleInputUsername1" placeholder="Title" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Available</label>
                                                    <input type="text" class="form-control" name="available"
                                                        id="exampleInputEmail1" placeholder="Available" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="Capacity">Capacity</label>
                                                    <input type="text" class="form-control" name="capacity"
                                                        id="Capacity" placeholder="Capacity" required />
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
