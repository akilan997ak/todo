@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <!-- Conditional Rendering of Vue Components -->
            <signup></signup>
            <!-- You can conditionally render the login page if needed -->
            <!-- <login></login> -->
        </div>
    </div>
@endsection
