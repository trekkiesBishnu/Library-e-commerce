@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
            <div class="container py-3 col-md-8">
        <h3>Roles
            {{-- @can('create.book') --}}
                <a class="float-end btn btn-primary" href="{{route('role.create')}}">Add Author</a>
                {{-- @endcan --}}
        </h3>

            </div>

    </div>
</div>
<div class="row">
    <div class="container">

        <div class="col-md-22">
                <div class="container py-1 ">
                    <table  class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)

                            <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                             {{-- @can('update.author') --}}
                             <td>
                                <a class="btn btn-primary btn-sm" href="{{route('role.edit',$role->id)}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('role.delete',$role->id) }}">Delete</a>
                    
                           
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
