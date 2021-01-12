<div class="tab-pane tab-large fade" id="tab-affiliates">
    <div class="page-header">
        <h1 class="page-title responsive-hide" id="affiliate_count">0 Affiliates</h1>
        <div class="page-header-actions">
            <button class="btn btn-sm btn-primary btn-outline btn-round"
                    data-url="/slide-affiliates-add/{{ $id }}" data-toggle="slidePanel">
                <i class="icon wb-plus" aria-hidden="true"></i>
                <span class="hidden-sm-down">Add Affiliate</span>
            </button>
        </div>
    </div>

    <div class="page-content-table">

        <div class="page-main text-center">

            <table id="rolesTable" class="table" data-plugin="animateList" data-animate="fade"
                   data-child="tr">
                <thead>
                <tr>
                    <th class="cell-300">User</th>
                    <th class="cell-150 responsive-hide">Aff ID</th>
                    <th class="cell-100 responsive-hide">Commission</th>
                    <th class="responsive-hide">Revenue</th>
                    <th class="cell-100 text-right pr-30">Sales</th>
                </tr>
                </thead>

                <tbody>

                @foreach(Affiliate::where('guild_id', $id)->get() as $affiliate)
                    @if($affiliate->accepted)
                        <tr id="role_settings_1">
                            <td class="bg-purple-600" data-url="slide-server-member" data-toggle="slidePanel">
                                <div class="time"><span class="badge badge-light badge-lg">{{ $affiliate->getUser()->getDiscordUsername() }}</span>
                                </div>
                            </td>
                            <td class="bg-purple-500 responsive-hide" data-url="slide-affiliates-affiliate"
                                data-toggle="slidePanel">
                                <h5 class="text-white pl-10">{{ $affiliate->id }}</h5>
                            </td>
                            <td class="bg-blue-500 responsive-hide text-center" data-url="slide-affiliates-affiliate"
                                data-toggle="slidePanel">
                                <div class="time pl-30 white" style="padding-right: 2em;">{{ $affiliate->commission }}%</div>
                            </td>
                            <td class="bg-green-600 responsive-hide text-center" data-url="slide-affiliates-affiliate"
                                data-toggle="slidePanel">
                                <div class="time text-center white">${{ number_format(3000, 2, '.', ',') }}</div>
                            </td>
                            <td class="bg-blue-grey-500 text-right"
                                data-url="slide-promotions-transactions-coupon" data-toggle="slidePanel">
                                <div class="identity text-white">34 <a href="#"
                                                                       class="btn btn-sm btn-icon btn-pure btn-default btn-inverse on-default edit-row"
                                                                       data-toggle="tooltip"
                                                                       data-original-title="View"><i
                                            class="icon wb-eye" aria-hidden="true"></i></a></div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>

            <!-- pagination -->
            <!--  <ul data-plugin="paginator" data-total="50" data-skin="pagination-gap"></ul> -->
        </div>
    </div>
    <!-- end page table content div -->

</div>
