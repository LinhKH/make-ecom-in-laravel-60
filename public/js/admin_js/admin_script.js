$(document).ready(function () {

    $("#sections").DataTable();
    $("#categories").DataTable();
    $("#products").DataTable();
    $("#brands").DataTable();
    $("#banners").DataTable();
    $('.select2').select2()

    $('#current_pwd').keyup(function () {
        var current_pwd = $('#current_pwd').val();
        $.ajax({
            type: 'post',
            url: '/admin/check-current-pwd',
            data: { current_pwd: current_pwd },
            success: function (resp) {
                if (resp == 'false') {
                    $('#chkCurrendPwd').html("<font color=red>Current Password is incorect</font>");
                } else if (resp == 'true') {
                    $('#chkCurrendPwd').html("<font color=greem>Current Password is corect</font>");
                }
            }, error: function (e) {
                console.log("Error", e);
                alert(e);
            }
        });
    });

    $('.updateSectionStatus').click(function () {
        var status = $(this).children("i").attr('status');
        var section_id = $(this).attr('section_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#section-' + section_id).html("<i style='color:red' class='fa fa-toggle-off fa-2x' aria-hidden='true' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#section-' + section_id).html("<i class='fa fa-toggle-on fa-2x' aria-hidden='true' status='Active'></i>");
                }
            }
        });
    });

    $('.updateCategoryStatus').click(function () {
        var status = $(this).children("i").attr('status');
        var category_id = $(this).attr('category_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#category-' + category_id).html("<i style='color:red' class='fa fa-toggle-off fa-2x' aria-hidden='true' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#category-' + category_id).html("<i class='fa fa-toggle-on fa-2x' aria-hidden='true' status='Active'></i>");
                }
            }
        });
    });

    $('#section_id').change(function () {
        var section_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '/admin/append-categories-level',
            data: { section_id: section_id },
            success: function (resp) {
                $('#appendCategoriesLevel').html(resp);
            },
            error: function (e) {
                console.log(e);
                alert(e);
            }
        });
    });

    // Confirm Delete with SwwetAlert2
    $(".confirmDelete").click(function () {
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Are you sure?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
        })
    });

    $('.updateBannerstatus').click(function () {
        var status = $(this).children("i").attr('status');
        var banner_id = $(this).attr('banner_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-banner-status',
            data: { status: status, banner_id: banner_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#banner-' + banner_id).html("<i style='color:red' class='fa fa-toggle-off fa-2x' aria-hidden='true' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#banner-' + banner_id).html("<i class='fa fa-toggle-on fa-2x' aria-hidden='true' status='Active'></i>");
                }
            }
        });
    });

    $('.updateBrandStatus').click(function () {
        var status = $(this).children("i").attr('status');
        var brand_id = $(this).attr('brand_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#brand-' + brand_id).html("<i style='color:red' class='fa fa-toggle-off fa-2x' aria-hidden='true' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#brand-' + brand_id).html("<i class='fa fa-toggle-on fa-2x' aria-hidden='true' status='Active'></i>");
                }
            }
        });
    });

    $('.updateProductStatus').click(function () {
        var status = $(this).children("i").attr('status');
        var product_id = $(this).attr('product_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#product-' + product_id).html("<i style='color:red' class='fa fa-toggle-off fa-2x' aria-hidden='true' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $('#product-' + product_id).html("<i class='fa fa-toggle-on fa-2x' aria-hidden='true' status='Active'></i>");
                }
            }
        });
    });

    $('.updateProductImagesStatus').click(function () {
        var status = $(this).text();
        var product_image_id = $(this).attr('product_image_id');
        $.ajax({
            type: 'post',
            url: '/admin/update-product-image-status',
            data: { status: status, product_image_id: product_image_id },
            success: function (resp) {
                if (resp['status'] == 0) {
                    $('#image-' + product_image_id).html("<a class='updateProductImagesStatus' href='javascript:void(0)'>Inactive</a>");
                } else if (resp['status'] == 1) {
                    $('#image-' + product_image_id).html("<a class='updateProductImagesStatus' href='javascript:void(0)'>Active</a>");
                }
            }
        });
    });

    var maxField = 10;
    var addButton = $('.add_button');
    var wrapper = $('.field_wrapper');
    var fieldHTML = '<div style="margin-top:10px;"><input style="width:185px;" id="size" type="text" name="size[]" placeholder="Size" value=""/>&nbsp;<input style="width:185px;" id="sku" type="text" name="sku[]" placeholder="sku" value=""/>&nbsp;<input style="width:185px;" id="price" type="number" min="1" name="price[]" placeholder="price" value=""/>&nbsp;<input style="width:185px;" id="stock" type="number" min="1" name="stock[]" placeholder="stock" value=""/>&nbsp;<a href="javascript:void(0);" class="remove_button" title="Remove field">&nbsp;<i class="fas fa-minus"></i></a></div>';
    var x = 1;
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++;
            $(wrapper).append(fieldHTML);
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    $(".editProductAttr").click(function() {
        var attr_id = $(this).attr('data-id');
        $.ajax({
            type: 'post',
            url: '/admin/show-product-attributes',
            data: { status: 1, attr_id: attr_id },
            success: function (resp) {
                $("#id").val(resp['data']['id']);
                $("#size").val(resp['data']['size']);
                $("#sku").val(resp['data']['sku']);
                $("#price").val(resp['data']['price']);
                $("#stock").val(resp['data']['stock']);
            }
        });
    })


})


