@extends('layouts.app')

@section('welcome')
  @auth
  <h4><strong>Hello, {{ Auth::user()->name }}</strong></h4>
  How can I help you today?
  @else
      Hello Guest. Welcome to our platform.
  @endauth
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2><strong>Users Management</strong></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<br>

<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
        @php
        $roleClass = '';
        switch($v) {
            case 'Admin':
                $roleClass = 'green-pill';
                break;
            case 'Manager':
                $roleClass = 'orange-pill';
                break;
            case 'Guest':
                $roleClass = 'grey-pill';
                break;
            // Add more cases for other roles if needed
        }
        @endphp
    <label class="{{ $roleClass }}">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>

{!! $data->links('pagination::bootstrap-4') !!}

<p class="text-center text-primary"><small>Last updated: {{ now()->format('j F Y (l)') }}</small></p>
@endsection