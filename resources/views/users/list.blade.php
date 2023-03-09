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
                    <table class="table table-bordered">
                        <thead class="">
                            <tr>
                                <th width="5%" class="">Sr.</th>
                                <th width="35%" class="">Name</th>
                                <th width="10%" class="">Role</th>
                                <th width="30%" class="">Permissions</th>
                                <th width="20%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td scope="row" class="border p-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border">{{ $user->name }}</td>
                                    <td class="border">
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-secondary">{{ $role->name }}</span>
                                        @endforeach

                                    </td>
                                    <td class="border">
                                        @foreach ($user->permissions as $permission)
                                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="border">
                                        <div style="width:100%;">
                                            @if ($user->id != 1)
                                                <a href="{{ route('edit.user', $user->id) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                @if (auth()->user()->hasRole('super-admin') ||
                                                        auth()->user()->hasRole('admin'))
                                                    <a href="{{route('login.impersonate', $user->id)}}" class="btn btn-success btn-sm">Login as
                                                        {{ $user->name }}</a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
