@extends('crudPermission::layout.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-center"> User List</h3>
                        <a href="{{route('users.create')}}" class="btn btn-primary">Add New Item</a>
                    </div>
                </div>
                <div class="card-body">
                   {{-- @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            {{Session::get('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            {{Session::get('error')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif--}}
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <div class="d-flex flex-row">
                                                <a href="{{route('users.edit', $user->id)}}" role="button" class="btn btn-info btn-sm mr-2" style="margin-right: 5px;">Edit</a>
                                                <a href="javascript:void(0);" role="button" OnClick="deleteItem({{$user->id}})" class="btn btn-info btn-sm">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><p class="text-center">No Data Found</p></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal start-->
    <div class="modal fade" id="user-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.delete') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" id="userId">
                    <div class="modal-body">
                       <h3>Are you sure? Want to delete?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Delete Modal end-->

</div>
@endsection

@once
    @push('scripts')
    <script>
        function deleteItem(userId) {
            $('#userId').val(userId);
            $('#user-delete-modal').modal('show');
        }
    </script>
    @endpush
@endonce

