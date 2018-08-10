//when the document is ready 
$(document).ready(function(){
//if the like button is clicked 
$('.like-btn').on('click', function(){
var post_id = $(this).data('id');
$clicked_btn = $(this);
if($clicked_btn.hasClass('fa-thumbs-o-up')){
action = 'like';
}else if($clicked_btn.hasClass('fa-thumbs-up')){
action = 'unlike';
}
$.ajax({
url: './testfile.php',
type : 'post',
data: {
 'action' : action, 
'post_id' : post_id,
'user_id' : 12
},
success: function(data){
res = json.parse(data);
if (action == "like"){
$clicked_btn.removeClass('fa-thumbs-o-up');
$clicked_btn.addClass('fa-thumbs-up');
}else if(action=="unlike"){
 $clicked_btn.removeClass('fa-thumbs-up');
 $clicked_btn.addClass('fa-thumbs-o-up');
} //end of else
//display the number of likes and dislikes
//$clicked_btn.siblings('span.likes').text(res.likes);
//$clicked_btn.sublings('span.dislikes).text(res.dislikes);
//change button style f the other button  
$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');


}//end of function
});
});

//if user clicks the dislike button
$('.dislike-btn').on('click', function(){
    var post_id = $(this).data('id');
    $clicked_btn = $(this);
if($clicked_btn.hasClass('fa-thumbs-o-down')){
action = 'dislike';
}else if($clicked_btn.hasClass('fa-thumbs-down')){
action = 'undislike';
}
$.ajax({
url: '',
type : 'post',
data: {
 'action' : action, 
'post_id' : post_id,
'user_id' : 12
},
success: function(data){
res = json.parse(data);
if (action == "dislike"){
$clicked_btn.removeClass('fa-thumbs-o-down');
$clicked_btn.addClass('fa-thumbs-down');
}else if(action=="undislike"){
 $clicked_btn.removeClass('fa-thumbs-down');
 $clicked_btn.addClass('fa-thumbs-o-down');
} //end of else
//display the number of likes and dislikes
//$clicked_btn.siblings('span.likes').text(res.likes);
//$clicked_btn.sublings('span.dislikes).text(res.dislikes);

//change button style f the other button  
$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
}//end of function
});
});


});//end of function