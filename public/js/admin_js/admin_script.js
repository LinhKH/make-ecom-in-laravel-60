$(document).ready(function() {

    $('.updateSectionStatus').click(function() {
        var status = $(this).text();
        var section_id = $(this).attr('section_id');
        $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp) {
                if(resp['status']==0) {
                    $('#section-'+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Active</a>");
                } else if (resp['status']==1) {
                    $('#section-'+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'>Inactive</a>");
                }
            }
        });
    });

    $('.updateCategoryStatus').click(function() {
        var status = $(this).text();
        var category_id = $(this).attr('category_id');
        $.ajax({
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp) {
                if(resp['status']==0) {
                    $('#category-'+category_id).html("<a class='updateCategooryStatus' href='javascript:void(0)'>Active</a>");
                } else if (resp['status']==1) {
                    $('#category-'+category_id).html("<a class='updateCategooryStatus' href='javascript:void(0)'>Inactive</a>");
                }
            }
        });
    });


})


