@extends('layouts.app')

@section('content')
    <h2>Список из базы данных</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Категория</th>
            <th>Теги</th>
            <th>Сообщение</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($feedbacks as $fb)
            <tr>
                <td>{{ $fb->id }}</td>
                <td>{{ $fb->name }} <br> <small>{{ $fb->email }}</small></td>
                <td>
                    {{ $fb->category ? $fb->category->name : 'Нет' }}
                </td>
                <td>
                    @foreach($fb->tags as $tag)
                        <span class="badge badge-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>{{ Str::limit($fb->message, 50) }}</td>
                <td>
                    <a href="{{ route('feedback.show', $fb->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('feedback.edit', $fb->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('feedback.destroy', $fb->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Del</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
