# TEAM-SYSTEM プロジェクト

このプロジェクトは、フロントエンド（Client）、バックエンド（Server）、およびデータベース（Database）を明確に分離した構造になっています。プロジェクトの品質を維持するため、すべての開発者は以下の構成と規約を遵守してください。

---

## 📂 ディレクトリ構成 (Directory Structure)

プロジェクトの全体像を把握し、適切な場所にコードを記述してください。

- **`client/`**: ユーザーインターフェースとフロントエンドのロジック。
  - `css/`: スタイルシート（CSS/Sass）を格納。
  - `js/`: クライアント側のJavaScript処理。
  - `page/`: 各画面ごとのファイルやコンポーネント。
  - `index.php`: クライアント側のメインエントリポイント。
- **`database/`**: データベース関連の管理。
  - `index.sql`: テーブル定義（Schema）および初期データ（Seed）。
- **`helpers/`**: プロジェクト全体で使用する共通関数。
  - `def.php`: 定数定義（Constants）およびシステム設定。
  - `utils.php`: 便利な共通ユーティリティ関数（バリデーション、フォーマット等）。
- **`server/`**: ビジネスロジック、API処理、データベース操作（Backend）。
- **`vendor/`**: 外部ライブラリ（直接編集禁止）。
- **`README.md`**: このドキュメント。

---

## 🛠 開発ルール (Development Rules)

### 1. 設計原則 (Separation of Concerns)

- **Client層:** SQL文を直接記述しないでください。表示ロジックのみに専念します。
- **Server層:** データ操作や重いロジック処理はすべてここに集約してください。
- **Helpers:** 2箇所以上で再利用する処理は、必ず `utils.php` に関数として切り出してください。

### 2. 命名規則 (Naming Conventions)

- **ファイル・フォルダ名:** 小文字英数字を使用し、単語間はハイフンで繋いでください（例: `user-login.php`）。
- **変数・関数名:** `camelCase` を推奨します（例: `getUserStatus`）。
- **定数名:** 全大文字とアンダースコアを使用してください（例: `DB_HOST`）。

### 3. データベースの更新

- テーブル構造を変更した場合は、必ず `database/index.sql` を更新し、チームメンバーに共有してください。
- データベースは学校で学習したものを避け、各自で新しいデータベースを作成してください。

---

## 🚀 セットアップ (Setup)

1.  **リポジトリのクローン:**

    ```bash
    git clone https://github.com/quanck30/team-system.git
    ```

2.  **環境設定:**
    - `helpers/def.php` 内のデータベース接続情報（ホスト名、ユーザー、パスワード）を自分の環境に合わせて設定してください。

3.  **データベースのインポート:**
    - 去年のデータベース講義のように、`database/index.sql` を実行してください。

4.  **実行:**
    - ローカルサーバー（XAMPP, Laragon等）を起動し、ブラウザで `http://localhost/TEAM-SYSTEM/client/index.php` にアクセスしてください。

---

## 📝 ワークフロー (Workflow)

1.  作業開始前に必ず最新のコードを取得する: `git pull origin main`
2.  コードをプッシュする前に、不要な `var_dump` や `console.log` が残っていないか確認してください。
3.  コードのプッシュ準備：

```bash
    git add .
    git commit -m "コメント内容"
    git push
```

## Git branch

- ブランチとは、直訳すると「木の枝、支流、支系」の意味を持っており、**1つのプロジェクト**から**分岐させること**により、プロジェクト本体に影響を与えずに開発を行える機能のことを言います。
- またこのように枝分かれをさせ、別の作業を行うことを「ブランチを切る」といいます。

# ブランチを切り方

1. ブランチを作成、切り替える

```bash
    git checkout -b <ブランチ名>
```

2.　ブランチの確認

```bash
    git branch
```
3. プッシュ
* そのブランチにプッシュしてください

```bash
    git add .
    git commit -m "コメント内容"
    git push origin <ブランチ名>
```
4. GitHubを開いて「Pull Request」機能を使って、リクエストする
---


### データベースの作成
1. ルートに入る
```mysql -u root -p```

2. データベースの作成
```CREATE DATABASE team_system; ```

3.　ユーザー権限設定
```GRANT ALL ON team_system.* TO dbuser; ```

ご不明な点があれば、Teamsに連絡してください。
