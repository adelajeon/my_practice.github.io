# ------------------------------------------- 데이터베이스 생성 -------------------------------------------------
CREATE DATABASE projectdb; -- projectdb 생성

# -------------------------------------------------------------------------------------------------------



# ------------------------------------------- 테이블 생성 -------------------------------------------------
USE projectdb;  -- projectdb를 사용하겠다는 의미

# prodtbl 생성
CREATE TABLE prodtbl  -- 제품 테이블
(	prodNum INT(5) AUTO_INCREMENT NOT NULL PRIMARY KEY,  -- 제품 아이디(PK)
	TYPE CHAR(8), -- 제품 모델명
	TIME TIME,  -- 제품 생성된 시간
	DATE DATE,  -- 제품 생성된 일자
	beltNum CHAR(4),  -- 벨트 번호
	managerNum char(8)  -- 사원 번호
);
ALTER TABLE prodtbl auto_increment = 1000; -- 시작 번호 1000

# memtbl 생성
CREATE TABLE memtbl  -- 사원 테이블
(	managerNum CHAR(8) NOT NULL PRIMARY KEY,  -- 사용자 아이디(PK)
	NAME CHAR(4) NOT NULL,  -- 이름
	extensionNum char(5),  -- 내선 번호
	beltNum CHAR(4)  -- 벨트 번호
);

# standtbl 생성
CREATE TABLE standtbl  -- 판단 기준 테이블
(	TYPE CHAR(8) NOT NULL PRIMARY KEY,  -- 모델명
	foldSize INT(3),  -- 접었을 때 크기
	unfoldSize INT(3),  -- 폈을 때 크기
	weight INT(4),  -- 무게
	term INT(3),  -- 접었을 때의 간격
	wellFold INT(3),  -- 잘 접히는지
	waterProof INT(3),  -- 방수 잘 되는지
	keyTest INT(3)  -- 키테스트
);

# colltbl 생성
CREATE TABLE colltbl  -- 수집 테이블
(	currentAmount INT(5) AUTO_INCREMENT NOT NULL PRIMARY KEY,  -- 제작수량
	prodNum INT(5) NOT NULL,  -- 제품 아이디(FK)
	foldSize INT(3),  -- 접었을 때 크기
	unfoldSize INT(3),  -- 폈을 때 크기
	weight INT(4),  -- 무게
	term INT(3),  -- 접었을 때의 간격
	wellFold INT(3),  -- 잘 접히는지
	waterProof INT(3),  -- 방수 잘 되는지
	keyTest INT(3),  -- 키테스트
	FOREIGN KEY(prodNum) REFERENCES prodtbl(prodNum)  -- FK
);
ALTER TABLE colltbl AUTO_INCREMENT = 1; -- 시작 번호 1

# remaketbl 생성
CREATE TABLE remaketbl  -- 가공 테이블
(	currentAmount INT(5),  -- 제작수량
	testScore INT(3) NOT NULL,  -- 테스트 점수
	defectYorN INT(3),  -- 불량 유무
	FOREIGN KEY(currentAmount) REFERENCES colltbl(currentAmount)  -- FK
);

# finaltbl 생성
CREATE TABLE finaltbl  -- 최종 테이블
(	targetAmount INT(4),  -- 목표수량
	good INT(4),  -- 테스트 점수 95점 이상의 제품 수량
	bad INT(4),  -- 테스트 점수 95 미만의 제품 수량
	defectPercent FLOAT,  -- 불량률
	currentAmount INT(5),  -- 제작수량
	currentTime TIME,  -- 최종 테이블 업데이트한 시간
	FOREIGN KEY(currentAmount) REFERENCES colltbl(currentAmount)  -- Fk
);



# 생성 보완
ALTER TABLE prodtbl
ADD FOREIGN KEY(managerNum) REFERENCES memtbl(managerNum),  -- prodtbl FK 추가
ADD FOREIGN KEY(TYPE) REFERENCES standtbl(TYPE);

# -------------------------------------------------------------------------------------------------------



# ------------------------------------------- 값 insert -------------------------------------------------
# memtbl insert
INSERT INTO memtbl VALUES('20231852', '전해달', '1852', 'BG01'),
									('20232475', '김수달', '2475', 'BG02'),
									('20233192', '이토끼', '3192', 'BG03'),
									('20234753', '박거북', '4753', 'BG04');
									
# standtbl insert
INSERT INTO standtbl VALUES('BG-F17J', 12, 16, 173, 2, 1, 1, 15);

# prodtbl insert
INSERT INTO prodtbl VALUES (1000, 'BG-F17J', CURTIME(), CURDATE(), 'BG01', '20231852');

# colltbl insert
INSERT INTO colltbl VALUES(1, 1000, 12, 15, 173, 2, 1, 1, 15);

