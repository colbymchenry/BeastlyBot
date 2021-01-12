<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="tab_subscribe">
        <div>
        @if(auth()->user()->canAcceptPayments())
                    <div class="card border-0 font-size-16">
                        <div class="card-block p-0 reverse-class">
                            <div class="text-center mt-md-20">
                            <h4 class="text-white font-weight-300 my-20 my-lg-50">You can start earning!</h4>
                                <div class="w-300 mx-auto">
                                        <div>
                                            <a href="#" class="btn font-size-30 text-white text-center btn-link">
                                                <div class="row"><div class="ml-2"><button type="button" class="btn btn-success py-1 font-size-30">Live</span></button></div></div>
                                            </a>
                                            <div class="font-size-16 font-weight-200 mt-1">Active Until</div>
                                            <hr class="mb-10 mt-1">
                                            <a href="/servers?click-first=true"><button type="button" class="btn btn-block btn-success mt-5"><i class="icon-shop" aria-hidden="true"></i>
                                                    <br>My Servers</button></a>
                                            <a href="#"><button type="button" class="btn btn-dark btn-outline mt-20">Cancel Plan</button></a>
                                        </div>

                                    </div>

                            </div>
                        </div>
                    </div>
        @elseif(!auth()->user()->getStripeHelper()->hasExpressPlan())
            @include('/block/steps')
            <div class="row mt-lg-25">
                <div class="col-lg-8 col-md-12 offset-lg-2">

                    <div class="card border-0 font-size-16">
                        <div class="card-block p-0">
                            <div class="text-center mt-md-20">
                                <h4 class="font-weight-300 mb-md-20">You're ready to go live and start earning!</h4>

                            </div>

                            <div class="mt-20 mt-md-20 mt-lg-40">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-lg-4 order-2 order-md-1">
                                        <ul class="text-center mt-20 mt-md-0 text-md-right list-group font-weight-100 mt-lg-5 mb-0">
                                            <li class="list-group-item py-0 font-size-12 text-uppercase font-weight-400 visible-sm-down hidden-md-up text-md-right pt-sm-20">Features</li>
                                            <li class="list-group-item py-1 text-md-right">Public Stores</li>
                                            <li class="list-group-item py-1 text-md-right">Accept Payments</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 text-center order-1 order-md-2">
                                        <div>
                                            <!--<a href="javascript:buyPlan(true);" class="btn font-size-30 grey-100 text-center btn-link">
                                                <div class="row"><i class="wb-arrow-right mr-2"></i> Go<div class="pulse ml-2"><button type="button" class="btn btn-success py-1 font-size-30">Live</span></button></div></div>
                                            </a>-->
                                            <!--<div class="font-size-16 font-weight-200 mt-1 mr-20"><span class="font-weight-400"><sup><del>$25/mo</del></sup></span> <span class="font-size-18 grey-100 font-weight-600 animation-fade animation-delay-400">$0 <span class="font-weight-200">try for free!</span></span></div>
                                            <hr class="mb-10 mt-1">-->
                                            <a href="javascript:buyPlan(true);"><button onclick="buyPlan(true);" type="button" class="btn btn-block btn-success font-size-14"><h2 class="my-1 text-white">Live</h2>Special Free 30-day Trial<!--<br><small class="text-white">$0 today</small>--><!--(first month free, then $25/m) Live Special Free Promo--></button></a>
                                            {{--<p class="my-2">or</p>--}}
                                            {{--<small><a href="#" onclick="buyPlan(false);">Live Yearly (5 months free)</a></small>--}}
                                            <a href="javascript:buyPlan(false);"><button onclick="buyPlan(false);" type="button" class="btn btn-block {{--btn-success btn-outline--}} btn-link font-size-14 green-300 mt-2">or {{--<h2 class="my-1">Live Yearly</h2>--}}Live Yearly (5 months free)</button></a>
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4 order-3 order-md-3">
                                        <ul class="text-center mt-md-20 mt-md-0 text-md-left list-group font-weight-100 mt-lg-5">
                                            <li class="list-group-item py-1 text-md-left">Daily Payout</li>
                                            <li class="list-group-item py-1 text-md-left">24x7 Support Chat</li>
                                        </ul>
                                    </div>

                                    <!--<div class="col-12 col-md-6 col-lg-4 text-center order-1 order-lg-2">
                                        <div>
                                            <a href="javascript:void(0)" class="btn font-size-30 grey-600 text-center btn-link">
                                                <div class="row"><i class="wb-arrow-right mr-2"></i> Go<div class="pulse" style="margin-left: 0.2em;margin-top: -0.1em;"><button type="button" class="btn btn-success py-1 font-size-30" onclick="javascript:buyPlan(true);">Live</span></button></div></div>
                                            </a>

                                            <div class="btn-group btn-group-justified">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-light waves-effect waves-classic">
                                                    <span class="text-uppercase">Monthly</span>
                                                    </button>
                                                </div>

                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-light waves-effect waves-classic">
                                                    <span class="text-uppercase">Yearly</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="font-size-14 mt-10 font-weight-500">$25/month <a href="javascript:buyPlan(false);" class="font-size-14">or save $120 yearly</a></div>

                                        </div>


                                    </div>-->

                                </div>
                            </div>

                        </div>
                    </div>

                    <!--<div class="card card-shadow text-center font-size-16">
                        <div class="card-block p-0">
                            <div class="p-30 vertical-align-middle">
                                <p class="font-size-30 grey-600">Go <span class="badge badge-lg badge-success font-size-30">Live</span></p>
                            </div>
                            <div class="text-center">
                                <h4 class="grey-500">You're ready to go live and start earning!</h4>
                            </div>
                            <div class="bg-green-600 p-30">
                            <div class="row">
                                <div class="col-6">
                                <div class="white">
                                    <button class="btn btn-success btn-outline btn-inverse btn-lg">Subscribe</button>
                                </div>
                                <div class="font-size-14 white mt-5">$25/mo</div>
                                </div>
                                <div class="col-6">
                                <div class="white">
                                    <button class="btn btn-success btn-outline btn-inverse btn-lg">Subscribe</button>
                                </div>
                                <div class="font-size-14 white mt-5">$360/yr</div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-8 col-md-12 offset-lg-2 text-center">
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action flex-column align-items-start text-center" href="{{ \App\StripeHelper::getConnectURL() }}">
                            <h4 class="list-group-item-heading mt-0 mb-5">Connect Stripe</h4>
                            <p class="mb-0">To go live and take payments connect your email with Stripe, our secure payment processor.</p>
                            <button type="button" class="btn btn-primary btn-block w-300 mt-20 ladda-button mx-auto"
                                    onclick="window.location.href = '{{ \App\StripeHelper::getConnectURL() }}';"
                                    data-style="slide-up" data-plugin="ladda">
                                    <i class="icon-stripe ladda-label" aria-hidden="true"></i>
                                    <br>
                                    <span class="ladda-label">Connect Stripe</span>
                                    <span class="ladda-spinner"></span>
                                </button>

                        </a>
                    </div>

                </div>
            </div>
            @endif
            </div>
    </div>
</div>

<script type="text/javascript">
    function buyPlan(monthly) {
        $.ajax({
            url: '/process-checkout',
            type: 'POST',
            data: {
                'product_type': 'express',
                'billing_cycle': monthly ? 1 : 12,
               
             {{--   'coupon_code': monthly ? 'promo_1HZ3vJHTMWe6sDFbuyfevPls' : '', --}}
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if (msg['success']) {
                swal.close();
                stripe.redirectToCheckout({
                    sessionId: msg['msg']
                }).then(function (result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer
                    // using `result.error.message`.
                });
            } else {
                Swal.fire({
                    title: 'Failure',
                    text: msg['msg'],
                    showCancelButton: false,
                    showConfirmButton: true,
                    target: document.getElementById('slider-div')
                });
            }
        });
    }
</script>
