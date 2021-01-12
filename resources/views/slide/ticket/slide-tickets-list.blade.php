    
  <header class="slidePanel-header bg-indigo-600">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close" id="slide-close"
        aria-hidden="true"></button>
        <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-plus mr-30" id="slide-create"
      aria-hidden="true" data-url="/slide-ticket-create" data-toggle="slidePanel"></button>
      <button type="button" class="btn btn-icon btn-pure btn-inverse actions-top icon wb-chevron-left mr-60 d-none" id="slide-help"
      aria-hidden="true" data-url="/slide-help-titles" data-toggle="site-sidebar"></button>
    </div>
    <h1><i class="icon wb-chat"></i> Support</h1>
</header>
<div class="site-sidebar-tab-content tab-content">

    <div class="tab-pane fade active show" id="sidebar-help">
        <div class="mt-15">
        
                    @if($tickets->isEmpty())
                        <!--<p>You have not created any tickets.</p>-->
                    @else

                    <div class="list-group no-select pt-0" id="helpList">
                    @foreach($tickets as $ticket)
                        <a class="list-group-item flex-column align-items-start px-10 py-10" data-toggle="slidePanel" data-url="/slide-ticket-show/{{ $ticket->ticket_id }}">
                            <div class="float-right"><p class="mb-0"><span class="badge badge-success bg-{{ $ticket->status == 'Team Reply' ? 'green-600' : 'indigo-600' }} mr-1">{{ $ticket->status }}</span>{{-- <small>{{ $ticket->updated_at->diffForHumans() }}--}}</small></p> 
                            </div>
                            <h4 class="list-group-item-heading mt-0 mb-5">{{ Str::limit($ticket->title, 150) }}</h4>
                            <p class="mb-0">{{ Str::limit($ticket->message, 115) }}</p>
                        </a>
                    @endforeach
                    </div>
                    {{ $tickets->render() }}

                    @endif


         
      </div>

    </div>

</div>

<script>


    var searchParamsFirst = new URLSearchParams(window.location.search);
    if(searchParamsFirst.has('open')){
        searchParamsFirst.delete('open');
        window.history.replaceState({}, '', `${location.pathname}?${searchParamsFirst}`);
    }

    $(document).on('slidePanel::beforeHide', function (e) {
    var searchParamsSecond = new URLSearchParams(window.location.search);
        if(searchParamsSecond.has('messages')){
            params = searchParamsSecond.delete('messages');
            window.history.replaceState({}, '', `${location.pathname}`);
        }
    });

</script>

<script>

    if(window.location.href.includes('help')) {
        $("#slide-help").removeClass('d-none')
    };


    if((!window.location.href.includes('guide-opened')) && window.location.href.includes('server')) {
        setTimeout(function(){
           // set variables
        },100)
    };

</script>


@include('partials/clear_script')