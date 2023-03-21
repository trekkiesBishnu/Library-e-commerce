@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
                <div class="container py-3 col-md-8">
            <h3>OUR User 
               
            </h3>

                </div>

        </div>
    </div>
    <div class="row">
            <div class="container">
        
                <div class="col-md-22">
                        <div class="container py-1 ">
                            <table class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $userItem)
        
                                    <tr>
                                    <td>{{$userItem->id}}</td>
                                    <td>{{$userItem->name}}</td>
                                    <td>{{$userItem->email}}</td>
                               
                                    
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