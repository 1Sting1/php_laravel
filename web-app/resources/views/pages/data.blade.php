@extends('layouts.app')

@section('content')
    <h2>Все полученные данные</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Сообщение</th>
        </tr>
        </thead>
        <tbody>
        @foreach($formData as $data)
            <tr>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>{{ $data['message'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
