<?php
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Отзыв #{{ $feedback->id }}
            <a href="{{ route('feedback.index') }}" class="float-right btn btn-sm btn-secondary">Назад</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $feedback->name }} ({{ $feedback->email }})</h5>
            <h6 class="card-subtitle mb-2 text-muted">
                Категория: {{ $feedback->category->name ?? 'Не указана' }}
            </h6>
            <p class="card-text">{{ $feedback->message }}</p>
            <hr>

            <h6>Комментарии:</h6>
            @forelse($feedback->comments as $comment)
                <div class="border p-2 mb-2 bg-light">
                    {{ $comment->body }} <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
            @empty
                <p>Комментариев нет.</p>
            @endforelse

            <form action="{{ route('feedback.comment', $feedback->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="body" class="form-control" placeholder="Добавить комментарий...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
