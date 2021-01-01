<script>

function btnEditRoles() {
    $('.role.inactive-role').removeClass('d-none');
    $('.toggle-role').removeClass('d-none');
    $('#btn_save-roles').removeClass('d-none');
    $('#btn_save-products').removeClass('d-none');

    $('#btn_edit-roles').addClass('d-none');
    $('.settings-role').addClass('d-none');
    $('.info-role').addClass('d-none');

    if($('#icon_save-roles').hasClass('wb-check')){
        $('#icon_save-roles').addClass('wb-minus').removeClass('wb-check');
    }
    if($('#btn_save-roles').hasClass('btn-primary')){
        $('#btn_save-roles').addClass('btn-dark').removeClass('btn-primary');
    }
}

$(document).on('click', '.btn_save-roles', function (e) {

    e.preventDefault();

    $('.role.inactive-role').addClass('d-none');
    $('.toggle-role').addClass('d-none');
    $('#btn_save-roles').addClass('d-none');
    $('#btn_save-products').addClass('d-none');

    $('#btn_edit-roles').removeClass('d-none');
    $('.settings-role').removeClass('d-none');
    $('.info-role').removeClass('d-none');

});

</script>
<script type="text/javascript">
    var roles = {};
    var guild_id = '{{ $id }}';
    var shop_name = '{{ $shop->url }}';
    var Global = {};
    var enabled_get = false;
    var is_enabled = 'inactive-role';


        $(document).on('click', '.toggle-btn-trigger', function (e) {

            e.preventDefault();
            var role_id = $(this).data('role_id');

            var clicked = false;
            $('#toggle-product_' + guild_id + '_' + role_id).addClass('disabled').attr("disabled", true);
            $('#icon_save-roles').removeClass('wb-minus wb-check').addClass('wb-refresh spinning');
            $('#btn_save-roles').attr("disabled", true);
            $('#product-settings_' + guild_id + '_' + role_id).addClass('disabled').attr("disabled", true);
            // $('#icon_save-roles').addClass('spinning');

            Swal.fire({
                title: 'Toggling Product...',
                text: 'This can take a minute.'
                // type: 'info',
            });

                //switchery.disable();
                $.ajax({
                    url: '/product',
                    type: 'POST',
                    data: {
                        'product_type': 'discord',
                        'interval_cycle': 1,
                        'guild_id': guild_id,
                        'role_id': role_id,
                        'guild_name': Global.name,
                        'name': $('#rolename-' + role_id).text(),
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    //switchery.enable();
                    if (!msg['success']) {
                        //$('.js-switch').click();
                        if(msg['msg'] != 'StripeError'){
                            Swal.fire({
                                title: 'Failure',
                                text: msg['msg'],
                                type: 'warning',
                                showCancelButton: false,
                                showConfirmButton: true,
                                target: document.getElementById('tab-content')
                            });
                            $('#icon_save-roles').removeClass('wb-minus wb-refresh spinning').addClass('wb-alert')
                        }else{
                            Swal.fire({
                                title: 'Connect Payout Method',
                                text: "Before we do that, lets connect your bank to get paid.",
                                type: 'info',
                                showCancelButton: true,
                                showConfirmButton: true,
                               // target: document.getElementById('tab-content')
                               confirmButtonText: "Get Paid",
                            }).then(result => {
                                console.log(result);
                                if(result.value == true){
                                    window.location.replace("{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&email=' . auth()->user()->getDiscordHelper()->getEmail() . '&client_id=' . env('STRIPE_CLIENT_ID') }}");
                                }
                                $('#toggle-product_' + guild_id + '_' + role_id).removeClass('disabled').attr("disabled", false);
                                $('#icon_save-roles').removeClass('wb-minus wb-refresh spinning').addClass('wb-alert')
                            });
                        }
                    } else {
                        //switchery.enable();
                        if (msg['active']) {
                            Toast.fire({
                                title: 'Great. Add some prices to enable!',
                                type: 'success',
                                target: document.getElementById('tab-content')
                            });
                            $('#' + guild_id + '_' + role_id).removeClass('inactive-role').addClass('active-role');
                            $('#toggle-product-icon_' + guild_id + '_' + role_id).removeClass('wb-plus').addClass('wb-minus');
                            $('#toggle-check_' + guild_id + '_' + role_id).addClass('green-600').removeClass('grey-2');
                            $('#product-settings_' + guild_id + '_' + role_id).removeClass('disabled btn-dark').addClass('btn-primary').attr("disabled", false).click();
                            $('#toggle-product_' + guild_id + '_' + role_id).addClass('active');
                            $('.text_save-roles').removeClass('d-none').text('Enabled');
                            $('#product-settings_' + guild_id + '_' + role_id).removeClass('disabled').attr("disabled", false);
                        } else {
                            Toast.fire({
                                title: 'Product Disabled',
                                type: 'success',
                                target: document.getElementById('tab-content')
                            });
                            $('#' + guild_id + '_' + role_id).addClass('inactive-role').removeClass('active-role');
                            $('#toggle-product-icon_' + guild_id + '_' + role_id).addClass('wb-plus').removeClass('wb-minus');
                            $('#toggle-check_' + guild_id + '_' + role_id).addClass('grey-2').removeClass('green-600');
                            $('#product-settings_' + guild_id + '_' + role_id).addClass('disabled btn-dark').removeClass('btn-primary').attr("disabled", true);
                            $('#toggle-product_' + guild_id + '_' + role_id).removeClass('active');
                            $('.text_save-roles').removeClass('d-none').text('Disabled');
                        }
                        if($('#btn_save-roles').hasClass('btn-primary')){
                            $('#btn_save-roles').addClass('btn-dark').removeClass('btn-primary').attr("disabled", false);;
                        }else{
                            $('#btn_save-roles').addClass('btn-primary').removeClass('btn-dark').attr("disabled", false);;
                        }
                        $('#icon_save-roles').removeClass('wb-minus wb-refresh spinning wb-alert').addClass('wb-check');
                        setTimeout(function(){
                            //$('#icon_save-roles').removeClass("wb-check").addClass("wb-minus");
                            $('.text_save-roles').addClass('d-none').text();
                        }, 2000);
                    

                    }
                    //clicked = false;
                     $('#toggle-product_' + guild_id + '_' + role_id).removeClass('disabled').attr("disabled", false);
                });

            // clicked = true;
            });

</script>
