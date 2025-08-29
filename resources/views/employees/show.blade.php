<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Employee Details</h2></x-slot>
<div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-4 rounded shadow">
        <p><b>Name:</b> {{ $employee->name }}</p>
        <p><b>Email:</b> {{ $employee->email }}</p>
        <p><b>Phone:</b> {{ $employee->phone }}</p>
        <p><b>Position:</b> {{ $employee->position }}</p>
        <p><b>Salary:</b> {{ $employee->salary }}</p>
        <p><b>Address:</b> {{ $employee->address }}</p>
        <p><b>Active:</b> {{ $employee->active ? 'Yes' : 'No' }}</p>
    </div>
</div>
</x-app-layout>
