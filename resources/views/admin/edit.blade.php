<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:19 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>

@extends('laravel-administrator.layout')

@section('title', 'Pages')

@section('content')

    <h1>Edit page <em>{{ $page->title }}</em></h1>

    {!! Form::model($page, ['route' => ['laravel-administrator-pages-put', 'id' => $page->id], 'class' => 'warn-on-change']) !!}
    {!! Form::hidden('type', $page->type) !!}
    {!! Form::hidden('_method', 'PUT') !!}
    <div class="panel  panel__full">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Enter a title</h4>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('title') ? 'error' : '' }}">
                        {!! Form::text('title', $page->title) !!}
                        <div class="form__error">{{ $errors->first('title') }}</div>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>

    {!! Form::hidden('page_type', $page->page_type) !!}
    @foreach($page->sections as $section)
        {!! $section->getDecorator()->renderForm() !!}
    @endforeach

    <div class="panel__row">
        <div class="panel__full">
            <fieldset class="{{ $errors->has('published') ? 'error' : '' }}">
                {!! Form::hidden('published', 0) !!}
                <label class="form__label-check">
                    {!! Form::checkbox('published', 1, $page->published, array('class' => 'form-checkbox')) !!}
                    <span class="checkbox"></span>Published
                </label>
                <div class="form__error">{{ $errors->first('published') }}</div>
            </fieldset>
        </div>
    </div>

    <div class="panel__row">
        <div class="panel__full">
            <fieldset class="{{ $errors->has('promoted') ? 'error' : '' }}">
                {!! Form::hidden('promoted', 0) !!}
                <label class="form__label-check">
                    {!! Form::checkbox('promoted', 1, $page->promoted, array('class' => 'form-checkbox')) !!}
                    <span class="checkbox"></span>Promote to home page
                </label>
                <div class="form__error">{{ $errors->first('promoted') }}</div>
            </fieldset>
        </div>
    </div>

    {!! Form::submit('Save', ['name' => 'submit']) !!}

    {!! Form::close() !!}

@endsection
