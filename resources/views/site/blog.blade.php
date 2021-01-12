@extends('layouts.site')

@section('title', 'Blog')
<meta name="description" content="Discord new stuff, marketing tricks and other cool stuff for Discord.">
<meta name="keywords" content="BeastlyBot, Beastly Bot, Discord, Subscription, Marketing, Tricks, Money">
<meta name="author" content="BeastlyBot">
@section('content')
    <!--page-title starts-->
    <div class="page-title-area bg-grey-2">
        <div class="container">
            <div class="row height-300 pt-70 align-items-center">
                <div class="col-lg-12">
                    <div class="page-title section-title text-center">
                        <h1><span class="text-white">Blog</span></h1>
                        <div class="site-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page-title ends-->

    <!--case-studies start-->
    <div class="care-sudies-area pt-93 pt-sm-75 pb-70 pb-sm-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gallery-nav">
                        <ul class="list-none">
                            <li data-filter="*" class="active">All</li>
                            <li data-filter=".new">New Stuff</li>
                            <li data-filter=".marketing">Marketing</li>
                            <li data-filter=".other">Cool</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row gallery-items mt-25">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-sm-6 marketing">
                        <div class="blog-single style-2 mb-30 wow fadeIn" data-wow-delay=".3s">
                            <div class="blog-thumb">
                                <a href="/blog/post/{{ $blog->url_title }}"><img src="{!! $blog->getThumbnail() !!} "
                                                                                 alt=""/></a>
                            </div>
                            <div class="blog-desc">
                                @if(!empty($blog->tags))
                                    <ul class="blog-category">
                                        <li>
                                            <a href="/blog/post/{{ $blog->url_title }}">{{ ucwords(str_replace(',', ' ', $blog->tags)) }}</a>
                                        </li>
                                    </ul>
                                @endif
                                <h3><a href="/blog/post/{{ $blog->url_title }}">{{ $blog->title }}</a></h3>
                            </div>
                            <a href="/blog/post/{{ $blog->url_title }}" class="enter-arrow"><i
                                    class="ti-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--case-studies end-->



    <!--blog-area start-->
    <!-- <div class="blog-area pt-100 pt-sm-80 pb-100 pb-sm-80">
         <div class="container">
             <div class="row">
                 <div class="col-lg-4">
                     <div class="blog-sidebar">

                         <div class="sidebar-search">
                             <input type="text" placeholder="Search" />
                             <button><i class="icon_search"></i></button>
                         </div>

                         <div class="sidebar-category mt-65 mt-sm-50">
                             <h4 class="sidebar-title"><span>Categories</span></h4>
                             <ul class="list-none">
                                 <li><a href="#">New Stuff</a></li>
                                 <li><a href="#">Media Content</a></li>
                                 <li><a href="#">Digital Marketing</a></li>
                                 <li><a href="#">Specials</a></li>
                             </ul>
                         </div>

                         <div class="popular-posts mt-55 mt-sm-40">
                             <h4 class="sidebar-title"><span>Recent Posts</span></h4>
                             <ul class="list-none">
                                 <li class="d-table">
                                     <div class="popular-thumb table-cell">
                                         <a href="#"><img src="site/assets/images/2.jpg" alt="" /></a>
                                     </div>
                                     <div class="popular-desc table-cell">
                                         <h4><a href="#">What does best for promotions</a></h4>
                                         <small><i class="fa fa-clock-o"></i> 18th Jan, 2019</small>
                                     </div>
                                 </li>
                                 <li class="d-table">
                                     <div class="popular-thumb table-cell">
                                         <a href="#"><img src="site/assets/images/1.png" alt="" /></a>
                                     </div>
                                     <div class="popular-desc table-cell">
                                         <h4><a href="#">Perks Tip: Something new here</a></h4>
                                         <small>15 November 2019</small>
                                     </div>
                                 </li>
                                 <li class="d-table">
                                     <div class="popular-thumb table-cell">
                                         <a href="#"><img src="site/assets/images/2.png" alt="" /></a>
                                     </div>
                                     <div class="popular-desc table-cell">
                                         <h4><a href="#">Top 3 best places to advertise servers</a></h4>
                                         <small>15 November 2019</small>
                                     </div>
                                 </li>
                                 <li class="d-table">
                                     <div class="popular-thumb table-cell">
                                         <a href="#"><img src="site/assets/images/3.png" alt="" /></a>
                                     </div>
                                     <div class="popular-desc table-cell">
                                         <h4><a href="#">Some cool stats that happened for us</a></h4>
                                         <small>15 November 2019</small>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                         <div class="tags-list mt-60 mt-sm-40">
                             <h4 class="sidebar-title"><span>Search By Tags</span></h4>
                             <div>
                                 <a href="#">Releases</a>
                                 <a href="#">Email Marketing</a>
                                 <a href="#">Digital</a>
                                 <a href="#">Content</a>
                                 <a href="#">Social Media</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-8">
                     <div class="blog-single blog-wide mt-sm-50 wow fadeIn" data-wow-delay=".3s">
                         <div class="blog-thumb">
                             <a href="/blog/post"><img src="site/assets/images/3.png" alt="" /></a>
                         </div>
                         <div class="blog-desc mt-30">
                             <ul class="blog-category">
                                 <li><a href="/blog?category=new+stuff">New Stuff</a></li>
                             </ul>
                             <h3><a href="/blog/post">Launching is nothing new for us</a></h3>
                             <p>We've launched and it seems like we've already launched. Having already planned and acquired partners our launch is in full swing right out of the box. Exciting stuff to co...</p>
                             <ul class="blog-date-time">
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-clock-o"></i>
                                         10TH OCT, 2019
                                     </a>
                                 </li>
                                 <li>
                                     by
                                     <a href="#">
                                         Team Beast
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>-->
    <!--blog-area end-->

@endsection
