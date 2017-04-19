<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:18 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('laravel-administrator.layout')

@section('title', 'Pages')

@section('content')

    <h1>Manage pages</h1>
    <div class="panel  panel__half">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full  create  solo-button">
                    <a href="{{ route('laravel-administrator-pages-create') }}" class="btn  btn--primary">
                        <span class="plus-span">
                            <svg class="icon icon-plus-circle"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus-circle"></use></svg>
                        </span>
                        Create new page
                    </a>

                </div>
            </div>

        </div>
    </div>


@endsection
