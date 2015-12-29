function newPost(){

    $("#newPostBtn").remove();

    var newPostHtml = '<div id="addPostContainer"> <p>Add a Post</p> <form id="addPostForm" method="post" action=""> <div> <label for="title">Post Title</label> <input type="text" id="title" name="title"/> <label for="body">Post Body</label> <textarea name="body" id="body" cols="20" rows="5"></textarea> <input type="hidden" name="country" id="country" value="\'.$country.\'" /> <input type="hidden" name="user" id="user" value="\'.$user.\'" /> <input type="submit" id="submit" value="Submit" /> </div> </form> </div>';
    $("#newPost").html(newPostHtml);

}