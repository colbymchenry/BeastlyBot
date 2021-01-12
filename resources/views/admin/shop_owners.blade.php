@extends('layouts.app')

@section('title', 'Admin - Partner List')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Partner List</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
          <li class="breadcrumb-item" href="/admin/shop">Shop</li>
          <li class="breadcrumb-item active">Owners</li>
        </ol>
       <!-- <div class="page-header-actions">
            <a class="btn btn-sm btn-primary btn-outline btn-round">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Shop Owners</span>
            </a>
        </div>-->
      </div>
<div class="page-content">
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="row">
                <div class="col-12">




                <table id="partnerListTable" class="table table-hover mb-50" data-plugin="animateList" data-animate="fade" data-child="tr">
                    <tbody>
                        @foreach($shops as $shop)


                        <tr id="admin_table_">
                            <td class="cell-30 pl-15 text-right">
                                <h6>1</h6>
                            </td>
                            <td class="cell-400 pl-15">
                                <div class="content text-left">
                                    <h4><span class="badge badge-{{ $shop->live ? 'success' : 'primary' }}">{{ $shop->live ? 'Live' : 'Test' }}</span>  <a href="{{ env('APP_URL') }}/shop/{{ $shop->url }}">{{ $shop->url }}</a></h4>
                                    <p>{{ $shop->id }} / {{ $shop->refunds_enabled ? 'Yes' : 'No' }} @if( $shop->refunds_enabled) - {{ $shop->refunds_days }} days - @if($shop->refunds_terms == "1")NQA @endif @if($shop->refunds_terms == "2")ASD @endif @endif</p>
                                </div>
                            </td>
                            <td>
                                <p class="text-wrap">{{ $shop->description }}</p>
                            </td>
                            <td class="cell-300 pr-20 text-right">
                                <div class="time">{{ App\User::where('id', '=' ,$shop->owner_id)->get()[0]->getDiscordUsername() }} <small>({{ $shop->where('owner_id', '=', (App\User::where('id', '=' ,$shop->owner_id)->value('id')))->count()}} Shop)</small></div>
                                <div class="identity">{{ App\User::where('id', '=' ,$shop->owner_id)->get()[0]->getDiscordEmail() }}</div>
                            </td>
                            <td class="cell-100 pr-20">
                                <button type="button" class="btn btn-dark" data-url="/slide-payout/{{ App\User::where('id', $shop->owner_id)->value('stripe_express_id') }}" data-toggle="slidePanel">Stripe</button>
                            </td>
                            <td class="cell-100 pr-20">
                                <button type="button" class="btn btn-primary">Login</button>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
