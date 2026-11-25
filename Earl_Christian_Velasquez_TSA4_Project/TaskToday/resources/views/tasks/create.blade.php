@extends('layouts.app') @section('title','Create Task') @section('content')<h1>Create task</h1><form method="POST" action="{{ route('tasks.store') }}">@csrf @include('tasks.form') </form>@endsection
