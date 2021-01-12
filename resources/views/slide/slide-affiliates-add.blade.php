<!-- TODO: add coupon tab and select to add affilaite tab -->

<!-- coupon tab has coupon name, expiry, uses etc -->
<!-- affiliate tab has uses, expiry, percentage etc -->

<header class="slidePanel-header bg-purple-500">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true"></button>
    </div>
    <h1>Add Affiliate</h1>
</header>

<div class="put-long" id="slider-div">
    <div class="p-30">
        <div class="row">
            <div class="col-md-12 p-15">
                <div class="p-15 d-flex flex-row flex-wrap align-items-center justify-content-between">
                    <h5>Commission</h5>
                    <div class="d-block">
                        <div class="input-group w-100">
                            <input id="affiliate-commission" type="textbox" class="form-control" value="20">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="put-bottom">
            <div class="row">
                <div class="col-12 pt-15">
                    <button style="visibility: hidden;" hidden="hidden" data-toggle="modal"
                            data-target="#requestLinkModal"
                            id="modal-btn">Create
                        Request Link
                    </button>
                    <button class="btn btn-success btn-block" onclick="createAffiliateLink()">Create
                        Request Link
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    function createAffiliateLink() {
        $.ajax({
            url: '/create-affiliate-link',
            type: 'POST',
            data: {
                'commission': $('#affiliate-commission').val(),
                'guild_id': '{{ $guild_id }}',
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if (msg['success']) {
                $('#modal-affiliate-inv-link').text(msg['msg']);
                $('#modal-btn').click();
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
</script>
