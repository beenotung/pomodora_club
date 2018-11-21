create table if not exists user (
  user_id  int                    auto_increment,
  username varchar(20) unique,
  password tinyblob,
  type     enum ('user', 'admin') default 'user',
  primary key (user_id)
);