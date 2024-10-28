@extends('layout')
@section('title', 'Add A Book')
@section('content')


<div class="flex">
    <div class="bg-blue-500 p-4">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
</div>

<div class="flex flex-row-reverse">
    <div class="bg-blue-500 p-4">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
</div>
<div class="flex flex-col">
    <div class="bg-blue-500 p-4 m-4">Item 1</div>
    <div class="bg-red-500 p-4 m-4">Item 2</div>
    <div class="bg-green-500 p-4 m-4">Item 3</div>
</div>

<div class="flex flex-wrap">
    <div class="bg-blue-500 p-4 m-6 w-80">Item 1</div>
    <div class="bg-red-500 p-4 m-6">Item 2</div>
    <div class="bg-green-500 p-4 m-6">Item 3</div>
    <div class="bg-yellow-500 p-4 m-6">Item 4</div>
    <div class="bg-purple-500 p-4 m-6">Item 5</div>
    <div class="bg-blue-500 p-4 m-6">Item 1</div>
    <div class="bg-red-500 p-4 m-6">Item 2</div>
    <div class="bg-green-500 p-4 m-6">Item 3</div>
    <div class="bg-yellow-500 p-4 m-6">Item 4</div>
    <div class="bg-purple-500 p-4 m-6">Item 5</div>
</div>

<div class="flex justify-between">
    <div class="bg-blue-500 p-4">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
</div>

<div class="flex items-center">
    <div class="bg-blue-500 p-4 w-1/2">Item 1</div>
    <div class="bg-red-500 p-4 w-1/2">Item 2</div>
    <div class="bg-green-500 p-4 w-1/2">Item 3</div>
    <div class="bg-blue-500 p-4 w-1/2">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
    <div class="bg-blue-500 p-4">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
</div>

<div class="flex flex-wrap content-center">
    <div class="bg-blue-500 p-4">Item 1</div>
    <div class="bg-red-500 p-4">Item 2</div>
    <div class="bg-green-500 p-4">Item 3</div>
    <div class="bg-yellow-500 p-4">Item 4</div>
    <div class="bg-purple-500 p-4">Item 5</div>
</div>


@endsection