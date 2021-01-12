<div class="tab-pane fade active show" id="tab-server">
    <div class="row">

        <div class="col-xxl-6 offset-xxl-1 col-lg-6">

            <!-- Panel Watchlist -->
            <div class="panel panel-shadow mt-5" id="panel-products">
                <div class="panel-heading">
                    <div class="ribbon-container">
                        <div class="ribbon ribbon-primary">
                            <span class="ribbon-inner">Products</span>
                        </div>
                        <p>Enable roles<span class="hidden-md-down"> for purchase on your shop</span></p>
                    </div>
                    <div class="panel-actions panel-actions-keep">
                    <button type="button" class="btn btn-sm btn-dark btn-icon btn-round mr-5" onclick="refreshRoles()" id="btn_refresh-roles"
                                data-toggle="tooltip" data-original-title="Refresh Roles">
                            <i class="icon wb-refresh" aria-hidden="true"></i>
                        </button>
                       <button type="button" class="btn btn-sm btn-dark btn-icon btn-round" onclick="btnEditRoles()" id="btn_edit-roles"
                                data-toggle="tooltip" data-original-title="Show All">
                            <i class="icon wb-plus" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon btn-round d-none btn_save-roles" id="btn_save-roles"
                                data-toggle="tooltip" data-original-title="Done">
                            <span class="d-none text_save-roles"></span> <i class="icon wb-minus" id="icon_save-roles" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-body px-0 pb-10">
                    <table class="table" data-plugin="animateList"
                        data-animate="fade"
                        data-child="tr">
                        <tbody id="roles_table">
                            @foreach($roles as $role) 
                           
                            @if($role->name !== '@everyone' && !$role->managed)
                            @php
                            $active = in_array($role->id, $active_roles);
                            @endphp

                            <tr class="role @if($active) active-role @else inactive-role d-none @endif" id="{{ $id . '_' . $role->id }}">
                                <td class="pl-15">
                                    <div class="content text-left">
                                        <span class="badge badge-primary badge-lg" style="background-color: #{{ dechex($role->color) }}"><i class="icon-discord mr-2" aria-hidden="true"></i>
                                        <span id="rolename-{{ $role->id }}">{{ $role->name }}</span></span>
                                    </div>
                                </td>
                                <td class="info-role w-20 grey-4" style="display:none; visiblity:hidden">
                                    <i class="icon wb-payment" id="active-cell_{{ $role->id }}" aria-hidden="true" data-toggle="tooltip" data-original-title="Subscriptions Enabled"></i>
                                </td>
                                <td class="info-role w-200 pr-lg-10 text-right">
                                    <div class="time"><span id="sub_count_{{ $role->id }}">{{ $subscribers[$role->id] }}</span> Sub<span class="hidden-md-down">scription</span><span id="sub-suffix_{{ $role->id }}">s</span></div>
                                    <div class="identity d-none" id="status_{{ $id }}_{{ $role->id }}"><i class="icon wb-medium-point yellow-500" id="state_color_{{ $role->id }}" aria-hidden="true"></i><span id="state_{{ $role->id }}">@if($active) Active @else Inactive @endif</span></div>
                                </td>
                                <td class="cell-120 cell-sm-120 toggle-role d-none">
                                    <button type="button" class="btn btn-icon @if($active) btn-primary @else disabled btn-dark @endif py-md-20 w-p100" disabled="@if($active) true @else false @endif" id="product-settings_{{ $id }}_{{ $role->id }}" data-url="/slide-roles-settings/{{ $id }}/{{ $role->id }}" data-toggle="slidePanel"><i class="icon wb-more-horizontal" aria-hidden="true"></i></button>
                                </td>
                                <td class="cell-60 hidden-md-up settings-role" data-toggle="slidePanel" data-url="/slide-roles-settings/{{ $id }}/{{ $role->id }}">
                                    <button class="btn btn-primary btn-icon" data-toggle="tooltip" data-original-title="Settings"><i class="icon wb-more-horizontal" aria-hidden="true"></i></button>
                                </td>
                                <td class="cell-120 pr-15 hidden-sm-down settings-role" data-toggle="slidePanel" data-url="/slide-roles-settings/{{ $id }}/{{ $role->id }}">
                                    <button class="btn btn-block btn-primary btn-icon py-20" data-toggle="tooltip" data-original-title="Settings"><i class="icon wb-more-horizontal" aria-hidden="true"></i></button>
                                </td>
                                <td class="cell-100 cell-sm-100 toggle-role d-none text-right">
                                    <button type="button" class="btn btn-primary btn-icon btn-round py-md-20 w-p80 animation-scale-up @if($active) active @endif toggle-btn-trigger" id="toggle-product_{{ $id }}_{{ $role->id }}" data-role_id="{{ $role->id }}"><i class="icon @if($active) wb-minus @else wb-plus @endif text-white" aria-hidden="true" id="toggle-product-icon_{{ $id }}_{{ $role->id }}"></i></button>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-lg-6">
            <!-- Panel Watchlist -->
            <div class="panel panel-shadow mt-5">
                <div class="panel-heading">
                    <div class="ribbon-container">
                        <div class="ribbon ribbon-success">
                            <span class="ribbon-inner">New Payments</span>
                        </div>
                        <p>&#8205;</p>
                    </div>
                    <div class="panel-actions panel-actions-keep" onclick="fillRecentPayments('{{ $shop->id }}');">
                        <button type="button" class="btn btn-sm btn-dark btn-icon btn-round" id="btn_recent-refresh"
                                data-toggle="tooltip" data-original-title="Refresh">
                            <i class="icon wb-refresh" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-body h-350 pb-10" data-plugin="scrollable">
                    <div data-role="container">
                        <div data-role="content" class="p-0">
                            <table class="table mb-0" data-plugin="animateList" data-animate="fade" data-child="tr">
                                <tbody class="table bg-grey-3 loading-bg" hidden>
                                    @include('partials/server/loaders/new-payments')                
                                </tbody>
                                <tbody id="recent-transactions-table">
                                    @foreach(\App\Subscription::where('store_id', $shop->id)->whereDay('latest_invoice_paid_at', '=', date('d'))->whereMonth('latest_invoice_paid_at', '=', date('m'))->whereYear('latest_invoice_paid_at', '=', date('Y'))->orderBy('latest_invoice_paid_at', 'DESC')->take(25)->get() as $sub) 
                                    @php
                                        $discord_id = \App\DiscordOAuth::where('user_id', $sub->user_id)->first()->discord_id;
                                        $discord_helper = new \App\DiscordHelper(\App\User::where('id', $sub->user_id)->first());

                                        $start = new DateTime($sub->latest_invoice_paid_at);
                                        $end = new DateTime('NOW');
                                        $interval = $end->diff($start);
                                        $days = $interval->format('%d');
                                        $hours = 24 * $days + $interval->format('%h');
                                        $minutes = $interval->format('%i');

                                    @endphp
                                    <tr data-url="/slide-invoice?id={{ $sub->latest_invoice_id }}&user_id={{ $sub->user_id }}&role_id={{ $sub->metadata['role_id'] }}&guild_id={{ $id }}" data-toggle="slidePanel">
                                        <td class="w-120 font-size-12 pl-20">@if($hours < 1) {{ $minutes . ' minutes ago.' }} @else {{ $hours . ' hours ago.' }} @endif</td>
                                        <td class="content"><div>{{ $discord_helper->getUsername() }}</div></td>
                                        <td class="green-600 w-120 text-right pr-20">+ ${{ number_format($sub->latest_invoice_amount / 100, 2, '.', ',') }}</td>
                                    </tr>
                                    @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel Watchlist -->
        </div>

        


    </div>
</div>

<div class="tab-pane fade" id="sidebar-roles">
    <div class="page-header">
        <h1 class="page-title responsive-hide" id="role_count">Loading...</h1>
        <div class="page-header-actions">
            <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round"
                    data-toggle="tooltip" data-original-title="Refresh">
                <i class="icon wb-refresh" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div>

        <table class="table" data-plugin="animateList" data-animate="fade"
               data-child="tr">
            <tbody id="roles_table"></tbody>
        </table>
        <!-- pagination -->

    </div>
</div><!-- end tab -->

<form id="refresh-roles-form" action="/refresh-roles/{{ $id }}" method="POST" hidden>
@csrf
</form>

