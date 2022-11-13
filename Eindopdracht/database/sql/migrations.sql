create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

INSERT INTO MiniDiscord.migrations (id, migration, batch) VALUES (1, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO MiniDiscord.migrations (id, migration, batch) VALUES (2, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO MiniDiscord.migrations (id, migration, batch) VALUES (3, '2022_10_07_093817_create_tables', 1);
