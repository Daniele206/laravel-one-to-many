@extends('layouts.admin')

@section('content')
        <div class="col bg-success h-100 overflow-auto">
            @if ($errors->any())
                <div class="alert alert-danger ms-2 mt-3 w-50" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger ms-2 mt-3 w-50" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success ms-2 mt-3 w-50" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="mt-3 ms-2 w-50 p-3 bg-light shadow">
                <h2>Aggiungi Project <i class="fa-solid fa-plus"></i></h2>
                <form class="d-flex" action="{{ route('admin.projects.store') }}" method="POST">
                    @csrf
                    <input class="form-control w-25" type="text" placeholder="Name" name="name">
                    <select class="form-select w-25 mx-1" aria-label="Default select example" name="type_id">
                        <option selected value="">Type</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{$type->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-outline-success mx-1">Aggiungi</button>
                </form>
            </div>
            <table class="table mt-3 ms-2 w-50 shadow">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>
                                <form action="{{ route('admin.projects.update', $project) }}" method="POST" id="form-edit-{{ $project->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input class="imp_reed" type="text" value="{{ $project->name }}" name="name" id="{{ $project->name }}">
                                </form>
                            </td>
                            <td>{{ $project->type->name }}</td>
                            <td class="d-flex justify-content-end">
                                <button class="btn btn-warning mx-1" onclick="submitForm({{ $project->id }})"><i class="fa-solid fa-pen"></i></button>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Sicuro di voler eliminare il progetto {{ $project->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1" href="#"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function submitForm(id){
                const form = document.getElementById(`form-edit-${id}`);
                form.submit();
            }
        </script>
@endsection
