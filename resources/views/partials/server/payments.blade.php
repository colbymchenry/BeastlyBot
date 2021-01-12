<style>
.list-hover li:hover{
    background-color: #25252b;
}
.page-link {
    border: 1px solid #1c2327;
}
.page-item.disabled .page-link {
    border-color: #1c2327;
}
</style>
<div class="tab-pane tab-large fade" id="tab-payments">
    <!--<div class="page-header">
        <h1 class="page-title responsive-hide">Payments</h1>
        <div class="page-header-actions">
          <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round waves-effect waves-classic" id="btn_payments-refresh" data-toggle="tooltip" data-original-title="Refresh">
            <i class="wb-refresh" aria-hidden="true"></i>
          </button>
        </div>
    </div>-->


            <div class="row">

            <div class="col-md-10 offset-md-1">
         
                <div class="card card-shadow card-responsive" id="paymentsChart">
                    <div class="card-block p-0">
                    <div class="p-30" style="height:120px;">
                        <div class="row">
                            <div class="col-4">
                                <div class="counter text-left">
                                <div class="counter-label blue-grey-200">Total Payout</div>
                                <div class="counter-number-group">
                                    <span class="counter-number green-600">{{ number_format(($total_payout / 100), 2, '.', ',') }}</span>
                                    <span class="counter-number-related green-600 font-size-12">USD</span>
                                </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter text-left">
                                <div class="counter-label">Weekly Av<span class="hidden-md-down">era</span>g<span class="hidden-md-down">e</span></div>
                                <div class="counter-number-group">
                                    <span class="counter-number">{{ number_format(($average_weekly / 100), 2, '.', ',') }}</span>
                                    <span class="counter-number-related font-size-12">USD</span>
                                </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter text-left">
                                <div class="counter-label">Pending Payout</div>
                                <div class="counter-number-group">
                                    <span class="counter-number">{{ number_format(($pending_payout / 100), 2, '.', ',') }}</span>
                                    <span class="counter-number-related font-size-12">USD</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($subscriptions->count() > 0)
                

                                <table class="table mb-0" data-plugin="animateList" data-animate="fade" data-child="tr">
                                    <tbody id="recent-transactions-table">
                                    @foreach($subscriptions as $subscription)
                                        @php
                                    
                                        $discord_helper = new \App\DiscordHelper(\App\User::where('id', $subscription->user_id)->first());
                                        $role = $discord_helper->getRole($id, $subscription->metadata['role_id']);
                                        @endphp
                                        <tr data-url="/slide-invoice?id={{ $subscription->latest_invoice_id }}&user_id={{ $subscription->user_id }}&role_id={{ $role->id }}&guild_id={{ $id }}" data-toggle="slidePanel">
                                            <td class="w-250 pl-20 responsive-hide">{{ $discord_helper->getUsername() }}</td>
                                            <td class="content"><div><span class="badge m-5" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span></div></td>
                                            <!--Status: 1) Active 2) Canceled 3) Refund Requested 4) Overdue / Deleted 5) Refunded / Deleted-->
                                            @if($subscription->status <= 3)
                                                @if($subscription->latest_paid_out_invoice_id == $subscription->latest_invoice_id) 
                                                <td class="green-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="green-600 w-200 text-right pr-20">Paid Out</td>
                                                @else 
                                                    @if($subscription->latest_invoice_paid_at < Carbon\Carbon::now()->addDays(21))
                                                    <td class="green-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                    <td class="green-600 w-200 text-right pr-20">Pending</td>
                                                    @else 
                                                    <td class="indigo-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                    <td class="w-200 text-right pr-20">Invoice Sent</td>
                                                    @endif 
                                                @endif
                                            @else 
                                                @if($subscription->status == 4)
                                                <td class="green-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="w-200 text-right pr-20">Canceled</td> <!-- reversed & refunded too-->
                                                @elseif($subscription->status == 5)
                                                <td class="pink-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="w-200 text-right pr-20">Refunded</td> <!-- paying out but canceled (owner refund) -->
                                                @elseif($subscription->status == 6)
                                                <td class="w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="w-200 text-right pr-20">Dispute Pending</td>
                                                @elseif($subscription->status == 7)
                                                <td class="green-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="w-200 text-right pr-20">Dispute Won</td>
                                                @elseif($subscription->status == 8)
                                                <td class="pink-600 w-200 text-right pr-20 hidden-sm-down">${{ number_format(($subscription->latest_invoice_amount / 100), 2, '.', ',') }} USD</td>
                                                <td class="w-200 text-right pr-20">Dispute Lost</td>
                                                @endif
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        
                    @endif
                    <div class="float-right mt-20">
                    {{ $subscriptions->render() }}
                    </div>

                    <div class="ct-chart h-150"></div>
                    </div>
                </div>

                    

             
            </div>

           {{-- <div class="col-md-10 offset-md-1">
                 <div class="card">

                    <div class="card-header card-header-transparent py-20">
                        <ul class="nav nav-pills nav-pills-rounded chart-action">
                            <li class="nav-item"><a class="active nav-link" id="payments-btn" href="#">Sales</a></li>
                           <!-- <li class="nav-item"><a class="nav-link" id="disputes-btn" href="#" onclick="loadDisputes()">Disputes</a></li>-->
                        </ul>
                    </div>

                    <div class="card-body pt-0 mt-md-10 payments">
                        <div class="list-group list-group-dividered" id="payments-loading_table">
                            @include('partials/server/loaders/payments-loader')
                        </div>
                        <div class="list-group list-group-dividered" id="payments_table">
                        </div>
                        <div class="list-group list-group-dividered hidden" id="disputes_table">
                        </div>
                    </div>

                </div>
            </div>--}}

        </div>


