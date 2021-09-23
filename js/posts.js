
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
            $(".post-edit").on("click",function(){
                var post_id=$(this)[0].id;
                $(".update_form").show();
                var real_id=post_id.split("-")[1];
                var posts_children=$("#"+post_id)[0].parentNode.children;
                var title=posts_children[2].textContent;
                var post=posts_children[3].textContent;
                $("#ed_post").val(real_id);
                $("#update_title").val(title);
                $("#update_post").val(post);
            });
            
        }
    });   
});

$(".create-post").on("click", function () {
    console.log("ide belép");
    $(".insert_form").show();
});

$("#update_btn").on("click", function(){
    var ed_post=$("#ed_post").val();
    var update_title=$("#update_title").val();
    var update_post=$("#update_post").val();
    var thumbnail="";
    
    edit_post(ed_post, update_title, update_post, thumbnail);

    //return false;
})

function createNewElement(title, post, created_at, user, id){

    var post_div='<div class="post1"><span>'+created_at+'</span><h2>'+title+'</h2><p>'+post+'</p><a href="#" class="post-delete" id="post_delete-'+id+'">remove</a> <a href="#" class="post-edit" id="post_edit-'+id+'">Edit</a></div>';
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
            alert(response.message);
            location.href="http://localhost/fazi-blog/";
        }
    });

    return false;
}

function edit_post(post_id, title, content, thumbnail){
    console.log(post_id);

    $.ajax({
        type: "PUT",
        url: "api/post.php",
        data: JSON.stringify({
            id:post_id,
            title:title,
            content:content,
            thumbnail:thumbnail
        }),
        contentType:"application/json; charset=utf-8",
        dataType: "json",
        success: function (response) {
            alert(response.message);
        }
    });
}


$("#insert_btn").on("click", function () {
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
            alert(response.message);
        }
    });
});

