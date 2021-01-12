<header class="slidePanel-header">
  <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="close-slide"></button>
  </div>
  <h1>Subscription Details</h1>
</header>
<div class="put-long pt-3" id="slider-div">
    <div class="text-center">
        <h3>{{ $guild_name }}</h3>
        <span class="badge badge-primary font-size-20 ml-2" id="role_badge" style="background-color: {{ $role_color }};"><i class="icon-discord mr-2" aria-hidden="true"></i> <span id="role_name2">{{ $role_name }}</span>
        </span>
    </div>
       <div class="mt-md-50">
         <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between" data-step="3" data-intro="Manage subscription" data-position='left'>
            <h5>Subscription</h5>
            <div>
                 <div class="dropdown">
                    @if($sub->status == 'active')
                        @if($sub->cancel_at_period_end && $sub->status <= 3)
                        <button type="button" class="btn w-160 btn-info btn-sm active" id="moreDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cancel Period End
                        </button>
                        <div class="dropdown-menu" aria-labelledby="moreDropdown" role="menu" x-placement="bottom-start">
                            <a class="dropdown-item" href="javascript:void(0)" onclick="undoCancelSubscription();" role="menuitem">Undo or Update</a>
                        </div>
                        @else
                        <button type="button" class="btn w-160 btn-success btn-sm active bg-green-600" id="moreDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon wb-payment" aria-hidden="true"></i> Subscribed
                        </button>
                        <div class="dropdown-menu" aria-labelledby="moreDropdown" role="menu" x-placement="bottom-start">
                            @if($days_passed <= $subscription->refund_days && ($subscription->refund_enabled != 1))
                                <a class="dropdown-item disabled" href="javascript:void(0)" onclick="cancelSubscription();">End Subscription</a>
                            @else
                                <a class="dropdown-item disabled" href="javascript:void(0)" onclick="requestRefundSubscription();">Refund ({{ $subscription->refund_days - $days_passed }} days remaining)</a>
                            @endif
                        </div>
                        @endif
                    @else
                    <button type="button" class="btn w-160 btn-primary btn-sm active" aria-expanded="false">
                        Unsubscribed
                    </button>
                    @endif
                  </div>
            </div>
          </div>
      </div>
      <div>
         <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between">
            <h5>Start Date</h5>
            <div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text w-42">
                          <i class="icon wb-calendar" aria-hidden="true"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control w-120" data-plugin="datepicker" value="{{ gmdate('m-d-Y', $sub->start_date)}}" disabled>
                    </div>
            </div>

          </div>
      </div>
       <div>
         <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between">
            <h5>End Date</h5>
            <div>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text w-42">
                          <i class="icon wb-calendar" aria-hidden="true"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control w-120" data-plugin="datepicker" value="{{ gmdate('m-d-Y', $sub->current_period_end)}}" disabled>
                    </div>
            </div>

          </div>
      </div>

      <div>
        <div class="card border-0 p-20">
         <h5>Latest Invoice</h5>
            <div class="list-group list-group-dividered">
                    <a class="list-group-item flex-column align-items-start border-0" href="javascript:void(0)"
                    data-url="/slide-invoice?id={{ $latest_invoice->id }}&user_id={{ auth()->user()->id }}&role_id={{ $subscription->metadata['role_id'] }}&guild_id={{ \App\DiscordStore::where('id', $subscription->store_id)->first()->guild_id }}" data-toggle="slidePanel">
                        <span class="badge badge-pill text-capitalize badge-primary">{{ $latest_invoice->status }}</span>
                        <span class="badge badge-pill badge-primary badge-outline mr-2 hidden-sm-down">{{ $latest_invoice->number }}</span>
                        <span class="badge badge-first badge-pill badge-success mr-15"><i class="wb wb-check"></i></span>
                        <div><p class="desc">{{ $latest_invoice['lines']['data'][0]['description'] }}</p></div>
                    </a>
            </div>

        </div>
      </div>

    </div>
       {{-- @if($sub->status == 'active')
        <div class="put-bottom">
            <div class="row">
                <div class="col-md-12">
                    @if($days_passed <= $subscription->refund_days && ($subscription->refund_enabled != 1))
                        <button class="btn btn-dark btn-block" onclick="cancelSubscription();">End Subscription</button>
                    @else
                        <button class="btn btn-dark btn-block" onclick="requestRefundSubscription();">Cancel/Refund ({{ $subscription->refund_days - $days_passed }} days remaining)</button>
                    @endif
                </div>
            </div>
        </div>
        @endif --}}

</div>


