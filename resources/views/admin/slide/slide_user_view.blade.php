<header class="slidePanel-header dual">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
      aria-hidden="true"></button>
  </div>
  <h1>User</h1><!--<h1>Partner</h1>--><!--<h1>Banned</h1>-->
  <p>Username#8080</p>
</header>

<ul class="nav-quick nav-quick-sm row nav"  role="tablist">
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_user_info" role="tab">
    <i class="icon wb-user" aria-hidden="true"></i>
    Info
  </a>
  </li>
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_user_payments" role="tab">
    <i class="icon wb-order" aria-hidden="true"></i>
    Payments
    <span class="badge badge-success">8</span>
    </a>
  </li>
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_user_subscriptions" role="tab">
    <i class="icon wb-star" aria-hidden="true"></i>
    Subscriptions
  </a>
  </li>
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_user_emails" role="tab">
    <i class="icon wb-inbox" aria-hidden="true"></i>
    Emails
    <span class="badge badge-danger">13</span>
    </a>
  </li>
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_partner_servers" role="tab">
    <i class="icon wb-layout" aria-hidden="true"></i>
    Servers
  </a>
  </li>
  <li class="nav-item col-md-2 col-4">
    <a class="nav-link" data-toggle="tab" href="#tab_partner_promotions" role="tab">
    <i class="icon wb-time" aria-hidden="true"></i>
    Promotions
  </a>
  </li>
</ul>


