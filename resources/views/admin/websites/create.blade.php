<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Website</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6">
        <form method="POST" action="{{ route('admin.websites.store') }}" class="bg-white p-6 rounded shadow">
            @csrf

            <label>User</label>
            <select name="user_id" class="w-full border p-2 mb-4">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <label>Website Name</label>
            <input name="name" class="w-full border p-2 mb-4">

            <label>Domain</label>
            <input name="domain" class="w-full border p-2 mb-4">

            <label>Expiry Date</label>
            <input type="date" name="expiry_date" class="w-full border p-2 mb-4">

            <label>Billing Amount</label>
            <input name="billing_amount" class="w-full border p-2 mb-4">

            <label>Billing Frequency</label>
            <select name="billing_frequency" class="w-full border p-2 mb-4">
                <option value="yearly">Yearly</option>
                <option value="monthly">Monthly</option>
            </select>

            <button class="bg-brand text-white px-4 py-2 rounded">
                Save Website
            </button>
        </form>
    </div>
</x-app-layout>
