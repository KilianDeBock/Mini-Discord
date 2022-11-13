create table channels
(
    id          bigint unsigned auto_increment
        primary key,
    name        varchar(30)     not null,
    description varchar(200)    not null,
    guild_id    bigint unsigned not null,
    created_at  timestamp       null,
    updated_at  timestamp       null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.channels (id, name, description, guild_id, created_at, updated_at) VALUES (2, 'general', 'All about general stuff', 2, '2022-11-10 10:05:26', '2022-11-10 10:05:26');
INSERT INTO MiniDiscord.channels (id, name, description, guild_id, created_at, updated_at) VALUES (4, 'general', 'All about general stuff', 3, '2022-11-13 12:54:27', '2022-11-13 12:54:27');
INSERT INTO MiniDiscord.channels (id, name, description, guild_id, created_at, updated_at) VALUES (5, 'general', 'All about general stuff', 4, '2022-11-13 12:54:42', '2022-11-13 12:54:42');
INSERT INTO MiniDiscord.channels (id, name, description, guild_id, created_at, updated_at) VALUES (6, 'New channel', 'About channels', 3, '2022-11-13 12:55:16', '2022-11-13 12:55:16');
