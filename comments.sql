create table comments
(
    id           int auto_increment
        primary key,
    parentId     int        default 0                 null,
    date         datetime   default CURRENT_TIMESTAMP null,
    comment_text text                                 not null,
    authorId     char(100)                            null,
    author_name  char(10)                             null,
    hide         tinyint(1) default 0                 null
);