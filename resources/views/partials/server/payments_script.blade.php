<script type="text/javascript">
    var guild_id = '{{ $id }}';
    var roles = null;
    var loaded_payments = false;
    var loaded_disputes = false;

    $(document).ready(function () {
        var socket_id = '{{ uniqid() }}';
        roles = [];
        socket.emit('get_roles', [socket_id, guild_id]);

        socket.on('res_roles_' + socket_id, function (msg) {
            roles = msg;
            // Populate roles array because we will need the roles array later
            Object.keys(roles).forEach(function (key) {
                roles[key] = {
                    name: roles[key]['name'],
                    color: roles[key]['color']
                };
            });

        });
    });

    function loadPayments() {
        $('#payments-btn').addClass('active');
        $('#disputes-btn').removeClass('active');
        $('#disputes_table').hide();
        if(loaded_disputes) {
            $('#payments_table').show();
            return;
        }
        $('#btn_payments-refresh').addClass('spinning');
        $('#disputes_table').hide();
        loaded_payments = true;
        $.ajax({
            url: `/get-transactions`,
            type: 'GET',
            data: {
                roles: roles,
                guild: guild_id,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (response) {
            for (var i = 0; i < response.length; i++) {
                var invoice = response[i];

                var id = invoice['id'];
                var number = invoice['number'];
                var description = invoice['lines']['data'][0]['description'];
                var status = invoice['status'];
                var status_color = status == 'paid' ? 'success' : 'default';
                var html = `
                    <a class="list-group-item flex-column align-items-start" href="javascript:void(0)"
                    data-url="/slide-invoice/${id}" data-toggle="slidePanel">
                        <span class="badge badge-pill text-capitalize badge-${status_color}">${status}</span> 
                        <span class="badge badge-pill badge-primary badge-outline mr-2 hidden-sm-down">#${number}</span>
                        <span class="badge badge-first badge-pill badge-success mr-15"><i class="wb wb-arrow-down"></i></span>
                        <div><p class="desc">${description}</p></div>
                    </a>                   
                `;
                $('#btn_payments-refresh').removeClass('spinning');
                if($('#btn-disputes').hasClass('active')){
                    $('#payments_table').append(html);
                }else{
                    $('#payments_table').append(html).show();
                }
            }
            $('#payments-loading_table').hide();
        });
    }

    function loadDisputes() {
        $('#disputes-btn').addClass('active');
        $('#payments-btn').removeClass('active');
        $('#payments_table').hide();
        if(loaded_disputes) {
            $('#disputes_table').show();
            return;
        }
        $('#btn_payments-refresh').addClass('spinning');
        loaded_disputes = true;
        $.ajax({
            url: `/get-disputes`,
            type: 'GET',
            data: {
                guild: guild_id,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (response) {

            for (var i = 0; i < response.length; i++) {
                var dispute = response[i];

                var sub_id = dispute['sub_id'];

                var user_id = dispute['user_id'];

                //var user_name = ' App\User::where('id',' + user_id + '->get()[0]->getDiscordUsername() ';

                var role_name = dispute['role_name'];
                var amount = dispute['amount'];
                var refund_enabled = dispute['refund_enabled'];
                var refund_days = dispute['refund_days'];
                var refund_terms = dispute['refund_terms'];

                var terms_text = refund_terms == '1' ? 'No Questions Asked' : 'By Owner Discretion';

                var decision = dispute['decision'];

                var status_color = decision == '1' ? 'success' : 'warning';
                var status_icon = decision == '1' ? 'check' : 'alert';
                var status_text = decision == '1' ? 'Complete' : '';
                var status_hidden = decision == '1' ? 'd-none' : '';
                var status_hidden0 = decision == null || '0' ? '' : 'd-none';

                var issued = dispute['issued'];
                //var created_at = dispute['created_at'];
                var created_at = dispute['created_at']


                var html = `
                    <a class="list-group-item flex-column align-items-start dispute-open" href="javascript:void(0)" data-sub_id="${sub_id}">
                        <span class="badge badge-pill text-capitalize badge-${status_color} ${status_hidden0}">${status_text}</span> 
                        <span class="badge badge-pill badge-primary badge-outline ${status_hidden}">${refund_days} Days - ${terms_text}</span>
                        <span class="badge badge-first badge-pill badge-${status_color} mr-15"><i class="wb wb-${status_icon}"></i></span>
                        <div><p class="desc"><span class="badge badge-dark mr-2">${created_at}</span> ${role_name}</p></div>
                    </a>                   
                `;
                $('#btn_payments-refresh').removeClass('spinning');
                $('#disputes_table').prepend(html).show();
            }
            $('#payments_table').hide();
            $('#payments-loading_table').hide();
        });
    }
</script>


<script type="text/javascript">
    $(document).on('click', '.dispute-open', function (e) {
        e.preventDefault();
        var $sub_id = $(this).attr('data-sub_id');
        console.log($sub_id);
        Swal.fire({
            title: "Decision",
            {{-- html: "User: {{ $refundrequest->getUser()->getDiscordUsername() }}<br>Role: {{ $refundrequest->role_name }}<br>Purchase Date: {{ Carbon::createFromTimestamp($refundrequest->start_date)->toDateTimeString() }}@if(($refundrequest->refunds_enabled) == '1')<br><br><b>Your Refund Policy: </b>{{ $refundrequest->refund_days }} days, @if(($refundrequest->refund_terms) == '1')No Questions Asked @endif @if(($refundrequest->refund_terms) == '2')by server owner discretion with reason. @endif @endif", --}}
            // html: "<b>Refund Policy:</b> 15 days by server owner discretion with reason.<br>Username: SnowFalls<br>Role: VIP Member<br>Purchase Date: 05/06/19<br>Reason: Here is the request reason the user entered",
            footer: '<span class=\"text-white text-center\"><div class=\"checkbox-custom checkbox-default\"><input type=\"checkbox\" id=\"sub_ban\" name=\\"inputSub_ban\" autocomplete=\"off\"><label for=\"inputSub_ban\">Ban user from future purchases?</label></div></span>',
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, accept refund!',
            cancelButtonText: 'No, deny request.',
            showCloseButton: true,
            target: document.getElementById('slider-div')
        }).then(function(result){
            if($("#sub_ban").is(':checked')) {
                var subBan = "1";
            }else{
                var subBan = "0";
            }
            if (result.value) {
                $.ajax({
                    url: '/request-subscription-decision',
                    type: 'POST',
                    data: {
                        sub_id: $sub_id,
                        issued: '1',
                        ban: subBan,
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Thank you.',
                            text: 'User notified, subscription cancelled and role removed. Refund queued.',
                            //input: 'checkbox',
                            //inputPlaceholder: 'Ban user from future purchases?',
                            type: 'success',
                            showCancelButton: false,
                        }).then(result => {
                            $('#close-slide').click();
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Subscription already cancelled.',
                            type: 'warning',
                            showCancelButton: false,
                        });
                    }
                })
            }else if(result.dismiss == 'cancel'){

              $.ajax({
                    url: '/request-subscription-decision',
                    type: 'POST',
                    data: {
                        sub_id: $sub_id,
                        issued: '0',
                        ban: subBan,
                        _token: '{{ csrf_token() }}'
                    },
                  }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Refund denied. User notified, subscription was not cancelled. Thank you.',
                            //input: 'checkbox',
                            //inputPlaceholder: 'Ban user from future purchases?',
                            type: 'success',
                            showCancelButton: false,
                        }).then(result => {
                            $('#close-slide').click();
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: 'Subscription already cancelled.',
                            type: 'warning',
                            showCancelButton: false,
                        });
                    }
                  })
              }
          })
    });
</script>