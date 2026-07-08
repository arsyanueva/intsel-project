<div class="mb-3">
    <label for="user_id" class="form-label">Borrower</label>
    <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror">
        <option value="">-- Select User --</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $borrowing->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    @error('user_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="borrow_date" class="form-label">Borrow Date</label>
            <input
                id="borrow_date"
                type="date"
                class="form-control @error('borrow_date') is-invalid @enderror"
                name="borrow_date"
                value="{{ old('borrow_date', optional($borrowing)->borrow_date?->format('Y-m-d')) }}">

            @error('borrow_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="return_date" class="form-label">Return Date</label>
            <input
                id="return_date"
                type="date"
                class="form-control @error('return_date') is-invalid @enderror"
                name="return_date"
                value="{{ old('return_date', optional($borrowing)->return_date?->format('Y-m-d')) }}">

            @error('return_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
        <option value="Borrowed" {{ old('status', $borrowing->status ?? 'Borrowed') === 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
        <option value="Returned" {{ old('status', $borrowing->status ?? '') === 'Returned' ? 'selected' : '' }}>Returned</option>
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>

<h5>Borrowed Products</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <label for="details-0-product_id" class="form-label visually-hidden">Product</label>
                <select id="details-0-product_id" name="details[0][product_id]" class="form-select @error('details.0.product_id') is-invalid @enderror">
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('details.0.product_id', optional(optional($borrowing)->details->first())->product_id) == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>

                @error('details.0.product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
            <td>
                <label for="details-0-quantity" class="form-label visually-hidden">Quantity</label>
                <input
                    id="details-0-quantity"
                    type="number"
                    name="details[0][quantity]"
                    class="form-control @error('details.0.quantity') is-invalid @enderror"
                    value="{{ old('details.0.quantity', optional(optional($borrowing)->details->first())->quantity ?? 1) }}">

                @error('details.0.quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </td>
        </tr>
    </tbody>
</table>

<div class="mb-3">
    <button type="submit" class="btn btn-primary mt-3">
        {{ $button ?? 'Save' }}
    </button>

    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary mt-3">
        Cancel
    </a>
</div>
