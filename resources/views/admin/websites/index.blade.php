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

    <div class="py-12">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <!-- THIS CONTAINER IS THE KEY -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white shadow rounded-lg">

                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-5 py-3 text-left font-semibold w-16">S.No.</th>
                            <th class="px-6 py-3 text-left">Website</th>
                            <th class="px-6 py-3 text-left">Domain</th>
                            <th class="px-6 py-3 text-left">User</th>
                            <th class="px-6 py-3 text-left">Expiry</th>
                            <th class="px-6 py-3 text-left">Billing</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    @php
                      $index = 0;
                    @endphp
                    <tbody>
                        @foreach($websites as $site)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-8 py-3 text-gray-600">{{ $index+=1 }}</td>
                                <td class="px-8 py-3">{{ $site->name }}</td>
                                <td class="px-8 py-3">{{ $site->domain }}</td>
                                <td class="px-8 py-3">{{ $site->user->name }}</td>
                                <td class="px-8 py-3">
                                    {{ $site->expiry_date->format('d M Y') }}
                                </td>
                                <td class="px-8 py-3">
                                    {{ $site->billing_currency }}
                                    {{ number_format($site->billing_amount, 2) }}
                                    / {{ ucfirst($site->billing_frequency) }}
                                </td>
                                @php
                                $daysLeft = now()->diffInDays($site->expiry_date, false);
                                @endphp
                                <td class="px-8">
                                  @if($daysLeft < 0)
                                      <span class="bg-red-100 text-red-700 px-2 py-1 rounded">Expired</span>
                                  @elseif($daysLeft <= 30)
                                      <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Expiring</span>
                                  @else
                                      <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Active</span>
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
