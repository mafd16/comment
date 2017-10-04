
--
-- Table Comments
--
DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "UserId" INTEGER,
    "UserName" TEXT,
    "UserEmail" TEXT,
    "comment" TEXT,
    "created" TIMESTAMP,
    "updated" DATETIME,
    "deleted" DATETIME
);
