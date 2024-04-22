
$(document).ready(function () {
  $(".com").hide();
  let offset = 0;
/**
 * A function to load next two post whenever user clicks on load more button.
 */
  $("#button").click(function () {
    // Incrementing the offset value by 2.
    offset += 2;
    $.ajax({
      url: "../Controllers/load.php",
      method: 'POST',
      data: {
        'starting': offset
      },
      success: function (response) {
        // Appending next two post in a particular div after clicking load-more
        //button.
        $('.post-show').append(response);
        $(".com").hide();
      }

    })
  })

/**
 * A function to show number of likes in a particular post to all user.
 */
  $(document).on("click", ".social", function () {
    // Collecting post-id.
    var postId = $(this).data('post-id');
    var like = $(this).find('.show-count');

    $.ajax({
      url: "../Controllers/Likecount.php",
      method: 'POST',
      data: {
        'postid':postId
      },
      success: function(res) {
        like.text(res);
      }
    })
  })
/**
 * A function to display comments in a particular post.
 */
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

/**
 * A function to insert comment to a particular post by different user.
 */
  $(document).on("click", "#submit", function () {
    var $this = $(this).parent();
    var postId = $(this).data('post-id');
    var userId = $(this).data('user-id');
    var commentTextarea = $(this).closest('.comment1').find('.com');
    var comment = commentTextarea.val();
    var show = $(this).find('.show-comment');
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

