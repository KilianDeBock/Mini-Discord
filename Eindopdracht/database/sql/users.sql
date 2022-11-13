create table users
(
    id                bigint unsigned auto_increment
        primary key,
    username          varchar(30)                  not null,
    email             varchar(200)                 not null,
    password          varchar(200)                 not null,
    avatar_url        varchar(200) default '0.png' not null,
    remember_token    varchar(100)                 null,
    email_verified_at timestamp                    null,
    created_at        timestamp                    null,
    updated_at        timestamp                    null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.users (id, username, email, password, avatar_url, remember_token, email_verified_at, created_at, updated_at) VALUES (1, 'User', 'user@lyttle.it', '$2y$10$4C.SiUIoXWQkSHWtjEoaDu5gW4lLT5kqMzKP5XkRFeTLNb.6m9POa', '1.png', 'xjRyWEnnJ12V6iks6tAg04Ng2Qa7t27ByNlkBNwJrOrwIoei074ii4mV3rHI', null, '2022-11-10 09:58:11', '2022-11-10 09:58:11');
INSERT INTO MiniDiscord.users (id, username, email, password, avatar_url, remember_token, email_verified_at, created_at, updated_at) VALUES (2, 'Moderator', 'moderator@lyttle.it', '$2y$10$nCHpa5pufyGEuZCYlVUhuuMKWC7SkpClq7rdIk59QVbZY/dLqRhpe', '2.png', null, null, '2022-11-10 09:59:04', '2022-11-10 09:59:04');
INSERT INTO MiniDiscord.users (id, username, email, password, avatar_url, remember_token, email_verified_at, created_at, updated_at) VALUES (3, 'Writer', 'writer@lyttle.it', '$2y$10$ONvH9ifD1Z9Drg5p4o79AefCvkUevczmpDQr8c8b1pp6itJFRsB7q', '3.png', null, null, '2022-11-10 10:00:04', '2022-11-10 10:00:04');
INSERT INTO MiniDiscord.users (id, username, email, password, avatar_url, remember_token, email_verified_at, created_at, updated_at) VALUES (4, 'Reader', 'reader@lyttle.it', '$2y$10$NiBOCJl9Se5iYbOD4L8jUuGhATmfHFaU5XTiuSb9wHGUU7oJ5wPdm', '4.png', null, null, '2022-11-10 10:00:18', '2022-11-10 10:00:18');
INSERT INTO MiniDiscord.users (id, username, email, password, avatar_url, remember_token, email_verified_at, created_at, updated_at) VALUES (5, 'Admin', 'admin@lyttle.it', '$2y$10$iWntZ1vwvp0iKnp/g05cpuK9Vu7duzLhuyh3jwu3zuP8oNKu80qbK', '5.png', null, null, '2022-11-10 10:02:26', '2022-11-10 10:02:26');
