@extends('layouts.app')

@section('content')
ini dashboard user

<form action="{{ route('logout') }}" method="POST" class="inline">
    @csrf
    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
        Logout
    </button>
</form>

@endsection
