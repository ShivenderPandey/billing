<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Users
            </h2>

            <a href="{{ route('admin.users.create') }}"
               class="bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
                + Add User
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-5 py-3 text-left">S.No.</th>
                            <th class="px-5 py-3 text-left">Name</th>
                            <th class="px-5 py-3 text-left">Email</th>
                            <th class="px-5 py-3 text-left">Role</th>
                            <th class="px-5 py-3 text-left">Phone</th>
                            <th class="px-5 py-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-5 py-3 text-gray-600">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-3">{{ $user->name }}</td>
                                <td class="px-5 py-3">{{ $user->email }}</td>
                                <td class="px-5 py-3 capitalize">
                                    {{ $user->role }}
                                </td>
                                <td class="px-5 py-3">
                                    {{ $user->phone ?? '-' }}
                                </td>
                                <td class="px-5 py-3 space-x-3">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="text-blue-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-6 text-center text-gray-500">
                                    No users found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
