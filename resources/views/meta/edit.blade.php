<?php
/**
 * @author Jonathon Wallen
 * @date 20/6/17
 * @time 2:24 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>

@extends('laravel-administrator.layout')

@section('title', 'Meta tags')

@section('content')

    <h1>Edit meta tag <em>{{ $meta->name }}</em> for page <em>{{ $meta->page->title }}</em></h1>

    {!! $tabs !!}

    {!! Form::model($meta, ['route' => ['laravel-administrator-pages-meta-update', $meta->id]]) !!}

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

        </div>
    </div>

    {!! Form::hidden('_method', 'PUT') !!}
    {!! Form::submit('Save', ['name' => 'submit']) !!}
    {!! Form::close() !!}

@endsection
