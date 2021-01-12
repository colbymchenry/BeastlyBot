@extends('layouts.app')

@section('title', 'Help - Articles')

@section('content')


    <div class="page-header">
        <h1 class="page-title mb-10">Getting Started
        <small>( 8 Articles )</small>
        </h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/help">Home</a></li>
        <li class="breadcrumb-item"><a href="/help/categories">Categories</a></li>
        <li class="breadcrumb-item active">Getting Started</li>
        </ol>
    </div>

    <div class="page-content">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <select data-plugin="selectpicker" data-style="btn-inverse">
                <option>Getting started</option>
                <option>Configuration</option>
                <option>Partner Tutorial</option>
                <option>About Us</option>
              </select>
            </div>
            <button type="submit" class="input-search-btn">
              <i class="icon md-search" aria-hidden="true"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search the knowledge base...">
          </div>
        </div>

        <div class="documents-wrap articles">
          <ul class="blocks blocks-100 blocks-xxl-2 blocks-lg-2 blocks-sm-100" data-plugin="matchHeight">
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
            <li>
              <div class="articles-item">
                <i class="icon md-file" aria-hidden="true"></i>
                <h4 class="title"><a href="/help/category/article">An Article Title Here.</a></h4>
                <p>And an input for the artile summary that will show here I think this long.</p>
              </div>
            </li>
          </ul>
        </div>

    </div>



@endsection