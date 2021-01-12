@extends('layouts.site')

@section('title', 'About')
<meta name="description" content="Our story and about BeastlyBot.">
<meta name="keywords" content="BeastlyBot, Beastly Bot, Discord, Subscription, About">
<meta name="author" content="BeastlyBot">
@section('content')
<!--page-title starts-->
<div class="page-title-area bg-grey-2">
			<div class="container">
				<div class="row height-300 pt-70 align-items-center">
					<div class="col-lg-12">
						<div class="page-title section-title text-center">
							<h1><span class="text-white">About Us</span></h1>
							<div class="site-breadcrumb">
								<nav aria-label="breadcrumb">
								  <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">About</li>
								  </ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--page-title ends-->
		
	
		<!--about starts-->
		<div class="about-area pt-95 pt-sm-77">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="section-title mb-40 wow fadeIn" data-wow-delay=".3s">
							<h2><span>Our Story & Bot</span></h2>
							<p class="mt-35">Discord has been populated with amazing servers that offer exclusive perks, chats and more to members. 
								Tired of taking payments manually the Discord Beast was born. A superiorly coded bot that manages subscriptions for Discord roles.
								Now you can create a shop and start taking payments with ease.
							</p>
						</div>
					</div>
					<div class="col-lg-6">
						<ul class="list-none list-sign wow fadeIn" data-wow-delay=".4s">
							<!--<li>Endorsed by </li>-->
							<li>Used by trading, gaming and private groups</li>
							<li>Much More than an Bot</li>
							<li>Service Minded - Results Driven</li>
							<li>A Responsible, Happy Company</li>
							<li>Our Talented & Experienced Developers</li>
						</ul>
					</div>
				</div>
				<!--<div class="row mt-65 mt-sm-75">
					<div class="col-lg-3 col-sm-6">
						<div class="counter-single style-2 bg-d4f4f4 wow fadeInUp" data-wow-delay=".3s">
							<i class="ti-heart-broken"></i>
							<span class="count1">920</span>
							<h4>Partners</h4>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="counter-single style-2 bg-fbe7ea wow fadeInUp" data-wow-delay=".4s">
							<i class="ti-check-box"></i>
							<span class="count3">570</span>
							<h4>Subscribers</h4>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="counter-single style-2 bg-e3f8d8 wow fadeInUp" data-wow-delay=".5s">
							<i class="ti-bar-chart"></i>
							<span class="count2">8630</span>
							<h4>Payments</h4>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="counter-single style-2 bg-f5efd8 wow fadeInUp" data-wow-delay=".6s">
							<i class="ti-crown"></i>
							<span class="count4">40</span>
							<span>+</span>
							<h4>Ranks</h4>
						</div>
					</div>
				</div>-->
			</div>
		</div>
		<!--about ends-->

		@include('site/blocks/steps')

		{{--<!--testimonial start-->
		<div class="testimonial-area pt-95 pt-sm-77">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-title text-center">
							<h2><span>What Partners Say?</span></h2>
						</div>
					</div>
				</div>
				<div class="row mt-30">
					<div class="col-xl-12">
						<div class="row testimonial-carousel">
							<div class="col-lg-6">
								<div class="testimonial-single style-3">
									<div class="testimonial-info">
										<div class="testimonial-thumb">
											<img src="https://cdn.discordapp.com/avatars/301838193018273793/90ae4012595efe8c05b66649d52f4859.png?size=2048" alt="" />
										</div>
										<div class="testimonial-name">
											<h5>Robert</h5>
											<span>Robs Server</span>
										</div>
									</div>
									<div class="testimonial-desc">
										<p>"Its pretty nice having the bot do all the work for me, Discord Beast is truly beastly.”</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="testimonial-single style-3">
									<div class="testimonial-info">
										<div class="testimonial-thumb">
											<img src="https://cdn.discordapp.com/avatars/301838193018273793/90ae4012595efe8c05b66649d52f4859.png?size=2048" alt="" />
										</div>
										<div class="testimonial-name">
											<h5>Robert</h5>
											<span>Robs Server</span>
										</div>
									</div>
									<div class="testimonial-desc">
										<p>"Its pretty nice having the bot do all the work for me, Discord Beast is truly beastly.”</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="testimonial-single style-3">
									<div class="testimonial-info">
										<div class="testimonial-thumb">
											<img src="https://cdn.discordapp.com/avatars/301838193018273793/90ae4012595efe8c05b66649d52f4859.png?size=2048" alt="" />
										</div>
										<div class="testimonial-name">
											<h5>Robert</h5>
											<span>Robs Server</span>
										</div>
									</div>
									<div class="testimonial-desc">
										<p>"Its pretty nice having the bot do all the work for me, Discord Beast is truly beastly.”</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--testimonial ends-->--}}

				
		<!--call-to-action start-->
		<div class="cta-area pt-27 mt-sm-75">
			<div class="container">
				<div class="row height-470 align-items-center">
					<div class="col-lg-6 col-md-6 text-center">
						<div class="wow rollIn" data-wow-delay=".3s">
							<img src="site/assets/images/2.png" alt="" />
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="section-title mt-sm-40">
							<div class="wow fadeInUp" data-wow-delay=".3s">
								<h2><span>We’re Hiring!</span></h2>
							</div>
							<div class="wow fadeInUp" data-wow-delay=".4s">
								<p class="mt-20">We are always looking to hire the right talent to <br/> help us grow</p>
							</div>
							<div class="wow fadeInUp" data-wow-delay=".5s">
								<a href="https://discord.beastlybot.com/dashboard" class="btn-common btn-pink radius-50 mt-35">Apply Now</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--call-to-action end-->

        		
		@include('site/blocks/cta-bottom')



@endsection