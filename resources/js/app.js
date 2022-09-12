import './bootstrap';



// delete button click
$('#delete').click(function() {
    const id = $(this).data('id');

    if (id) {
        // const result = window.confirm('Do you want to delete?');
        // if (result) {
        $.ajax({
            url: `/batch_details/${id}/export`,
            type: 'GET',
            success: function(response) {
                if (response && response.status === 'success') {
                    const data = response.data;
                    // $(`#post_${data.id}`).remove();
                }
            }
        });
    } else {
        console.log('error', 'Post not found');
    }
    // }
});
