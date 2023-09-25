-- -------------------------------------------------------------
-- TablePlus 3.12.6(366)
--
-- https://tableplus.com/
--
-- Database: homestead
-- Generation Time: 2023-09-24 21:19:48.8740
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."employees";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS employees_id_seq;

-- Table Definition
CREATE TABLE "public"."employees" (
    "id" int4 NOT NULL DEFAULT nextval('employees_id_seq'::regclass),
    "name" varchar NOT NULL,
    "company_name" varchar NOT NULL,
    "email" varchar,
    "salary" int4,
    PRIMARY KEY ("id")
);

