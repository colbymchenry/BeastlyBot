<header class="slidePanel-header bg-dark">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true"></button>
    </div>
    <h1>Payout</h1>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-payout">
        <div>
            <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-block border border-primary p-20">
                        <div class="counter counter-md text-left">
                            <div class="counter-label text-uppercase mb-5">PENDING EARNINGS</div>
                            <div class="counter-number-group mb-10">
                            <span class="counter-number"><span class="blue-600">$</span> {{ number_format($earnings, 2, '.', ',') }}
                                <button type="button" class="btn btn-success float-right ladda-button" data-style="slide-up" data-plugin="ladda" onclick="window.open('{{ $stripe_login_link }}', '_blank');">
                                    <span class="ladda-label">Stripe Dashboard <i class="wb-arrow-right ml-1"></i></span>
                                    <span class="ladda-spinner"></span>
                                </button>
                            </span>
                            </div>
                            <div class="counter-label">
                                <div class="counter counter-sm text-left">
                                    <div class="counter-number-group">
                                    <span class="counter-icon blue-600 mr-5"><i class="wb-check"></i></span>
                                    <span class="counter-number h5">Funds will automatically be transferred to your connected Stripe account!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card card-block p-20">
                        <div class="counter counter-lg">
                            <div class="counter-label text-uppercase">Payout Total</div>
                            <div class="counter-number-group">
                            <!--<span class="counter-icon mr-10 green-600">
                                <i class="wb-calendar"></i>
                            </span>-->
                            <span class="counter-number-related">$</span>
                            <span class="counter-number">$payout_valid + $payout_invalid</span>
                            <div class="counter-label font-size-16">$ $payout_invalid <span class="badge bg-purple-600 text-white"><i class="wb-calendar mr-1"></i> Pending</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-block p-20">
                        <div class="counter counter-lg">
                            <div class="counter-label text-uppercase">Total Earnings</div>
                            <div class="counter-number-group">
                        <!-- <span class="counter-icon mr-10 green-600">
                                <i class="fa fa-dollar"></i>
                            </span>-->
                            <span class="counter-number-related">$</span>
                            <span class="counter-number">$total_not_paid_out</span>
                            <div class="counter-label font-size-16">$$total_paid_out <span class="badge bg-green-600 text-white">Paid <i class="wb-arrow-right mr-1"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                {{-- <div class="card"> --}}

                    <div class="card-body pt-0 mt-md-10 payments">
                        <div class="list-group list-group-dividered">
                            @foreach($pending_invoices as $invoice)
                            <a class="list-group-item flex-column align-items-start" href="javascript:void(0)"
                                data-url="/slide-invoice/{{ $invoice['id'] }}" data-toggle="slidePanel">
                                <span class="badge badge-pill badge-primary badge-outline mr-2 hidden-sm-down" style="margin-top: 0.75em;">Transferring in {{ (round(abs($invoice['created'] - strtotime('-'.$stripe_payout_delay.' days', time()))/60/60/24)) }} Day{{ (round(abs($invoice['created'] - strtotime('-'.$stripe_payout_delay.' days', time()))/60/60/24)) > 1 ? 's' : '' }}</span>
                                <div><p class="desc">{{ $invoice['lines']['data'][0]['description'] }}</p></div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        </div>
    </div>
</div>

@include('partials/clear_script')
