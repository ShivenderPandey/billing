<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Website
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
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
                  action="{{ route('admin.websites.update', $website) }}"
                  class="bg-white shadow rounded-lg p-6 space-y-4">
                @csrf
                @method('PUT')

                {{-- User --}}
                <div>
                    <label class="block font-medium">User</label>
                    <select name="user_id"
                            class="w-full border p-2 rounded"
                            required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $website->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Website Name --}}
                <div>
                    <label class="block font-medium">Website Name</label>
                    <input name="name"
                           value="{{ old('name', $website->name) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                {{-- Domain --}}
                <div>
                    <label class="block font-medium">Domain</label>
                    <input name="domain"
                           value="{{ old('domain', $website->domain) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                {{-- Billing Amount --}}
                <div>
                    <label class="block font-medium">Billing Amount</label>
                    <input type="number"
                           step="0.01"
                           name="billing_amount"
                           value="{{ old('billing_amount', $website->billing_amount) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                {{-- Billing Currency --}}
                <div>
                    <label class="block font-medium">Billing Currency</label>
                    <input name="billing_currency"
                           value="{{ old('billing_currency', $website->billing_currency) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                {{-- Billing Frequency --}}
                <div>
                    <label class="block font-medium">Billing Frequency</label>
                    <select name="billing_frequency"
                            class="w-full border p-2 rounded"
                            required>
                        <option value="monthly"
                            {{ $website->billing_frequency === 'monthly' ? 'selected' : '' }}>
                            Monthly
                        </option>
                        <option value="yearly"
                            {{ $website->billing_frequency === 'yearly' ? 'selected' : '' }}>
                            Yearly
                        </option>
                    </select>
                </div>

                {{-- Expiry Date --}}
                <div>
                    <label class="block font-medium">Expiry Date</label>
                    <input type="date"
                           name="expiry_date"
                           value="{{ old('expiry_date', $website->expiry_date->format('Y-m-d')) }}"
                           class="w-full border p-2 rounded"
                           required>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-medium">Status</label>
                    <select name="status"
                            class="w-full border p-2 rounded"
                            required>
                        <option value="active"
                            {{ $website->status === 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="expired"
                            {{ $website->status === 'expired' ? 'selected' : '' }}>
                            Expired
                        </option>
                    </select>
                </div>

                {{-- Notes --}}
                <div>
                    <label class="block font-medium">Notes</label>
                    <textarea name="notes"
                              rows="3"
                              class="w-full border p-2 rounded"
                              placeholder="Optional notes">{{ old('notes', $website->notes) }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('admin.websites.index') }}"
                       class="px-4 py-2 border rounded">
                        Cancel
                    </a>

                    <button class="bg-brand text-white px-4 py-2 rounded hover:bg-brand-dark">
                        Update Website
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
