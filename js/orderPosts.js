function orderBy(param,country){

    $.ajax({
        url: 'orderPosts.php',
        data: 'param='+param+'&country='+country,
        type: 'POST',

        success: function(postHtml){

            $('#blogSpace').html(postHtml);

        }
    });

}

function filterPostsWithUsername(country){

    var username = $('#user_filter').val();

    $.ajax({
        url: 'orderPosts.php',
        data: 'country='+country+'&username='+username,
        type: 'POST',

        success: function(postHtml){

            $('#blogSpace').html(postHtml);
            $('#user_filter').val('');

        }
    });

}