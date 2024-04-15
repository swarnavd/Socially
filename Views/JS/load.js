
$(document).ready(function () {
  $(".com").hide();
  let offset = 0;

  $("#button").click(function () {

    offset += 2;

    $.ajax({
      url: "../Controllers/load.php",
      method: 'POST',
      data: {
        'starting': offset
      },
      success: function (response) {
        // console.log(response);
        $('.post-show').append(response);
        $(".com").hide();
      }

    })
  })
//Like count
  $(document).on("click", ".social", function () {
    var postId = $(this).data('post-id');
    console.log(postId);
    var like = $(this).find('.show-count');

    $.ajax({
      url: "../Controllers/Likecount.php",
      method: 'POST',
      data: {
        'postid':postId
      },
      success: function(res) {
        like.text(res);
        // like1.text(res);
        console.log(res);
      }
    })
  })

  $(document).on("click", ".comment", function () {
    // Assuming the post ID is stored as a data attribute in the button
    var $this = $(this).parent();
    var grandParent = $this.parent();
    grandParent.find(".com").show();
    var postId = $this.data('post-id');
    var commentTextarea = $(this).closest('.comment1').find('.com');
    var comment = commentTextarea.val();

    $.ajax({
      url: "../Controllers/Getcomment.php",
      method: 'POST',
      data: {
        'postid': postId,
        'comment': comment
      },
      success: function (res) {
        grandParent.find('.show-comment').html(res);
      }
    })

  })


  $(document).on("click", "#submit", function () {
    var $this = $(this).parent();
    var postId = $(this).data('post-id');
    var userId = $(this).data('user-id');
    var commentTextarea = $(this).closest('.comment1').find('.com');
    var comment = commentTextarea.val();
    var show = $(this).find('.show-comment');
    console.log("Post ID:", postId);
    console.log("Comment:", comment);
    console.log("uid:", userId);
    $.ajax({
      url: "../Controllers/Insertcomment.php",
      method: 'POST',
      data: {
        'postid': postId,
        'comment': comment,
        'userid': userId
      },
      success: function (res) {
      }
    })
  })
})

