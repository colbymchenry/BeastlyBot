@foreach($invoices as $invoice)

@php
$invoice_data = $invoice['lines']['data'][0]['plan']['id'];
$role_id = null;
$guild_id = null;
if(strpos($invoice_data, 'discord_') !== false) {
    $data_array = explode('_', $invoice_data);
    $guild_id = $data_array[1];
    $role_id = $data_array[2];
}
@endphp

<a class="list-group-item flex-column align-items-start" href="javascript:void(0)"
    data-url="/slide-invoice?id={{ $invoice['id'] }}&user_id={{ auth()->user()->id }}&role_id={{ $role_id }}&guild_id={{ $guild_id }}" data-toggle="slidePanel">
    <span class="badge badge-pill text-capitalize @if($invoice['status'] === 'paid')badge-success @else badge-secondary @endif">{{ $invoice['status'] }}</span> 
    <span class="badge badge-pill badge-primary badge-outline mr-2 hidden-sm-down">#{{ $invoice['number'] }}</span>
    <span class="badge badge-first badge-pill badge-primary mr-15"><i class="wb wb-arrow-down"></i></span>
    <div><p class="desc">{{ $invoice['lines']['data'][0]['description'] }}</p></div>
</a> 
@endforeach    