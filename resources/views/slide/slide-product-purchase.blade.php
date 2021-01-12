<header class="slidePanel-header bg-blue-600 draw-grad-up">
    <button id="payment-success" type="button"
            class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left"
            aria-hidden="true" data-url="/slide-product-purchase-success" data-toggle="slidePanel" hidden
            style="visibility: hidden;"></button>
    <button id="payment-failure" type="button"
            class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left"
            aria-hidden="true" data-url="/slide-product-purchase-failed" data-toggle="slidePanel" hidden
            style="visibility: hidden;"></button>
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true"></button>
    </div>
    <div class="row">

        <div class="col-sm-2 col-4">
            <a class="avatar avatar-xxl" href="javascript:void(0)">
                <img src="{{ $discord_helper->getAvatar() }}" alt="...">
            </a>
        </div>
        <div class="col-sm-8 col-8">
            <h1 class="pt-20" style="color: white;">{{ $discord_helper->getUsername() }}</h1>
            <!-- <div class="badge badge-lg font-size-20" style="color: white;background-color: #{{ dechex($role->color) }};">
                <i class="icon-discord mr-2" aria-hidden="true"></i> 
                <span>{{ $role->name }}</span>
            </div> -->
        </div>
    </div>
</header>


<div class="row no-space" id="slider-div">
    <div class="col-md-12 text-center">
        <div class="font-size-20 font-weight-400 text-white pt-20 pt-lg-50">Subscribe to <span class="badge font-size-20 ml-2" style="color: white;background-color: #{{ dechex($role->color) }};"><i class="icon-discord mr-2" aria-hidden="true"></i> <span>{{ $role->name }}</span>
        </span>

    </div>
        <div class="pt-0 pt-md-25 pt-lg-25 pt-xl-50">
            <div class="row mx-auto">
                <div class="col-12 card border-0">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-12">

                            </div>

                            @php
                            $first = true;
                            @endphp

                            @foreach($plans as $plan)

                            
                            <div class="col-6 col-md-3 mx-auto">
                                <div class="card vertical-align h-150 mt-15 mt-md-0" >
                                    <div class="text-center vertical-align-middle font-size-16 pb-15">
                                            <h4 class="font-weight-200 pt-5">{{ $plan->interval_cycle }} @if($plan->interval_cycle > 1)Months @else Month @endif</h4>
                                        <i class="wb-triangle-down font-size-24 mb-10 blue-600"></i>
                                        <div>
                                        
                                            <span class="font-size-16">${{ number_format(($plan->getStripePlan()->amount / 100), 2, '.', ',') }}</span>
                                        </div>

                                    </div>
                                    @if($first)
                                    <input id="inputRadios{{ $plan->interval_cycle }}Months" name="inputRadios"  onclick="updatePrices('{{ $plan->interval_cycle }}', '{{ ($plan->getStripePlan()->amount / 100) }}')" type="radio" class="to-labelauty" data-plugin="labelauty" data-labelauty=" " checked/>
                                    @php
                                    $first = false;
                                    @endphp
                                    @else
                                    <input id="inputRadios{{ $plan->interval_cycle }}Months"  name="inputRadios" onclick="updatePrices('{{ $plan->interval_cycle }}', '{{ ($plan->getStripePlan()->amount / 100) }}')" type="radio" class="to-labelauty" data-plugin="labelauty" data-labelauty=" " />
                                    @endif
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-0 pt-md-25 pt-lg-25 pt-xl-50">
            <h3 class="mt-0 pb-md-10 text-white">Total: <span class="font-weight-200">$<span id="big_price_label">{{ number_format(($plans[0]->getStripePlan()->amount / 100), 2, '.', ',') }}</span></span></h3>
            <div>
                <input type="text" class="form-control form-control-lg w-200 mx-auto" placeholder="Coupon Code" id="couponCode" disabled>
                <p id="coupon_info"></p>
                <p id="coupon_info_1"></p>
            </div>
            <div class="w-300 mt-30 mx-auto">
                <div class="container">
                    <div class="row">
                        <br/>
                        @if(($discord_helper->ownsGuild($store->guild_id)) && (!auth()->user()->canAcceptPayments()))
                        <a href="javascript:void(0)" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#partnerPricingModal"
                           role="button">Pay</a>
                        @else
                        <a href="#" onclick="beginCheckout()" class="btn btn-success btn-lg btn-block" id="payButton"
                           role="button" @if(count($plans) > 1) disabled @endif>Pay</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-25 mt-sm-25  mt-md-50 mt-lg-50 mt-xl-100 p-25 pb-md-50 draw-grad">

                @if($store->refunds_enabled)
                <span class="font-size-26 grey-400 font-weight-100 pt-lg-15">{{ $store->refunds_days }} Day Refund Policy
                </span>
                @endif
                <div>By clicking Pay you agree to our <a href="/terms" target="_blank">terms of service</a>.</div><div> You can request a refund anytime during your subscriptions first billing term. @if($store->refunds_terms == '1')<b>No questions asked.</b>@endif
                </div><div>By server owner discretion{{ $store->refunds_terms == '2' ?  '.' : ' with reason.' }}</div>
            </div>

        </div>


    </div>
</div>

