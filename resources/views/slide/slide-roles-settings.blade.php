<header class="slidePanel-header dual bg-blue-500">
    <div class="slidePanel-actions" aria-label="actions" role="group">
    <!-- TODO: Deal with the $special -->
    @php
    $special = false;
    @endphp
    
    @if($special)
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-right"
        aria-hidden="true" data-url="/slide-server-member/{{ $guild_id }}/{{ $useruser()->DiscordOAuth->discord_id }}" id="back-btn" data-toggle="slidePanel"></button>
      @else
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
        aria-hidden="true"></button>
    @endif
    </div>
    <h1>Product Settings @if($special)<span class="text-bold">| {{ $user()->getDiscordHelper()->getUsername() }}</span>@endif</h1>
    <p><span id="role_name"></span></p>
</header>

<div class="site-sidebar-tab-content put-long tab-content" id="slider-div">
    <div class="tab-pane fade active show" id="sidebar-userlist">
        <div>



           <div>
                <div class="row">
                    <div class="col-12">
                    <h5>Subscription Prices</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="row no-space text-center">
                                @for($i = 0; $i < 13; $i++)
                                @if($i === 1 || $i === 3 || $i === 6 || $i === 12)
                                <div class="col-6 col-sm-3">
                                    <div class="card border-0 vertical-align h-100">
                                    <div class="vertical-align-middle font-size-16">
                                        <div class="d-block">
                                            <div class="input-group w-120 mx-auto">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input id="price_{{ $i }}m" type="text" class="form-control"
                                                    placeholder="0.00"
                                                    value="{{ $prices[$i] }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <i class="wb-triangle-down font-size-24 mb-10 blue-600"></i>
                                        <div>
                                        <span class="font-size-12">{{ $i }} month</span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                                @endfor

                            
                                <div class="col-12">
                                    <button id="prices_btn" type="button" class="btn btn-dark btn-lg btn-block @if(!$enabled) disabled @endif"
                                        onclick="updatePrices()" @if(!$enabled) disabled @endif>Update Prices
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div>
                <div class="row pb-30">
                    <div class="col-12">
                        <h5>Role Description</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row no-space text-center">
                                    <div class="col-12">
                                        @if(isset($desc))
                                            <textarea id='product-description' class="lit-group-item form-control" placeholder="These awesome perks..."
                                                    @if(!$enabled) disabled
                                                    @endif>{{ $desc->description }}</textarea>
                                        @else
                                            <textarea id='product-description' class="lit-group-item form-control" placeholder="These awesome perks.."
                                                    @if(!$enabled) disabled @endif></textarea>
                                        @endif
                                        <button type="button" class="btn btn-block mt-10 btn-dark btn-lg @if(!$enabled) disabled @endif" id="desc-btn"
                                            @if(!$enabled) disabled @else onclick="updateProductDesc()" @endif>Update Description
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div>
                <div class="row pb-30">
                    <div class="col-12">
                        @if(isset($shop_url))
                        <a href="/shop/{{ $shop_url }}" class="btn float-right btn-primary d-none" id="btn_visit-shop">Visit shop</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
$('textarea#product-description').on('keyup', function(){
  $(this).val($(this).val().replace(/[\r\n\v]+/g, ' '));
  $(this).attr('maxlength','150');
});
</script> 

