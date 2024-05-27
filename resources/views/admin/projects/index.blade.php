@extends('layouts.admin')

@section('content')
        <div class="col bg-success h-100 overflow-auto d-flex flex-nowrap">
            <div class="left_box w-50">
                @if ($errors->any())
                <div class="alert alert-danger ms-2 mt-3 w-98" role="alert">
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
                    <div class="alert alert-danger ms-2 mt-3 w-98" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success ms-2 mt-3 w-98" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-3 ms-2 p-3 w-98 bg-light shadow">
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
                <table class="table mt-3 ms-2 w-98 shadow">
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
                                <td>
                                    @if (isset($project->type->name))
                                        {{ $project->type->name }}
                                    @else
                                        ---
                                    @endif
                                </td>
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
            <div class="rigth-box w-50">
                <div id="carouselExampleAutoplaying" class="carousel slide mt-3 ms-3 w-98" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active bg-black">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/tsah7c9evnal289z5fig/Biglietto%20d'ingresso%20per%20IMG%20Worlds%20of%20Adventure%20a%20Dubai%2C%20Klook.jpg" class="d-block w-100 opacity-50" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h4 class="fw-bold">First slide label</h4>
                                <p class="fs-5">Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item bg-black">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/tsah7c9evnal289z5fig/Biglietto%20d'ingresso%20per%20IMG%20Worlds%20of%20Adventure%20a%20Dubai%2C%20Klook.jpg" class="d-block w-100 opacity-50" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h4 class="fw-bold">First slide label</h4>
                                <p class="fs-5">Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div class="carousel-item bg-black">
                            <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1200,h_630/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/tsah7c9evnal289z5fig/Biglietto%20d'ingresso%20per%20IMG%20Worlds%20of%20Adventure%20a%20Dubai%2C%20Klook.jpg" class="d-block w-100 opacity-50" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h4 class="fw-bold">First slide label</h4>
                                <p class="fs-5">Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <script>
            function submitForm(id){
                const form = document.getElementById(`form-edit-${id}`);
                form.submit();
            }
        </script>
@endsection
