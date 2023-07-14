@extends('admin.layouts.app')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $pageName }}</h1>
        {{--            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
        {{--                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th>Joined</th>
                        <th>Config</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th>Joined</th>
                        <th>Config</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->verified)
                                    <span class="badge text-bg-success">Verified</span>
                                @else
                                    <a href="#" class="badge text-bg-warning" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="verify" data-bs-target="adminVerifyModal-{{ $user->id }}">Pending</a>

                                    <div class="modal fade" id="adminVerifyModal-{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="adminVerifyModal-{{ $user->id }}-Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content small">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="adminVerifyModal-{{ $user->id }}-Label">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fw-bold text-opacity-75">
                                                        Sure give access to Admin Site?
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary w-50">Understood</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </td>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td><a href="#" class="btn btn-sm btn-outline-success bi-pencil-fill"></a></td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="7">Empty</th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
