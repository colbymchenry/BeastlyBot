@extends('layouts.app')

@section('title', 'Servers')

@section('content')

    <div class="page-header">
        <ol class="breadcrumb">
            <h4 class="font-weight-100">Servers</h4>
        </ol>
       {{-- @if(auth()->user()->StripeConnect->express_id != null) --}}
        <div class="page-header-actions add-pulse">
            <a class="btn btn-primary btn-round"
        href="{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}" target="_blank" id="Addbtn" onclick="changeBtn()">
                <i class="icon wb-plus" aria-hidden="true"></i>
                Add Bot
            </a>
            <button type="button" class="btn btn-primary btn-outline btn-round d-none pulse" id="Refreshbtn" onclick="document.location.href='/servers#refresh';">
                <i class="icon wb-refresh" aria-hidden="true"></i>
                Refresh
            </button>
        </div>
      {{--  @else
        <div class="page-header-actions add-pulse">
            <a class="btn btn-primary btn-round"
               href="{{ \App\StripeHelper::getConnectURL() }}">
                Connect Stripe
                <i class="icon-stripe ml-2" aria-hidden="true"></i>
            </a>
        </div>
        @endif --}}
        <script type="text/javascript">
                function changeBtn() {
                  setTimeout(function(){
                    $('#Refreshbtn').removeClass('d-none');
                    $('#Addbtn').addClass('d-none');
                  },2000);
                }
              
            </script>
    </div>
<div class="row">
    <div class="col-lg-12">

        <div class="page-content-table">
            <div class="page-main">
                <table class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
                    <thead>
                        <tr>
                            <th class="cell-100"></th>
                            <th></th>
                            <th class="cell-150 hidden-md-down"></th>
                            <th class="cell-100 hidden-md-up"></th>
                        </tr>
                    </thead>
                    <tbody id="servers-table">
                        @foreach($guilds as $guild)
                        <tr onClick="document.location.href='/server/{{ $guild['id'] }}';" data-key="{{ $guild['id'] }}">
                            <td class="cell-100 pl-15 pl-lg-30">
                                <a class="avatar avatar-lg" href="javascript:void(0)">
                                @if($guild['icon'] == NULL)
                                <img src="https://i.imgur.com/qbVxZbJ.png" alt="...">
                                @else
                                <img src="https://cdn.discordapp.com/icons/{{ $guild['id'] }}/{{ $guild['icon'] }}.png?size=256" alt="...">
                                @endif
                                </a>
                            </td>
                            <td>
                                <div class="title">{{ $guild['name'] }}</div>
                            </td>
                            <td class="cell-150 hidden-md-down text-center">
                                @if(\App\DiscordStore::where('guild_id', $guild['id'])->exists())
                                <div class="time" id="subCount{{ $guild['id'] }}">{{ \App\Subscription::where('store_id', \App\DiscordStore::where('guild_id', $guild['id'])->first()->id)->where('status', '<', 4)->count() }} Subscriptions</div>
                                @else
                                <div class="time" id="subCount{{ $guild['id'] }}">0 Subscribers</div>
                                @endif
                            </td>
                            <td class="cell-100 hidden-md-up">
                                <button class="btn btn-link">Settings</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection


@section('scripts')

    <script type="text/javascript">
    $('#Addbtn').click(function(){
        location.hash = "refresh";
    });
    </script>


    <script type="text/javascript">
    setInterval(function(){
    if(window.location.href.includes('click-first=true')) {
        $('#servers-table tr').each(function(i, el) {
            if (i === 0) {
            $("tr td").addClass('bg-grey-2');
            setTimeout(function(){
                $("tr").click();
            },100)
            }
        })
        }
    },1900);
    setInterval(function(){
    if(window.location.href.includes('refresh')) {
        document.location.href='/servers#refresh';
    }
    },1900);
    setTimeout(function(){
    if( $('#servers-table tr').length == 0 ) {
        if(!window.location.href.includes('refresh')) {
            location.hash = "auto-open";
            $(".slide-button-ultimate").click();
        }
        $(".add-pulse").addClass('pulse');
            var hrf = 'document.location.href="/server/';
            var guid = '#guide-ultimate=true';
            var slash = '/servers';
            var clickfirst = '?click-first=true';
            $('#Refreshbtn').attr('href',slash + clickfirst + guid);
    } else {
        if(window.location.href.includes('refresh')) {
            location.hash = "click-first=true";
        }
        setTimeout(function(){
            if(window.location.href.includes('guide-ultimate=true')) {
            var hrf = 'document.location.href="/server/';
            var guid = '#guide-ultimate=true';
            var slash = '/servers';
            var clickfirst = '?click-first=true';
            $('#Refreshbtn').attr('href',slash + clickfirst + guid);
             $('#servers-table tr').each(function(){
                 var atr = $('tr').attr('data-key');
                 var str = atr.split('1');
                 var natr = hrf + str + guid + '"';
                 $('tr').attr('onclick',natr);
                 //$(this).setAttribute('onClick', $(this).getAttribute('onClick') + '#guide-ultimate=true');
             })
             if((!window.location.href.includes('click-first=true')) && (!window.location.href.includes('refresh'))) {
                $(".slide-button-ultimate").click();
                }
            }}, 200)
        }

    },1500);
/*          setTimeout(function(){
         if (RegExp('ultimate-guide', 'gi').test(window.location.search)) {
             $(".slide-button-ultimate").click();
             $('#servers-table tr').each(function(){
                 var hrf = 'document.location.href="/server/';
                 var guid = '#guide-ultimate=true"';
                 var atr = $('tr').attr('data-key');
                 var str = atr.split('1');
                 var natr = hrf + str + guid;
                 $('tr').attr('onclick',natr);
                 //$(this).setAttribute('onClick', $(this).getAttribute('onClick') + '#guide-ultimate=true');
             })
        }}, 2000); */

       // setTimeout(function(){
        //    if(window.location.href.includes('ultimate-guide=true')) {
        //        $(".slide-button-ultimate").click();
        //        $('#servers-table').children("tr").forEach((elem, index) => {
        //            var dkey = $('tr').attr("data-key")
       //             $(this).attr('onclick', dkey)
       //         });
        //    }
       // },2000);
    </script>

@endsection
