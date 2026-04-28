/*  
    データベースの基礎データを導入
    2026/04/28
 */

SET NAMES utf8mb4;


INSERT INTO job (jname) VALUES 
('マネージャー'),
('エンジニア'),  
('一般社員'),  
('WEBデザイナー'),
('事務職');       

INSERT INTO status (status) VALUES 
('無事'),        
('軽傷'),        
('重傷'),        
('救助が必要');

INSERT INTO canwork(can_work) VALUES 
('出勤可能'),
('出勤可 (在宅のみ)'),
('出勤不可');

INSERT INTO department (dname, mgr_no) VALUES 
('管理部', NULL),
('営業部', NULL),   
('開発部', NULL),  
('総務部', NULL);

-- INSERT INTO employee (emp_no, ename, birthday, sex, tel, address, job_no, dept_no) VALUES 
-- ('E0001', '田中 太郎', '1985-05-20', 'M', '080-1234-5678', '東京都新宿区西新宿1-1-1', 1, 1),
-- ('E0002', '佐藤 美紀', '1992-11-10', 'F', '090-8765-4321', '神奈川県横浜市中区桜木町', 1, 2),
-- ('E0003', '鈴木 一郎', '1978-03-15', 'M', '070-1122-3344', '千葉県千葉市中央区', 1, 3),
-- ('E0004', '高橋 健一', '1980-07-22', 'M', '080-3344-5566', '埼玉県さいたま市大宮区', 1, 4),
-- ('E0005', '伊藤 あおい', '1995-12-05', 'F', '090-2233-4455', '東京都渋谷区道玄坂', 2, 3),
-- ('E0006', '渡辺 誠', '1988-09-18', 'M', '070-9988-7766', '千葉県船橋市本町', 2, 2),
-- ('E0007', '中村 結衣', '1993-04-30', 'F', '080-4455-6677', '東京都港区六本木', 2, 3),
-- ('E0008', '小林 裕太', '1982-11-12', 'M', '090-6677-8899', '神奈川県川崎市中原区', 3, 2),
-- ('E0009', '加藤 陽子', '1975-06-08', 'F', '070-5566-7788', '東京都江東区豊洲', 3, 3);

-- UPDATE department SET mgr_no = 'E0001' WHERE dept_no = 1;
-- UPDATE department SET mgr_no = 'E0002' WHERE dept_no = 2;
-- UPDATE department SET mgr_no = 'E0003' WHERE dept_no = 3;
-- UPDATE department SET mgr_no = 'E0004' WHERE dept_no = 4;

-- INSERT INTO safety (emp_no, status_id, comment, current_location, can_work_no, create_at) VALUES 
-- ('E0001', 1, '家族全員無事です。避難所にいます。', '代々木公園避難所', 1, NOW()),
-- ('E0002', 2, '足に軽い怪我をしましたが、歩けます。', '自宅', 2, NOW()),
-- ('E0003', 1, '外出中でしたが、怪我はありません。', '品川駅付近', 3, NOW());