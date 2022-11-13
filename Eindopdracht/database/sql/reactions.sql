create table reactions
(
    id         bigint unsigned auto_increment
        primary key,
    reaction   varchar(20)     not null,
    message_id bigint unsigned not null,
    user_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null
)
    collate = utf8mb4_unicode_ci;

