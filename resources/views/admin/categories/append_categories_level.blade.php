<label for="parent_id">Select Category Level</label>
<select class="form-control select2 select2-danger" id="parent_id" name="parent_id"
    data-dropdown-css-class="select2-danger" style="width: 100%;">
    <option value="0">Main Category</option>
    @if (!empty($getCategories))
        @foreach ($getCategories as $category)
            <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
            @if (!empty($category))
                @foreach ($category['subcategories'] as $subcategories)
                    <option value="{{ $subcategories['id'] }}">&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategories['category_name'] }}</option>
                @endforeach
                
            @endif
        @endforeach
    @endif
</select>