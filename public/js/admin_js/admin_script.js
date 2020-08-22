$(document).ready(function() {

    $('#current_pwd').keyup(function() {
        var current_pwd = $('#current_pwd').val();
        $.ajax({
            type:'post',
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success: function(resp) {
                if (resp == 'false') {
                    $('#chkCurrendPwd').html("<font color=red>Current Password is incorect</font>");
                } else if (resp == 'true') {
                    $('#chkCurrendPwd').html("<font color=greem>Current Password is corect</font>");
                }
            }, error: function(e) {
                console.log("Error",e);
                alert(e);
            }
        });
    });

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

    $('#section_id').change(function() {
        var section_id = $(this).val();
        $.ajax({
            type:'post',
            url:'/admin/append-categories-level',
            data:{section_id:section_id},
            success: function(resp) {
                $('#appendCategoriesLevel').html(resp);
            },
            error:function(e) {
                console.log(e);
                alert(e);
            }
        });
    });


})


