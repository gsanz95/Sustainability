$(document).ready(function(){
    $(".like-btn").click(function(){
        var post_id = $(this).data('id');
        var user_id = $(this).data('userid');
        $clicked_btn = $(this);
        if($clicked_btn.hasClass('fa-thumbs-o-up')){
              action = 'like'; 
              //alert(action);
        }else if($clicked_btn.hasClass('fa-thumbs-up')){
              action = 'unlike';
              //alert(action);
        }
        $.ajax({
            url: 'home.php',
            type: 'post',
            data:{
                'action': action,
                'post_id':post_id,
                'user_id' :user_id
            },
            success: function(){ 
                //res = JSON.parse(data);
                if(action == "like"){
                    $clicked_btn.removeClass('fa-thumbs-o-up');
                    $clicked_btn.addClass('fa-thumbs-up');
                }else if(action == "unlike"){
                    //alert("unlike");
                    $clicked_btn.removeClass('fa-thumbs-up');
                    $clicked_btn.addClass('fa-thumbs-o-up');
                } 
                $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
            },
           

        });
    });

    $(".dislike-btn").click(function(){
        var post_id = $(this).data('id');
        var user_id = $(this).data('userid');
        $clicked_btn = $(this);
        if($clicked_btn.hasClass('fa-thumbs-o-down')){
            action = 'dislike'; 
            alert(user_id);
      }else if($clicked_btn.hasClass('fa-thumbs-down')){
            action = 'undislike';
            //alert(action);
      }
      $.ajax({
          url: 'home.php',
          type: 'post',
          data:{
              'action': action,
              'post_id':post_id,
              'user_id' :user_id
          },
          success: function(){ 
              //res = JSON.parse(data);
              if(action == "dislike"){
                  $clicked_btn.removeClass('fa-thumbs-o-down');
                  $clicked_btn.addClass('fa-thumbs-down');
              }else if(action == "undislike"){
                  //alert("unlike");
                  $clicked_btn.removeClass('fa-thumbs-down');
                  $clicked_btn.addClass('fa-thumbs-o-down');
              } 
              $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
          },
         

      });



    });


    $(".getcomments").click(function(){ 
       var post_id = $(this).attr('data-postid');
       var last_comment_id = $(this).attr('data-lastcommentid'); 
       
        $.ajax({
           url:'testfile.php',
           type:'post',
           data:{
             'postid' :post_id,
              'last_comment_id': last_comment_id
           },
          success:function(data){
              var res = JSON.parse(data);
            // var alpha = ['a','b','c','d','e'];
              var $newdiv;
              var comment = 'a';
              alert(last_comment_id);
              for (var i = 0; i < 5; i++) {
                switch(comment){
                    case 'a':
                    $newdiv = $("<div class='ci'>" + res.a[0].com + "<br>" + res.a[0].comby + "<hr> </div>");
                    $("." + post_id).append($newdiv);
                    comment = 'b';
                    break;
                    case 'b':
                    $newdiv = $("<div class='ci'>" + res.b[0].com + "<br>" + res.b[0].comby + "<hr> </div>");
                    $("." + post_id).append($newdiv);
                    comment ='c';
                    break;
                    case  'c':
                    $newdiv = $("<div class='ci'>" + res.c[0].com + "<br>" + res.c[0].comby + "<hr> </div>");
                    $("." + post_id).append($newdiv);
                    comment ='d';
                    break;
                    case  'd':
                    $newdiv = $("<div class='ci'>" + res.d[0].com + "<br>" + res.d[0].comby + "<hr> </div>");
                    $("." + post_id).append($newdiv);
                    comment = 'e';
                    break;
                    case 'e':
                    $newdiv = $("<div class='ci'>" + res.e[0].com + "<br>" + res.e[0].comby + "<hr> </div>");
                    $("." + post_id).append($newdiv);
                    comment ='';
                    break;
                    default:
                 }
                 // $newdiv = $("<div class='ci'>" + res.a[0].com + "<br>" + res.a[0].comby + "<hr> </div>");
                 // $("." + post_id).append($newdiv);
              }
              last_comment_id = res.last;
              $('.getcomments').data('lastcommentid', last_comment_id);
             // alert(last_comment_id); 
              //var com_a = res.a[0].com;
              //var com_a_by = res.a[0].comby;
             //var string1 = "<div class='ci'>" + com_a + "<br>" + com_a_by + "<hr> </div>" ; 
             //  var com_b = res.b[0].com;
            //  var com_b_by = res.b[0].comby;
             // var string2 = "<div class='ci'>" + com_b + "<br>" + com_b_by + "<hr> </div>" ;
             /*var com_c = res.c[0].com;
              var com_c_by = res.c[0].comby;
              var string3 = "<div class='ci'>" + com_c + "<br>" + com_c_by + "<hr> </div>" ;
              var com_d = res.d[0].com;
              var com_d_by = res.d[0].comby;
              var string4 = "<div class='ci'>" + com_d + "<br>" + com_d_by + "<hr> </div>" ;
              var com_e = res.e[0].com;
              var com_e_by = res.e[0].comby;
              var string5 = "<div class='ci'>" + com_e + "<br>" + com_e_by + "<hr> </div>" ;*/
             // var list = [ string2];
             //$( ).append(list);

           }

       });

    });

   /* $(".getcomments").click(function(){
       
        //alert(last_comment_id);
        $.ajax({
            url: '',
           type : 'post',
           data :{
              'postid': post_id,
              'last_comment_id' : last_comment_id 

           },
           success: function(data){
           var res  = JSON.parse(data);
           var count = 0;
           var comment = 'a';
           while(count < 5){
             switch(comment){
                case 'a':
                      res.a[0].com;
                     comment = 'b';
                break;
                case 'b':
                    res.b[0].com;
                    comment ='c';
                break;
                case  'c':
                      res.c[0].com;
                    comment ='d';
                break;
                case  'd':
                    res.d[0].com;
                    comment = 'e';
                break;
                case 'e':
                    res.e[0].com;
                    comment ='';
                break;
                default:
             }
            count++;
           }


           }


        })*/

        $('window').scroll(function(){
            if($('window').scrollTop() + $('window').height() >= $('document').height()){
                var last_id = $('.post:last').attr('id');
                loadMoreData(last_id);
            }

        });
        function loadMoreData(last_id){
            $.ajax(
                {
                    url:'home.php',
                    type:'get',

                })
                .done (function(data){

                    $("#")
                })
        }


    });