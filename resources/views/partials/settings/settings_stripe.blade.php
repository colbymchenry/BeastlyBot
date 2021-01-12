            @if(auth()->user()->getStripeHelper()->isExpressUser())
                <div class="{{ Request::is('account/settings') ? 'col-xxl-8 col-lg-12 offset-xxl-1' : 'col-12' }} order-1 order-md-2">

                    <div class="card">
                        <div class="card-body pt-20">
                            
                            <div class="row">
                                <div class="{{ Request::is('account/settings') ? 'col-md-6 col-lg-5' : 'col-12' }}">
                                    <div class="mx-auto @if(!auth()->user()->getStripeHelper()->hasActiveExpressPlan()) pt-lg-30 @endif">
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn font-size-30 grey-200 text-center btn-link" data-toggle="modal" data-target="#partnerPricingModal">
                                                <div class="row"><div><button type="button" class="btn btn-success py-1 font-size-30">Live</span></button></div></div>
                                            </a>
                                            @if(auth()->user()->getStripeHelper()->hasActiveExpressPlan())
                                            <div class="font-size-16 font-weight-200 mt-1">Active Until {{ gmdate("m-d-Y", Auth::user()->getPlanExpiration()) }}</div>
                                            <hr class="mb-10 mt-1">
                                            <a href="/servers"><button type="button" class="btn btn-block btn-success"><i class="icon-shop" aria-hidden="true"></i>
                                                    <br>My Servers</button></a>
                                            @else
                                            <h4 class="font-weight-300 mt-20">You're ready to go live and start earning!</h4>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                                <div class="{{ Request::is('account/settings') ? 'col-md-6 col-lg-5 offset-lg-1' : 'col-12' }}">
                                    <div class="btn-group btn-group-justified text-center pt-30">
                                        @if(!isset($stripe_login_link) || $stripe_login_link === null)
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary"
                                                        onclick="window.location.href = '{{ $stripe_login_link }}';">
                                                    <i class="icon icon-stripe" aria-hidden="true"></i>
                                                    <br>
                                                    <span>Connect @if(Auth::user()->error == '1')a US Stripe Account @endif</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-dark"
                                                        onclick=" window.open('{{ $stripe_login_link }}','_blank')">
                                                    <i class="icon-stripe" aria-hidden="true"></i>
                                                    <br>
                                                    <span>Stripe Payouts Dashboard</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="pt-20">@if(isset($stripe_login_link) || $stripe_login_link !== null)<span class="badge badge-dark">Stripe Connected</span> @endif @lang('lang.connect_stripe')</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif 