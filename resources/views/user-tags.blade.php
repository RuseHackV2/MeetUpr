<div id="content{{$userId}}">

</div>
@if(\Auth::id() != $userId))
<div>
    <select class="select2" placeholder="please select" id="tag{{$userId}}">
        <option value=""></option>
    @foreach($tags as $id => $tag)
        <option value="{{$id}}">{{$tag}}</option>
    @endforeach
    </select>

    <input class="btn" type="button" onclick="add{{$userId}}()" value="Add" >
</div>
@endif

<script>
$(function(){
    refreshPlayerTags{{$userId}}();
})

function add{{$userId}}()
{
    if($('#tag{{$userId}}').val() != undefined) {
        var tagId = $('#tag{{$userId}}').val();
        var url = "/user/tags/add/{{$userId}}/" + tagId
        $.get( url, function( data ) {
            refreshPlayerTags{{$userId}}();
        });
    }
}

function refreshPlayerTags{{$userId}}()
{
    var url = "/user/tags/get/{{$userId}}";

    $.get( url, function( data ) {

        if(data.length == 0) {
            return '';
        }
        $str = "<div class='tags'>";
        for(i = 0; i < data.length; i++) {
            $str += "<span class='tag label label-info'>" + data[i].count_tags  + ' x ' + data[i].name + "</span>";
        }
        $str += '</div>';
        $('#content{{$userId}}').html($str);
    });
}

</script>