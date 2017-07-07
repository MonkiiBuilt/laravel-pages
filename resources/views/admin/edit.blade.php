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

    <h1>Edit page <em>{{ $page->title }}</em></h1>

    <div class="row">
        <div class="col-md-6">
            {!! Form::model($page, ['route' => ['laravel-administrator-pages-put', 'id' => $page->id], 'class' => 'warn-on-change']) !!}
            {!! Form::hidden('type', $page->type) !!}
            {!! Form::hidden('_method', 'PUT') !!}
            {!! Form::hidden('page_type', $page->page_type) !!}


            <!-- Title -->
            <div class="form-group">
                <fieldset class="{{ $errors->has('title') ? 'error' : '' }}">
                    <label for="edit-page-title">Enter a title</label>
                    {!! Form::text('title', $page->title,  array('id' => 'edit-page-title', 'class' => 'form-control')) !!}
                    <div class="form__error">{{ $errors->first('title') }}</div>
                </fieldset>
            </div>


            <!-- Sections -->
            @foreach($page->sections as $section)
                <div class="page-section">
                    <div class="page-section-delete" data-id="{{ $section->id }}">Delete</div>
                    {!! $section->getDecorator()->renderForm() !!}
                </div>
                <hr>
            @endforeach


            <!-- Published -->
            <fieldset class="{{ $errors->has('published') ? 'error' : '' }}">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('published', 1, $page->published, array('class' => 'form-checkbox')) !!}
                        Published
                    </label>
                </div>
                <div class="form__error">{{ $errors->first('published') }}</div>
            </fieldset>


            <!-- Promote this page -->
            <fieldset class="{{ $errors->has('promoted') ? 'error' : '' }}">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('promoted', 1, $page->promoted, array('class' => 'form-checkbox')) !!}
                        Promote to home page
                    </label>
                </div>

                <div class="form__error">{{ $errors->first('promoted') }}</div>
            </fieldset>

            <fieldset class="{{ $errors->has('promoted_delta') ? 'error' : '' }}">
                <div class="checkbox">
                    <label>
                        {!! Form::select('promoted_delta', [0,1,2], $page->promoted_delta, array('class' => 'form-select')) !!}
                        Order of promoted page
                    </label>
                </div>

                <div class="form__error">{{ $errors->first('promoted_delta') }}</div>
            </fieldset>


            <!-- Submit -->
            <input name="submit" type="submit" value="Save" class="btn  btn-primary">


            {!! Form::close() !!}
        </div>
    </div>

    <br>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.page-section-delete').click(function(e) {

                var data = {
                    "id": this.dataset.id,
                    "_method": "DELETE",
                    "_token": $("input[name=_token]").val()
                };

                var url = "{{ route('laravel-administrator-page-sections-delete') }}";

                var context = $(this).parent();

                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: data,
                    context: context,
                    success: function(data, status) {
                        $(this).remove();
                    }
                });
            });
        });
    </script>

@endsection
