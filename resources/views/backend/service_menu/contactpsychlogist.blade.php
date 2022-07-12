@extends('backend.layout.main')
@section('contain')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Contact Psychlogist</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Psychlogist</li>
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
                                            <th> Name </th>
                                            <th> Phone Code </th>
                                            <th> Number </th>
                                            <th> Address </th>
                                            <th> Type </th>
                                            <th> Status</th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td> <?= ++$count ?></td>
                                                <td> {{ $item->name ? $item->name : '-----' }} </td>
                                                <td> {{ $item->phone_code ? $item->phone_code : 'Not data' }} </td>
                                                <td> {{ $item->number ? $item->number : 'Not data' }} </td>
                                                <td> {{ $item->address ? $item->address : 'Not data' }} </td>
                                                <td>
                                                    @if ($item->type == '1')
                                                        government
                                                    @elseif($item->type == '2')
                                                        private
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == '1')
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-toggle="modal" data-target="#exampleModald-<?= $item->id ?>">
                                                        <i class="mdi mdi-lead-pencil"></i></button>
                                                    <a href="{{ route('contactpsychlogist.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>
                                                {{-- ---------------model start here------- --}}
                                                <div class="modal fade" id="exampleModald-<?= $item->id ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Contact
                                                                    Psychlogist Edit
                                                                </h5>
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
                                                                                {{-- <h4 class="card-title">Default form</h4>
                              <p class="card-description"> Basic form layout </p> --}}
                                                                                <form class="forms-sample"
                                                                                    action="{{ route('contactpsychlogist.edit', $item->id) }}"
                                                                                    method="post">
                                                                                    @csrf

                                                                                    <div class="form-group">
                                                                                        <label for="name">Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                                            name="name" id="name"
                                                                                            placeholder="Name"
                                                                                            value="{{ $item->name }}"
                                                                                            required />
                                                                                        @error('name')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="phone_code">Phone
                                                                                            code</label>
                                                                                        <input type="text"
                                                                                            class="form-control @error('phone_code') is-invalid @enderror"
                                                                                            name="phone_code"
                                                                                            id="phone_code"
                                                                                            value="{{ $item->phone_code }}"
                                                                                            placeholder="phone
                                                                                            code"
                                                                                            required />
                                                                                        @error('phone_code')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="number">Number</label>
                                                                                        <input type="tel"
                                                                                            class="form-control @error('number') is-invalid @enderror"
                                                                                            name="number" id="number"
                                                                                            value="{{ $item->number }}"
                                                                                            placeholder="number" required />
                                                                                        @error('number')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="number">Status</label>
                                                                                        <select name="status"
                                                                                            class="form-control @error('status') is-invalid @enderror">
                                                                                            <option value="1"
                                                                                                {{ 1 == $item->status ? 'selected' : '' }}>
                                                                                                Active</option>
                                                                                            <option value="0"
                                                                                                {{ 0 == $item->status ? 'selected' : '' }}>
                                                                                                Inactive
                                                                                            </option>
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="number">Type</label>
                                                                                        <select name="type"
                                                                                            class="form-control @error('type') is-invalid @enderror">
                                                                                            <option selected disabled>
                                                                                                --Select Type --</option>
                                                                                            <option value="1"
                                                                                                {{ 1 == $item->type ? 'selected' : '' }}>
                                                                                                government</option>
                                                                                            <option value="2"
                                                                                                {{ 2 == $item->type ? 'selected' : '' }}>
                                                                                                private
                                                                                            </option>
                                                                                        </select>
                                                                                        @error('type')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label
                                                                                            for="address">Address</label>
                                                                                        <input
                                                                                            class="form-control @error('address') is-invalid @enderror"
                                                                                            id="address" name="address"
                                                                                            type="text"
                                                                                            value="{{ $item->address }}"
                                                                                            placeholder="address" required>
                                                                                        @error('address')
                                                                                            <div class="alert alert-danger">
                                                                                                {{ $message }}</div>
                                                                                        @enderror

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
                            <h5 class="modal-title" id="exampleModalLabel">Contact Psychlogist Add</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <form class="forms-sample"
                                                action="{{ route('contactpsychlogist.create') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" id="name" placeholder="Name" required />
                                                    @error('name')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_code">Phone code</label>
                                                    <input type="text"
                                                        class="form-control @error('phone_code') is-invalid @enderror"
                                                        name="phone_code" id="phone_code" placeholder="phone code"
                                                        required />
                                                    @error('phone_code')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Number</label>
                                                    <input type="tel"
                                                        class="form-control @error('number') is-invalid @enderror"
                                                        name="number" id="number" placeholder="number" required />
                                                    @error('number')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Type</label>
                                                    <select name="type"
                                                        class="form-control @error('type') is-invalid @enderror">
                                                        <option selected disabled>--Select Type --</option>
                                                        <option value="1">government</option>
                                                        <option value="2">private </option>
                                                    </select>
                                                    @error('type')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input class="form-control @error('address') is-invalid @enderror"
                                                        id="address" name="address" type="text"
                                                        placeholder="address" required>
                                                    @error('address')
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror

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
