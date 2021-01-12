<style>
.dark .timeline-period {
    position: relative;
    z-index: 6;
    display: block;
    padding: 25px 10px;
    margin: 20px auto 30px;
    clear: both;
    font-size: 14px;
    text-align: left;
    text-transform: none;
}
.timeline::before {
    background-color: #24242b;
}
.dark .timeline-message {
    position: relative;
    z-index: 6;
    display: block;
    padding: 25px 10px;
    margin: 20px auto 30px;
    clear: both;
}
</style>

<header class="slidePanel-header bg-indigo-600">
  <div class="slidePanel-actions" aria-label="actions" role="group">
    <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close d-none" id="slide-close"
      aria-hidden="true"></button>
      <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-replay mr-30" id="slide-refresh"
      aria-hidden="true" data-url="/slide-ticket-show/{{ $ticket->ticket_id }}" data-toggle="slidePanel"></button>
    <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left" id="slide-back"
      aria-hidden="true" data-url="/slide-tickets-list" data-toggle="slidePanel"></button>
  </div>
  </div>
  <h1><i class="icon wb-chat"></i> {{ $ticket->category->name }}</h1>
</header>
<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-help">
        <div>
            <div>
              <div class="badge badge-lg badge-primary bg-dark my-1" id="step1">{{ Str::limit($ticket->title, 45) }}</div>
              <div class="badge badge-lg badge-primary bg-{{ $ticket->status == 'Team Reply' ? 'green-600' : 'indigo-600' }} float-right my-1" id="step1">{{ $ticket->status }}</div>
                <ul class="timeline timeline-icon mb-0">
                    
                    <li class="timeline-period bg-indigo-600 rounded text-white"><b>{{ $ticket->user->getDiscordHelper()->getUsername() }}:</b> {!! nl2br($ticket->message) !!}</li>

                    @if($ticket->comments->count() > 0)
                    @foreach($ticket->comments as $comment)
                   
                    <li class="timeline-item {{ $ticket->user->id === $comment->user_id ? 'timeline-reverse' : '' }} {{-- ((!$loop->first && $ticket->comments[$loop->index - 1]->user_id === $comment->user->id) || $loop->first) ? 'my-0' : '' --}} mb-0">
                                    @if((!$loop->first && $ticket->comments[$loop->index - 1]->user_id != $comment->user->id) || $loop->first)
                                    <div class="timeline-dot {{ $comment->user->admin == 1 ? 'bg-green-600' : 'bg-dark' }}">
                                   
                                      @if($ticket->user->id === $comment->user_id)
                                        
                                        <span class="avatar avatar-online">
                                            <img src="{{ $ticket->user->getDiscordHelper()->getAvatar() }}" alt="User">
                                            <i></i>
                                        </span>
                                      @else
                                      <i class="icon wb-reply"></i>
                                      @endif
                                    </div>
                                    @if($ticket->user->id != $comment->user_id)
                                    <div class="badge badge-lg badge-primary {{ $comment->user->admin == 1 ? 'bg-green-600' : 'bg-indigo-600' }} my-1" id="step1">Support Team</div>
                                    @endif
                                    @endif
                                    <div class="timeline-content">
                                        <div class="card card-article card-shadow @if(!$loop->last) mb-0 @endif">
                                            <div class="card-block">
                                                <p>{!! nl2br($comment->comment) !!}</p>
                                                <p class="card-text">
                                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                </p>                  
                                            </div>
                                        </div>
                                    </div>
                                    @if($comment->url != NULL)
                                    <div class="timeline-info pr-15">
                                      <a class="btn btn-dark btn-link ml-10" href="{{ $comment->url }}" target="_blank"><i class="icon icon-link"></i> Support Link</a>
                                    </div>
                                    @endif
                                </li>
                                <li class="clearfix"></li>

                    @endforeach
                    @else
                    <div class="timeline-message text-center mb-0 pt-5"><div class="badge badge-lg bg-green-600 text-white">Waiting for Team Reply </div>
                    {{--<p><small>May take up to 24 hours</small></p></div>--}}
                    @endif
                  
                </ul>
                <div class="p-0">
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }} mb-2">
                      <div class="input-group">
                          <textarea rows="2" id="reply-comment" class="form-control bg-grey-4" name="reply-comment"></textarea>
                          <div class="input-group-append">
                            <button type="button" class="btn btn-dark bg-indigo-600 text-white btn-block" id="reply-button">Reply</button>
                          </div>
                      </div>
                        @if ($errors->has('comment'))
                            <span class="help-block">
                              <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>

           
        </div>
    </div>
</div>

<script>

$(document).on('slidePanel::beforeHide', function (e) {
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('open')){
        params = searchParams.delete('open');
        window.history.replaceState({}, '', `${location.pathname}`);
    }
});

</script>

<script type="text/javascript">
    if(window.location.href.includes('auto-open')) {
        $("#slide-close").removeClass('d-none')
        $("#slide-back").addClass('d-none')
    };


    $('#reply-button').on('click', function() {
            $('#reply-button').attr('disabled', true);
           // Swal.showLoading();

        $.ajax({
            url: `/bknd000/ticket-reply-post`,
            type: 'POST',
            data: {
                ticket_id: '{{ $ticket->id }}',
                comment: $('#reply-comment').val(),
                _token: '{{ csrf_token() }}'
            },
        }).done(function (msg) {
            if(msg['success']) {
                  Toast.fire({
                            title: 'Done!',
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
              $('#slide-refresh').click();
            },50)
        });

    });

</script>

@include('partials/clear_script')