<script type="text/javascript">
    var token = '{{ csrf_token() }}';
    var current_price, net_price;
    var is_member = '{{ $discord_helper->isMember($guild->id, $discord_helper->getID()) ? "true" : "false" }}';

    if(is_member == "true") {
        is_member = true;
    } else {
        is_member = false;
    }

    $(document).ready(function () {

        /**
         * ALL THE CODE FOR THE COUPON CODE BOX
         */
        var typingTimer;
        var doneTypingInterval = 300;
        var $input = $('#couponCode');

        //on keyup, start the countdown
        $input.keyup(function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        });

        //on keydown, clear the countdown
        $input.bind('keypress', function () {
            clearTimeout(typingTimer);
            $input.addClass('loading');
            $input.removeClass('is-valid');
            $input.removeClass('is-invalid');
        });

        function doneTyping() {
            $input.removeClass('loading');
            $.ajax({
                url: '/validate-coupon',
                type: 'POST',
                data: {
                    owner_id: '{{ $guild->owner_id }}',
                    code: $input.val(),
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                net_price = current_price;
                if (msg['valid']) {
                    $input.removeClass('is-invalid');
                    $input.addClass('is-valid');
                    if(msg['data']['percent_off'] > 0) {
                        net_price = current_price - (current_price * (msg['data']['percent_off']/100));
                        if(net_price < 0) net_price = 0;
                        // $("#big_price_label").text(net_price);
                        $('#coupon_info').text("* " + msg['data']['percent_off'] + "% off " + (msg['data']['duration'] === 'forever' ? 'forever' : msg['data']['duration'] === 'once' ? 'for the first payment' : 'for the first ' + msg['data']['duration_in_months'] + ' months.'));
                        $('#coupon_info_1').text('Go to checkout for updated price');
                    } else if(msg['data']['amount_off'] > 0) {
                        net_price = current_price - (msg['data']['amount_off'] / 100);
                        if(net_price < 0) net_price = 0;
                        // $("#big_price_label").text(net_price);
                        $('#coupon_info').text('* $' + (msg['data']['amount_off'] / 100) + " off " + (msg['data']['duration'] === 'forever' ? 'forever' : msg['data']['duration'] === 'once' ? 'for the first payment' : 'for the first ' + msg['data']['duration_in_months'] + ' months.'));
                        $('#coupon_info_1').text('Go to checkout for updated price');
                    }
                } else {
                    $input.removeClass('is-valid');
                    $input.addClass('is-invalid');
                    $('#coupon_info').empty();
                    $('#coupon_info_1').empty();
                }
            });
        }

    });

    function updatePrices(interval, value) {
        current_price = value;
        net_price = value;
        $("#big_price_label").text(formatMoney(net_price, 2, ".", ","));
        $('#couponCode').val('');
        $('#couponCode').attr('disabled', false);
        $('#payButton').attr('disabled', false);
        $('#coupon_info').text('');

        $('#inputRadios1Months').removeAttr('checked');
        $('#inputRadios3Months').removeAttr('checked');
        $('#inputRadios6Months').removeAttr('checked');
        $('#inputRadios12Months').removeAttr('checked');
    }

    function getSelectedDuration() {
        var duration_1_month = $('#inputRadios1Months');
        var duration_3_month = $('#inputRadios3Months');
        var duration_6_month = $('#inputRadios6Months');
        var duration_12_month = $('#inputRadios12Months');

        if (duration_1_month !== undefined && duration_1_month.is(':checked')) return 1;
        if (duration_3_month !== undefined && duration_3_month.is(':checked')) return 3;
        if (duration_6_month !== undefined && duration_6_month.is(':checked')) return 6;
        if (duration_12_month !== undefined && duration_12_month.is(':checked')) return 12;
    }

    function formatMoney(number, decPlaces, decSep, thouSep) {
        decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
            decSep = typeof decSep === "undefined" ? "." : decSep;
        thouSep = typeof thouSep === "undefined" ? "," : thouSep;
        var sign = number < 0 ? "-" : "";
        var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
        var j = (j = i.length) > 3 ? j % 3 : 0;

        return sign +
            (j ? i.substr(0, j) + thouSep : "") +
            i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
            (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
    }

    function beginCheckout() {
        if(!is_member) {
            Swal.fire({
                title: 'Not a member!',
                text: 'Please join the server before purchasing any roles.',
                type: 'warning',
                showCancelButton: false,
                showConfirmButton: true,
                allowOutsideClick: () => false,
                target: document.getElementById('slider-div')
            });
            return;
        }
        Swal.fire({
            title: 'Processing...',
            text: '',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: () => !Swal.isLoading(),
            target: document.getElementById('slider-div')
        });

        Swal.showLoading();

        var process_url = '/process-checkout';
     
        $.ajax({
            url: process_url,
            type: 'POST',
            data: {
                'guild_id': '{{ $store->guild_id }}',
                'role_id': '{{ $role->id }}',
                'product_type': 'discord',
                'billing_cycle': getSelectedDuration(),
                'coupon_code': $('#couponCode').val(),
                //'server_icon': $('#guild_icon').attr('src'),
                //'guild_name': '{{ $guild->name }}',
                //'role_name': '{{ $role->name }}',
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if (msg['success']) {
                swal.close();
                console.log(msg['msg']);
                stripe.redirectToCheckout({
                    sessionId: msg['msg']
                }).then(function (result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, display the localized error message to your customer
                    // using `result.error.message`.
                    alert(result.error.message);
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

@include('partials/clear_script')
