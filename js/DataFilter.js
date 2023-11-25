$(document).ready(function() {
    // fetchData("../php/charactersGallery.php", "rarity");
    // fetchData("../php/charactersGallery.php", "region");
    // fetchData("../php/charactersGallery.php", "elementType");
    //
    // fetchData("../php/weaponsGallery.php", "rarity");

    fetchData("rarity");
    fetchData("region");
    // fetchData("elementType");
});

// function fetchData(myUrl, keyName){
//     let inputElement = '#' + keyName;
//     $(inputElement).on('change', function (){
//         let result = $(this).val();
//
//         $.ajax({
//             url: myUrl,
//             type: 'GET',
//             data: {[keyName]: result},
//             success: function (response){
//                 $('body').html(response)
//             },
//             error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         })
//     });
// }

function fetchData(keyName) {
    let inputElement = '#' + keyName;
    $(inputElement).on('change', function (){
        let result = $(this).val();

        // 获取当前页面的完整 URL
        let currentUrl = window.location.href;

        // 基于 URL 决定 AJAX 请求的目标地址
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
