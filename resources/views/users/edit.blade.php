<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="alert alert-warning"><strong>Note: </strong> This is just an example to apply roles and permissions for oop technologies test task.</div>
                    <form action="{{route('edit.user', $user->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value=""></option>
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}" {{$user->hasRole($role->slug)?"selected":""}} >{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Permissions:</label>
                            <div>
                                @foreach ($permissions as $permission)
                                <div>
                                    <label> <input type="checkbox" name="permissions[]" id="permission_{{$permission->id}}" value="{{$permission->id}}" {{$user->hasPermission($permission)?"checked":""}} > {{$permission->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
