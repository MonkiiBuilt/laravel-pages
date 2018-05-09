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
                    <div class="panel panel-default  page-section  {{ $errors->has('sections.' . $section->id) ? "panel-danger" : "" }}">
                        <div id="page-section-{{ $section->id }}-heading" class="panel-heading  page-section__heading">
                            <div class="panel-handle" title="Drag to reorder">
                                <svg class="icon icon-bars"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bars"></use></svg>
                            </div>
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class="panel-title__link  {{ $errors->has('sections.' . $section->id) ? "" : "collapsed" }}" href="#page-section-{{ $section->id }}-content">
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
                        <div id="page-section-{{ $section->id }}-content" class="panel-collapse collapse {{ $errors->has('sections.' . $section->id) ? "in" : "" }}">
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
                        {!! Form::hidden('published', 0) !!}
                        {!! Form::checkbox('published', 1, $page->published, array('class' => 'form-checkbox')) !!}
                        Published
                    </label>
                </div>
                <div class="form__error">{{ $errors->first('published') }}</div>
            </fieldset>

            <!-- Ordering -->
            <fieldset class="{{ $errors->has('delta') ? 'error' : '' }}">
                <div class="checkbox">
                    <label>
                        {!! Form::number('delta', $page->delta, array('class' => 'form-input')) !!}
                        Ordering
                    </label>
                </div>
                <div class="form__error">{{ $errors->first('delta') }}</div>
            </fieldset>

            <br>

            <!-- Submit -->
            <input name="submit" type="submit" value="Save" class="btn  btn-primary">


            {!! Form::close() !!}
        </div>
    </div>

    @if(isset($availableSections) && !empty($availableSections))
        <hr />
        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['route' => 'laravel-administrator-page-sections-get']) !!}
                    <h4>Add a content section</h4>
                    <div class="select">
                        <label>
                            <select name="section" class="form-select">
                                <option value="">Select type</option>
                                @foreach($availableSections as $machineName => $value)
                                    <option value="{{ $machineName }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    {!! Form::hidden('pageId', $page->id) !!}
                    <input name="submit" type="submit" value="Add section" class="btn  btn-primary">
                {!! Form::close() !!}
            </div>
        </div>
    @endif

    <div id="asset-picker-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="plan-info" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Asset picker</h4>
                </div>
                <div class="modal-body">
                    <!-- This iframe's src will be updated to point at the asset picker when the modal opens -->
                    <iframe class="asset-picker-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script type="text/javascript">
        window.assetModalURL = "<?= route("laravel-asset-manager-selector") ?>";

        $(document).ready(function() {
            $(document).on('click', '.page-section-delete', function(e) {
                e.preventDefault();

                $(this).closest('.page-section').slideUp(400, function() { $(this).remove(); });
            });
        });
    </script>
@endpush
