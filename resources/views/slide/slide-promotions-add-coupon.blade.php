<header class="slidePanel-header bg-indigo-500">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>@lang('lang.add_coupon')</h1>
</header>


<div class="put-long" id="slider-div">
    <div class="p-30">

        <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <h5 class="pr-15 responsive-hide">Coupon Code</h5>
            <input id="coupon_code" type="text" class="form-control mx-auto w-200" placeholder="COUPONCODE" onkeyup="inputSuccess()">
            {{--<a class="btn btn-pure btn-success icon wb-check" href="javascript:void(0)" id="show-check"></a>
            <a class="btn btn-pure btn-danger icon wb-close" href="javascript:void(0)" id="show-error" data-plugin="webuiPopover"
               data-title="Invalid Code"
               data-content="&lt;p&gt;@lang('lang.coupon_requirements')&lt;/p&gt;" data-trigger="hover"
               data-animation="pop"></a>--}}

        </div>
        <hr>
        <div class="pr-15 pl-15 pt-15">
            <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                    <div class="radio-custom radio-primary pr-15 mx-auto">
                        <input type="radio" id="radio-percentage" name="discountRadios" checked/>
                        <label for="radio-percentage"><h5 class="mt-1 mb-0">Percent Off</h5></label>
                    </div>
                    <div class="d-block pl-30 mx-auto">
                        <div class="input-group">
                            <input id="coupon-radio-percentage" type="amount" class="form-control w-80" value="20"
                                   placeholder="0">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                    <div class="radio-custom radio-primary pr-15 mx-auto">
                        <input type="radio" id="radio-amount" name="discountRadios"/>
                        <label for="radio-amount"><h5 class="mt-1 mb-0">Fixed Amount</h5></label>
                    </div>
                    <div class="d-block pl-15 mx-auto">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input id="coupon-radio-amount" type="amount" class="form-control w-100" placeholder="0.00"
                                   disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
            <div class="d-block d-flex flex-row flex-wrap align-items-center justify-content-between">
                <div>
                    <div class="d-flex flex-row flex-wrap align-items-center justify-content-between">
                        <h5 class="pr-15 mx-auto">Duration</h5>
                        <div class="checkbox-custom checkbox-primary">
                        </div>

                        <div class="d-block pl-15 mx-auto">
                            <div class="input-group" id="group-expiry-date">
                                <select class="form-control" id="duration">
                                    <option value="forever">Forever</option>
                                    <option value="once">Once</option>
                                    <option value="repeating">Multiple Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-block pl-15 mx-auto" id="duration_months_div" style="visibility: hidden" hidden>
                            <div class="input-group input-search-dark" id="group-max-uses">
                                <input id="duration_months_input" type="number" class="form-control w-100" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="put-bottom put-large">
            <div class="row">
                <div class="col-12 pt-15">
                    <button class="btn btn-success btn-block" id="btn-create"
                            onclick="createPromotion()" disabled>@lang('lang.create_coupon')</button>
                </div>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#duration').on('change', function (e) {
            if ($(this).val() === 'repeating') {
                $('#duration_months_div').css('visibility', 'visible');
                $('#duration_months_div').attr('hidden', false);
            } else {
                $('#duration_months_div').css('visibility', 'hidden');
                $('#duration_months_div').attr('hidden', true);
                $('#duration_months_input').val(0);
            }
        });
    });
</script>

<script type="text/javascript">
    function createPromotion() {
        var percentageOff = $('#coupon-radio-percentage').val();
        var fixedAmount = $('#coupon-radio-amount').val();
        var couponCode = $('#coupon_code').val();
        var duration = $('#duration').val();
        var months_in_effect = $('#duration_months_input').val();

        //var show_check = $('#duration');
        //var show_error = $('#duration');

        $.ajax({
            url: '/promotions-create-promotion',
            type: 'POST',
            data: {
                'code': couponCode,
                'duration': duration,
                'percentage': percentageOff,
                'fixed_amount': fixedAmount,
                'months_in_effect': months_in_effect,
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if (msg['success']) {
                Toast.fire({
                    title: 'Woohoo!',
                    text: msg['msg'],
                    type: 'success',
                    showCancelButton: false
                }).then(function (result) {
                    $('#back-btn').click();
                    window.location.reload(true);
                });
                return true;
            } else {
                Swal.fire({
                    title: 'Oops!',
                    text: msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    target: document.getElementById('slider-div')
                });

                return false;
            }
        });
    }
</script>

<script>
    $(function () {
        $('#coupon-store-wide').on('click', function () {
            $('#coupon-active-roles').attr('disabled', $(this).is(':checked'));
            $('#coupon-active-roles').val('').trigger('change')
        });
        $('#coupon-expiry-enable, #group-expiry-date').on('click', function () {
            $('#coupon-expiry-date').removeAttr('disabled', $(this).is(':checked'));
            $('#coupon-expiry-enable').attr('checked', true)
        });
        $('#radio-percentage').on('click', function () {
            $('#coupon-radio-amount').attr('disabled', $(this).is(':checked'));
            $('#coupon-radio-percentage').removeAttr('disabled', $(this).is(':checked'));
        });
        $('#radio-amount').on('click', function () {
            $('#coupon-radio-amount').removeAttr('disabled', $(this).is(':checked'));
            $('#coupon-radio-percentage').attr('disabled', $(this).is(':checked'));
        });
    });

    $('input#coupon-max-uses').blur(function () {
        tmpval = $(this).val();
        if (tmpval > '0') {
            $('#group-max-uses').removeClass('input-search-dark');
        } else {
            $('#group-max-uses').addClass('input-search-dark');
        }
    });

    function inputSuccess() {
	 if(document.getElementById("coupon_code").value==="") {
            document.getElementById('btn-create').disabled = true;
        } else {
            document.getElementById('btn-create').disabled = false;
        }
    }
</script>

@include('partials/clear_script')
