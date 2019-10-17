@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <strong>Users List to Approve</strong>
                </div>

                <div class="card-body">

                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Registered at</th>
                            <th>Role</th>
                            <th>Allow Permissions</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($users as $user)
                        <tr>
                            <form action="{{ route('admin.users.approve') }}" method="POST">
                                @csrf
                                <input type="hidden" name="userId" value="{{ $user->id }}" />
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <label for="addRight" class="mr-2">Add Item</label>
                                    <input type="checkbox" id="addRight" name="addRight" /> <br />
                                    <label for="searchRight" class="mr-2" id="searchRight">Search Items</label>
                                    <input type="checkbox" name="searchRight" id="searchRight" />
                                </td>
                                <td><button type="submit" class="btn btn-primary btn-sm">Approve</button></td>
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection