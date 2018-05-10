<?php
/**
 * Created by PhpStorm.
 * User: SLY
 * Date: 10/05/2018
 * Time: 2:35 PM
 */
?>

<div class="panel panel-default  page-section  {{ ($errors && $errors->has('sections.' . $section->id)) ? "panel-danger" : "" }}">
    <div id="page-section-{{ $section->id }}-heading" class="panel-heading  page-section__heading">
        <div class="panel-handle" title="Drag to reorder">
            <svg class="icon icon-bars"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-bars"></use></svg>
        </div>
        <h4 class="panel-title">
            <a data-toggle="collapse" class="panel-title__link  {{ ($errors && $errors->has('sections.' . $section->id)) ? "" : "collapsed" }}" href="#page-section-{{ $section->id }}-content">
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
    <div id="page-section-{{ $section->id }}-content" class="panel-collapse collapse {{ ($errors && $errors->has('sections.' . $section->id)) ? "in" : "" }}">
        <div class="panel-body  page-section__content">
            {!! $section->getDecorator()->renderForm() !!}
        </div>
    </div>
</div>
