{{-- @if(App\User::where('stripe_express_id', '=' ,$owner['id'])->exists())
                        <tr id="admin_table_" data-url="/admin/slide/user-view" data-toggle="slidePanel">
                            <td class="cell-30 pl-15 text-right">
                                <h6>1</h6>
                            </td>
                            <td class="pl-15">{{ $owner }}
                                <div class="content text-left">
                                    <h4>{{ App\User::where('stripe_express_id', '=' ,$owner['id'])->value('id') }}: {{ (App\User::where('stripe_express_id', '=' ,$owner['id'])->get()[0])->getDiscordUsername() }}</h4>
                                </div>
                            </td>
                            <td class="cell-150 pr-20 text-right">
                                <div class="time">{{ $owner->email }}</div>
                                <div class="identity">{{ App\Shop::where('owner_id', '=', (App\User::where('stripe_express_id', '=' ,$owner['id'])->value('id')))->count()}} Live</div>
                            </td>
                        </tr>
                        @endif --}}
