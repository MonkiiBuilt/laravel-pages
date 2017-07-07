<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:18 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor.laravel-administrator.layout')

@section('title', 'Pages')

@section('content')

    <h1>Manage pages</h1>

    <p>
        <a href="{{ route('laravel-administrator-pages-create') }}" class="btn  btn-primary">
            <svg class="icon icon-plus-circle"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus-circle"></use></svg>
            Create new page
        </a>
    </p>

    <table class="table table-striped table-hover">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Slug</th>
            <th>&nbsp;</th>
        </tr>
        <tbody>
            @foreach($pages as $page)
                <tr data-id="{{ $page->id }}">
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->page_type }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>
                        <a href="{{ route('laravel-administrator-pages-edit', ['id' => $page->id]) }}" class="icon-btn" title="Edit page">
                            <svg class="icon icon-pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-pencil"></use></svg>
                        </a>

                        <a href="{{ route('laravel-administrator-pages-meta', ['pageId' => $page->id]) }}" class="icon-btn" title="Edit meta tags">
                            <svg class="icon icon-tags"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-tags"></use></svg>
                        </a>

                        <a href="#delete-page-{{ $page->id }}" class="icon-btn" data-toggle="modal" title="Delete page">
                            <svg class="icon icon-bin"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bin"></use></svg>
                        </a>

                        <div class="modal fade" id="delete-page-{{ $page->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Delete page</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the page <strong>'{{ $page->title }}'</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        {!! Form::open(['route' => ['laravel-administrator-pages-delete', $page->id],'class' => 'inline confirm']) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            <button type="submit" class="btn  btn-primary">Delete</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
