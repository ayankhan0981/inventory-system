@php $e = $employee; @endphp
<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div>
        <label>Name</label>
        <input name="name" value="{{ old('name', $e->name ?? '') }}" class="input" required>
    </div>
    <div>
        <label>Email</label>
        <input name="email" type="email" value="{{ old('email', $e->email ?? '') }}" class="input">
    </div>
    <div>
        <label>Phone</label>
        <input name="phone" value="{{ old('phone', $e->phone ?? '') }}" class="input">
    </div>
    <div>
        <label>Position</label>
        <input name="position" value="{{ old('position', $e->position ?? '') }}" class="input">
    </div>
    <div>
        <label>Salary</label>
        <input name="salary" type="number" step="0.01" value="{{ old('salary', $e->salary ?? 0) }}" class="input">
    </div>
    <div class="flex items-center gap-2 mt-6">
        <input type="checkbox" name="active" value="1" {{ old('active', $e->active ?? true) ? 'checked' : '' }}>
        <label>Active</label>
    </div>
</div>
<style>
label{display:block;margin-bottom:.25rem}
.input{width:100%;border:1px solid #d1d5db;border-radius:.375rem;padding:.5rem}
</style>
