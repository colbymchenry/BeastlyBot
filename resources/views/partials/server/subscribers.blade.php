<div class="tab-pane tab-large fade" id="tab-subscribers">

    <div>
        <table class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
            <tbody id="subscribers_table">
            @if(\App\DiscordStore::where('guild_id', $id)->exists())
                    @foreach($users_roles as $user_id => $roles)
                    @php
                        $discord_id = \App\DiscordOAuth::where('user_id', $user_id)->first()->discord_id;
                        $discord_helper = new \App\DiscordHelper(\App\User::where('id', $user_id)->first());
                    @endphp
                    <tr id="sub_{{ $discord_id }}" data-url="/slide-server-member?user_id={{ $user_id }}&store_id={{ $shop->id }}" data-toggle="slidePanel">
                        <td class="cell-30 responsive-hide">
                            <a class="avatar avatar-lg" href="javascript:void(0)">
                                <img src="{{ $discord_helper->getAvatar() }}" alt="...">
                            </a>
                        </td>
                        <td class="cell-60 responsive-hide">
                        </td>
                        <td class="cell-160">
                            <div class="content">
                                <div class="title">{{ $discord_helper->getUsername() }}</div>
                            </div>
                        </td>
                        <td class="text-right">
                        @foreach($roles as $role_id)
                        @php
                        $role = $discord_helper->getRole($id, $role_id);
                        @endphp
                        <span class="badge m-5" style="color: white;background-color: #{{ dechex($role->color) }};">{{ $role->name }}</span>
                        @endforeach
                        </td>
                        <td class="cell-60 responsive-hide">
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- pagination -->

    </div>
</div><!-- end tab -->
