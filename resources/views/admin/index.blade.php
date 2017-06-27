<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:18 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor/laravel-administrator.layout')

@section('title', 'Pages')

@section('content')

    <h1>Manage pages</h1>
    <div class="panel  panel__half">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full  create  solo-button">
                    <a href="{{ route('laravel-administrator-pages-create') }}" class="btn  btn--primary">
                        <span class="plus-span">
                            <svg class="icon icon-plus-circle"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus-circle"></use></svg>
                        </span>
                        Create new page
                    </a>

                </div>
            </div>

        </div>
    </div>

    <div class="panel">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h3>Pages</h3>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th class="col-1">&nbsp;</th>
                            <th class="col-2">Title</th>
                            <th class="col-3">Type</th>
                            <th class="col-4">Slug</th>
                            <th class="col-5">&nbsp;</th>
                            <th class="col-6">&nbsp;</th>
                        </tr>
                        <tbody class=" sortable">
                        @foreach($pages as $page)
                            <tr data-id="{{ $page->id }}">
                                <td class="col-1">
                                    <svg class="icon icon-arrows-v"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrows-v"></use></svg>
                                </td>
                                <td class="col-2">{{ $page->title }}</td>
                                <td class="col-3">{{ $page->page_type }}</td>
                                <td class="col-4">{{ $page->slug }}</td>
                                <td class="col-5">
                                    <a href="{{ route('laravel-administrator-pages-edit', ['id' => $page->id]) }}">Edit</a>
                                    {!! Form::open(['route' => ['laravel-administrator-pages-delete', $page->id],'class' => 'plain confirm']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    <button type="submit">Delete</button>
                                    {!! Form::close() !!}
                                </td>
                                <td class="col-5">
                                    <a href="{{ route('laravel-administrator-pages-meta', ['pageId' => $page->id]) }}">Meta tags</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- This contains the content for Colorbox modal inline calls -->
    <div class='colorbox-inline'>
        <div id='confirm_content'>
            <h3>Are you sure you want to remove this page?</h3>
            <a class="btn  btn--primary  confirm_link">Yes</a>
            <a class="btn  btn--tertiary  confirm_link">No</a>
        </div>
    </div>

@endsection
