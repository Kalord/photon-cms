@extends('layouts.admin')

@section('title', 'Публикации')

@section('content')
<table class="table admin-post-list">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Заголовок</th>
      <th scope="col">Категория</th>
      <th scope="col">Автор</th>
      <th scope="col">Аватар</th>
      <th scope="col">Статус</th>
      <th scope="col">Просмотры</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody class="table-content">

  </tbody>
</table>
{{@csrf_field()}}
<button class="btn btn-success show-more">Показать еще</button>
@endsection