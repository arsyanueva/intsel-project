<div class="mb-3">
    <label for="name" class="form-label">
        Category Name
    </label>

    <input
        id="name"
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $category->name ?? '') }}"
        placeholder="Enter category name">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        {{ $button ?? 'Save' }}
    </button>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</div>