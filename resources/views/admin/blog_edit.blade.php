@extends('layouts.app')

@section('title', 'Admin - Edit Blog')

@section('content')
<div class="page-header">
        <h1 class="page-title">Edit Blog</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Admin</a></li>
          <li class="breadcrumb-item"><a href="/admin/blog">Blog</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="page-header-actions">
          <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Hide">
            <i class="icon wb-refresh" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Delete">
            <i class="icon wb-settings" aria-hidden="true"></i>
          </button>
        </div>
      </div>
<div class="page-content">
<div class="panel">
        <div class="panel-body container-fluid">
            <div class="row">
                <div class="col-12">
                <form autocomplete="off">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label" for="blogTitle">Blog Title</label>
                            <input type="text" class="form-control" id="blogTitle" name="blogTitle" 
                            placeholder="Enter Blog Title" value="This is My Cool Title Yea!" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-control-label" for="blogCategory">Blog Category</label>
                            <select class="form-control">
                                <option value="category1" selected>Category1</option>
                                <option value="category2">Category2</option>
                                <option value="category3">Category3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-control-label" for="blogPublished">Published</label>
                            <input type="date" class="form-contol" id="blogPublished" name="blogPublished" value="2019-12-30">
                        </div>                        
                        <div class="form-group col-md-12">
                            <label class="form-control-label" for="blogContent">Blog Content <code>(use "< b >", [link: https://link.com]'text', and < br ></code></label>
                            <textarea class="form-control" rows="20" id="blogContent" name="blogContent" placeholder="Blog Content" value="This is my dope text that really hopefully works and stuff good luck with this one Colbster"></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"
                            data-default-file="../../../global/photos/placeholder.png" />
                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured" checked>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"
                            data-default-file="../../../global/photos/placeholder.png" />
                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="file" id="blogGalleryOne" data-plugin="dropify" data-height="150"
                            data-default-file="../../../global/photos/placeholder.png" />
                            <input type="radio" class="to-labelauty" name="blogPostFeatureImg" data-plugin="labelauty" data-labelauty="Gallery | Featured">
                        </div> 
                        <div class="form-group col-md-12">
                            <div class="checkbox-custom checkbox-default float-right">
                            <input type="checkbox" id="blogSendEmail" name="blogSendEmail" autocomplete="off">
                            <label for="blogSendEmail">Send Email</label>
                            </div>
                        </div>                          
                        <div class="form-group col-md-12">                                        
                            <button class="btn btn-default float-right">Save Blog Post</button>
                        </div>

                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection