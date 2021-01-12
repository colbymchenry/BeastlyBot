@extends('layouts.app-zero2')



@section('metadata')
    <title>{{ $guild->name }} | Shop</title>
    <meta name="description"
          content="{{ App\DiscordStore::where('guild_id', $guild_id)->first()->description }}"> <!-- server description -->
    <meta name="keywords" content="{{ $guild->name }}, {{ $guild_id }}, Discord, Shop, Beastly, Bot"> <!-- server name -->
    <meta name="author" content="BeastlyBot">

@endsection

@section('content')

@if(auth()->user()->getDiscordHelper()->ownsGuild($guild_id))
    @if((!App\DiscordStore::where('guild_id', $guild_id)->get()[0]->live) || $owner_array->error == '2')
        <div class="bg-dark-4 text-white text-center font-size-16 font-weight-500 w-200 mx-auto card m-0 mb-30">
            <a class="card-body p-5 text-white" href="/server/{{ $guild_id }}{{ (!auth()->user()->canAcceptPayments()) ? '#ready' : '' }}">
        <!-- <p>You are viewing this as a <span class="badge badge-primary">Test</span> session <span class="font-weight-100">(only you can see this page)</span>.
            To open this store <a href="/server/{{ $guild_id }}" class="text-white">set your server to <span class="badge badge-success">Live</span> on the dashboard.</a></p>-->
            Store mode: <span class="btn btn-primary btn-sm font-size-14 ml-2">Test</span>
            </a>
        </div>
    @else
    <div class="bg-dark-4 text-white text-center font-size-16 font-weight-500 w-200 mx-auto card m-0 mb-30">
            <a class="card-body p-5 text-white" @if($owner_array->error != '1')href="/server/{{ $guild_id }}" @else href="/dashboard" @endif>
        <!-- <p>You are viewing this as a <span class="badge badge-primary">Test</span> session <span class="font-weight-100">(only you can see this page)</span>.
            To open this store <a href="/server/{{ $guild_id }}" class="text-white">set your server to <span class="badge badge-success">Live</span> on the dashboard.</a></p>-->
            Store mode: <span class="btn btn-success btn-sm font-size-14 ml-2">@if($owner_array->error != '1')Live @else Error @endif</span>
            </a>
        </div>
    @endif
@else
    <div href="/account/subscriptions" class="bg-dark-4 text-white text-center font-size-16 font-weight-500 w-200 mx-auto card m-0 mb-30">
        <div class="card-body p-5 text-white">
       <!-- <p>You are viewing this as a <span class="badge badge-primary">Test</span> session <span class="font-weight-100">(only you can see this page)</span>.
        To open this store <a href="/server/{{ $guild_id }}" class="text-white">set your server to <span class="badge badge-success">Live</span> on the dashboard.</a></p>-->
            <a href="/account/subscriptions" class="btn btn-dark btn-sm font-size-14 ml-2">My Subscriptions</a>
        </div>
    </div>
