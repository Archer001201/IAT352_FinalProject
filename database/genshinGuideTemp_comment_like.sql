SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- table和key使用小驼峰命名
-- table使用复数命名

CREATE TABLE IF NOT EXISTS comment_like(
    -- 查询数据
    userID INT,
    FOREIGN KEY (userID) REFERENCES users(uid),
    commentID INT,
    FOREIGN KEY (commentID) REFERENCES comments(commentID)
);