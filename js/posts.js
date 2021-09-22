
$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: "api/post.php?posts",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            //console.log(response);
            for (let i = 0; i < response.data.length; i++) {
                createNewElement(response.data[i].title, response.data[i].content, response.data[i].createAt, response.data[i].username, response.data[i].id);
            }
            $(".post-delete").on("click",function(){
                var post_id=($(this)[0].id).split("-")[1];
                
                delete_post(post_id);
            });
        }
    });   
});

function createNewElement(title, post, created_at, user, id){

    var post_div='<div class="post1"><span>'+created_at+'</span><span>'+user+'<span><h2>'+title+'</h2><p>'+post+'</p><a href="#" class="post-delete" id="post_delete-'+id+'">remove</a> <a href="#" class="post-update" id="post_edit-'+id+'">Edit</a></div>';
    //$(".posts").html(post_div);
    html_div=$.parseHTML(post_div);
    $(".posts").append(html_div);

}

function delete_post(post_id){
    console.log(post_id);

    $.ajax({
        type: "DELETE",
        url: "api/post.php",
        data: JSON.stringify({
            id: post_id
        }),
        contentType:"application/json; charset=utf8",
        dataType: "json",
        success: function (response) {
            console.log(response.message);
        }
    });
}

function create_post_from(){
    var post_div='<div class="post1"><span>'+created_at+'</span><span>'+user+'<span><h2>'+title+'</h2><p>'+post+'</p><a href="#" class="post-delete" id="post_delete-'+id+'">remove</a> <a href="#" class="post-update" id="post_edit-'+id+'">Edit</a></div>';
    //$(".posts").html(post_div);
    html_div=$.parseHTML(post_div);
    $(".posts").append(html_div);
}

function edit_post(post_id, title, content, thumbnail){
    console.log(post_id);

    $.ajax({
        type: "PUT",
        url: "api/post.php",
        data: JSON.stringify({
            id:id,
            title:title,
            content:content,
            thumbnail:thumbnail
        }),
        contentType:"application/json; charset=utf-8";
        dataType: "json",
        success: function (response) {
            console.log(response.message);
        }
    });
}


$("#button_id").on("click", function () {
    var title=$("#title_id").val();
    var post=$("#post_id").val();


    //createNewElement(title, post);

    $.ajax({
        type: "POST",
        url: "api/post.php",
        data: JSON.stringify({
            title: title,
            content: post,
            thumbnail:null,
            user_id:2
        }),
        contentType:"application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            console.log(response.message);
        }
    });

    return false;
});

