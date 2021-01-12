@extends('layouts.app')

@section('title', 'Admin - Create Blog')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Create Blog</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item"><a href="/admin/blog">Blog</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ol>
    </div>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form autocomplete="off" action="/admin/post_blog" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for="blogTitle">Blog Title</label>
                                    <input type="text" class="form-control" id="blogTitle" name="blogTitle"
                                           placeholder="Enter Blog Title" autocomplete="off">
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-control-label" for="tags">Tags</label>
                                    <input type="text" class="form-control" id="tags" name="tags"
                                           placeholder="Separate tags by commas" autocomplete="off">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-control-label" for="blogContent">Blog Content <code>(remember to login before posting)</code></label>
                                    <textarea class="form-control" rows="20" id="blogContent" name="blogContent"
                                              placeholder="Blog Content"></textarea>
                                </div>
                                {{--                        <div class="form-group col-md-4">--}}
                                {{--                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"--}}
                                {{--                            data-default-file="../../../global/photos/placeholder.png" />--}}
                                {{--                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured">--}}
                                {{--                        </div>--}}
                                {{--                        <div class="form-group col-md-4">--}}
                                {{--                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"--}}
                                {{--                            data-default-file="../../../global/photos/placeholder.png" />--}}
                                {{--                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured">--}}
                                {{--                        </div>--}}
                                {{--                        <div class="form-group col-md-4">--}}
                                {{--                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"--}}
                                {{--                            data-default-file="../../../global/photos/placeholder.png" />--}}
                                {{--                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured">--}}
                                {{--                        </div>--}}
                                {{--                        <div class="form-group col-md-12">--}}
                                {{--                            <div class="checkbox-custom checkbox-default float-right">--}}
                                {{--                            <input type="checkbox" id="blogSendEmail" name="blogSendEmail" autocomplete="off">--}}
                                {{--                            <label for="blogSendEmail">Send Email</label>--}}
                                {{--                            </div>--}}
                                {{--                        </div>--}}
                                <div class="form-group col-md-12">
                                    <button class="btn btn-default float-right" href="/admin/blog/blog_edit">Create Blog
                                        Post
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>

    <script src="{{ asset('sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('sceditor/minified/formats/bbcode.js') }}"></script>
    <script>
        // Replace the textarea #example with SCEditor
        var textarea = document.getElementById('blogContent');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: '/sceditor/minified/themes/content/default.min.css',
            emoticonsRoot: '/sceditor/',
            width: '100%',
            resizeMaxWidth: 1
        });
    </script>
@endsection
