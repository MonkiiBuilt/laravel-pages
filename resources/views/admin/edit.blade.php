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
    <h1>Edit page <em>'{{ $page->title }}'</em></h1>

    {!! $tabs !!}

    <div class="row">
        <div class="col-md-8">
            {!! Form::model($page, ['route' => ['laravel-administrator-pages-put', 'id' => $page->id], 'class' => 'warn-on-change']) !!}
            {!! Form::hidden('type', $page->type) !!}
            {!! Form::hidden('_method', 'PUT') !!}
            {!! Form::hidden('page_type', $page->page_type) !!}


            <!-- Title -->
            <div class="form-group">
                <fieldset class="{{ $errors->has('title') ? 'error' : '' }}">
                    <label for="edit-page-title">Title</label>
                    {!! Form::text('title', $page->title,  array('id' => 'edit-page-title', 'class' => 'form-control')) !!}
                    <div class="form__error">{{ $errors->first('title') }}</div>
                </fieldset>
            </div>

            <hr>

            <!-- Sections -->
            <label>Sections</label>
            <div class="page-sections  page-sections--sortable">
                @foreach($page->sections as $section)
                    @php
                        // When we have the ability to know if a page section has errors in it this logic should be removed / refactored
                        $sectionHasErrors = false;

                        if($section->id == 1) {
                            $sectionHasErrors = true;
                        }
                    @endphp
                    <div class="panel panel-default  page-section  {{ $sectionHasErrors ? "panel-danger" : "" }}">
                        <div id="page-section-{{ $section->id }}-heading" class="panel-heading  page-section__heading">
                            <div class="panel-handle" title="Drag to reorder">
                                <svg class="icon icon-bars"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bars"></use></svg>
                            </div>
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="panel-title__link  {{ $sectionHasErrors ? "" : "collapsed" }}" href="#page-section-{{ $section->id }}-content">
                                    <svg class="icon icon-caret-up"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-caret-up"></use></svg>
                                    {{ $section->label }}
                                </a>
                            </h4>
                            <div class="panel-options-container  btn-group">
                                <a href="/" class="dropdown-toggle" data-toggle="dropdown" title="Options">
                                    <svg class="icon icon-ellipsis-h"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-ellipsis-h"></use></svg>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-right">
                                    <li><a href="/" class="page-section-delete">Delete</a></li>
                                    <!-- We might want to list other options here eventually, e.g. duplicate, hide etc. -->
                                </ul>
                            </div>
                        </div>
                        <div id="page-section-{{ $section->id }}-content" class="panel-collapse collapse {{ $sectionHasErrors ? "in" : "" }}">
                            <div class="panel-body  page-section__content">
                                {!! $section->getDecorator()->renderForm() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr>

            <label>Settings</label>
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
                {!! Form::select('promoted_delta', [0,1,2], $page->promoted_delta, array('class' => 'form-select')) !!}
                
                Order of promoted page

                <div class="form__error">{{ $errors->first('promoted_delta') }}</div>
            </fieldset>

            <br>

            <!-- Submit -->
            <input name="submit" type="submit" value="Save" class="btn  btn-primary">


            {!! Form::close() !!}
        </div>
    </div>

    <br>
@endsection


@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.page-section-delete', function(e) {
                e.preventDefault();

                $(this).closest('.page-section').slideUp(400, function() { $(this).remove(); });
            });
        });
    </script>
@endpush
