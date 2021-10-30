@extends('crudPermission::layout.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-center"> Create User</h3>
                        <a href="{{route('users.index')}}" class="btn btn-primary">Use List</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" autocomplete="off" placeholder="Enter Username">
                                    @if ($errors->has('username'))
                                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" autocomplete="off" placeholder="Enter Email Address">
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" autocomplete="off" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Avatar</label>
                                    <input class="form-control" type="file" name="avatar" id="formFile">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Group</label>
                                    <select class="form-select" name="group[]" multiple aria-label="multiple select example">
                                        <option selected>Select Role</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">User</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

