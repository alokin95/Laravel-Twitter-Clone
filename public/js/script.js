$(document).ready(function(){

    $(".show-comments").on('click', function(){

        $(".response-comments").empty();

        var tweet_id = this.id;

        $.ajax({
            type: 'GET',
            url : BASE_URL + "/comments",
            _token : TOKEN,
            data: {
                id : tweet_id
            },
            success: function (response) {
                var text = "";
                if (response.length>0){
                    $.each(response, function(index, value){
                        text+=`<a href="${BASE_URL}user/${value['user']['id']}">${value['user']['name']}</a> 

                        <div class='col-lg-8 tweet-body'>
                            ${value['body']}
                        </div><hr>`;
                    });
                }
                $("#tweetid_"+tweet_id).html(text);

            }
        })
    });

    $(".vote").on('click', function(){
        var tweet_id = this.id;
        var value = this.value;
        var parent = $(this).parent();
        $.ajax({
           url: BASE_URL + 'vote/' +tweet_id +'/value/'+ value,
            type: "GET",
            data: {
               tweet_id : tweet_id,
                value : value,
                _token : TOKEN
            },
            success: function(response){
               var text = '<i>Rating: ' +response+ '</i>';
               parent.html(text);
            }
        });
    });

    $("#add-comment").on('click', function(){

        var comment = $("#comment").val();
        var tweetid = $("#hidden-id").val();

        $.ajax({
            url: BASE_URL + 'comments/' + tweetid,
            type: 'POST',
            data: {
                comment: comment,
                tweetid: tweetid,
                _token: TOKEN
            },
            success: function(response){

                var text=`<a href="${BASE_URL}user/${response['id']}">${response['name']}</a> 

                        <div class='col-lg-8 tweet-body'>
                            ${response['comments'][0]['body']}
                        </div><hr>`;

                $("#tweetid_"+tweetid).append(text);

                $("#mymodal-"+tweetid).animate({ scrollTop: $("#mymodal-"+tweetid)[0].scrollHeight}, 1000);

            }
        })
    });

    $(".delete").on('click', function(e){
        var tweetid = $(this).attr('id');

        $.ajax({
            url: BASE_URL + 'delete/' + tweetid,
            type: "GET",
            data: {
                tweetid: tweetid
            },
            success: function(response){
                $("#tweet-"+tweetid).remove();
            }
        })
    })


    document.getElementById("uploadBtn").addEventListener('change', function(){
        document.getElementById("uploadFile").value = this.value;
    });

});

function mail(){
    var mail = document.getElementById('email');
    var regMail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    if(!regMail.test(mail.value)) {
        mail.style.borderColor='red';
    }
    else {
        mail.style.borderColor='green';
    }
}

