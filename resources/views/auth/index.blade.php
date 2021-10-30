@extends('crudPermission::layout.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-center"> Login Here</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.login') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6 offset-3">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="email" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" autocomplete="off" placeholder="Enter Email Address">
                                    @if ($errors->has('username'))
                                        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" autocomplete="off" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mb-3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
