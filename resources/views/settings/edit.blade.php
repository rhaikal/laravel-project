@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.breadcrumb')
    
        <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="h4 pb-2 mb-2 text-dark border-bottom border-2 border-dark">
                            <i class="bi bi-pencil-square"></i> Account Information
                        </div>
                        
                        <form method="POST" action="">
                            @csrf
        
                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label text-md-start">{{ __('Name') }}</label>
        
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
        
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-form-label text-md-start">{{ __('Email Address') }}</label>
        
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-2 col-form-label text-md-start">No Hp</label>
        
                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required autocomplete="phone_number">
        
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="address" class="col-md-2 col-form-label text-md-start">Alamat</label>
        
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">{{ old('address', $user->address) }}</textarea>
        
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    
        <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="h4 pb-2 mb-2 text-dark border-bottom border-2 border-dark">
                            <i class="bi bi-pencil-square"></i> Security
                        </div>
        
                        <form action="" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="password" class="col-md-2 col-form-label text-md-start">{{ __('Password') }}</label>
        
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
        
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-start">{{ __('Confirm Password') }}</label>
        
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
        
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection