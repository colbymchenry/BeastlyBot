@extends('layouts.app')

@section('title', 'Settings')

@section('content')

    <div class="page-header">
        <ol class="breadcrumb">
            <h4 class="font-weight-100">Settings</h4>
        </ol>
    </div>
    <div class="px-30">
        <div class="row">

            @include('partials/settings/settings_user')

            @include('partials/settings/settings_stripe')

        </div>
    </div>
@endsection


@section('scripts')
    @include('partials/settings/settings_scripts')
@endsection
