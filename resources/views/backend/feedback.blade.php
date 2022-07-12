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
                <h3 class="page-title">Feedback</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Feedback</li>
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
                                            <th> Feedback</th>
                                            <th> Star</th>
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
                                                <td> {{ $item->feedback ? $item->feedback : '-----' }} </td>
                                                <td>
                                                    @for ($i = 0; $i < $item->star; $i++)
                                                        <i class="mdi mdi-star" style="color: gold;"></i>
                                                    @endfor
                                                </td>
                                                <td>
                                                    @if ($item->status == '1')
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('feedback.delete', $item->id) }}"
                                                        class="btn btn-danger btn-sm"> <i class="mdi mdi-delete"></i></a>

                                                </td>
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
