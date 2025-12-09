@extends('layouts.app')

@section('content')
    <h2>Оставить отзыв (Create)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Имя</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Категория</label>
            <select name="category_id" class="form-control">
                <option value="">Без категории</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Теги</label>
            <select name="tags[]" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Зажмите Ctrl для выбора нескольких</small>
        </div>

        <div class="form-group">
            <label>Сообщение</label>
            <textarea class="form-control" name="message">{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить в БД</button>
    </form>
@endsection
