function addVote(id, vote_rank){

    $.ajax({

        url: 'addVote.php',
        data: 'id='+id+'&vote_rank='+vote_rank,
        type: 'POST',
        beforeSend: function(){
            $('.btn-votes').html("<img src='images/LoaderIcon.gif' />");
        },
        success: function(vote_rank_status){

            var votes = parseInt($('#votes-'+id).val());

            switch(vote_rank) {
                case "1":
                    votes += 1;
                    //vote_rank_status = vote_rank_status+1;
                    break;
                case "-1":
                    votes -= 1;
                    //vote_rank_status = vote_rank_status-1;
                    break;
            }
            $('#votes-'+id).val(votes);

            //console.log(vote_rank_status);

            var up,down;
            if(vote_rank_status == 1){
                up = 'disabled';
                down = 'enabled';
            }
            if(vote_rank_status == -1){
                up = 'enabled';
                down = 'disabled';
            }

            // changing html vote label and buttons
            var vote_button_html = '<input type="button" title="Up" class="up" onClick="addVote('+id+',\'1\')" '+up+' /><div class="label-votes">'+votes+'</div><input type="button" title="Down" class="down"  onClick="addVote('+id+',\'-1\')" '+down+' />';
            $('.btn-votes').html(vote_button_html);

        }

    });
}