<x-app-layout>
<div class="p-6">

    <h2 class="text-xl font-bold mb-4">Edit Patient</h2>

    <form method="POST" action="/patients/{{ $patient->id }}">
        @csrf
        @method('PUT')

        <input type="text" name="first_name" value="{{ $patient->first_name }}" class="border p-2">
        <input type="text" name="last_name" value="{{ $patient->last_name }}" class="border p-2">
        <input type="number" name="age" value="{{ $patient->age }}" class="border p-2">

        <button class="bg-green-500 text-white px-4 py-2">Update</button>
    </form>

</div>
</x-app-layout>