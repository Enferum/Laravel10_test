@extends('layout')
@section('content')
    <div class="mt-6 flex justify-center border-3">
        <p>Here is your temp link</p>
    </div>
    <div class="mt-6 flex justify-center">
        <p><a href="{{ $link }}">Link</a></p>
    </div>
@endsection
