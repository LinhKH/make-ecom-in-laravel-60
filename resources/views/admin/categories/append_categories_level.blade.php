<label for="parent_id">Select Category Level</label>
<select class="form-control select2" id="parent_id" name="parent_id" style="width: 100%;">
    <option value="0"
        @if (isset($categoryDetail['parent_id']) && $categoryDetail['parent_id'] == 0 )
            selected=""
        @endif>Main Category</option>
    @if (!empty($getCategories))
        @foreach ($getCategories as $category)
            <option value="{{ $category['id'] }}" 
            @if (isset($categoryDetail['parent_id']) && $categoryDetail['parent_id'] == $category['id'])
                selected=""
            @endif>{{ $category['category_name'] }}</option>
            @if (!empty($category))
                @foreach ($category['subcategories'] as $subcategories)
                    <option value="{{ $subcategories['id'] }}">&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategories['category_name'] }}</option>
                @endforeach
                
            @endif
        @endforeach
    @endif
</select>