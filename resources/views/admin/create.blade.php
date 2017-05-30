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

    <h1>Create page</h1>

    {!! Form::open(['route' => 'laravel-administrator-pages-post']) !!}
    <div class="panel  panel__full">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Enter a title</h4>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('title') ? 'error' : '' }}">
                        {!! Form::text('title') !!}
                        <div class="form__error">{{ $errors->first('title') }}</div>
                    </fieldset>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <h4>Select a page type</h4>
                </div>

                <div class="panel__full">
                    <fieldset class="{{ $errors->has('page_type') ? 'error' : '' }}">
                        {!! Form::select('page_type', ['' => 'Please select a page type'] + $types) !!}
                        <div class="form__error">{{ $errors->first('page_type') }}</div>
                    </fieldset>
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit('Save and edit', ['name' => 'submit']) !!}

    {!! Form::close() !!}

@endsection
