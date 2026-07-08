<div class="mb-3">
    <label for="code" class="form-label">
        Product Code
    </label>

    <input
        id="code"
        type="text"
        name="code"
        class="form-control @error('code') is-invalid @enderror"
        value="{{ old('code', $product->code ?? '') }}"
        placeholder="Enter product code">

    @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">
        Product Name
    </label>

    <input
        id="name"
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name ?? '') }}"
        placeholder="Enter product name">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="category_id" class="form-label">
        Category
    </label>

    <select
        id="category_id"
        name="category_id"
        class="form-select @error('category_id') is-invalid @enderror">

        <option value="">-- Select Category --</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>

                {{ $category->name }}

            </option>
        @endforeach

    </select>

    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="stock" class="form-label">
        Stock
    </label>

    <input
        id="stock"
        type="number"
        name="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $product->stock ?? '') }}"
        placeholder="Enter stock">

    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="location" class="form-label">
        Location
    </label>

    <input
        id="location"
        type="text"
        name="location"
        class="form-control @error('location') is-invalid @enderror"
        value="{{ old('location', $product->location ?? '') }}"
        placeholder="Enter storage location">

    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="condition" class="form-label">
        Condition
    </label>

    <select
        id="condition"
        name="condition"
        class="form-select @error('condition') is-invalid @enderror">

        <option value="">-- Select Condition --</option>

        <option
            value="Good"
            {{ old('condition', $product->condition ?? '') == 'Good' ? 'selected' : '' }}>
            Good
        </option>

        <option
            value="Damaged"
            {{ old('condition', $product->condition ?? '') == 'Damaged' ? 'selected' : '' }}>
            Damaged
        </option>

    </select>

    @error('condition')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">
        Product Image
    </label>

    <input
        id="image"
        type="file"
        name="image"
        class="form-control @error('image') is-invalid @enderror">

    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mt-4">
    <button type="submit" class="btn btn-primary">
        {{ $button ?? 'Save' }}
    </button>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">
        Cancel
    </a>
</div>
