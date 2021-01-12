    
  <header class="slidePanel-header bg-indigo-600">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
        aria-hidden="true"></button>
        <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-tickets-list" data-toggle="slidePanel"></button>
    </div>
    <h1><i class="icon wb-chat"></i> Send Ticket</h1>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        @if (session('status'))
           <div class="alert alert-success">
               {{ session('status') }}
           </div>
        @endif
       <div>
      <div>
        <div class="form-group pb-0 mb-15">
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text w-50"><i class="wb wb-chat-working"></i></span>
                </div>
                <select id="category" type="category" class="form-control" name="category">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        @if(isset($type))
                        <option value="{{ $category->id }}" @if($category->id == $type)selected @endif>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
              </div>
            </div>

            <div class="form-group pb-0 mb-15">
              <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text w-50"><i class="wb wb-help"></i></span>
                </div>
                <input type="text" class="form-control" id="ticket-title" name="title" placeholder="I need help with?">
              </div>
            </div>

            <div class="form-group pb-0 mb-15">

                <textarea rows="6" id="message" class="form-control" name="message" placeholder="Write a little more to help us help you..."></textarea>
              
            </div>
            <div class="form-group pb-0 mb-15">

            <button type="button" class="btn btn-block btn-dark" id="send-button">Send</button>
            </div>

         </div>
      </div>

    </div>

</div>

<script>

if(window.location.href.includes('auto-open')) {
        $("#slide-close").removeClass('d-none')
        $("#slide-back").addClass('d-none')
    };

    if((!window.location.href.includes('guide-opened')) && window.location.href.includes('server')) {
        setTimeout(function(){
           // set variables
        },100)
    };

</script>

<script type="text/javascript">
    if(window.location.href.includes('auto-open')) {
        $("#slide-close").removeClass('d-none')
        $("#slide-back").addClass('d-none')
    };


    $('#send-button').on('click', function() {
           
           // Swal.showLoading();

        $.ajax({
            url: `{{ route('newTicketPost') }}`,
            type: 'POST',
            data: {
                title: $('#ticket-title').val(),
                category: $('#category').val(),
                message: $('#message').val(),
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
              $('#send-button').attr('disabled', true);
                  Toast.fire({
                            title: 'Sent!',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                      /*
                    setTimeout(function(){
                        $("#test-switch").removeClass('focus');
                        $('#btn-store1').removeClass("btn-success");
                        $('#icon-store1').addClass("blue-600").removeClass("green-600");;
                        $('#btn-store2').addClass("btn-primary").removeClass("btn-success");
                        Toast.fire({
                            title: 'Done!',
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                        });
                    },2000) */
            } else {
                Toast.fire({
                    //title: 'Going ' + live + ' Mode...',
                    text: ' ' + msg['msg'],
                    type: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false,
                });
                //$('#partnerPricingModal').modal('show');
            }
            setTimeout(function(){
              $('#slide-back').click();
            },50)
        });

    });

</script>


@include('partials/clear_script')