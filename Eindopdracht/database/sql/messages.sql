create table messages
(
    id         bigint unsigned auto_increment
        primary key,
    content    varchar(2000)   not null,
    channel_id bigint unsigned not null,
    message_id bigint unsigned not null,
    user_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (5, 'Yeah, thats my name!', 2, 0, 5, '2022-11-10 10:05:43', '2022-11-10 10:05:43');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (17, ':O', 4, 0, 1, '2022-11-13 12:54:32', '2022-11-13 12:54:32');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (18, 'Ooh, secret', 5, 0, 1, '2022-11-13 12:54:55', '2022-11-13 12:54:55');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (19, 'yes indeed', 5, 0, 5, '2022-11-13 12:54:59', '2022-11-13 12:54:59');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (20, 'Channels channel!', 6, 0, 1, '2022-11-13 12:55:21', '2022-11-13 12:55:21');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (21, 'General', 4, 0, 1, '2022-11-13 12:55:25', '2022-11-13 12:55:25');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (23, 'Look', 2, 0, 5, '2022-11-13 12:56:02', '2022-11-13 12:56:02');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (24, 'My last message was more than 10 minutes ago, so It remade my icon & name', 2, 0, 5, '2022-11-13 12:56:20', '2022-11-13 12:56:20');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (25, 'It also always does this for reactions!', 2, 24, 5, '2022-11-13 12:56:38', '2022-11-13 12:56:38');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (26, 'Always.', 2, 25, 5, '2022-11-13 12:56:43', '2022-11-13 12:56:43');
INSERT INTO MiniDiscord.messages (id, content, channel_id, message_id, user_id, created_at, updated_at) VALUES (27, 'Yes.', 2, 0, 5, '2022-11-13 12:56:45', '2022-11-13 12:56:45');
