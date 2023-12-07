/*
当当前页面的DOM结构加载完成之后，执行此函数
调用fetchData函数以监听Gallery页面的下拉菜单输入
 */
$(document).ready(function() {
    handleDataByButton("userLike");
    handleDataFromBackEnd("userLike");
    handleDataByButton("userFavorite");
    handleDataFromBackEnd("userFavorite");
});


function handleDataByButton(keyName){
    $('.' + keyName).click(function() {
        if (!isLogin) {
            window.location.href = '../php/sign-in.php?loginRequest=' + keyName;
            return;
        }
        let button = $(this);
        let myUrl;
        if (keyName === "userLike") myUrl = "../php/handleUserLikes.php";
        else if (keyName === "userFavorite") myUrl = "../php/handleUserFavorites.php";
        else return;
        let guideId = $(this).data('guide-id');
        let field = keyName + '_guideId';
        $.ajax({
            type: 'POST',
            url: myUrl,
            data: { [field]: guideId },
            success: function(response) {
                button.toggleClass('added');
                if (button.hasClass('added')) alert('点赞成功！');
                else alert('取消点赞！');
            },
            error: function() {
                alert('点赞失败！');
            }
        });
    });
}

function handleDataFromBackEnd(keyName){
    let myUrl;
    if (keyName === "userLike") myUrl = "getUserLikes.php";
    else if (keyName === "userFavorite") myUrl = "getUserFavorites.php";
    else return;
    $.ajax({
        type: 'GET',
        url: myUrl,
        success: function(response) {
            let guides = JSON.parse(response);
            guides.forEach(function(guideId) {
                $('button.' + keyName + '[data-guide-id="' + guideId + '"]').addClass('added');
            });
        }
    });
}
