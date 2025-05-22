<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $customer->first_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $customer->last_name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}">
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
</div>

<div class="mb-3">
    <label for="date_of_birth" class="form-label">Date of Birth</label>
    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $customer->date_of_birth ?? '') }}">
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea name="address" class="form-control" rows="2">{{ old('address', $customer->address ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notes</label>
    <textarea name="notes" class="form-control" rows="3">{{ old('notes', $customer->notes ?? '') }}</textarea>
</div>