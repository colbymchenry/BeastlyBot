<script type="text/javascript">
        function beginCheckout(plan) {
            Swal.fire({
                title: 'Processing....',
                text: '',
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: () => !Swal.isLoading(),
                target: document.getElementById('slider-div')
            });
            swal.showLoading();

            var url = '/buy-plan';

            @if(auth()->user()->plan_sub_id !== null)
                url = '/change-plan';
            @endif

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'promotion_code': '',
                    'affiliate_id': 1,
                    'plan': plan,
                    _token: '{{ csrf_token() }}'
                },
            }).done(function (msg) {
                if (msg['success']) {
                    swal.close();

                    @if(auth()->user()->plan_sub_id !== null)
                    Swal.fire({
                        title: 'Pay Invoice',
                        html:
                            'Change successful! ' +
                            '<a href="' + msg['invoice_url'] + '">links</a> ',
                        showCancelButton: false,
                        showConfirmButton: true
                    });
                    @else
                    stripe.redirectToCheckout({
                        sessionId: msg['msg']
                    }).then(function (result) {
                        // TODO: Do this for all including the product-purchase slide
                        // If `redirectToCheckout` fails due to a browser or network
                        // error, display the localized error message to your customer
                        // using `result.error.message`.
                    });
                    @endif
                } else {
                    Swal.fire({
                        title: 'Failure',
                        text: msg['msg'],
                        showCancelButton: false,
                        showConfirmButton: true
                    });
                }
            });
        }
    </script>

    <script>
    $('#dark-day').on('click', function(e) {
        $('body').toggleClass('dark');
        e.stopPropagation();
    });
    </script>

<script type="text/javascript">
        $(document).ready(function () {
        });

    function changeNightMode() {

        if($("body").hasClass("dark")){
            var mode = 1;
        }else{
            var mode = 0;
        }

        $.ajax({
            url: '/change_night_mode',
            type: 'POST',
            data: {
                'mode': mode,
                _token: '{{ csrf_token() }}'
            },
        })
    }

    </script>
