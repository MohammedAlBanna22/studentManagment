@extends('app.layout')

@section('head')
    <title>Profile</title>
@endsection

@section('content')
<div class="page-wrapper" style="max-width: 860px; margin: 0 auto; padding: 2rem;">

    <div class="card-header" style="margin-bottom: 2rem;">
        <h1 style="font-family: 'Syne', sans-serif; font-size: 1.8rem; font-weight: 800; letter-spacing: -0.02em;">
            Profile
        </h1>
        <p style="color: var(--muted); font-size: 0.88rem; margin-top: 0.25rem;">
            Manage your account settings
        </p>
    </div>

    {{-- Update Profile Info --}}
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 2rem; margin-bottom: 1.25rem;">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Update Password --}}
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 2rem; margin-bottom: 1.25rem;">
        @include('profile.partials.update-password-form')
    </div>

    {{-- Delete Account --}}
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 2rem; border-color: rgba(255,101,132,0.2);">
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection
