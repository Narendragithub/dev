$(document).on('click','.delete',function(){
    return confirm('Are you sure you want to delete this '+$(this).attr('prop')+' ?');
});

