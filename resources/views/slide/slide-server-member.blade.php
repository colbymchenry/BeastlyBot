<header class="slidePanel-header">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true"></button>
    </div>
    <h1>{{ $discord_helper->getUsername() }}</h1>
</header>

<!-- nav-tabs -->
<ul class="site-sidebar-nav nav nav-tabs nav-tabs-line" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#sidebar-user" role="tab">
            <i class="icon wb-more-vertical" aria-hidden="true"></i>
            <h5>Roles</h5>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-payments" role="tab">
            <i class="icon wb-order" aria-hidden="true"></i>
            <h5>Payments</h5>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-details" role="tab">
            <i class="icon wb-user-circle" aria-hidden="true"></i>
            <h5>Settings</h5>
        </a>
    </li>
</ul>

<style>
#sidebar-user .table tr:hover{
    background-color: rgba(255, 255, 255, 0);
}
</style>
<div class="site-sidebar-tab-content put-short tab-content">
    <div class="tab-pane fade active show" id="sidebar-user">
        <div>
            <table id="rolesTable" class="table table-hover" data-plugin="animateList" data-animate="fade" data-child="tr">
                <tbody>
                    <thead>
                    <tr>
                        <th class="cell-400 text-left">Role</th>
                        <th class="cell-150 text-right">Expires</th>
                        <th class="cell-200 text-right pr-20">Status</th>
                    </tr>
                    </thead>
                    @foreach(\App\Subscription::where('user_id', $user_id)->where('store_id', $discord_store->id)->get() as $sub)
                        @php
                        $role = $discord_helper->getRole($discord_store->guild_id, $sub->metadata['role_id']);
                        @endphp

                        <tr>
                            <td >
                                <h3><span class="badge m-5" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span></h3>
                            </td>
                            <td class="text-right">
                                <div class="time">{{ date_format($sub->current_period_end, "m-d-Y") }}</div>
                            </td>
                            @if($sub->status <= 3)
                                                @if($sub->latest_paid_out_invoice_id == $sub->latest_invoice_id) 
                                                <td class="indigo-600 w-200 text-right pr-20">Active</td>
                                                @else 
                                                    @if($sub->latest_invoice_paid_at > Carbon\Carbon::now()->subDays(15)) 
                                                    <td class="indigo-600 w-200 text-right pr-20">Active</td>
                                                    @else 
                                                    <td class="indigo-600 w-200 text-right pr-20">Active</td>
                                                    @endif 
                                                @endif
                                            @else 
                                                @if($sub->status == 4)
                                                <td class="w-200 text-right pr-20">Canceled</td>
                                                @elseif($sub->status == 5)
                                                <td class="w-200 text-right pr-20">Canceled</td>
                                                @endif
                                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="sidebar-payments">
        <div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="cell-150 text-left">Invoice</th>
                        <th class="cell-100 responsive-hide text-left">Date</th>
                        <th class="cell-100 text-left">Amount</th>
                        <th class="cell-100 text-left">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $subscription_id => $invoice_array)
                    @php
                        $subscription = \App\Subscription::where('id', $subscription_id)->first();
                        $role = $discord_helper->getRole($discord_store->guild_id, $subscription->metadata['role_id']);
                    @endphp
                        @foreach($invoice_array as $invoice)
                        <tr data-url="/slide-invoice?id={{ $invoice->id }}&user_id={{ $user_id }}&role_id={{ $role->id }}&guild_id={{ $discord_store->guild_id }}" data-toggle="slidePanel">
                            <td><a href="javascript:void(0)">#{{ $invoice->number }}</a></td>
                            <td class="responsive-hide">
                                <span class="text-muted"><i class="wb wb-time"></i> {{ date("Y-m-d", $invoice->created) }}</span>
                            </td>
                            <td>${{ number_format($invoice->amount_paid/100, 2, '.', ',') }}</td>
                            <td><span class="badge m-5" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span></td>
                        </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   <div class="tab-pane fade" id="sidebar-details">
        <div>
            <div>
                <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between">
                    <h5>Ban from Store</h5>
                    <div>
                        <button type="button" class="btn btn-dark btn-block ban-user-from-store">Ban User from Store</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on("click", ".ban-user-from-store", function () {
    $.ajax({
        url: '/bknd-000/ban-user-from-store',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
    }).done(function (response) {
        console.log(response);
        
        
    })

});
</script>

@include('partials/clear_script')
