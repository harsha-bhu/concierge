@extends('layouts.master')

@section('content')
     <div class="row">
        <div class="col-md-12 modal-outer noPad">
            <h2>Site Users</h2>
            <h4 class="pull-right"><a href="{{url('/users/add')}}">Create New User</a></h4>
	        <table class="table table-hover table-bordered">
		    <thead>
		        <tr>
		        <th>Name</th>
		        <th>Email</th>
		        <th>Username</th>
		        <th>Role</th>
		        <th>Active Self Leases</th>
		        <th>Total Leases Created <span title="Includes Terminated & Expired Leases" class="glyphicon glyphicon-question-sign"></span></th>
		        <th>Actions</th>
		        </tr>
		    </thead>
		    <tbody>
		     	@foreach($users as $user)
		      	<tr>
		       		<td>{{{$user->name}}}</td>
		       		<td>{{{$user->email}}}</td>
		       		<td>{{{$user->username}}}</td>
		       		<td>
		       		@if($user->admin)
		       		Admin
		       		@else
		       		Standard User
		       		@endif
		       		</td>
		       		<td>{{{$user->getActiveLeases()->count()}}}</td>
		       		<td>{{{$user->leases()->withTrashed()->count()}}}</td>
	    			<td>
	    				@if($user->id != Auth::user()->id)
                        <form method="post" action="">
                            <a href="/user/{{$user->id}}/edit">
                                <span title="Edit User" class="glyphicon glyphicon-edit"></span>
    		    			</a>

    		    			<input type="hidden" name="user_id" value="{{{$user->id}}}" />
    		    			<input type="hidden" name="_token" value="{{{csrf_token()}}}">
    		    			<a href="" style="color: #ff0000;" onclick="if(confirm('Are you sure you want to delete this user (All his active leases/invites will be terminated?')) {parentNode.submit();} return false;">
                                <span title="Delete User" class="glyphicon glyphicon-minus-sign"></span>
    		    			</a>
		    			</form>
		    			@endif
	    			</td>
		       	</tr>
		       	@endforeach
		    </tbody>
   		    </table>
		</div>
	</div>
@stop
