SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- table和key使用小驼峰命名
-- table使用复数命名

CREATE TABLE IF NOT EXISTS users(
    userID INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS weaponTypes(
    weaponTypeID INT AUTO_INCREMENT PRIMARY KEY,
    weaponTypeName VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS characters(
    characterID INT AUTO_INCREMENT PRIMARY KEY,
    -- 查询数据
    name VARCHAR(50) NOT NULL,
    elementType VARCHAR(20) NOT NULL,
    region VARCHAR(20) NOT NULL,
    rarity VARCHAR(20) NOT NULL,
    weaponTypeID INT,
    FOREIGN KEY (weaponTypeID) REFERENCES weaponTypes(weaponTypeID),
    -- url数据
    image VARCHAR(255),
    description TEXT
);

CREATE TABLE IF NOT EXISTS weapons(
    weaponID INT AUTO_INCREMENT PRIMARY KEY,
    -- 查询数据
    name VARCHAR(50) NOT NULL,
    weaponRarity VARCHAR(20) NOT NULL,
    weaponTypeID INT,
    FOREIGN KEY (weaponTypeID) REFERENCES weaponTypes(weaponTypeID),
    -- url数据
    image VARCHAR(255),
    description TEXT
);

CREATE TABLE IF NOT EXISTS artifacts(
    artifactID INT AUTO_INCREMENT PRIMARY KEY,
    -- 查询数据
    name VARCHAR(50) NOT NULL,
    -- url数据
    image VARCHAR(255),
    description TEXT
);

CREATE TABLE IF NOT EXISTS guides(
    guideID INT AUTO_INCREMENT PRIMARY KEY,
    postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- 查询数据
    likes INT DEFAULT 0,
    favorites INT DEFAULT 0,
    characterID INT,
    FOREIGN KEY (characterID) REFERENCES characters(characterID),
    userID INT,
    FOREIGN KEY (userID) REFERENCES users(userID),
    -- 攻略数据
    guideTitle VARCHAR(255) NOT NULL,
    guideDescription TEXT,
    bestWeaponID INT,
    FOREIGN KEY (bestWeaponID) REFERENCES weapons(weaponID),
    replacementWeaponID INT,
    FOREIGN KEY (replacementWeaponID) REFERENCES weapons(weaponID),
    artifactID_1 INT,
    FOREIGN KEY (artifactID_1) REFERENCES artifacts(artifactID),
    artifactID_2 INT,
    FOREIGN KEY (artifactID_2) REFERENCES artifacts(artifactID)
);

CREATE TABLE IF NOT EXISTS user_favorite(
    -- 查询数据
    userID INT,
    FOREIGN KEY (userID) REFERENCES users(userID),
    guideID INT,
    FOREIGN KEY (guideID) REFERENCES guides(guideID)
);

CREATE TABLE IF NOT EXISTS comments(
    commentID INT AUTO_INCREMENT PRIMARY KEY,
    postDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    text TEXT,
    likes INT DEFAULT 0,
    -- 查询数据
    userID INT,
    FOREIGN KEY (userID) REFERENCES users(userID),
    guideID INT,
    FOREIGN KEY (guideID) REFERENCES guides(guideID)
)