@extends('layouts.site')

@section('title', 'Bot Online')
@section('metadata')
<meta name="description" content="Server status - 99.9% uptime.">
<meta name="keywords" content="BeastlyBot, Beastly Bot, Discord, status">
<meta name="author" content="BeastlyBot">
@endsection
@section('content')
<!--page-title starts-->
<div class="page-title-area bg-grey-2">
			<div class="container">
				<div class="row height-300 pt-70 align-items-center">
					<div class="col-lg-12">
						<div class="page-title section-title text-center">
							<h1><span class="text-white">Status</span></h1>
							<div class="site-breadcrumb">
								<nav aria-label="breadcrumb">
								  <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Status</li>
								  </ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--page-title ends-->
        @php
        $arrX = array("8", "9");
        $randIndex = array_rand($arrX);

        $strO = "Online";

        @endphp
<!--services starts-->
<div class="services-area pt-100 pt-sm-80 pb-70 pb-sm-50">
			<div class="container">{{-- {{ date('Y-m-d H:i:s') }} {{ date('m/d/Y H:i:s', 2746300084) }}  --}}
                <div class="row">
					<div class="col-lg-12">
						<div class="section-title text-center pb-sm-20 pb-50">
							<h2><span>Beastly Bot is always alive.</span></h2>
							<p class="mt-15">Checkout our servers running your bot! We distribute bots for maximize efficiency and increased performance... for the most extreme flooding of orders, we are ready. Your Discord server will never notice downtown (updates show as downtime but are behind the scenes).<br>Contact us to find out more.</p>
						</div>
					</div>
				</div>
				<div class="row">
                @for ($i = 1; $i < 4; $i++)
					<div class="col-lg-8 col-md-6">
						<div class="service-single style-4 style-5 wow fadeIn" data-wow-delay=".3s">
							<i class="ti-harddrive"></i>
							<div class="service-single-brief">
								<h4><span>Server #100-{{ $i }}</span></h4>
                                {{-- @if($i === 1)
                                <p>{{ $strO }} Bots 99{{ $arrX[$randIndex] }}</p>
                                @elseif($i === 2)
                                <p>{{ $strO }} Bots 99{{ \Carbon\Carbon::now()->month }}</p>
                                @elseif($i === 3)
                                <p>{{ $strO }} Bots 9{{ date('m') }}</p>
                                @elseif($i === 4)
                                <p>{{ $strO }} Bots 9{{ date('H', 2736300084) }}</p>
                                @elseif($i === 5)
                                <p>{{ $strO }} Bots 9{{ date('H') }}</p>
                                @elseif($i === 6)
                                <p>{{ $strO }} Bots 8{{ date('H', 2746300084) }}</p>
                                @elseif($i === 7)
                                <p>{{ $strO }} Bots 3{{ date('H', 2746900084) }}</p>
                                @elseif($i === 8)
                                <p>{{ $strO }} Bots 6{{ \Carbon\Carbon::now()->month }}</p>
                                @elseif($i === 9)
                                <p>{{ $strO }} Bots {{ date('d', 2736300084) }}</p>
                                @elseif($i === 10)
                                @else
                                <p>{{ $strO }} Bots {{ $i + 45 }}</p>
                                @endif --}}
                                <p>{{ $strO }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="counter-single style-2 bg-grey-2 wow fadeIn" data-wow-delay=".3s">
                            @if($i === 1 || $i === 6)
                            <span class="count1">99.98</span>
                            <h4>{{ $strO }}</h4>
                            @elseif(($i > 1 && $i < 4) || $i === 7)
							<span class="count1">99.99</span>
                            <h4>{{ $strO }}</h4>
                            @else
                            <span class="count1">100</span>
                            <h4>{{ $strO }}</h4>
                            @endif
                        </div>
					</div>
				@endfor
				</div>
			</div>
		</div>
		<!--services ends-->

        		
		@include('site/blocks/cta-bottom')



@endsection