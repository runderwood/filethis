create table dispatch (
    id serial not null,
    from_num varchar(14) not null,
    timestamp integer not null default extract(EPOCH from CURRENT_TIMESTAMP),
    audio_url varchar(256) not null,
    transcript text
);
