@extends('layouts.app')

@section('title', 'Subscriptions')

@section('content')
<div class="page-header text-md-center">
            <h4 class="font-weight-100">Subscriptions</h4>
        </div>
<div class="row">
    <div class="col-lg-10 offset-lg-1">


        <div class="page-content-table">
            <div class="page-main">

                <!-- nav-tabs -->
                <ul class="site-sidebar-nav nav nav-tabs nav-tabs-line bg-grey-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab-active" role="tab">
                            <i class="icon wb-star" aria-hidden="true"></i>
                            <h5>Active</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-inactive" role="tab">
                            <i class="icon wb-star-outline" aria-hidden="true"></i>
                            <h5>Inactive</h5>
                        </a>
                    </li>
                </ul>

                <div class=" tab-content">

                    <div class="tab-pane active show" id="tab-active">
                    <!-- active subs tab -->
                        <table class="table table-hover" id="SubscriptionTable">
                            <thead>
                                <tr>
                                    <th class="cell-200 text-left">Server</th>
                                    <th class="text-left">Role</th>
                                    <th class="cell-30"></th>
                                    <th class="cell-150 text-right">More</th>
                                    <th class="cell-30 hidden-md-down"></th>
                                </tr>
                            </thead>
                            <tbody id="activeSubsTable" data-plugin="animateList" data-animate="fade"
                            data-child="tr">

                            @foreach(auth()->user()->getStripeHelper()->getSubscriptions('active') as $subscription)

                            @php
                                $plan_id = $subscription['items']['data'][0]['plan']['id'];
                            @endphp

                            @if(strpos($plan_id, 'discord_') !== false)

                            @php
                                $data = explode('_', $plan_id);
                                $guild = $discord_helper->getGuild($data[1]);
                                $role = $discord_helper->getRole($data[1], $data[2]);
                            @endphp

                            <tr id="subscription_{{ $subscription['id'] }}" data-url="/slide-account-subscription-settings?id={{ $subscription['id'] }}&guild_name={{ $guild->name }}&role_name={{ $role->name }}&role_color={{ dechex($role->color) }}" data-toggle="slidePanel">
                                <td class="cell-200 text-left">
                                    <h4>{{ $guild->name }}</h4>
                                </td>
                                <td class="text-left">
                                    <span class="badge badge-primary text-left" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span>
                                </td>
                                <td class="cell-30">
                                    <i class="icon wb-payment grey-4 green-500" aria-hidden="true"></i>
                                </td>
                                <td class="cell-150 text-right">
                                    <div class="time">{{ date("m-d-Y", $subscription['current_period_end']) }}</div>
                                    <div class="identity">Active<i class="icon ml-2 mt-1 wb-medium-point green-500" aria-hidden="true"></i>
                                    </div>
                                </td>
                                <td class="cell-30 hidden-md-down">
                                </td>
                            </tr>
                            @endif
                            
                            @endforeach

                            </tbody>
                        </table>
                        <!-- pagination -->
                    </div>
                    <div class="tab-pane" id="tab-inactive">
                    <!-- inactive subs tab -->
                        <table class="table table-hover" id="SubscriptionTable">
                            <thead>
                                <tr>
                                    <th class="cell-200 text-left">Server</th>
                                    <th class="text-left">Role</th>
                                    <th class="cell-30"></th>
                                    <th class="cell-150 text-right">More</th>
                                    <th class="cell-30 hidden-md-down"></th>
                                </tr>
                            </thead>
                            <tbody id="inactiveSubsTable" data-plugin="animateList" data-animate="fade"
                            data-child="tr">

                            @foreach(auth()->user()->getStripeHelper()->getSubscriptions('canceled') as $subscription)

                            @php
                                $plan_id = $subscription['items']['data'][0]['plan']['id'];
                            @endphp

                            @if(strpos($plan_id, 'discord_') !== false)

                            @php
                                $data = explode('_', $plan_id);
                                $guild = $discord_helper->getGuild($data[1]);
                                $role = $discord_helper->getRole($data[1], $data[2]);
                            @endphp

                            <tr id="subscription_{{ $subscription['id'] }}" data-url="/slide-account-subscription-settings?id={{ $subscription['id'] }}&guild_name={{ $guild->name }}&role_name={{ $role->name }}&role_color={{ dechex($role->color) }}" data-toggle="slidePanel">
                                <td class="cell-200 text-left">
                                    <h4>{{ $guild->name }}</h4>
                                </td>
                                <td class="text-left">
                                    <span class="badge badge-primary text-left" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span>
                                </td>
                                <td class="cell-30">
                                    <i class="icon wb-payment grey-4 red-500" aria-hidden="true"></i>
                                </td>
                                <td class="cell-150 text-right">
                                    <div class="time">{{ date("m-d-Y", $subscription['current_period_end']) }}</div>
                                    <div class="identity">Canceled<i class="icon ml-2 mt-1 wb-medium-point red-500" aria-hidden="true"></i>
                                    </div>
                                </td>
                                <td class="cell-30 hidden-md-down">
                                </td>
                            </tr>
                            @endif
                            
                            @endforeach
                            

                            </tbody>
                        </table>
                        <!-- pagination -->
                    </div>

                </div>


            </div>

        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#rolesTable tr').each(function() {
            $(this).first().attr('data-step', '2');
            $(this).first().attr('data-intro', 'Now lets open this');
        });
    </script>
    <script>
        setTimeout(function(){
        if (RegExp('multipage', 'gi').test(window.location.search)) {
            introJs().setOption('disableInteraction','false').start();
            $('#rolesTable tr').each(function(){
                $(this).attr('data-url', $(this).data('url') + '?multipage=true');
            })
        }}, 1000);
    </script>
@endsection

