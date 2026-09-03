@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <div class="card p-6">
        <div class="max-w-2xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card p-6">
        <div class="max-w-2xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

</div>

@endsection