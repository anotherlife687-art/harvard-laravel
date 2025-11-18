
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2 class="text-lg font-bold mb-4">Manajemen Pengguna</h2>

                    @if(session('success'))
                        <div class="mb-4 text-green-500 font-semibold">{{ session('success') }}</div>
                    @endif

                    <table class="min-w-full border text-left">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="p-2 border">Nama</th>
                                <th class="p-2 border">Email</th>
                                <th class="p-2 border">Role</th>
                                <th class="p-2 border">Ubah Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="p-2 border">{{ $user->name }}</td>
                                    <td class="p-2 border">{{ $user->email }}</td>
                                    <td class="p-2 border">{{ $user->role }}</td>
                                    <td class="p-2 border">
                                        <form method="POST" action="{{ route('admin.users.updateRole', $user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                                                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                            </select>
                                            <button type="submit" class="ml-2 px-2 py-1 bg-blue-500 text-white rounded">Ubah</button>
                                        </form>
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

