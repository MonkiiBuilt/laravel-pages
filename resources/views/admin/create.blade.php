<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:19 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor.laravel-administrator.layout')

@section('title', 'Pages')

@section('content')

    <h1>Create page</h1>

    {!! Form::open(['route' => 'laravel-administrator-pages-post']) !!}

    <div class="row">
        <div class="col-md-6">

            <!-- Title -->
            <div class="form-group">
                <fieldset class="{{ $errors->has('title') ? 'error' : '' }}">
                    <label for="create-page-title">Enter a title</label>
                    {!! Form::text('title', '', array('id' => 'create-page-title', 'class' => 'form-control')) !!}
                    <div class="form__error">{{ $errors->first('title') }}</div>
                </fieldset>
            </div>


            <!-- Page type -->
            <div class="form-group">
                <fieldset class="{{ $errors->has('page_type') ? 'error' : '' }}">
                    <label for="create-page-type">Select a page type</label>
                    {!! Form::select('page_type', ['' => 'Please select a page type'] + $types, null, array('id' => 'create-page-type', 'class' => 'form-control')) !!}
                    <div class="form__error">{{ $errors->first('page_type') }}</div>
                </fieldset>
            </div>


            <input name="submit" type="submit" value="Save and edit" class="btn  btn-primary">
        </div>
    </div>

    {!! Form::close() !!}

@endsection
