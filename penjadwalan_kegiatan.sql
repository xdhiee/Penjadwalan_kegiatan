create database penjadwalan_kegiatan;
use penjadwalan_kegiatan;

create table kegiatan (
id_kegiatan int AUTO_INCREMENT primary key,
title varchar(100),
tanggal date,
lokasi varchar(100),
description varchar(100));