<script type="text/javascript">
    function cancelSubscription() {
        Swal.fire({
            title: 'Cancel Subscription?',
            text: "You won't be able to revert this! (subscription will be cancelled at end of term)",
            html: "<b>You won't be able to revert this!</b><br>(subscription will be cancelled at end of term)",
            footer: '<span class=\"text-white text-center\"><div class=\"checkbox-custom checkbox-default\"><input type=\"checkbox\" id=\"end_now\" name=\\"inputEnd_now\" autocomplete=\"off\"><label for=\"inputEnd_now\">Terminate immediately?</label></div></span>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!',
            cancelButtonText: 'Nope, never mind.',
            target: document.getElementById('slider-div')
        }).then((result) => {
            if (result.value) {
                if($("#end_now").is(':checked')) {
                    var endNow = "1";
                }else{
                    var endNow = "0";
                }
                $.ajax({
                    url: '/cancel-subscription',
                    type: 'POST',
                    data: {
                        sub_id: '{{ $sub->id }}',
                        end_now: endNow,
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Subscription cancelled!',
                            type: 'success',
                            showCancelButton: false,
                            target: document.getElementById('slider-div')
                        }).then(result => {
                            $('#close-slide').click();
                            if(endNow == "1"){
                                window.location.reload(true);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: msg['msg'],
                            type: 'warning',
                            showCancelButton: false,
                            target: document.getElementById('slider-div')
                        });
                    }
                });
            }
        });
    }
</script>

<script type="text/javascript">
    function requestRefundSubscription() {
        var no_questions_asked = "{{ $subscription->refund_terms }}";

        if(no_questions_asked == 1) {
            var swal_data = {
                title: 'Refund Request',
                html: "<b>Refund Policy:</b> No Questions Asked.",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, request refund!',
                cancelButtonText: 'Nope, never mind.',
                target: document.getElementById('slider-div')
            };
        } else {
            var swal_data = {
                title: 'Refund Request',
                html: "<b>Refund Policy:</b> By server owner discretion with reason.",
                input: 'textarea',
                inputPlaceholder: 'I would like a refund because...',
                inputAttributes: {
                    'aria-label': 'Refund reason'
                },
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, request refund!',
                cancelButtonText: 'Nope, never mind.',
                target: document.getElementById('slider-div')
            };
        }

        Swal.fire(swal_data).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/request-subscription-refund`,
                    type: 'POST',
                    data: {
                        sub_id: '{{ $sub->id }}',
                        sub_guild_name: '{{ $guild_name }}',
                        sub_role_name: '{{ $role_name }}',
                        sub_user_id: '{{ auth()->user()->id }}',
                        reason: result.value,
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    if (msg['success']) {
                        Swal.fire({
                            title: 'Success!',
                            text: msg['msg'],
                            type: 'success',
                            showCancelButton: false,
                            target: document.getElementById('slider-div')
                        }).then(result => {
                            $('#close-slide').click();
                            window.location.reload(true);
                        });
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: msg['msg'],
                            type: 'warning',
                            showCancelButton: false,
                            target: document.getElementById('slider-div')
                        });
                    }
                });
            }
        });
    }
</script>



<script type="text/javascript">
    function undoCancelSubscription() {
        Swal.fire({
            title: 'Undo or Update?',
            footer: '<span class=\"text-white text-center\"><div class=\"checkbox-custom checkbox-default\"><input type=\"checkbox\" id=\"end_now\" name=\\"inputEnd_now\" autocomplete=\"off\"><label for=\"inputEnd_now\">or terminate immediately?</label></div></span>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes please.',
            cancelButtonText: 'Nope, never mind.',
            target: document.getElementById('slider-div')
        }).then((result) => {
            if (result.value) {
                if($("#end_now").is(':checked')) {
                    var endNow = "1";
                }else{
                    var endNow = "0";
                }
                $.ajax({
                    url: '/undo-cancel-subscription',
                    type: 'POST',
                    data: {
                        sub_id: '{{ $sub->id }}',
                        end_now: endNow,
                        _token: '{{ csrf_token() }}'
                    },
                }).done(function (msg) {
                    if (msg['success']) {
                        if(endNow == "1"){
                            Swal.fire({
                                title: 'Success!',
                                text: 'Subscription cancelled now!',
                                type: 'success',
                                showCancelButton: false,
                                target: document.getElementById('slider-div')
                            }).then(result => {
                                $('#close-slide').click();
                                window.location.reload(true);
                            });
                        }else{
                            Swal.fire({
                                title: 'Success!',
                                text: 'Subscription uncancelled!',
                                type: 'success',
                                showCancelButton: false,
                                target: document.getElementById('slider-div')
                            }).then(result => {
                                $('#close-slide').click();
                                if(endNow == "1"){
                                    window.location.reload(true);
                                }
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Oops!',
                            text: msg['msg'],
                            type: 'warning',
                            showCancelButton: false,
                            target: document.getElementById('slider-div')
                        });
                    }
                });
            }
        });
    }
</script>




@include('partials/clear_script')