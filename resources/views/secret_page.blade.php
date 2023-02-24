@extends('layout')
@section('content')
    @auth
        <div class="mt-16 flex justify-center">
            <form action="{{ route('create_link') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success text-gray-900">Create new link</button>
            </form>
        </div>
        <div class="mt-6 justify-center grid">
            @foreach($links as $link)
                <li class="content mb-3">
                    Link - <a href="{{ $link }}"
                              @if (url()->full() == $link) style="background-color: chartreuse" @endif>{{ $link }}</a>
                    <form action="{{ route('delete_link') }}" method="POST">
                        <input type="text" hidden name="link" value="{{ $link }}">
                        @csrf
                        <button type="submit" class="btn btn-danger text-gray-900">Delete link</button>
                    </form>
                    @if(session('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                </li>
            @endforeach
        </div>
        <div class="mt-16 flex justify-center">
            <form action="{{ route('get_luck') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success text-gray-900">Imfeelinglucky</button>
            </form>
        </div>
        <div class="mt-4 flex justify-center">
            @if(session('result') || session('random_number') || session('win_result') || session('pull'))
                <div class="alert alert-warning">
                    {{ 'Result ' . session('result') }}<br>
                    {{ 'Random number ' . session('random_number') }}<br>
                    {{ 'You win ' . session('win_result') }}<br>
                </div>
            @endif
        </div>
        <div class="mt-16 flex justify-center">
            <form action="{{ route('show_history') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning text-gray-900">History</button>
            </form>
        </div>
        <div class="mt-4 flex justify-center">
            @if(session('stack'))
                <div class="alert alert-warning">
                    @foreach(session('stack') as $num)
                        {{ 'Pull of last 3 numbers ' . $num }}<br>
                    @endforeach
                </div>
            @endif
        </div>
    @endauth
@endsection
