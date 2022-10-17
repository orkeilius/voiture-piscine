#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        userName     Varchar (50) NOT NULL ,
        userPassword Varchar (255) NOT NULL ,
        userAccess   TinyINT NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (userName)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: POST
#------------------------------------------------------------

CREATE TABLE POST(
        postId      Int  Auto_increment  NOT NULL ,
        postTitle   Varchar (50) NOT NULL ,
        postContent Longtext NOT NULL ,
        postTime    Date NOT NULL ,
        postPinned  Bool ,
        userName    Varchar (50) NOT NULL
	,CONSTRAINT POST_PK PRIMARY KEY (postId)

	,CONSTRAINT POST_user_FK FOREIGN KEY (userName) REFERENCES user(userName)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: postLike
#------------------------------------------------------------

CREATE TABLE postLike(
        userName Varchar (50) NOT NULL ,
        postId   Int NOT NULL
	,CONSTRAINT postLike_PK PRIMARY KEY (userName,postId)

	,CONSTRAINT postLike_user_FK FOREIGN KEY (userName) REFERENCES user(userName)
	,CONSTRAINT postLike_POST0_FK FOREIGN KEY (postId) REFERENCES POST(postId)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: postComment
#------------------------------------------------------------

CREATE TABLE postComment(
        postId         Int NOT NULL ,
        userName       Varchar (50) NOT NULL ,
        commentContent Longtext NOT NULL
	,CONSTRAINT postComment_PK PRIMARY KEY (postId,userName)

	,CONSTRAINT postComment_POST_FK FOREIGN KEY (postId) REFERENCES POST(postId)
	,CONSTRAINT postComment_user0_FK FOREIGN KEY (userName) REFERENCES user(userName)
)ENGINE=InnoDB;

