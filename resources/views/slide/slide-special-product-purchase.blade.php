<header class="slidePanel-header bg-blue-600 draw-grad-up" id="bg_badge">
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
                <img id="discord_icon"
                     src="{{ auth()->user()->getDiscordHelper()->getAvatar() }}"
                     alt="...">
            </a>
        </div>
        <div class="col-sm-8 col-8">
            <h1 class="pt-10 pl-10" id="discord_username" style="color: white;">{{ auth()->user()->getDiscordHelper()->getUsername() }}</h1>
           <div class="badge badge-lg badge-primary font-size-20"><i class="icon-discord mr-2"
                                                                                  aria-hidden="true"></i> <span
                id="role_name">Loading...</span>
            </div>
            {{--            <p>Logged in <span class="badge badge-outline ml-5 badge-light">Switch</span></p>--}}
        </div>
    </div>
</header>


<div class="row no-space" id="slider-div">
    <div class="col-md-12 text-center">
    @if(RoleDesc::where('guild_id', $guild_id)->where('role_id', $role_id)->exists())
        <div class="container pt-lg-30 pt-20 pt-xl-50">
            <span class="font-size-16 font-weight-100 mt-30 px-lg-20 text-white text-break">{{ RoleDesc::where('guild_id', $guild_id)->where('role_id', $role_id)->get()[0]->description }}</span>
        </div>
    @endif
        <div class="font-size-20 font-weight-400 text-white pt-20 pt-lg-50">Subscribe to <span class="badge badge-primary font-size-20 ml-2" id="role_badge"><i class="icon-discord mr-2"
                                                                                  aria-hidden="true"></i> <span
                id="role_name2"></span>
        </span>

    </div>
        <div class="pt-0 pt-md-25 pt-lg-25 pt-xl-50">
            <div class="row mx-auto">
                    <div class="col-12 card border-0">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-12">

                                </div>
                                @for($i = 0; $i < 13; $i += 1)
                                @if($i === 1 || $i === 3 || $i === 6 || $i === 12)
                                @if($prices[$i] >= 0)
                                <div class="col-6 col-md-3 mx-auto">
                                    <div class="card vertical-align h-150 mt-15 mt-md-0" id="{{ $i }}-card">
                                        <div class="text-center vertical-align-middle font-size-16 pb-15">
                                                <h4 class="font-weight-200 pt-5">{{ $i }} @if($i > 1)Months @else Month @endif</h4>
                                                {{-- <div class="input-group w-60 mx-auto">
                                                    <input type="radio" class="to-labelauty" onclick="updatePrices('{{ $prices[$i] }}')" id="inputRadios{{ $i }}month"
                                                    name="inputRadios" data-plugin="labelauty"
                                                    data-labelauty=" "/>
                                                </div> --}}
                                            <i class="wb-triangle-down font-size-24 mb-10 blue-600"></i>
                                            <div>
                                                <span class="font-size-16">${{ $prices[$i] }}</span>
                                            </div>

                                        </div>
                                        <input type="radio" class="to-labelauty" onclick="updatePrices('{{ $prices[$i] }}')" id="inputRadios{{ $i }}month"
                                       name="inputRadios" data-plugin="labelauty"
                                       data-labelauty=" "/>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endfor

                            </div>
                        </div>
                    </div> {{--
                @for($i = 0; $i < 13; $i += 1)
                    @if($i === 1 || $i === 3 || $i === 6 || $i === 12)
                        @if($prices[$i] > 0)
                            <div class="form-group col-6 col-md-3 mx-auto">
                                <input type="radio" class="to-labelauty" onclick="updatePrices('{{ $prices[$i] }}')" id="inputRadios{{ $i }}month"
                                       name="inputRadios" data-plugin="labelauty"
                                       data-labelauty="{{ $i }} @if($i > 1)Months @else Month @endif"/>
                            </div>
                        @endif
                    @endif
                @endfor  --}}
            </div>
        </div>
        <div class="pt-0 pt-md-25 pt-lg-25 pt-xl-50">
            <h3 class="mt-0 pb-md-10 text-white">Total: <span class="font-weight-200">$<span id="big_price_label">0</span></span></h3>
            <div>
                <input type="text" class="form-control form-control-lg w-200 mx-auto" placeholder="Coupon Code" id="couponCode" disabled>
                <p id="coupon_info"></p>
            </div>
            <div class="w-300 mt-30 mx-auto">
                <div class="container">
                    <div class="row">
                        <br/>
                        @if((auth()->user()->getDiscordHelper()->ownsGuild($guild_id)) && (!auth()->user()->canAcceptPayments()))
                        <a href="javascript:void(0)" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#partnerPricingModal"
                           role="button">Pay</a>
                        @else
                        <a href="#" onclick="beginCheckout()" class="btn btn-success btn-lg btn-block" id="payButton"
                           role="button" disabled>Pay</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-25 mt-sm-25  mt-md-50 mt-lg-50 mt-xl-100 p-25 pb-md-50 draw-grad">

                @if(App\Shop::where('id', $guild_id)->get()[0]->refunds_enabled)
                <span class="font-size-26 grey-400 font-weight-100 pt-lg-15">{{ App\Shop::where('id', $guild_id)->get()[0]->refunds_days }} Day Refund Policy
                </span>
                @endif
                <div>By clicking Pay you agree to our <a href="/terms" target="_blank">terms of service</a>.</div><div> You can request a refund anytime during your subscriptions first billing term. @if(App\Shop::where('id', $guild_id)->where('refunds_terms', '=', '1')->exists())<b>No questions asked.</b>@endif
                </div><div>By server owner discretion{{ App\Shop::where('id', $guild_id)->value('refunds_terms') == '2' ?  '.' : ' with reason.'}}</div>
            </div>

        </div>


    </div>
