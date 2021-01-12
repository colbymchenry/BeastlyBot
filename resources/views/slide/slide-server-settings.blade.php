
<header class="slidePanel-header bg-primary-600">
  <!--<div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left"
      aria-hidden="true" data-url="/slide-server" data-toggle="slidePanel"></button>
  </div>-->
   <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
      aria-hidden="true"></button>
  </div>
  <h1>Store Front Settings</h1>
</header>

<div class="p-md-15 put-long" id="slider-div">
    <div>
        <div class="list-group-item d-flex flex-row flex-wrap align-items-center justify-content-between">
            <h5>Store Front URL</h5>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text w-xs-p100" id="basic-addon3">beastly.store/</span>
                </div>
                <input type="text" class="form-control w-xs-p100" id="basic-url" aria-describedby="basic-addon3" value="{{ $shop->url }}">
            </div>
        </div>
    </div>

    <div>
        <div class="list-group-item flex-row flex-wrap align-items-center justify-content-between">
            <div>
                <h5 class="mt-0">Description</h5>
                <div>
                    <textarea class="form-control" rows="1" id="description">{{ $shop->description }}</textarea>
                    <small class="hiddden-sm-down">Server description used on your store front meta data.</small>
                </div>
            </div>
        </div>
    </div>

    <div class="list-group-item">

        <h5 class="mt-0">Refund Policy</h5>
         <div class="row">
             <div class="col-6 col-md-2 col-lg-1">
                 <div class="checkbox-custom checkbox-primary">
                     <input type="checkbox" id="refunds-enabled" {{ $shop->refunds_enabled ? 'checked' : '' }} />
                     <label for="refund-enabled"></label>
                 </div>
             </div>
             <div class="col-6 col-md-4 col-lg-3">
                 <div class="input-group w-120 ml-auto">
                     <input type="text" class="form-control" id="refunds-days" name="refunds-days" value="{{ $shop->refunds_days }}" />
                     <div class="input-group-append">
                         <span class="input-group-text">Days</span>
                     </div>
                 </div>
             </div>
             <div class="col-12 col-md-6 col-lg-8">
                 <div class="input-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text">Terms:</span>
                     </div>
                     <select class="form-control @if($shop->refunds_enabled == '0') disabled @endif" @if($shop->refunds_enabled == '0') disabled @endif id="refunds-terms">
                         <option value="1" @if($shop->refunds_terms == '1') selected @endif>No Questions Asked!</option>
                         <option value="2" @if($shop->refunds_terms == '2') selected @endif>By server owner discretion with reason.</option>
                     </select>
                 </div>                           
             </div>
             <div class="col-12">
             <small>Your shop refund policy. A friendly policy encouages sales and lowers credit chargebacks. <!--<a href="#" target="_blank">read more</a>--></small>
             </div>
         </div>
                
    </div>

    <button type="button" class="btn btn-block put-bottom btn-primary" onclick="saveServerSettings();">Save Settings</button>
</div>

<script type="text/javascript">
$('textarea#description').on('keyup', function(){
  $(this).val($(this).val().replace(/[\r\n\v]+/g, ' '));
  $(this).attr('maxlength','150');
});
$('input#basic-url').on('keyup', function(){
  $(this).val($(this).val().replace(' ', '_'));
  $(this).attr('maxlength','40');
});
</script>

<script type="text/javascript">
    function saveServerSettings() {

        Toast.fire({
            title: 'Saving...',
            // type: 'info',
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
           // target: document.getElementById('slider-div')
        });

        Toast.showLoading();

        var base_url = "https://beastly.store/";
        var url = $("#basic-url").val(); 

        if($("#refunds-enabled").is(':checked')) {
            var refundsEnabled = "1";
        }else{
            var refundsEnabled = "0";
        }

        $.ajax({
            url: `/save-server-settings`,
            type: 'POST',
            data: {
                id: '{{ $shop->guild_id }}',
                url: $("#basic-url").val(),
                description: $("#description").val(),
                refunds_enabled: refundsEnabled,
                refunds_days: $("#refunds-days").val(),
                refunds_terms: $("#refunds-terms").val(),
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
                Toast.fire({
                    title: 'Done!',
                    type: 'success',
                    //showCancelButton: false,
                    //showConfirmButton: true,
                    //target: document.getElementById('slider-div')
                });

                $('#btn-store1').attr('onclick', `window.open('${base_url}${url}')`);
                $('#btn-store2').attr('onclick', `window.open('${base_url}${url}')`);
                $('#btn-store1').attr('data-original-title', (base_url + url));
            } else {
                Swal.fire({
                    title: 'Saving...',
                    text: msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    showConfirmButton: true,
                    target: document.getElementById('slider-div')
                });
            }
        });
    }

    $(function () {
       // $('#refund-enable').on('click', function () {
        //    $('#refund-days').attr('disabled', $(this).not(':checked'));
        //    $('#refund-terms').attr('disabled', $(this).not(':checked'));
       //     $('#refund-terms').val('2', $(this).is(':checked'));
       //     $('#refund-terms').val('1', $(this).not(':checked'));
        //    $('#refund-days').val('').trigger('change')
       // })
        $('#refunds-enabled').on('click', function () {
            if($(this).is(':checked')){
            $('#refunds-terms').val('1');
            $('#refunds-days').prop('disabled',false);
            $('#refunds-days').val('7').focus();
            $('#refunds-terms').prop('disabled',false);
            }else{
            $('#refunds-days').prop('disabled',true);
            $('#refunds-terms').prop('disabled',true);
            $('#refunds-days').val('').trigger('change');
            $('#refunds-terms').val('2');
            }
            
        })
        $('input#refund-days').blur(function () {
            tmpval = $(this).val();
            if (tmpval < '1') {
                $('#refunds-days').prop('disabled',true);
                $('#refunds-terms').prop('disabled',true);
                $('#refunds-days').val('').trigger('change');
                $('#refunds-terms').val('2');
                $('#refunds-enable').prop('checked', false);
            }
        })
    });
    
</script>

@include('partials/clear_script')