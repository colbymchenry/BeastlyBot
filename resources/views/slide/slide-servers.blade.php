
<header class="slidePanel-header bg-blue-500">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-icon btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true" id="back-btn"></button>
    </div>
    <h1>Shops</h1>
</header>

    <div class="page-header my-10">
        {{--@if(auth()->user()->StripeConnect->express_id != null)--}}
        <div class="page-header-actions add-pulse">
            <a class="btn btn-primary btn-round"
               href="{{ 'https://discordapp.com/oauth2/authorize?client_id=' . env('DISCORD_CLIENT_ID') . '&scope=bot&permissions=' . env('DISCORD_BOT_PERMISSIONS') }}" target="_blank" id="Addbtn" onclick="changeBtn()">
                <i class="icon wb-plus" aria-hidden="true"></i>
                Add Bot
            </a>
            <a href="javascript:void(0);" class="btn btn-primary btn-outline btn-round d-none pulse"
            id="Refreshbtn" data-toggle="slidePanel" data-url="/servers?slide=true">
                <i class="icon wb-refresh" aria-hidden="true"></i>
                Refresh
            </a>
        </div>
       {{-- @else
        <div class="page-header-actions add-pulse">
            <a class="btn btn-primary btn-round"
               href="{{ 'https://connect.stripe.com/express/oauth/authorize?redirect_uri=' . env('APP_URL') . '&client_id=' . env('STRIPE_CLIENT_ID')  }}">
                Connect Stripe
                <i class="icon-stripe ml-2" aria-hidden="true"></i>
            </a>
        </div>
        @endif--}}
        <script type="text/javascript">
                function changeBtn() {
                  setTimeout(function(){
                    $('#Refreshbtn').removeClass('d-none');
                    $('#Addbtn').addClass('d-none');
                  },2000);
                }
              
            </script>
    </div>

    <div class="page-content-table app-beast">
        <div class="page-main">
            <table class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
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
                            <div class="time" id="subCount{{ $guild['id'] }}">{{ \App\Subscription::where('store_id', \App\DiscordStore::where('guild_id', $guild['id'])->first()->id)->where('status', '<=', 3)->count() }} Subscribers</div>
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
 
    <script type="text/javascript">
    setTimeout(function(){
    if(window.location.href.includes('click-first=true')) {
        $('#servers-table tr').each(function(i, el) {
            if (i === 0) {
            $(this).addClass('bg-grey-1');
            setTimeout(function(){
                $("tr").click();
            },100)
            }
        })
        }
    },500);
    </script>

    <script type="text/javascript">
    setTimeout(function(){
    if( $('#servers-table tr').length === 0 ) {
        $(".add-pulse").addClass('pulse');
           /* var hrf = 'document.location.href="/server/';
            var guid = '#guide-ultimate=true';
            var slash = '/servers';
            var clickfirst = '?click-first=true';
            $('#RBbtn').attr('href',slash + clickfirst + guid);*/
    } else {
        setTimeout(function(){
            if(window.location.href.includes('guide-ultimate=true')) {
            var hrf = 'document.location.href="/server/';
            var guid = '#guide-ultimate=true';
            var slash = '/servers';
            var clickfirst = '?click-first=true';
            $('#RBbtn').attr('href',slash + clickfirst + guid);
             $('#servers-table tr').each(function(){
                 var atr = $('tr').attr('data-key');
                 var str = atr.split('1');
                 var natr = hrf + str + guid + '"';
                 $('tr').attr('onclick',natr);

             })
             if(!window.location.href.includes('click-first=true')) {
                $(".slide-button-ultimate").click();
                }
            }}, 200)
        }

    },1500);

    </script>

@include('partials/clear_script')
