<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl">Websites</h2>

            <a href="{{ route('admin.websites.create') }}"
               class="bg-brand text-white px-4 py-2 rounded">
                + Add Website
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Website</th>
                    <th class="p-2">Domain</th>
                    <th class="p-2">User</th>
                    <th class="p-2">Expiry</th>
                    <th class="p-2">Billing</th>
                </tr>
            </thead>

            <tbody>
                @foreach($websites as $site)
                    <tr class="border-t">
                        <td class="p-2">{{ $site->name }}</td>
                        <td class="p-2">{{ $site->domain }}</td>
                        <td class="p-2">{{ $site->user->name }}</td>
                        <td class="p-2">
                            {{ $site->expiry_date->format('d M Y') }}
                        </td>
                        <td class="p-2">
                            ₹{{ $site->billing_amount }} / {{ ucfirst($site->billing_frequency) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