# remaketbl insert
INSERT INTO remaketbl VALUES(1, 220, 1);

# finaltbl insert
INSERT INTO finaltbl VALUES(1000, 1, 0, 0, 1, CURTIME());

# ---------------------------------------------------------------------------------------------------------




# ------------------------------------------- 트리거 생성 -------------------------------------------------
# 첫 번째 트리거 생성 / prod 테이블에 데이터가 입력되었을 때 coll 테이블이 변함
DELIMITER //
CREATE TRIGGER prod2coll
AFTER INSERT ON prodtbl FOR EACH ROW
BEGIN
	INSERT INTO colltbl (currentAmount,	prodNum, foldSize, unfoldSize, weight,	term, wellFold, waterProof, keyTest)
	VALUES(NULL, NEW.prodNum, 9, 15, 172, 2, 1, 0, 1);
	
END;
//
DELIMITER;



# 두 번째 트리거 생성 / coll 테이블에 데이터가 입력되었을 때 colltbl 값 합쳐서 remake tbl 만들기
DELIMITER //
CREATE TRIGGER coll2remake
AFTER INSERT ON colltbl FOR EACH ROW
BEGIN
	DECLARE testscore INT;
		SET testscore = (NEW.foldSize + NEW.unfoldSize + NEW.weight + NEW.term + NEW.wellFold + NEW.waterProof + NEW.keyTest);
	IF (217 <= abs(testscore) <= 220) THEN
		INSERT INTO remaketbl VALUES (NEW.currentAmount, testscore, 1);
	ELSE
		INSERT INTO remaketbl VALUES (NEW.currentAmount, testscore, 0);
	END IF;
END;
//
DELIMITER;



# 세 번째 트리거 생성 / remake 테이블에 데이터가 입력되었을 때 final 테이블 업데이트됨
DELIMITER //
CREATE TRIGGER remake2final
AFTER INSERT ON remaketbl FOR EACH ROW
BEGIN
	IF (NEW.defectYorN = 1) THEN
		UPDATE finaltbl SET good = good + 1;
	ELSEIF (NEW.defectYorN = 0) THEN
		UPDATE finaltbl SET bad = bad + 1;
	END IF;
	
	UPDATE finaltbl SET defectPercent = ROUND((bad/NEW.currentAmount)*100, 2);
	UPDATE finaltbl SET currentAmount = NEW.currentAmount;
	UPDATE finaltbl SET currentTime = CURTIME();
END;
//
DELIMITER;

# 세 번째 트리거 insert ver.-------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER remake2final
AFTER INSERT ON remaketbl FOR EACH ROW
BEGIN
	DECLARE defect INT;
	DECLARE good INT;
	deeclare bad INT;
	SET defect = (currentAmount/bad)*100;
	IF (NEW.defectYorN = 1) THEN
		INSERT INTO finaltbl VALUES(targetAmount, good = good + 1, bad, NEW.defect, NEW.CurrentAmount, CURTIME());
	ELSEIF (NEW.defectYorN = 0) THEN
		INSERT INTO finaltbl VALUES(targetAmount, good, bad = bad + 1, NEW.defect, NEW.CurrentAmount, CURTIME());
	END IF;
END;
//
DELIMITER;



# 트리거 잘 작동되는지 확인 insert문
INSERT INTO prodtbl VALUES (NULL, 'BG-F17J', CURTIME(), CURDATE(), 'BG01', '20231852'); # 잘 동작하므로 나중에 써먹어 무조건 !
INSERT INTO colltbl VALUES(NULL, 1004, 12, 15, 173, 2, 1, 1, 15);
SELECT * FROM prodtbl;
SELECT * FROM colltbl;
SELECT * FROM remaketbl;
SELECT * FROM finaltbl;

# ---------------------------------------------------------------------------------------------------------






# ------------------------------------------- 혹시 몰라 남겨놓은 쿼리 -----------------------------------------------
# remaketbl foreign key 추가
ALTER TABLE remaketbl
	ADD CONSTRAINT fk_colltbl_2
	FOREIGN KEY(currentAmount)
	REFERENCES colltbl (currentAmount);

# finaltbl foreign key 추가
ALTER TABLE finaltbl
	ADD CONSTRAINT fk_colltbl_1
	FOREIGN KEY(currentAmount)
	REFERENCES colltbl (currentAmount);
	
	
# coll2prod
DELIMITER //
CREATE TRIGGER coll2prod
AFTER INSERT ON colltbl FOR EACH ROW
BEGIN
	INSERT INTO prodtbl VALUES (NULL, 'BG-F17J', CURTIME(), CURDATE(), 'BG01', '20231852');
END;
//
DELIMITER;	
	

DROP database projectdb;





SELECT * FROM memtbl WHERE 	 AND PASSWORD = '1234';