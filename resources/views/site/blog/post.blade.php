@extends('layouts.site')

@section('title', 'Blog | Post-Title')

@section('content')
    <!--page-title starts-->
    <div id="hidden-div" style="visibility: hidden;display: none;" hidden>
        <textarea id="hidden-textarea" style="visibility: hidden;display: none;" hidden></textarea>
    </div>
    <div class="blog-banner-area overlay">
        <div class="container">
            <div class="row height-500 align-items-center">
                <div class="col-lg-8 offset-lg-2">
                    <div class="blog-banner">
                        @if(!empty($blog->tags))
                            <ul class="blog-category text-center z-index">
                                @foreach(explode(',', $blog->tags) as $tag)
                                    @if(!empty($tag))
                                        <li><a href="">{{ $tag }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                        <div class="blog-title text-center">
                            <h1>{{ $blog->title }}</h1>
                        </div>
                        <ul class="blog-date-time">
                            <li><a href="#"><i
                                        class="fa fa-clock-o"></i> {{ date("jS M Y",strtotime($blog->created_at)) }}</a>
                            </li>
                            <li>
                                by
                                <a href="#" id="author_id">Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page-title ends-->

    <!--blog-details-area start-->
    <div class="blog-details-area pt-92 pt-sm-77 pb-100 pb-sm-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-details br-bottom-ebebeb">
                        <div id="blogContent">
                        </div>
                    </div>
                    <div class="row pt-30">
                        <div class="col-lg-6 col-sm-6">
                            @if(!empty($blog->tags))
                                <ul class="blog-category in-blog-details">
                                    @foreach(explode(',', $blog->tags) as $tag)
                                        @if(!empty($tag))
                                            <li><a href="">{{ $tag }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>{{--
                        <div class="col-lg-6 col-sm-6">
                            <div class="social-icons style-7 pull-right">
                                <span>Share:</span>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- <div class="row mt-77">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3><span>Recommended</span></h3>
                    </div>
                </div>
            </div>
            <div class="row blog-carousel mt-35">
                <div class="col-lg-4">
                    <div class="blog-single">
                        <div class="blog-thumb">
                            <a href="#"><img src="/site/assets/images/1.png" alt=""/></a>
                        </div>
                        <div class="blog-desc mt-30">
                            <ul class="blog-category">
                                <li><a href="#">Marketing</a></li>
                            </ul>
                            <h3><a href="#">Affiliates can boost your revenue ten fold!</a></h3>
                            <ul class="blog-date-time">
                                <li><a href="#"><i class="fa fa-clock-o"></i> 18th Jan, 2020</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-single">
                        <div class="blog-thumb">
                            <a href="#"><img src="/site/assets/images/2.jpg" alt=""/></a>
                        </div>
                        <div class="blog-desc mt-30">
                            <ul class="blog-category">
                                <li><a href="#">Promotions</a></li>
                            </ul>
                            <h3><a href="#">Create demand by promotions, find out more here.</a></h3>
                            <ul class="blog-date-time">
                                <li><a href="#"><i class="fa fa-clock-o"></i> 25th Feb, 2020</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-single">
                        <div class="blog-thumb">
                            <a href="#"><img src="/site/assets/images/2.png" alt=""/></a>
                        </div>
                        <div class="blog-desc mt-30">
                            <ul class="blog-category">
                                <li><a href="#">Marketing</a></li>
                            </ul>
                            <h3><a href="#">Affiliates can boost your revenue ten fold!</a></h3>
                            <ul class="blog-date-time">
                                <li><a href="#"><i class="fa fa-clock-o"></i> 18th Jan, 2020</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-single">
                        <div class="blog-thumb">
                            <a href="#"><img src="/site/assets/images/2.jpg" alt=""/></a>
                        </div>
                        <div class="blog-desc mt-30">
                            <ul class="blog-category">
                                <li><a href="#">Marketing</a></li>
                            </ul>
                            <h3><a href="#">Affiliates can boost your revenue ten fold!</a></h3>
                            <ul class="blog-date-time">
                                <li><a href="#"><i class="fa fa-clock-o"></i> 18th Jan, 2020</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row mt-65">
                <div class="col-lg-10 offset-lg-1">
                    <div class="blog-comments">
                        <div class="section-title mb-25">
                            <h3><span>{{ sizeof($blog->getComments()) }} Comments</span></h3>
                        </div>
                        <ul class="list-none" id="comments-wrapper">
                            @foreach($blog->getComments() as $comment)
                                <li class="comment">
                                    <div class="comment-avatar">
                                        <img
                                            src="https://s3.amazonaws.com/profile_photos/740743473274829.ed1qnV5nibdkWz6ycIO6_60x60.png"
                                            alt=""/>
                                    </div>
                                    <div class="comment-desc">
                                        <small>1 Sept 2019 <span class="text-white">1 like</span></small>
                                        <h4 data-id_user="ColbyMcHenry#0000">Big Pappa</h4>
                                        <p>Test reply</p>
                                        <div class="comment-reaction comment-details">
                                            <a href="#" id="comment-like" data-id="123"><i class="fa fa-thumbs-up mr-2"></i>
                                                15</a>
                                            <a href="#" id="comment-liked" data-id="123" style="display:none"><i
                                                    class="fa fa-thumbs-up mr-2"></i> 16</a>
                                            <a class="reply-btn" href="#" data-id="123">Reply</a>
                                        </div>
                                        <form action="post_details.php" class="reply_form clearfix contact-form mt-15"
                                              id="comment_reply_form_123" data-id="123" style="display:none">
                                        <textarea class="form-control" name="reply_text" id="reply_text" cols="30"
                                                  rows="2">@ColbyMcHenry#0000 </textarea>
                                            <button class="btn btn-primary btn-xs pull-right submit-reply mt-15">Reply
                                            </button>
                                        </form>
                                    </div>

{{--                                    TODO: Comment on comment --}}
{{--                                    <ul class="list-none replies_wrapper_123">--}}
{{--                                        <li>--}}
{{--                                            <div class="comment-avatar">--}}
{{--                                                <img--}}
{{--                                                    src="https://cdn.discordapp.com/avatars/301838193018273793/90ae4012595efe8c05b66649d52f4859.png?size=2048"--}}
{{--                                                    alt=""/>--}}
{{--                                            </div>--}}
{{--                                            <div class="comment-desc">--}}
{{--                                                <small>1 Sept 2019</small>--}}
{{--                                                <h4 data-id_user="rob#8080">Rob</h4>--}}
{{--                                                <p>Dude wt looooool</p>--}}
{{--                                                <div class="comment-reaction comment-details">--}}
{{--                                                    <!-- I guess if own comment automatically like it -->--}}
{{--                                                    <a href="#" id="comment-like" data-id="124" style="display:none"><i--}}
{{--                                                            class="fa fa-thumbs-up mr-2"></i> 0</a>--}}
{{--                                                    <a href="#" id="comment-liked" data-id="124"><i--}}
{{--                                                            class="fa fa-thumbs-up mr-2"></i> 1</a>--}}
{{--                                                    <a href="#" class="reply-btn" data-id="124">Reply</a>--}}
{{--                                                </div>--}}
{{--                                                <form action="post_details.php"--}}
{{--                                                      class="reply_form clearfix contact-form mt-15"--}}
{{--                                                      id="comment_reply_form_124" data-id="124" style="display:none">--}}
{{--                                                <textarea class="form-control" name="reply_text" id="reply_text"--}}
{{--                                                          cols="30" rows="2">@rob#8080 </textarea>--}}
{{--                                                    <a class="btn btn-primary btn-xs pull-right submit-reply mt-15">Reply</a>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}

{{--                                    </ul>--}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @auth
                <div class="row mt-40">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="section-title">
                            <h3><span>Leave a Comment</span></h3>
                        </div>
                    </div>
                </div>
                <div class="contact-form mt-40">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn-common mt-25">Send A Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-40">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="section-title">
                            <h3><span><a
                                        href="{{ env('DISCORD_OAUTH_URL') }}">Login</a> to Leave a Comment</span>
                            </h3>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
    <!--blog-details-area end-->



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // When user clicks on submit comment to add comment under post
            $(document).on('click', '#submit_comment', function (e) {
                e.preventDefault();
                var comment_text = $('#comment_text').val();
                var url = $('#comment_form').attr('action');
                // Stop executing if no value is entered
                if (comment_text === "") return;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        comment_text: comment_text,
                        comment_posted: 1
                    },
                    success: function (data) {
                        var response = JSON.parse(data);
                        if (data === "error") {
                            alert('There was an error adding comment. Please try again');
                        } else {
                            $('#comments-wrapper').prepend(response.comment)
                            $('#comments_count').text(response.comments_count);
                            $('#comment_text').val('');
                        }
                    }
                });
            });
            // When user clicks on submit reply to add reply under comment
            $(document).on('click', '.reply-btn', function (e) {
                e.preventDefault();
                // Get the comment id from the reply button's data-id attribute
                var comment_id = $(this).data('id');
                // show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
                // and then its siblings which is a form element with id comment_reply_form_ + comment_id)
                $(this).parent().siblings('form#comment_reply_form_' + comment_id).slideToggle(500);
                $(document).on('click', '.submit-reply', function (e) {
                    e.preventDefault();
                    // elements
                    var reply_textarea = $(this).siblings('textarea'); // reply textarea element
                    var reply_text = $(this).siblings('textarea').val();
                    var url = $(this).parent().attr('action');
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            comment_id: comment_id,
                            reply_text: reply_text,
                            reply_posted: 1
                        },
                        success: function (data) {
                            if (data === "error") {
                                alert('There was an error adding reply. Please try again');
                            } else {
                                $('.replies_wrapper_' + comment_id).append(data);
                                reply_textarea.val('');
                            }
                        }
                    });
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '#comment-like', function (e) {
            e.preventDefault();
            var like_id = $(this).data('id');
            $(this).hide(0);
            //$(this).siblings('.comment-liked' + like_id).show(500);
            $(this).siblings('#comment-liked').fadeIn(400);
        });
        $(document).on('click', '#comment-liked', function (e) {
            e.preventDefault();
            var like_id = $(this).data('id');
            $(this).hide(0);
            //$(this).siblings('.comment-liked' + like_id).show(500);
            $(this).siblings('#comment-like').show(0);
        });
    </script>

    <script src="{{ asset('sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('sceditor/minified/formats/bbcode.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            socket.on('connect', function () {
                socket.emit('get_user_data', [socket_id, '{{ $blog->creator_id }}']);
            });
            socket.on('res_user_data_' + socket_id, function (message) {
                $('#author_id').text(message['name'] + ' #' + message['discriminator']);
            });
        });

        console.log("HELLO");
        var textarea = document.getElementById('hidden-textarea');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: '/sceditor/minified/themes/content/default.min.css',
            emoticonsRoot: '/sceditor/',
            width: '100%',
            resizeMaxWidth: 1
        });
        console.log('hello');
        // Will be <div><strong>Bold!</strong></div>
        var html = sceditor.instance(textarea).fromBBCode(`{!! $blog->body !!}`);
        $('#blogContent').append(html);
        console.log(html);

        // Will be <strong>Bold!</strong>
        // var htmlFragment = sceditor.instance(textarea).fromBBCode('[b]Bold![b]', true);

    </script>
@endsection
