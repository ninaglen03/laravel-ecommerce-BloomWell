@csrf
@php($product = $product ?? null)

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', optional($product)->name) }}" required>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="price">Price ($)</label>
        <input type="number" step="0.01" min="0" class="form-control" name="price" id="price" value="{{ old('price', optional($product)->price) }}" required>
    </div>
    <div class="form-group col-md-6">
        <label for="inventory">Inventory</label>
        <input type="number" min="0" class="form-control" name="inventory" id="inventory" value="{{ old('inventory', optional($product)->inventory ?? 0) }}" required>
    </div>
</div>

<div class="form-group">
    <label for="summary">Summary</label>
    <input type="text" class="form-control" name="summary" id="summary" value="{{ old('summary', optional($product)->summary) }}">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', optional($product)->description) }}</textarea>
</div>

<div class="form-group">
    <label for="image">Upload image</label>
    <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
    @if (!empty(optional($product)->image_src))
        <div class="mt-2">
            <small class="text-muted d-block">Current image:</small>
            <img src="{{ $product->image_src }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-height: 140px;">
        </div>
    @endif
</div>

<div class="form-group">
    <label for="image_url">Image URL</label>
    <input type="url" class="form-control" name="image_url" id="image_url" value="{{ old('image_url', optional($product)->image_url) }}">
</div>

<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" name="is_active" id="is_active" value="1" {{ old('is_active', optional($product)->is_active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Active</label>
</div>

<button type="submit" class="btn btn-wellness">{{ $buttonText }}</button>