@endif

    <div class="h-250 draw-grad-up">
        <div class="text-center blue-grey-800 m-0 mt-50">
            <a class="avatar avatar-xxl" href="javascript:void(0)">
                @if($guild->icon == NULL)
                    <img id="server_icon" src="https://i.imgur.com/qbVxZbJ.png" alt="...">
                @else
                    <img id="server_icon" src="https://cdn.discordapp.com/icons/{{ $guild_id }}/{{ $guild->icon }}.png?size=256" alt="...">
                @endif
            </a>
            <div class="font-size-50 blue-grey-100 mb--5" id="guild_name">{{ $guild->name }}</div>
            <div class="font-size-16 blue-grey-100 w-400 mx-auto hidden-md-down">{{ Str::limit(App\DiscordStore::where('guild_id', $guild_id)->first()->description, 100) }}</div>
            <span><button type="button" class="btn btn-sm btn-round btn-dark btn-icon mb-10 mt-20 mt-md-10 mt-lg-15" id="btn_copy-url" data-toggle="tooltip" data-original-title="beastly.store/{{ App\DiscordStore::where('guild_id', $guild_id)->value('url') }}" data-placement="right"><i class="wb-link"></i></button></span>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-xl-2 col-lg-1 col-md-12 order-1 order-lg-2">
                <div class="d-flex justify-content-center pt-40 pt-sm-60">
                    <div class="xx banner-image">
                        <div class="xx-head"></div>
                        <div class="xx-body"></div>
                        <div class="xx-hand"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 order-2 order-lg-1">

                <div class="row pt-30">
                    <div class="col-md-12">
                        <div class="container">

                            <div class="panel-body p-0">
                                <div class="panel-group" id="accordian_main" aria-multiselectable="true" role="tablist">
                                @foreach($roles as $role)
                                    @if($role->name !== '@everyone')
                                        @if(in_array($role->id, $active))
                                        <div class="panel" id="role-{{ $role->id }}">
                                            <div class="panel-heading p-20 d-flex flex-row flex-wrap align-items-center justify-content-between" id="heading_{{ $guild_id }}" role="tab">
                                                <div class="w-100 hidden-sm-down">
                               
                                                @if(count($descriptions) > 0 && $descriptions->where('role_id', $role->id)->first()->exists())
                                                    <a class="panel-title" data-toggle="collapse" href="#tab_{{ $role->id }}" data-parent="#accordian_main" aria-expanded="false" aria-controls="tab_{{ $role->id }}">
                                                    </a>
                                                @endif
                                       
                                                </div>
                                                <div class="text-center">
                                                    <a data-toggle="collapse" href="#tab_{{ $role->id }}" data-parent="#accordian_main" aria-expanded="true" aria-controls="tab_{{ $role->id }}">
                                                        <div class="badge badge-primary badge-lg font-size-18 text-white" style="background-color: #{{ dechex($role->color) }}"><i class="icon-discord mr-2"></i> <span>{{ $role->name }}</span></div>
                                                    </a>
                                                </div>
                                                <div class="w-100 hidden-sm-down">
                                                    <button data-url="/slide-product-purchase/{{ $guild_id }}/{{ $role->id }}" data-toggle="slidePanel" type="button"
                                                    class="btn btn-sm btn-success float-right">Subscribe <i class="icon wb-arrow-right ml-2" ></i>
                                                    </button>
                                                </div>
                                                <div class="w-20 hidden-md-up">
                                                    <button class="btn btn-success p-1" data-url="/slide-product-purchase/{{ $guild_id }}/{{ $role->id }}" data-toggle="slidePanel">
                                                        <i class="icon wb-arrow-right" ></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @if(count($descriptions) > 0 && $descriptions->where('role_id', $role->id)->first()->exists())
                                            <div class="panel-collapse collapse" id="tab_{{ $role->id }}" aria-labelledby="heading_{{ $guild_id }}" role="tabpanel">
                                                <div class="panel-body">
                                                
                                                   {{ $descriptions->where('role_id', $role->id)->first()->description }}
                                               
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
@if(auth()->user()->getDiscordHelper()->ownsGuild($guild_id))
    @if(auth()->user()->plan_sub_id !== null)
        @include('partials/clear_script')
    @endif
@endif
--}}
<input readonly type="text" value="https://beastly.store/{{ App\DiscordStore::where('guild_id', $guild_id)->value('url') }}" id="input_copy-url" style="opacity:0">

@endsection

@section('scripts')

@if($banned)
    <script type="text/javascript">
        $(document).ready(function () {
            Swal.fire({
                title: 'You are banned!',
                text: 'It looks like you are banned from this server... Sorry.',
                type: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
                allowEscapeKey : false,
                allowOutsideClick: false
            });
    });
    </script>
@endif

<script type="text/javascript">
$(function() {
   $('#btn_copy-url').click(function() {
     $('#input_copy-url').focus();
     $('#input_copy-url').select();
     document.execCommand('copy');
     $('#btn_copy-url').attr('data-original-title', 'Copied!').addClass('btn-primary').removeClass('btn-dark');
     $('html .tooltip-inner').text('Copied!')
    setTimeout(function(){
        $('#btn_copy-url').attr('data-original-title', 'Copy Link').addClass('btn-dark').removeClass('btn-primary');
        $('html .tooltip-inner').text("beastly.store/{{ App\DiscordStore::where('guild_id', $guild_id)->value('url') }}")
    }, 1000);
   });
});
</script>

@endsection
