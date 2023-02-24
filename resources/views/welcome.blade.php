@extends('layout')
@section('content')
    @guest
        <div class="mt-6 flex justify-center">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="username">{{ __('Username') }}</label>
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input id="phone" type="tel" class="form-control
                @error('phone') is-invalid @enderror"
                           name="phone" value="{{ old('phone') }}"
                           required autocomplete="tel"
                           placeholder="Example: 380509876543">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>

                <div class="form-group row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary text-gray-900">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endguest
@endsection
