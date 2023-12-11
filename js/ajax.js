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

    sortingDataByDropdown("guideSorting", "characterGuides", "guidesContainer");
    sortingDataByDropdown("favorite_guideSorting", "userFavoritedGuides", "guidesContainer");
    sortingDataByDropdown("post_guideSorting", "userPostedGuides", "guidesContainer");
    sortingDataByDropdown("commentSorting", "comment", "commentContainer");

    loadGuides("characterGuides", "guidesContainer", "characterDetail");
    loadGuides("userFavoritedGuides", "guidesContainer", "favorites");
    loadGuides("userPostedGuides", "guidesContainer", "posts");

    submitComment();
    loadComments();
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

function sortingDataByDropdown(keyName, page, responseId) {
    let myUrl = "../php/" + page + ".php";
    let inputElement = '#' + keyName;
    $(inputElement).on('change', function (){
        let result = $(this).val();

        $.ajax({
            url: myUrl,
            type: 'GET',
            data: {[keyName]: "sorting_" + result},
            success: function (response){
                console.log(response);
                $('#' + responseId).html(response);
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
            myUrl = "../php/characters.php";
        } else if (currentUrl.includes("weaponsGallery.php")) {
            myUrl = "../php/weapons.php";
        } else {
            console.error("Unable to determine the target URL for AJAX request");
            return;
        }

        $.ajax({
            url: myUrl,
            type: 'GET',
            data: {[keyName]: result},
            success: function (response){
                $('#card-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}

function loadGuides(myUrl, responseId,keyword) {
    var currentUrl = window.location.href;
    if (currentUrl.includes(keyword)) {
        $.ajax({
            type: "POST",
            url: "../php/" + myUrl + ".php",
            data: {loadGuides: true}, // 或者您可以根据需要传递其他数据
            success: function (response) {
                $("#" + responseId).html(response);
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}

function loadComments() {
    $.ajax({
        type: "POST",
        url: "../php/comment.php",
        data: { loadComments: true }, // 或者您可以根据需要传递其他数据
        success: function(response) {
            $("#comment-container").html(response);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function submitComment() {
    $('#submitComment').click(function() {
        let comment = $('#commentText').val();
        $.ajax({
            type: "POST",
            url: "../php/comment.php",
            data: { postComment: comment },
            success: function(response) {
                if (isNumeric(response.toString().trim())) {
                    loadComments();
                    setTimeout(function() {
                        let commentSelector = '#commentID_' + response;
                        $('html, body').animate({
                            scrollTop: $(commentSelector).offset().top
                        }, 500);
                    }, 1000);
                    $('#commentText').val('');
                    // loadComments();
                    alert('Your comment has been submitted!');
                } else {
                    $("#comment-container").html(response);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
}

function isNumeric(str) {
    return !isNaN(str) && !isNaN(parseFloat(str));
}



document.addEventListener("DOMContentLoaded", function() {
    let button = document.getElementById("toggleButton");
    let textArea = document.getElementById('commentInput');

    if (button == null) return;

    button.addEventListener("click", function() {
        if (!isLogin) {
            window.location.href = '../php/sign-in.php?loginRequest=comment';
            return;
        }
        if (textArea.style.display === "none") {
            textArea.style.display = "flex";
            button.textContent = "Cancel";
        } else {
            textArea.style.display = "none";
            button.textContent = "Post Comment";
        }
    });
});








