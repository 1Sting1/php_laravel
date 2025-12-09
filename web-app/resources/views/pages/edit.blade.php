<?php
@extends('layouts.app')

@section('content')
    <h2>Редактирование записи #{{ $feedback->id }}</h2>

    <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Имя</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $feedback->name) }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $feedback->email) }}">
        </div>

        <div class="form-group">
            <label>Категория</label>
            <select name="category_id" class="form-control">
                <option value="">Без категории</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $feedback->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Теги</label>
            <select name="tags[]" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $feedback->tags->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Сообщение</label>
            <textarea class="form-control" name="message">{{ old('message', $feedback->message) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Обновить</button>
    </form>
@endsection
