<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('admin.users.update', $user) }}"
                  class="bg-white shadow rounded-lg p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium">Name</label>
                    <input name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                <div>
                    <label class="block font-medium">
                        Password
                        <span class="text-sm text-gray-500">(leave blank to keep unchanged)</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="w-full border p-2 rounded">
                </div>

                <div>
                    <label class="block font-medium">Role</label>
                    <select name="role"
                            class="w-full border p-2 rounded">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                            User
                        </option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Phone</label>
                    <input name="phone"
                           value="{{ old('phone', $user->phone) }}"
                           class="w-full border p-2 rounded">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox"
                           name="whatsapp_opt_in"
                           value="1"
                           {{ $user->whatsapp_opt_in ? 'checked' : '' }}>
                    <label>WhatsApp Opt-in</label>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-4 py-2 border rounded">
                        Cancel
                    </a>

                    <button class="bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
                        Update User
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
