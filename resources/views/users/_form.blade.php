<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input
        id="name"
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '') }}">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input
        id="email"
        type="email"
        name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">

    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input
        id="password"
        type="password"
        name="password"
        class="form-control @error('password') is-invalid @enderror">

    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @isset($user->id)
        <small class="text-muted">Leave blank if you don't want to change password.</small>
    @endisset
</div>

<div class="mb-3">
    <label for="role_id" class="form-label">Role</label>
    <select
        id="role_id"
        name="role_id"
        class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Select Role --</option>
        @foreach($roles as $role)
            <option
                value="{{ $role->id }}"
                {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mt-4">
    <button class="btn btn-primary" type="submit">{{ $button }}</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</div>