<div class="site-sidebar-tab-content tab-content">

  <!-- INFO -->
  <div class="tab-pane fade active show" id="tab_user_info">
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Partner Status</h3>
      </div>
      <div class="panel-body">
        <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div>
                <button class="btn btn-info btn-sm" data-plugin="webuiPopover"
                                  data-title="Request Date: 04/04/04"
                                  data-content="This is where we put their request" data-trigger="hover"
                                  data-animation="pop">See Request</button>
            </div>
            <div>
              <!--<p>Pending</p>-->
              <p class="mb-0"><span id="partner_status">Accepted</span>
              <small>by <span id="partner_who-accepted">Rob#8080</span> on <span id="partner_time-accepted">04/04/04</span></small></p>
            </div>
            <div>
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" id="exampleColorDropdown2" data-toggle="dropdown" aria-expanded="false">Status</button>
                    <div class="dropdown-menu dropdown-menu-primary" aria-labelledby="exampleColorDropdown2" role="menu" x-placement="bottom-start">
                    <!--<a class="dropdown-item" href="javascript:void(0)" role="menuitem">Accept</a>-->
                    <!--<a class="dropdown-item" href="javascript:void(0)" role="menuitem">Deny</a>-->
                    <a class="active dropdown-item" href="javascript:void(0)" role="menuitem">Accepted</a>
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Remove</a>
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Ban</a>
                    </div>
                </div>
            </div>
          </div>
        </div>

    </div>
  </div><!-- end tab -->

  <!-- PAYMENTS -->
  <div class="tab-pane fade" id="tab_user_payments">
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

        <div class="col-md-12">
            <div class="panel">

                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>Invoice</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="text-center" id="payments_table">

                                <tr data-url="/slide-invoice/{ $invoice->id }" data-toggle="slidePanel">
                                    <td><a href="javascript:void(0)">Order #{ $invoice->number }</a></td>
                                    <td>{ $invoice->lines->data[0]->description }</td>
                                    <td>
                                        <!--if($invoice->status === 'paid')-->
                                            <div
                                                class="badge badge-table bg-success text-white">{ $invoice->status }</div>
                                        <!--else-->
                                            <div
                                                class="badge badge-table bg-secondary text-white">{ $invoice->status }</div>
                                        <!--endif-->
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


    </div>

  </div><!-- end tab -->

  <!-- SUBSCRIPTIONS -->
  <div class="tab-pane fade" id="tab_user_subscriptions">
      <table class="table table-hover" data-plugin="animateList" data-animate="fade" data-child="tr">
        <tbody id="rolesTable">

              <tr id="role_settings_1" data-url="/slide-account-subscription-settings?id=${sub_id}" data-toggle="slidePanel">
                    <!-- if slide panel wont work here i can add a button to remove them or we can do a swal -->
                    <td class="cell-30 responsive-hide">

                    </td>
                    <td class="cell-130">
                        <h4>` + guild_name + `</h4>
                    </td>
                    <td>

                        <span class="badge badge-primary text-left" style="background-color: ` + role_color + `">` + role_name + `</span>

                    </td>
                    <td class="cell-30">
                        <i class="icon wb-payment" aria-hidden="true"></i>
                    </td>
                    <td class="cell-100 text-right">
                        <div class="time"> ` + date_end + `</div>
                        <div class="identity"><i class="icon wb-medium-point green-500" aria-hidden="true"></i>` + status + `
                        </div>
                    </td>
                    <td class="cell-30 responsive-hide">

                    </td>
                </tr>


        </tbody>
      </table>


  </div><!-- end tab -->

  <!-- EMAILS -->
  <div class="tab-pane fade" id="tab_user_emails">

        <!-- show list of emails sent by our system, maybe if ticket system entire convos show here too -->

  </div><!-- end tab -->



  <!-- if partner || server/linked stripe (should show even if not partner anymore) -->



  <!-- SERVERS -->
  <div class="tab-pane fade" id="tab_partner_servers">


        <table class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
            <tbody id="servers-table">

               <tr>
                   <td class="cell-100" onClick="document.location.href='/server/${key}';">
                       <a class="avatar avatar-lg" href="javascript:void(0)">
                         <img src="${message[key]['iconURL']}" alt="...">
                       </a>
                   </td>
                   <td class="cell-60 responsive-hide" onClick="document.location.href='/server/${key}';"></td>
                   <td onClick="document.location.href='/server/${key}';">
                       <div class="title">${message[key]['name']}</div>
                   </td>
                   <td class="cell-200 responsive-hide" onClick="document.location.href='/server/${key}';">
                       <div class="time">${message[key]['memberCount']} Members</div>
                   </td>
                   <td class="cell-150 responsive-hide" onClick="document.location.href='/server/${key}';">
                       <div class="time" id="subCount${key}">0 Subs</div>
                   </td>
                   <td class="cell-200 responsive-hide">
                       <button type="button" class="site-action-toggle btn-raised btn btn-primary"
                               onclick="window.open('/shop/${key}','_blank')">
                           <i class="front-icon icon-shop animation-scale-up mr-2" aria-hidden="true"></i>Store Front
                       </button>
                   </td>
               </tr>

            </tbody>
        </table>

  </div><!-- end tab -->

  <!-- Promotions -->
  <div class="tab-pane fade" id="tab_partner_promotions">

  <table id="rolesTable" class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
                <thead>
                <tr>
                    <th class="cell-200">Coupon</th>
                    <th class="hidden-xs-down">Terms</th>
                    <!--<th class="responsive-hide">Expires</th>-->
                    <!--<th class="cell-150 responsive-hide">Affiliates</th>     -->
                    <th class="cell-130 text-right pr-30">
                    <span class="hidden-sm-down">Redemptions</span><span class="hidden-md-up">Uses</span>
                    </th>
                </tr>
                </thead>

                <tbody>

                <!--foreach($coupons as $promotion)-->
                    <tr id="role_settings_1">
                        <td class="bg-teal-500" data-url="slide-promotions-edit-coupon/{ $promotion['id'] }"
                            data-toggle="slidePanel">
                            <h5 class="text-white"><a href="#"
                                                      class="btn btn-sm btn-icon btn-pure btn-default btn-inverse on-default edit-row"
                                                      data-toggle="tooltip"
                                                      data-original-title="Edit"><i
                                        class="icon wb-edit" aria-hidden="true"></i></a>{ str_replace_first(strval(auth()->user()->id), '', $promotion['id']) }</h5>
                        </td>
                        <td class="hidden-xs-down" data-url="slide-promotions-edit-coupon/{ $promotion['id'] }" data-toggle="slidePanel">
                            <!--if($promotion['percent_off'] > 0)-->
                                <div class="time pl-15">{ $promotion['percent_off'] }% off <!--if($promotion['duration'] === 'forever')--> forever <!--elseif($promotion['duration'] === 'once')--> once <!--else--> for the first { $promotion['duration_in_months'] } months <!--endif--></div>
                            <!--else-->
                                <div class="time pl-15">${ $promotion['amount_off'] } off <!--if($promotion['duration'] === 'forever')--> forever <!--elseif($promotion['duration'] === 'once')--> once <!--else--> for the first { $promotion['duration_in_months'] } months <!--endif--></div>
                            <!--endif-->
                        </td>
                        <td class="bg-blue-grey-500 text-right" data-url="slide-promotions-transactions-coupon"
                            data-toggle="slidePanel">
                            <div class="identity text-white">{ $promotion['uses'] }}
                              <!--if($promotion['max_uses'] > 0)--> / {$promotion['max_uses'] } <!--endif--><a href="#"
                                                                                         class="btn btn-sm btn-icon btn-pure btn-default btn-inverse on-default edit-row"
                                                                                         data-toggle="tooltip"
                                                                                         data-original-title="View"><i
                                        class="icon wb-eye" aria-hidden="true"></i></a></div>
                        </td>
                    </tr>
                <!--endforeach-->
                </tbody>
            </table>


  </div>

</div>
