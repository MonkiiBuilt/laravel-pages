<?php
/**
 * @author Jonathon Wallen
 * @date 20/6/17
 * @time 1:24 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor/laravel-administrator.layout')

@section('title', 'Meta tags')

@section('content')

    <h1>Create meta tag for page <em>{{ $page->title }}</em></h1>

    {!! Form::open(['route' => ['laravel-administrator-pages-meta-store', $page->id]]) !!}

    <div class="panel  panel__full">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Name</h4>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('name') ? 'error' : '' }}">
                        {!! Form::text('name') !!}
                        <div class="form__error">{{ $errors->first('name') }}</div>
                    </fieldset>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Content</h4>
                </div>

                <div class="panel__full">
                    <fieldset class="{{ $errors->has('content') ? 'error' : '' }}">
                        {!! Form::textarea('content') !!}
                        <div class="form__error">{{ $errors->first('content') }}</div>
                    </fieldset>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    {!! Form::hidden('pageId', $page->id) !!}
                    {!! Form::submit('Save', ['name' => 'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

    <div class="panel">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h3>Meta tags for <em>{{ $page->title }}</em></h3>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th class="col-1">&nbsp;</th>
                            <th class="col-2">Name</th>
                            <th class="col-3">Content</th>
                            <th class="col-4">&nbsp;</th>
                        </tr>
                        <tbody class=" sortable">
                        @foreach($page->metaTags as $meta)
                            <tr data-id="{{ $meta->id }}">
                                <td class="col-1">
                                    <svg class="icon icon-arrows-v"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-arrows-v"></use></svg>
                                </td>
                                <td class="col-2">{{ $meta->name }}</td>
                                <td class="col-3">{{ $meta->content }}</td>
                                <td class="col-4">
                                    <a href="{{ route('laravel-administrator-pages-meta-edit', ['id' => $meta->id]) }}">Edit</a>
                                    {!! Form::open(['route' => ['laravel-administrator-pages-meta-delete', $meta->id],'class' => 'plain confirm']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    <button type="submit">Delete</button>
                                    {!! Form::close() !!}
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
