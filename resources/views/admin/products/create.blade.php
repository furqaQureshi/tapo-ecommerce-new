@extends('admin.master.layouts.app')
@section('page-title')
    Add Product
@endsection
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond@^4.30.4/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        li.select2-selection__choice {
            color: black !important;
        }

        .filepond--root {
            max-height: 400px;
            border-radius: 8px;
            padding: 10px;
        }

        .filepond--panel-root {
            background-color: #f8f9fa;
        }

        .filepond--item {
            width: 25%;
            padding: 5px;
            box-sizing: border-box;
        }

        .filepond--item>.filepond--panel {
            border-radius: 8px;
        }

        .filepond--image-preview {
            border-radius: 8px;
            overflow: hidden;
        }

        .filepond--file-info {
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .filepond--file-action-button {
            cursor: pointer;
        }

        .filepond--drop-label {
            font-size: 16px;
            color: #666;
        }

        .filepond-wrapper {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .filepond--list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .filepond--item {
                width: 50%;
            }
        }

        @media (max-width: 576px) {
            .filepond--item {
                width: 100%;
            }
        }
    </style>
@endsection
@section('page-content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="p-0">
                                    <h4 class="card-title mb-0 flex-grow-1">Product Add</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('admin.product.store') }}"
                                enctype="multipart/form-data" id="product-form">
                                @csrf
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <label for="name" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" required value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        placeholder="Slug" required value="{{ old('slug') }}">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <label for="qty" class="form-label">Quantity <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="qty" name="qty"
                                        placeholder="Quantity" required value="{{ old('qty') }}">
                                    @error('qty')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="category_id" class="form-label">Category <span
                                            class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="category_ids[]" id="category" multiple
                                        required>
                                        <option disabled {{ old('category_ids') ? '' : 'selected' }}>Select Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_ids')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select id="js-example-basic-multiple" name="category_ids[]" id="category" multiple required>
                                        <!-- <option disabled {{ old('category_ids') ? '' : 'selected' }}>Select Category</option> -->
                                        <option disabled >Select Category</option>
                                        @foreach ($categories as $category)
                                            {{-- Parent Category --}}
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, old('category_ids', [])) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>

                                            {{-- Child Categories --}}
                                            @if ($category->children->count() > 0)
                                                @foreach ($category->children as $child)
                                                    <option value="{{ $child->id }}"
                                                        {{ in_array($child->id, old('category_ids', [])) ? 'selected' : '' }}>
                                                        -- {{ $child->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('category_ids')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="price" class="form-label">Price <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Price" step="0.01" min="0" value="{{ old('price') }}"
                                        required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" name="discount" id="discount" class="form-control"
                                        placeholder="Discount %" step="0.01" min="0" max="100"
                                        value="{{ old('discount') }}" {{ old('is_subscription') ? 'disabled' : '' }}>
                                    @error('discount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="points" class="form-label">Points</label>
                                    <input type="number" name="points" id="points" class="form-control"
                                        placeholder="Points" min="0" step="1" value="{{ old('points') }}">
                                    @error('points')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->
                                <!-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="redeem_points" class="form-label">Redeem Points</label>
                                    <input type="number" name="redeem_points" id="redeem_points" class="form-control"
                                        placeholder="Redeem Points" min="0" step="1"
                                        value="{{ old('redeem_points') }}">
                                </div> -->
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="status">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                  <div class="col-md-3 col-lg-3 col-sm-12" id="box_price_2_discount">
                                    <label for="addon_price" class="form-label">Box2 Discount</label>
                                    <input type="text" name="box_price_2_discount" id="box_price_2_discount" class="form-control"
                                        placeholder="Box 2 Discount Price"
                                        value="{{ old('box_price_2_discount') }}">
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12" id="box_price_3_discount">
                                    <label for="addon_price" class="form-label">Box3 Discount</label>
                                    <input type="text" name="box_price_3_discount" id="box_price_3_discount" class="form-control"
                                        placeholder="Box 3 Discount Price"
                                        value="{{ old('box_price_3_discount') }}">
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12" id="ad_on_products">
                                    <label for="addon_price" class="form-label">Add On Products</label>
                                     <select class="js-example-basic-single" name="add_on_product_ids[]" id="category" multiple>
                                        <!-- <option disabled {{ old('add_on_product_ids') ? '' : 'selected' }}>Select Add On Products</option> -->
                                         <option disabled >Select Add On Products</option>

                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ in_array($product->id, old('add_on_product_ids', [])) ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 <div class="col-md-3 col-lg-3 col-sm-12" id="ad_on_products">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" name="sku" id="sku" class="form-control"
                                        placeholder="SKU"
                                        value="{{ old('sku') }}">
                                    @error('sku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="is_subscription" class="form-label"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_subscription"
                                            name="is_subscription" {{ old('is_subscription') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_subscription">
                                            Is Subscription
                                        </label>
                                    </div>
                                    @error('is_subscription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                              
                                <div class="col-md-3 col-lg-3 col-sm-12" id="label_wrapper"
                                    style="display: {{ old('is_subscription') ? 'block' : 'none' }};">
                                    <label for="label" class="form-label">Label <span
                                            class="text-danger">*</span></label>
                                    <select class="js-example-basic-single" name="label" id="label">
                                        <option value="normal" {{ old('label') == 'normal' ? 'selected' : '' }}>Normal
                                        </option>
                                        <option value="zeera_pick" {{ old('label') == 'zeera_pick' ? 'selected' : '' }}>
                                            Zeera Pick</option>
                                        <option value="addon" {{ old('label') == 'addon' ? 'selected' : '' }}>Addon
                                        </option>
                                    </select>
                                    @error('label')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12" id="addon_price_wrapper"
                                    style="display: {{ old('label') == 'addon' ? 'block' : 'none' }};">
                                    <label for="addon_price" class="form-label">Addon Price</label>
                                    <input type="number" name="addon_price" id="addon_price" class="form-control"
                                        placeholder="Addon Price" step="0.01" min="0"
                                        value="{{ old('addon_price') }}">
                                    @error('addon_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                 

                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-sm-12">
                                                <label for="short_description" class="form-label">Short
                                                    Description</label>
                                                <textarea type="text" class="form-control" rows="3" id="short_description" name="short_description"
                                                    placeholder="Short Description">{{ old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea type="text" class="form-control" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="images" class="form-label">Product Images <span
                                            class="text-danger">*</span></label>
                                    <div class="filepond-wrapper">
                                        <input type="file" name="images[]" id="images" multiple
                                            accept="image/jpeg,image/jpg,image/png,image/webp">
                                    </div>
                                    @error('images')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('images.*')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div id="filepond-warning" class="text-danger mt-2" style="display: none;">
                                        Please re-upload your files due to a validation error.
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="is_featured" class="form-label"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Featured Product
                                        </label>
                                    </div>
                                    @error('is_featured')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="is_e_ticket" class="form-label"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_e_ticket"
                                            name="is_e_ticket" {{ old('is_e_ticket') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_e_ticket">
                                            E-Ticket
                                        </label>
                                    </div>
                                    @error('is_e_ticket')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->
                                <!-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="is_affiliate" class="form-label"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_affiliate"
                                            name="is_affiliate" {{ old('is_affiliate') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_affiliate">
                                            Is Affiliate
                                        </label>
                                    </div>
                                    @error('is_affiliate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> -->
                                {{-- <div class="col-md-3 col-lg-3 col-sm-12">
                                    <label for="is_shop_product" class="form-label"></label>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_shop_product"
                                            name="is_shop_product" {{ old('is_shop_product') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_shop_product">
                                            Shop Product
                                        </label>
                                    </div>
                                    @error('is_shop_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div> --}}
                                <div id="affiliate_section" class="mb-4"
                                    style="{{ old('is_affiliate') ? '' : 'display: none;' }}">
                                    <div id="affiliate_repeater">
                                        @if (old('affiliate_title', []) && count(old('affiliate_title', [])) > 0)
                                            @foreach (old('affiliate_title', []) as $index => $title)
                                                <div class="row affiliate-row mb-2">
                                                    <div class="col-md-5">
                                                        <input type="text" name="affiliate_title[]"
                                                            class="form-control" placeholder="Affiliate Title"
                                                            value="{{ $title }}">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="url" name="affiliate_link[]"
                                                            class="form-control" placeholder="https://example.com"
                                                            value="{{ old('affiliate_link.' . $index) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        @if ($index > 0)
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-affiliate">Remove</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm addProductSubmit-btn add-affiliate">+
                                                                Add More</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row affiliate-row mb-2">
                                                <div class="col-md-5">
                                                    <input type="text" name="affiliate_title[]" class="form-control"
                                                        placeholder="Affiliate Title"
                                                        value="{{ old('affiliate_title.0') }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="url" name="affiliate_link[]" class="form-control"
                                                        placeholder="https://example.com"
                                                        value="{{ old('affiliate_link.0') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm addProductSubmit-btn add-affiliate">+
                                                        Add More</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12">
                                    <h3>Product Attributes</h3>
                                    <p>Add attributes like size, color, etc., with their values, price, and quantity</p>
                                    <div id="attribute_repeater" class="mb-4">
                                        @if (old('attribute_id', []) && count(old('attribute_id', [])) > 0)
                                            @foreach (old('attribute_id', []) as $index => $attribute)
                                                <div class="row attribute-row mb-2">
                                                    <div class="col-md-2">
                                                        <select class="js-example-basic-single" name="attribute_id[]">
                                                            <option value="size"
                                                                {{ old('attribute_id.' . $index) == 'size' ? 'selected' : '' }}>
                                                                Size</option>
                                                            <option value="color"
                                                                {{ old('attribute_id.' . $index) == 'color' ? 'selected' : '' }}>
                                                                Color</option>
                                                            <option value="material"
                                                                {{ old('attribute_id.' . $index) == 'material' ? 'selected' : '' }}>
                                                                Material</option>
                                                            <option value="style"
                                                                {{ old('attribute_id.' . $index) == 'style' ? 'selected' : '' }}>
                                                                Style</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="attribute_value[]"
                                                            class="form-control" placeholder="Attribute Value"
                                                            value="{{ old('attribute_value.' . $index) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" name="attribute_price[]"
                                                            class="form-control" placeholder="Price" step="0.01"
                                                            min="0"
                                                            value="{{ old('attribute_price.' . $index) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" name="attribute_discount[]"
                                                            class="form-control" placeholder="Discount" step="0.01"
                                                            min="0"
                                                            value="{{ old('attribute_discount.' . $index) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" name="attribute_qty[]" class="form-control"
                                                            placeholder="Quantity" min="0" step="1"
                                                            value="{{ old('attribute_qty.' . $index) }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        @if ($index > 0)
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-attribute">Remove</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm add-attribute">+ Add
                                                                More</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row attribute-row mb-2">
                                                <div class="col-md-2">
                                                    <select class="js-example-basic-single" name="attribute_id[]">
                                                        {!! getAttributes($attributes) !!}
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" name="attribute_value[]" class="form-control"
                                                        placeholder="Attribute Value"
                                                        value="{{ old('attribute_value.0') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="attribute_price[]" class="form-control"
                                                        placeholder="Price" step="0.01" min="0"
                                                        value="{{ old('attribute_price.0') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="attribute_discount[]" class="form-control"
                                                        placeholder="Discount" step="0.01" min="0"
                                                        value="{{ old('attribute_discount.0') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="attribute_qty[]" class="form-control"
                                                        placeholder="Quantity" min="0" step="1"
                                                        value="{{ old('attribute_qty.0') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-primary btn-sm add-attribute">+
                                                        Add More</button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div> -->
                                <input type="hidden" name="variants[]" value="">
                                <ul id="variant-list" class="list-group mt-4"></ul>
                                <div class="col-12">
                                    <div class="text-end">
                                        <button class="btn btn-danger" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.products.modal')
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js">
        </script>
        <script src="https://unpkg.com/filepond@^4.30.4/dist/filepond.min.js"></script>
        <script src="{{ asset('admin/assets') }}/libs/sortablejs/Sortable.min.js"></script>
        <script src="{{ asset('admin/assets') }}/js/pages/nestable.init.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize FilePond
                FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

                const pond = FilePond.create(document.querySelector('#images'), {
                    allowMultiple: true,
                    required: true,
                    acceptedFileTypes: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'],
                    fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                        resolve(type);
                    }),
                    maxFileSize: '10MB',
                    name: 'images[]',
                    storeAsFile: true,
                    allowRevert: true,
                    allowRemove: true,
                    labelIdle: 'Drag & Drop your images or <span class="filepond--label-action">Browse</span>',
                    labelFileLoading: 'Loading',
                    labelFileLoadError: 'Error during file load',
                    labelFileProcessing: 'Uploading',
                    labelFileProcessingComplete: 'Upload complete',
                    labelFileProcessingError: 'Error during upload',
                    labelTapToCancel: 'tap to cancel',
                    onaddfilestart: function(file) {
                        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
                        const maxSize = 10 * 1024 * 1024;
                        if (!allowedTypes.includes(file.fileType)) {
                            toastr.error('Invalid file type. Only JPG, JPEG, PNG, and WEBP are allowed.');
                            pond.removeFile(file);
                            return false;
                        }
                        if (file.fileSize > maxSize) {
                            toastr.error('File size exceeds 10MB limit.');
                            pond.removeFile(file);
                            return false;
                        }
                        const files = JSON.parse(localStorage.getItem('filepond_files') || '[]');
                        files.push({
                            name: file.file.name,
                            type: file.file.type,
                            size: file.file.size,
                            file: file
                        });
                        localStorage.setItem('filepond_files', JSON.stringify(files));
                        console.log('File added to queue:', file.file.name, file.fileType, file.fileSize);
                    },
                    onaddfile: function(error, file) {
                        if (error) {
                            toastr.error('Error adding file: ' + error.message);
                            console.error('FilePond onaddfile error:', error);
                            return;
                        }
                        console.log('File successfully added:', file.file.name);
                    },
                    onremovefile: function(error, file) {
                        const files = JSON.parse(localStorage.getItem('filepond_files') || '[]');
                        const updatedFiles = files.filter(f => f.name !== file.file.name);
                        localStorage.setItem('filepond_files', JSON.stringify(updatedFiles));
                        console.log('File removed:', file.file.name);
                    }
                });

                @if ($errors->any())
                    const savedFiles = JSON.parse(localStorage.getItem('filepond_files') || '[]');
                    if (savedFiles.length > 0) {
                        $('#filepond-warning').text('Please re-upload the following files due to a validation error: ' +
                            savedFiles.map(f => f.name).join(', ')).show();
                    }
                @endif

                $('#product-form').on('submit', function(e) {
                    console.log('Form submitting...');
                    const formData = new FormData(this);
                    for (let [key, value] of formData.entries()) {
                        if (key === 'images[]' && value instanceof File) {
                            console.log(
                                `File: ${key} - ${value.name}, Type: ${value.type}, Size: ${value.size}`);
                        } else {
                            console.log(`${key}: ${value}`);
                        }
                    }
                    if (!{{ $errors->any() ? 'true' : 'false' }}) {
                        localStorage.removeItem('filepond_files');
                    }
                });

                $('#is_subscription').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#label_wrapper').show();
                        $('#label').val('normal').trigger('change.select2');
                        $('#discount').val('').prop('disabled', true);
                    } else {
                        $('#label_wrapper').hide();
                        $('#label').val('normal').trigger('change.select2');
                        $('#addon_price_wrapper').hide();
                        $('#addon_price').val('').prop('required', false);
                        $('#discount').prop('disabled', false);
                    }
                });

                $('#label').on('change', function() {
                    if ($(this).val() === 'addon') {
                        $('#addon_price_wrapper').show();
                        $('#addon_price').prop('required', true);
                    } else {
                        $('#addon_price_wrapper').hide();
                        $('#addon_price').val('').prop('required', false);
                    }
                });

                @if (old('is_subscription'))
                    $('#label_wrapper').show();
                    $('#discount').val('').prop('disabled', true);
                    @if (old('label') == 'addon')
                        $('#addon_price_wrapper').show();
                        $('#addon_price').prop('required', true);
                    @endif
                @endif

                $('#points').on('input', function() {
                    let value = $(this).val();
                    if (value.includes('.')) {
                        $(this).val(Math.floor(value));
                    }
                    if (value < 0) {
                        $(this).val(0);
                    }
                });

                $('#is_affiliate').on('change', function() {
                    if ($(this).is(':checked')) {
                        $('#affiliate_section').show();
                        if ($('#affiliate_repeater .affiliate-row').length === 0) {
                            $('#affiliate_repeater').append(`
                                <div class="row affiliate-row mb-2">
                                    <div class="col-md-5">
                                        <input type="text" name="affiliate_title[]" class="form-control" placeholder="Affiliate Title">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="url" name="affiliate_link[]" class="form-control" placeholder="https://example.com">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btn-sm addProductSubmit-btn add-affiliate">+ Add More</button>
                                    </div>
                                </div>
                            `);
                        }
                    } else {
                        $('#affiliate_section').hide();
                    }
                });

                $(document).on('click', '.add-affiliate', function() {
                    $('#affiliate_repeater').append(`
                        <div class="row affiliate-row mb-2">
                            <div class="col-md-5">
                                <input type="text" name="affiliate_title[]" class="form-control" placeholder="Affiliate Title">
                            </div>
                            <div class="col-md-5">
                                <input type="url" name="affiliate_link[]" class="form-control" placeholder="https://example.com">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-affiliate">Remove</button>
                            </div>
                        </div>
                    `);
                });

                $(document).on('click', '.remove-affiliate', function() {
                    $(this).closest('.affiliate-row').remove();
                });

                $(document).on('input', 'input[name="affiliate_link[]"]', function() {
                    const $input = $(this);
                    const value = $input.val().trim();
                    const $parent = $input.parent();
                    $parent.find('.url-error').remove();
                    $input.css('border', '');
                    if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
                        $input.css('border', '1px solid red');
                        $parent.append(
                            '<small class="url-error text-danger d-block mt-1">Only http:// or https:// links allowed</small>'
                        );
                    }
                });

                const attributeOptions = `{!! getAttributes($attributes) !!}`;

                // Add attribute clone functionality
                $(document).on('click', '.add-attribute', function() {
                    const newRow = `
                        <div class="row attribute-row mb-2">
                            <div class="col-md-2">
                                <select class="js-example-basic-single attribute-select" name="attribute_id[]">
                                ${attributeOptions}
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="attribute_value[]" class="form-control" placeholder="Attribute Value">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="attribute_price[]" class="form-control" placeholder="Price" step="0.01" min="0">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="attribute_discount[]" class="form-control" placeholder="Discount" step="0.01" min="0">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="attribute_qty[]" class="form-control" placeholder="Quantity" min="0" step="1">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-attribute">Remove</button>
                            </div>
                        </div>`;
                    $('#attribute_repeater').append(newRow);
                    // Initialize select2 for the new select element
                    $('#attribute_repeater').find('.attribute-select').last().select2();
                });

                $(document).on('click', '.remove-attribute', function() {
                    $(this).closest('.attribute-row').remove();
                });

                // Validate attribute fields
                $(document).on('input', 'input[name="attribute_value[]"]', function() {
                    const $input = $(this);
                    const value = $input.val().trim();
                    const $parent = $input.parent();
                    $parent.find('.value-error').remove();
                    $input.css('border', '');
                    if (!value) {
                        $input.css('border', '1px solid red');
                        $parent.append(
                            '<small class="value-error text-danger d-block mt-1">Attribute value is required</small>'
                        );
                    }
                });

                $(document).on('input', 'input[name="attribute_price[]"]', function() {
                    const $input = $(this);
                    const value = parseFloat($input.val());
                    const $parent = $input.parent();
                    $parent.find('.price-error').remove();
                    $input.css('border', '');
                    if (isNaN(value) || value < 0) {
                        $input.css('border', '1px solid red');
                        $parent.append(
                            '<small class="price-error text-danger d-block mt-1">Price must be a non-negative number</small>'
                        );
                    }
                });
                
                $(document).on('input', 'input[name="attribute_discount[]"]', function() {
                    const $input = $(this);
                    const value = parseFloat($input.val());
                    const $parent = $input.parent();
                    $parent.find('.discount-error').remove();
                    $input.css('border', '');
                    if (isNaN(value) || value < 0) {
                        $input.css('border', '1px solid red');
                        $parent.append(
                            '<small class="discount-error text-danger d-block mt-1">Discount must be a non-negative number</small>'
                        );
                    }
                });

                $(document).on('input', 'input[name="attribute_qty[]"]', function() {
                    const $input = $(this);
                    const value = parseInt($input.val());
                    const $parent = $input.parent();
                    $parent.find('.qty-error').remove();
                    $input.css('border', '');
                    if (isNaN(value) || value < 0) {
                        $input.css('border', '1px solid red');
                        $parent.append(
                            '<small class="qty-error text-danger d-block mt-1">Quantity must be a non-negative integer</small>'
                        );
                    }
                });

                $('#description').summernote({
                    placeholder: 'Add description here',
                    tabsize: 2,
                    height: 250,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['color', ['color']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview']]
                    ],
                    codeviewFilter: true,
                    codeviewIframeFilter: true
                });
                
                $('#short_description').summernote({
                    placeholder: 'Add description here',
                    tabsize: 2,
                    height: 250,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['color', ['color']],
                        // ['insert', ['link', 'picture']],
                        // ['view', ['codeview']]
                    ],
                    codeviewFilter: true,
                    codeviewIframeFilter: true
                });

                $(function(){
                    $('#js-example-basic-multiple').select2();
                    $('.js-example-basic-single').select2();
                });
                
//                 $('.js-example-basic-single').select2({
//     dropdownParent: $('#myModal')
// });

                $('#name').on('input', function() {
                    const name = $(this).val();
                    const slug = name
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    $('#slug').val(slug);
                });

                $('#slug').on('input', function() {
                    const cleanedSlug = $(this).val()
                        .toLowerCase()
                        .replace(/[^a-z0-9-]/g, '')
                        .replace(/-+/g, '-');
                    $(this).val(cleanedSlug);
                });
            });

            let variants = [];

            function renderVariants() {
                const list = $('#variant-list');
                list.empty();
                variants.forEach((variant, index) => {
                    list.append(`
                        <li class="list-group-item d-flex justify-content-between align-items-center variant-item" data-index="${index}">
                            <span><strong>${variant.name}</strong> (${variant.sku})</span>
                            <span class="variant-actions">
                                <a class="edit-variant me-2" data-index="${index}" title="Edit" style="cursor:pointer;">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <a class="delete-variant me-2" data-index="${index}" title="Delete" style="cursor:pointer;">
                                    <i class="bx bx-trash"></i>
                                </a>
                            </span>
                            <input type="hidden" name="variant_name[]" value="${variant.name}">
                            <input type="hidden" name="variant_sku[]" value="${variant.sku}">
                            <input type="hidden" name="variant_qty[]" value="${variant.variant_qty}">
                            <input type="hidden" name="variant_region[]" value="${variant.region}">
                            <input type="hidden" name="variant_denomination[]" value="${variant.denomination}">
                            <input type="hidden" name="variant_price[]" value="${variant.price}">
                            <input type="hidden" name="variant_order[]" value="${index}">
                        </li>
                    `);
                });
            }

            function sortVariants() {
                const newOrder = [];
                $('#variant-list .variant-item').each(function() {
                    const index = $(this).data('index');
                    newOrder.push(variants[index]);
                });
                variants = newOrder;
                renderVariants();
            }

            $('#variantForm').on('submit', function(e) {
                e.preventDefault();
                const variantData = {
                    name: $('#variantName').val(),
                    sku: $('#sku').val(),
                    variant_qty: $('#variant_qty').val(),
                    region: $('#region').val(),
                    denomination: $('#denomination').val(),
                    price: $('#variant_price').val()
                };
                console.log(variantData);
                const editIndex = $('#editIndex').val();
                if (editIndex !== "") {
                    variants[editIndex] = variantData;
                } else {
                    variants.push(variantData);
                }
                renderVariants();
                $('#variantForm')[0].reset();
                $('#editIndex').val('');
                $('#variantModal').modal('hide');
            });

            $(document).on('click', '.delete-variant', function() {
                const index = $(this).data('index');
                variants.splice(index, 1);
                renderVariants();
            });

            $(document).on('click', '.edit-variant', function() {
                const index = $(this).data('index');
                const variant = variants[index];
                $('#variantName').val(variant.name);
                $('#sku').val(variant.sku);
                $('#variant_qty').val(variant.variant_qty);
                $('#region').val(variant.region);
                $('#denomination').val(variant.denomination);
                $('#variant_price').val(variant.price);
                $('#editIndex').val(index);
                $('#variantModal').modal('show');
            });

            $(function() {
                $('#variant-list').sortable({
                    update: function() {
                        sortVariants();
                    }
                });
            });

            $('#variantModal').on('hidden.bs.modal', function() {
                $('#variantForm')[0].reset();
                $('#editIndex').val('');
            });
        </script>
    @endsection