<script type="text/javascript">
    function updateProductDesc() {
        $.ajax({
            url: '/update_product_desc',
            type: 'POST',
            data: {
                'guild_id': '{{ $guild_id }}',
                'role_id': '{{ $role->id }}',
                'description': $('#product-description').val(),
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            Toast.fire({
                title: 'Success',
                text: 'Product updated!',
                type: 'success',
                showCancelButton: false,
                //showConfirmButton: true,
               // target: document.getElementById('slider-div')
            });
            $('#btn_visit-shop').removeClass('d-none');
        });
    }

    var guild_id = '{{ $guild_id }}';
    var role_id = '{{ $role->id }}';

    // TODO: For now we close the slide but we need to turn off the switcheries
    function updatePrices() {
        Toast.fire({
            title: 'Processing....',
            text: '',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: () => !Toast.isLoading(),
            //target: document.getElementById('slider-div')
        });
        Toast.showLoading();
        $.ajax({
            url: '/plan',
            type: 'POST',
            data: {
                'action': 'update',
                'product_type': 'discord',
                'interval': 'month',
                'interval_cycle': 1,
                'price': $('#price_1m').val(),
                'role_id': '{{ $role->id }}',
                'role_name': '{{ $role->name }}',
                'guild_id': '{{ $guild_id }}',
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg, enabled) {

            $.ajax({
                url: '/plan',
                type: 'POST',
                data: {
                    'action': 'update',
                    'product_type': 'discord',
                    'interval': 'month',
                    'interval_cycle': 3,
                    'price': $('#price_3m').val(),
                    'role_id': '{{ $role->id }}',
                    'role_name': '{{ $role->name }}',
                    'guild_id': '{{ $guild_id }}',
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg, enabled) {
                $.ajax({
                    url: '/plan',
                    type: 'POST',
                    data: {
                        'action': 'update',
                        'product_type': 'discord',
                        'interval': 'month',
                        'interval_cycle': 6,
                        'price': $('#price_6m').val(),
                        'role_id': '{{ $role->id }}',
                        'role_name': '{{ $role->name }}',
                        'guild_id': '{{ $guild_id }}',
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg, enabled) {
                    $.ajax({
                        url: '/plan',
                        type: 'POST',
                        data: {
                            'action': 'update',
                            'product_type': 'discord',
                            'interval': 'month',
                            'interval_cycle': 12,
                            'price': $('#price_12m').val(),
                            'role_id': '{{ $role->id }}',
                            'role_name': '{{ $role->name }}',
                            'guild_id': '{{ $guild_id }}',
                            _token: '{{ csrf_token() }}'
                        },
                    }).done(function (msg, enabled) {
                        if (msg['success']) {
                            Toast.fire({
                                title: 'Success!',
                                text: msg['msg'],
                                type: 'success',
                            });
                            $('#' + guild_id + '_' + role_id).removeClass('inactive-role').addClass('active-role');
                            $('#toggle-product-icon_' + guild_id + '_' + role_id).removeClass('wb-plus').addClass('wb-check');
                            $('#toggle-check_' + guild_id + '_' + role_id).addClass('green-600').removeClass('grey-2');
                            $('#product-settings_' + guild_id + '_' + role_id).removeClass('disabled btn-dark').addClass('btn-primary').attr("disabled", false);
                            $('#toggle-product_' + guild_id + '_' + role_id).addClass('active');
                            $('#product-settings_' + guild_id + '_' + role_id).removeClass('disabled').attr("disabled", false);
                        } else {
                            Toast.fire({
                                title: 'Success',
                                text: msg['msg'],
                                type: 'warning',
                            });
                            $('#' + guild_id + '_' + role_id).addClass('inactive-role').removeClass('active-role');
                            $('#toggle-product-icon_' + guild_id + '_' + role_id).addClass('wb-plus').removeClass('wb-check');
                            $('#toggle-check_' + guild_id + '_' + role_id).addClass('grey-2').removeClass('green-600');
                            $('#product-settings_' + guild_id + '_' + role_id).addClass('disabled btn-dark').removeClass('btn-primary').attr("disabled", true);
                            $('#toggle-product_' + guild_id + '_' + role_id).removeClass('active');
                            $('.text_save-roles').removeClass('d-none').text('Disabled');
                        }
                        setTimeout(function(){
                            //$('#icon_save-roles').removeClass("wb-check").addClass("wb-minus");
                            $('.text_save-roles').addClass('d-none').text();
                        }, 2000);
            
                        $('#btn_visit-shop').removeClass('d-none');
                    });
                });
            });
        });
    }
</script>

<script type="text/javascript">
      if (RegExp('multipage', 'gi').test(window.location.search)) {
        introJs().goToStepNumber(2).start();
      }
</script>

@include('partials/clear_script')