</div>

<script>
$(document).ready(function() {
    $('#inputRadios1month').trigger('click');
});
</script>
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
    var duration = 1;
    var guild_name, role_name, special_id;
    var guild_owner;
    var current_price, net_price;
    var in_guild = false;

    $(document).ready(function () {
        socket.emit('get_guild_data', [socket_id, '{{ $guild_id }}']);
        socket.emit('get_role_data', [socket_id, '{{ $guild_id }}', '{{ $role_id }}']);
        socket.emit('is_user_in_guild', [socket_id, '{{ $guild_id }}', '{{ auth()->user()->DiscordOAuth->discord_id }}']);

        socket.on('res_user_in_guild_' + socket_id, function(msg) {
                in_guild = msg;
        });

        socket.on('res_guild_data_' + socket_id, function (message) {
            guild_name = message['name'];
            guild_owner = message['owner'];
            //console.log(message);
        });

        socket.on('res_role_data_' + socket_id, function (message) {
            role_name = message['name'];
            $('#role_name').text(message['name']);
            $('#role_name2').text(message['name']);
            $('#role_badge').css('background-color', message['color']);
            // $('#bg_badge').css('background-color', message['color']);
        });

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
                url: '/bknd00/validate-coupon/',
                type: 'POST',
                data: {
                    owner_id: guild_owner,
                    code: $input.val(),
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                net_price = current_price;
                //console.log(msg);
                if (msg['valid']) {
                    $input.removeClass('is-invalid');
                    $input.addClass('is-valid');
                    if(msg['data']['percent_off'] > 0) {
                        net_price = current_price - (current_price * (msg['data']['percent_off']/100));
                        if(net_price < 0) net_price = 0;
                        $("#big_price_label").text(net_price);
                        $('#coupon_info').text("* " + msg['data']['percent_off'] + "% off " + (msg['data']['duration'] === 'forever' ? 'forever' : msg['data']['duration'] === 'once' ? 'for the first payment' : 'for the first ' + msg['data']['duration_in_months'] + ' months.'));
                    } else if(msg['data']['amount_off'] > 0) {
                        net_price = current_price - (msg['data']['amount_off'] / 100);
                        if(net_price < 0) net_price = 0;
                        $("#big_price_label").text(net_price);
                        $('#coupon_info').text('* $' + (msg['data']['amount_off'] / 100) + " off " + (msg['data']['duration'] === 'forever' ? 'forever' : msg['data']['duration'] === 'once' ? 'for the first payment' : 'for the first ' + msg['data']['duration_in_months'] + ' months.'));
                    }
                } else {
                    $input.removeClass('is-valid');
                    $input.addClass('is-invalid');
                }
            });
        }

    });

    function beginCheckout() {
        if(!in_guild && role_name) {
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
        swal.showLoading();

        var affiliate = 0;

        @if(isset($affiliate_id))
            affiliate = '{{ $affiliate_id }}';
        @endif

        if(special_id != null){
            process_url = '/process-special-checkout';
        }else{
           process_url = '/process-checkout';
        }
        //console.log(getSelectedDuration());
        $.ajax({
            url: process_url,
            type: 'POST',
            data: {
                'guild_id': '{{ $guild_id }}',
                'role_id': '{{ $role_id }}',
                'cycle': getSelectedDuration(),
                'promotion_code': $('#couponCode').val(),
                'affiliate_id': affiliate,
                'server_icon': $('#guild_icon').attr('src'),
                'guild_name': guild_name,
                'role_name': role_name,
                'special_id' = special_id,
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

    function updatePrices(value) {
        current_price = value;
        net_price = value;
        $("#big_price_label").text(formatMoney(net_price, 2, ".", ","));
        $('#couponCode').val('');
        $('#couponCode').attr('disabled', false);
        $('#payButton').attr('disabled', false);
        $('#coupon_info').text('');
    }

    function getSelectedDuration() {
        var duration_1_month = $('#inputRadios1month');
        var duration_3_month = $('#inputRadios3month');
        var duration_6_month = $('#inputRadios6month');
        var duration_12_month = $('#inputRadios12month');

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

</script>

@include('partials/clear_script')
