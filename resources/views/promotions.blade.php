@extends('layouts.app')

@section('title', 'Promotions')

@section('content')

    <div class="page-header">
    <h4 class="font-weight-100">Promos</h4>
        <div class="page-header-actions pulse">
            <a class="btn btn-primary bg-indigo-600 btn-round white" id="ABbtn"
            data-url="slide-promotions-add-coupon" data-toggle="slidePanel">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Add Coupon</span>
            </a>
            <a class="btn btn-primary btn-outline btn-round d-none" id="RBbtn" href="/promotions">
                <i class="icon wb-refresh" aria-hidden="true"></i>
                <span class="hidden-sm-down">Refresh</span>
            </a>
        </div>
    </div>

    <div class="page-content-table">

        <div class="page-main text-center">

            @include('partials/promotions/promotions_table')

        </div>
    </div>

@endsection