create table guilds
(
    id          bigint unsigned auto_increment
        primary key,
    displayname varchar(30)     not null,
    avatar_url  varchar(200)    not null,
    banner_url  varchar(200)    not null,
    user_id     bigint unsigned not null,
    created_at  timestamp       null,
    updated_at  timestamp       null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.guilds (id, displayname, avatar_url, banner_url, user_id, created_at, updated_at) VALUES (2, 'Admin Server', '2.png', '0.png', 5, '2022-11-10 10:05:26', '2022-11-10 10:05:26');
INSERT INTO MiniDiscord.guilds (id, displayname, avatar_url, banner_url, user_id, created_at, updated_at) VALUES (3, 'Stualyttle''s Server', '3.png', '0.png', 1, '2022-11-13 12:54:27', '2022-11-13 12:54:27');
INSERT INTO MiniDiscord.guilds (id, displayname, avatar_url, banner_url, user_id, created_at, updated_at) VALUES (4, 'Test', '0.png', '0.png', 5, '2022-11-13 12:54:42', '2022-11-13 12:54:42');
