@extends('errors::illustrated-layout')

@section('title', __('Maintenance Mode'))
@section('code', '423')
@section('message', __($exception->getMessage() ?: 'Maintenance Mode'))
