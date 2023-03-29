@extends('layouts.frontend.main')

@section('content')
<hr>
<div class="container bg-secondary text-white">
   <div class="row">
       <br>
       <br>
       <br>
       <br>
       <div class="mt-3">

           <h4>Email Varification Send </h4>
       </div>
       <div class="mt-2 ">
           <form action="{{ route('verification.send') }}" method="POST">
            @csrf
               <button type="submit" class="btn btn-primary text-white">Send Email To Varification</button>
               <br>
           </form>
       </div>
   </div>
</div>
<br>
<br>
<br>
<hr>
<hr>
@endsection