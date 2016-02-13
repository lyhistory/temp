/**
 * Created by linwei on 2015/7/23.
 */
function ajaxQueryByPost(queryUrl ,type , data)
{
    $.ajax({
        type: "POST",
        url: queryUrl,
        data: data,
        success: function(msg){
                processData(msg, type);
        }
    });
}
function queryByGet(queryUrl, type)
{
    $.get(queryUrl,function(data){
        processData(data);
    });
}
//回调信息处理
function processData(data) {
    try{obj =$.parseJSON(data);
       if (obj.hasOwnProperty("type")){
            processIndData(obj);
        }
    }
    catch (err){
        return;
    }

}

