/*
当当前页面的DOM结构加载完成之后，执行此函数
调用fetchData函数以监听Gallery页面的下拉菜单输入
 */
$(document).ready(function() {
    updateImageByDropdown("bestWeapon");
    updateImageByDropdown("replacementWeapon");
    updateImageByDropdown("artifacts_1");
    updateImageByDropdown("artifacts_2");

    filterDataByRadio("characterRarity");
    filterDataByRadio("region");
    filterDataByRadio("elementType");
    filterDataByRadio("character_weaponType");
    filterDataByRadio("weaponRarity");
    filterDataByRadio("weapon_weaponType");

    handleDataByButton("userLike");
});

/*
使用ajax监听下拉菜单选项并实时更新页面显示内容
fetchData函数会自动获取当前的php页面是charactersGallery还是weaponsGallery，所以该函数只能用于Gallery页面的数据查询和筛选
keyName -> jquery和ajax需要获取和更新的元素
 */
function updateImageByDropdown(keyName) {
    let inputElement = '#' + keyName;
    let responseElement = "#" + keyName + "_image";
    $(inputElement).on('change', function (){
        let result = $(this).val();

        $.ajax({
            url: "getImageUrl.php",
            type: 'GET',
            data: {[keyName]: result},
            success: function (response){
                console.log(response);
                $(responseElement).attr('src', response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}

function filterDataByRadio(keyName) {
    let inputElements = 'input[type=radio][name=' + keyName + ']';
    $(inputElements).on('change', function (){
        let result = $(this).val();

        let currentUrl = window.location.href;

        let myUrl;
        if (currentUrl.includes("charactersGallery.php")) {
            myUrl = "../php/charactersGallery.php";
        } else if (currentUrl.includes("weaponsGallery.php")) {
            myUrl = "../php/weaponsGallery.php";
        } else {
            console.error("Unable to determine the target URL for AJAX request");
            return;
        }

        $.ajax({
            url: myUrl,
            type: 'GET',
            data: {[keyName]: result},
            success: function (response){
                $('body').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}

function handleDataByButton(keyName){
    $('#' + keyName).click(function() {
        if (!isLogin) {
            window.location.href = '../php/sign-in.php?loginRequest=' + keyName;
            return;
        }
        let guideId = $(this).data('guide-id');
        let field = keyName + '_guideId';
        $.ajax({
            type: 'POST',
            url: 'characterDetail.php',
            data: { [field]: guideId },
            success: function(response) {
                alert('点赞成功！');
            },
            error: function() {
                alert('点赞失败！');
            }
        });
    });
}

