@extends('layouts.app')

@section('title', 'Payments')

@section('content')

    <div class="page-header">
        <h4 class="font-weight-100">Payments</h4>
    </div>

    <div class="row">

        <!-- only show this column if partner or an affiliate -->
        {{--    <div class="col-10 mx-auto">--}}
        {{--        <div class="row">--}}
        {{--                <div class="col-md-3">--}}

        {{--                    <div class="card card-block p-20">--}}
        {{--                        <div class="counter counter-lg">--}}
        {{--                            <div class="counter-label text-uppercase">Payout Total</div>--}}
        {{--                            <div class="counter-number-group">--}}
        {{--                            <!--<span class="counter-icon mr-10 green-600">--}}
        {{--                                <i class="wb-calendar"></i>--}}
        {{--                            </span>-->--}}
        {{--                            <span class="counter-number-related">$</span>--}}
        {{--                            <span class="counter-number">{{ $payout_valid + $payout_invalid }}</span>--}}
        {{--                            <div class="counter-label font-size-16">${{ $payout_invalid }} <span class="badge bg-purple-600 text-white"><i class="wb-calendar mr-1"></i> Pending</span></div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}

        {{--                </div>--}}

        {{--                <div class="col-md-6">--}}
        {{--                    <div class="card card-block border border-primary p-20">--}}
        {{--                        <div class="counter counter-md text-left">--}}
        {{--                            <div class="counter-label text-uppercase mb-5">Available Payout</div>--}}
        {{--                            <div class="counter-number-group mb-10">--}}
        {{--                            <span class="counter-number"><span class="blue-600">$</span> {{ $payout_valid }}--}}
        {{--                                @if(isset($stripe_login_link) && $stripe_login_link !== null)--}}
        {{--                                <button type="button" class="btn btn-success float-right ladda-button" data-style="slide-up" data-plugin="ladda" onclick="window.open('{{ $stripe_login_link }}', '_blank');">--}}
        {{--                                    <span class="ladda-label">Payouts Dashboard <i class="wb-arrow-right ml-1"></i></span>--}}
        {{--                                    <span class="ladda-spinner"></span>--}}
        {{--                                </button>--}}
        {{--                                @else--}}
        {{--                                <button type="button" class="btn btn-primary float-right ladda-button" data-style="slide-up" data-plugin="ladda" onclick="window.open('https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id=ca_Fm0KaKiRMrz8QMhnKfTvM0p9x1484RzG&scope=read_write')">--}}
        {{--                                    <span class="ladda-label">Payout with Stripe <i class="wb-arrow-right ml-1"></i></span>--}}
        {{--                                    <span class="ladda-spinner"></span>--}}
        {{--                                </button>--}}
        {{--                                @endif--}}
        {{--                            </span>--}}
        {{--                            </div>--}}
        {{--                            <div class="counter-label">--}}
        {{--                            <div class="progress progress-xs mb-10">--}}
        {{--                                <div class="progress-bar progress-bar-info bg-blue-600" aria-valuenow="{{ $percent_valid }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $percent_valid }}%" role="progressbar">--}}
        {{--                                <span class="sr-only">{{ $percent_valid }}%</span>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <div class="counter counter-sm text-left">--}}
        {{--                                <div class="counter-number-group">--}}
        {{--                                <span class="counter-icon blue-600 mr-5"><i class="wb-check"></i></span>--}}
        {{--                                <span class="counter-number">{{ $percent_valid }}%</span>--}}
        {{--                                <span class="counter-number-related">of payout total is available to get paid today!</span>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}

        {{--                <div class="col-md-3">--}}
        {{--                    <div class="card card-block p-20">--}}
        {{--                        <div class="counter counter-lg">--}}
        {{--                            <div class="counter-label text-uppercase">Total Earnings</div>--}}
        {{--                            <div class="counter-number-group">--}}
        {{--                        <!-- <span class="counter-icon mr-10 green-600">--}}
        {{--                                <i class="fa fa-dollar"></i>--}}
        {{--                            </span>-->--}}
        {{--                            <span class="counter-number-related">$</span>--}}
        {{--                            <span class="counter-number">{{ $total_not_paid_out }}</span>--}}
        {{--                            <div class="counter-label font-size-16">${{ $total_paid_out }} <span class="badge bg-green-600 text-white">Paid <i class="wb-arrow-right mr-1"></i></span></div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="col-lg-10 offset-lg-1">
            <div class="card">

                <div class="card-body pt-0 mt-md-10 payments">
                    <div class="list-group list-group-dividered">
                        @include('partials/payments/payments_foreach')
                  </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
        });
    </script>
@endsection
