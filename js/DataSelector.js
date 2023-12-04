/*
当当前页面的DOM结构加载完成之后，执行此函数
调用fetchData函数以监听Gallery页面的下拉菜单输入
 */
$(document).ready(function() {
    selectData("bestWeapon");
    selectData("replacementWeapon");
    selectData("artifacts_1");
    selectData("artifacts_2");
});

/*
使用ajax监听下拉菜单选项并实时更新页面显示内容
fetchData函数会自动获取当前的php页面是charactersGallery还是weaponsGallery，所以该函数只能用于Gallery页面的数据查询和筛选
keyName -> jquery和ajax需要获取和更新的元素
 */
function selectData(keyName) {
    let inputElement = '#' + keyName;
    $(inputElement).on('change', function (){
        let result = $(this).val();

        $.ajax({
            url: "newGuide.php",
            type: 'GET',
            data: {[keyName]: result},
            success: function (response){
                $("body").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}

