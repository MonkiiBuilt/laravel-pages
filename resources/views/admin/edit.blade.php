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
                    @include('pages::admin.partials.form_section', array('section' => $section, 'errors' => $errors))
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
                {!! Form::open(['id' => 'page-section-add', 'route' => 'laravel-administrator-page-sections-get']) !!}
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

            $(document).on('submit', '#page-section-add', function(e) {
                e.preventDefault();

                var data = $(this).serialize();

                $.post($(this).attr("action"), data)
                .done(function(data) {
                    $(".page-sections--sortable").append(data).sortable("refresh");

                    // Add var to form action to stay on this page after submit and save form.
                    //  We have to remove Submit button before we can submit form with js
                    var pageForm = $(".page-sections--sortable").closest("form");
                    $(pageForm).find("input[type='submit']").remove();
                    $(pageForm).attr("action", $(pageForm).attr("action") + "?stay=1").submit();
                });
            });
        });
    </script>
@endpush
