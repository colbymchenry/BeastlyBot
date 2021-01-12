@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="page-aside">

<div class="page-aside-switch">
  <i class="icon wb-chevron-left" aria-hidden="true"></i>
  <i class="icon wb-chevron-right" aria-hidden="true"></i>
</div>

<div class="page-aside-inner page-aside-scroll">
  <div data-role="container">
    <div data-role="content">

    <div class="card">
              <div class="card-header">
                Servers
              </div>
              <div class="card-block p-0">
                <ul class="list-group list-group-full list-group-dividered mb-0">
                  <li class="list-group-item px-5">
                    <div class="d-flex align-items-start">
                      <div class="pl-2 pr-10">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="https://cdn.discordapp.com/icons/608894397328785440/9cd0dbd96c17009815b7a0f90ac05a33.jpg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-5 mb-5">Server Name</h5>
                        <small>123 Members</small>
                      </div>
                      <div class="pl-5">
                        <button type="button" class="btn btn-primary mt-5">Shop</button>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item px-5">
                    <div class="d-flex align-items-start">
                      <div class="pl-2 pr-10">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="https://cdn.discordapp.com/icons/608894397328785440/9cd0dbd96c17009815b7a0f90ac05a33.jpg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-5 mb-5">Server Name</h5>
                        <small>123 Members</small>
                      </div>
                      <div class="pl-5">
                        <button type="button" class="btn btn-primary mt-5">Shop</button>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item px-5">
                    <div class="d-flex align-items-start">
                      <div class="pl-2 pr-10">
                        <a class="avatar avatar-lg" href="javascript:void(0)">
                          <img class="img-fluid" src="https://cdn.discordapp.com/icons/608894397328785440/9cd0dbd96c17009815b7a0f90ac05a33.jpg" alt="...">
                        </a>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-5 mb-5">Server Name</h5>
                        <small>123 Members</small>
                      </div>
                      <div class="pl-5">
                        <button type="button" class="btn btn-primary mt-5">Invite</button>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

    </div>
  </div>
</div>
<!---page-aside-inner-->
</div>

