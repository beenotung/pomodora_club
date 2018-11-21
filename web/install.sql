create table if not exists user (
  user_id  int                    auto_increment,
  username varchar(20) unique,
  password tinyblob,
  type     enum ('user', 'admin') default 'user',
  primary key (user_id)
);

create table if not exists task (
  task_id     int       auto_increment,
  user_id     int,
  task_name   text,
  finish_time timestamp null default null,
  primary key (task_id),
  foreign key (user_id) references user (user_id)
);