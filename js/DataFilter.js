/*
当当前页面的DOM结构加载完成之后，执行此函数
调用fetchData函数以监听Gallery页面的下拉菜单输入
 */
$(document).ready(function() {
    fetchData("characterRarity");
    fetchData("region");
    fetchData("elementType");
    fetchData("character_weaponType");

    fetchData("weaponRarity");
    fetchData("weapon_weaponType");
});

function fetchData(keyName) {
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

