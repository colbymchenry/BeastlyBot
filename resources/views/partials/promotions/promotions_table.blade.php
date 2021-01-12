<table id="rolesTable" class="table" data-plugin="animateList" data-animate="fade" data-child="tr">
    <thead>
    <tr>
        <th class="cell-200 hidden-sm-down text-left">Coupon</th>
        <th class="cell-120 hidden-md-up text-left">Coupon</th>
        <th class="text-left">Terms</th>
        <th class="cell-120 hidden-sm-down text-left"></th>
        <th class="cell-60 hidden-md-up text-left"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $promotion)
        <tr id="promotion_{{ $promotion['id'] }}">
            <td class="bg-indigo-600 text-white pl-10 pl-lg-20"> {{ substr_replace(strval($promotion['id']), '', 0, strlen(strval(auth()->user()->id))) }}</td>
            <td>
                @if($promotion['percent_off'] > 0)
                    <div class="time pl-15">{{ $promotion['percent_off'] }}% off @if($promotion['duration'] === 'forever') forever @elseif($promotion['duration'] === 'once') once @else for the first {{ $promotion['duration_in_months'] }} months @endif</div>
                @else
                    <div class="time pl-15">${{ $promotion['amount_off']/100 }} off @if($promotion['duration'] === 'forever') forever @elseif($promotion['duration'] === 'once') once @else for the first {{ $promotion['duration_in_months'] }} months @endif</div>
                @endif
            </td>
            <td class="text-center">
                <button type="button" class="site-action-toggle btn btn-dark"
                        onclick="deleteCoupon('{{ $promotion['id'] }}')">
                    <i class="front-icon icon-cancel animation-scale-up" aria-hidden="true"></i><span class="ml-2 hidden-sm-down">Delete</span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
