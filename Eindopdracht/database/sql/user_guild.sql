create table user_guild
(
    user_id  bigint unsigned not null,
    guild_id bigint unsigned not null,
    primary key (user_id, guild_id)
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.user_guild (user_id, guild_id) VALUES (1, 2);
INSERT INTO MiniDiscord.user_guild (user_id, guild_id) VALUES (1, 4);
INSERT INTO MiniDiscord.user_guild (user_id, guild_id) VALUES (5, 1);