<div class="page-main">
<div class="container-fluid mt-20 px-lg-30">

      <!-- start big row -->
      <div class="row">
        <div class="col-12">
          <h4 class="font-weight-100">Dashboard</h4>
        </div>
        <div class="col-12 order-2 order-md-1">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-bordered mb-md-0">
                  <div class="row no-space">
                    <div class="col-md-12 col-lg-7 col-xl-8">
                        <div class="card-block h-150 bg-grey-2 overlay">
                          <div class="overlay-panel vertical-align">
                            <div class="vertical-align-middle">
                              <a class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                                <img src="https://avatars0.githubusercontent.com/u/18431132?s=460&v=4" alt="">
                              </a>

                              <div class="float-left">
                                <div class="font-size-20 mt-20">Username</div>
                                  <p class="mb-20 text-nowrap">
                                    <span class="text-break">email@address.com</span>
                                  </p>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-lg-5 col-xl-4">
                        <div class="card-block h-150 h-only-xs-100 h-only-sm-100 h-only-md-100 bg-grey-1 draw-grad-up">
                          <div class="slider pt-0 mx-30" id="subscriptionsSlider">

                            <div>
                              <div class="text-center mt-lg-40">
                                <span class="badge badge-primary badge-lg font-size-20" style="background-color: #3c62cf">role_name</span>
                                <p class="font-weight-100">Subscribed</p>
                              </div>
                            </div>
                            <div>
                              <div class="text-center mt-lg-40">
                                <span class="badge badge-primary badge-lg font-size-20" style="background-color: #03946c">role_name</span>
                                <p class="font-weight-100">Ending Soon</p>
                              </div>
                            </div>
                            <div>
                              <div class="text-center mt-lg-30">
                                  <button type="button" class="btn btn-success font-size-30 mt--10">Live</button>
                                  <p class="font-weight-100">Subscribed</p>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!--<div class="col-md-4 hidden-md-down">
                        <div class="card-block h-150 h-only-xs-100 bg-grey-2">
                          <div class="mt-40 w-150 mx-auto">
                            <div class="d-flex justify-content-around">
                              <div>
                                <a href="#" class="btn btn-icon btn-dark btn-round"><i class="icon wb-settings"></i></a>
                              </div>
                              <div>
                                <a href="#" class="btn btn-dark">Payout</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>-->

                    </div>

                </div> <!-- end card -->


              </div> <!-- end col -->

          </div> <!-- end row -->



        </div> <!-- end first column -->

        <div class="col-12 order-1 order-md-2"> <!-- begin next column -->

        <div class="row no-space">
            <!--<div class="col-12 hidden-md-down visible-xs-down">
              <p class="mb-2 font-weight-100">Account</p>
            </div>-->
            <div class="col-6 col-sm-3">
                <a href="/account/subscriptions" class="card card-block card-bordered btn btn-primary mb-25" id="tour_subscriptions-block">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon wb-star text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Subscriptions</span>
                      </div>
                    </div>
              </a>
            </div>

            <div class="col-6 col-sm-3">
                <a href="/account/payments" class="card card-block card-bordered btn btn-primary mb-25">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon wb-order text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Payments</span>
                      </div>
                    </div>
                </a>
            </div>

            <!--<div class="col-6 col-md-4 col-lg-3 col-xxl-3">
                <a href="/account/settings" class="card card-block card-bordered btn btn-primary">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-150 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon wb-user-circle text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Settings</span>
                      </div>
                    </div>
                </a>
            </div>-->


          @if(auth()->user()->stripe_express_id != null)

           <!--<div class="col-12 hidden-md-down visible-xs-down">
              <p class="mb-1 font-weight-100">Shop</p>
            </div>-->
            <div class="col-6 col-sm-3">
                <a href="/servers" class="card card-block card-bordered btn btn-primary" id="servers-block">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon icon-shop text-white font-size-50 mb--10" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Shops</span>
                      </div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-sm-3">
                <a href="/promotions" class="card card-block card-bordered btn btn-primary">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-100 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon icon-gift1 text-white font-size-50 mb--10" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Promotions</span>
                      </div>
                    </div>
                </a>
            </div>

            <!--<div class="col-6 col-lg-3 col-xxl-3">
                <a href="javascript:void(0);" class="card card-block card-bordered btn btn-primary" data-toggle="slidePanel" data-url="slide-payout">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-md-150 h-only-xs-100 h-only-sm-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon icon-right-big text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Payout</span>
                      </div>
                    </div>
                </a>
            </div>-->


          @else

            <div class="col-6 col-sm-12">
                <a href="javascript:void(0);" class="card card-block card-bordered btn btn-dark"
                    id="btn_start-shop-block">
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-100">
                      <div class="vertical-align-middle">
                        <div class="counter-icon mb-5"><i class="icon-shop text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Create Shop</span>
                      </div>
                    </div>
                </a>
                <a href="{{ \App\StripeHelper::getConnectURL() }}" class="d-none card card-block card-bordered btn btn-primary ladda-button"
                    id="btn_connect-stripe-block" data-style="slide-up" data-plugin="ladda">
                    <i class="icon wb-info-circle l-up text-white" aria-hidden="true"
                      data-plugin="webuiPopover"
                      data-content="&lt;p&gt;@lang('lang.connect_stripe')&lt;/p&gt;" data-trigger="hover"
                      data-animation="pop"></i>
                    <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-100">
                      <div class="vertical-align-middle ladda-label">
                        <div class="counter-icon mb-5"><i class="icon-stripe text-white" aria-hidden="true"></i></div>
                        <span class="counter-number text-white">Connect Stripe</span>
                      </div>
                      <span class="ladda-spinner"></span>
                    </div>
                </a>
            </div>

          @endif

          </div>


        </div>

      </div><!-- end row -->


    <div class="row">
      <div class="col-12 mt-lg-30">
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mt-lg-15">
        <p class="font-weight-100">Need help?</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-bordered btn btn-light">
              <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Getting Started</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-bordered btn btn-light" id="start_help-subscriptions-block">
              <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Managing Subscriptions</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-bordered btn btn-light" data-toggle="site-sidebar" data-url="slide-help-ultimate-shop-guide">
              <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Ultimate Shop Tutorial</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12 col-md-6 col-lg-3">
          <a href="javascript:void(0);" class="card card-block card-bordered btn btn-light">
              <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-only-xs-50 h-only-sm-50 h-md-50">
                <div class="vertical-align-middle">
                  <span class="counter-number">Withdrawing Earnings</span>
                </div>
              </div>
          </a>
      </div>
      <div class="col-12">
          <a href="/help" class="card card-block card-bordered btn btn-light">
              <div class="counter counter-lg counter-inverse blue-grey-600 vertical-align h-only-xs-50 h-only-sm-50 h-md-100">
                <div class="vertical-align-middle">
                  <div class="counter-icon mb-5 hidden-md-down"><i class="icon wb-plugin blue-grey-400" aria-hidden="true"></i></div>
                  <span class="counter-number">More Help</span>
                </div>
              </div>
          </a>
      </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function changeBtn() {
            $('#btn_connect-stripe-block').removeClass('d-none');
            $('#btn_start-shop-block').addClass('d-none');
        }
        window.onload = function () {
            document.getElementById("btn_start-shop-block").addEventListener('click', changeBtn);
        }
    </script>
    <script type="text/javascript">
      $(window).on('load', function() {
        $("#subscriptionsSlider").slick({
          arrows:false,
          autoplay:true
        });
      });
    </script>
@endsection
