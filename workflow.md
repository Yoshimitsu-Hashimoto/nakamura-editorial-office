# なかむら編集室 WordPress テーマ - 作業手順書

## 概要
このドキュメントは、なかむら編集室WordPressテーマの開発・保守における標準作業手順を定義します。

---

## 標準作業フロー

### 1. 作業開始前
#### A. 現状確認
- [ ] `theme-requirements.md` で最新の要件を確認
- [ ] `development-log.md` で最新の作業状況を確認
- [ ] 現在のブランチとコミット状況を確認
- [ ] 作業対象の機能・課題を明確化

#### B. 環境確認
- [ ] ローカル開発環境の動作確認
- [ ] WordPress管理画面へのアクセス確認
- [ ] 必要なプラグイン（ACF等）の動作確認

### 2. 作業中
#### A. コード変更時
- [ ] 変更理由と影響範囲を記録
- [ ] 重要な技術的判断は即座にメモ
- [ ] 問題発生時は詳細を記録（エラーメッセージ、再現手順等）

#### B. テスト実施
- [ ] 機能動作テスト
- [ ] 管理画面でのカスタムフィールド表示確認
- [ ] フロントエンドでの表示確認
- [ ] レスポンシブデザイン確認

### 3. 作業完了時
#### A. 文書更新（必須）
- [ ] `development-log.md` に作業詳細を追記
- [ ] `theme-requirements.md` に仕様変更があれば更新
- [ ] 今後の課題や改善点を記録

#### B. コード整理
- [ ] 不要なコメントやデバッグコードの削除
- [ ] インデントやコーディング規約の確認
- [ ] functions.phpの最適化確認

---

## 文書更新ルール

### 更新タイミング
- **機能追加・変更**: 新機能実装や既存機能の修正時
- **設定変更**: functions.phpやテーマ設定の重要な変更時
- **問題解決**: バグ修正や課題解決時
- **最適化実施**: パフォーマンス改善や構造最適化時
- **作業セッション終了**: 各作業セッションの完了時

### 更新内容
#### development-log.md
```markdown
### [日付] 作業概要
#### 実施内容
- 具体的な変更内容
- 追加・修正したファイル

#### 技術的判断
- なぜその方法を選択したか
- 他の選択肢と比較した理由

#### 影響範囲
- 変更による他機能への影響
- 注意すべき点

#### 今後の課題
- 残されている課題
- 改善が必要な点
```

#### theme-requirements.md
- 新機能の要件追加
- 技術仕様の変更記録
- 制約事項の更新
- 設計方針の変更

---

## 保守・運用手順

### 定期メンテナンス
#### 月次チェック項目
- [ ] WordPressコア・プラグインの更新確認
- [ ] セキュリティ脆弱性の確認
- [ ] パフォーマンスの確認
- [ ] バックアップの動作確認

#### 年次レビュー
- [ ] テーマ全体の構造見直し
- [ ] 使用ライブラリの更新検討
- [ ] SEO設定の見直し
- [ ] ドキュメントの全体見直し

### 問題発生時の対応フロー
1. **問題の特定**
   - エラーメッセージの記録
   - 再現手順の確認
   - 影響範囲の特定

2. **原因調査**
   - 最近の変更内容を確認
   - ログファイルの確認
   - 同様の問題の過去事例を検索

3. **対応実施**
   - 修正方針の決定
   - バックアップの確保
   - 修正の実施とテスト

4. **記録・共有**
   - 問題と解決方法を`development-log.md`に記録
   - 再発防止策の検討と実装

---

## カスタムフィールド管理

### 新規フィールド追加時
1. **設計段階**
   - [ ] フィールドの目的と用途を明確化
   - [ ] フィールド名の命名規則確認
   - [ ] デフォルト値の設定
   - [ ] 表示レイアウトの検討

2. **実装段階**
   - [ ] `functions.php`にフィールド定義を追加
   - [ ] 適切なタブ・グループに配置
   - [ ] `wrapper`設定でレイアウト調整
   - [ ] デフォルト値の動作確認

3. **テンプレート更新**
   - [ ] `index.php`でフィールド値の取得・表示
   - [ ] 条件分岐の実装（値が空の場合の処理等）
   - [ ] フロントエンド表示の確認

### 注意事項
- **リピーターフィールドは使用しない**（プロジェクト要件）
- **グループフィールドを活用**してレイアウト管理
- **デフォルト値は必ず設定**する
- **フィールド名は一意性を保つ**

---

## SEO管理

### 現在の方針
- **ハードコーディング**: 暫定的にコード内で直接設定
- **将来のプラグイン対応**: SEOプラグイン導入時は該当関数を削除

### SEOプラグイン導入時の手順
1. **事前準備**
   - [ ] 現在のSEO設定値を記録
   - [ ] プラグインの機能範囲を確認

2. **関数削除**
   ```php
   // 以下を削除
   function nakamura_seo_meta_tags() { ... }
   add_action('wp_head', 'nakamura_seo_meta_tags');
   ```

3. **プラグイン設定**
   - [ ] 記録したSEO設定値をプラグインに移行
   - [ ] 構造化データの重複確認
   - [ ] 動作テスト

---

## Git管理

### コミット規則
- **コミットメッセージ**: 日本語で変更内容を明確に記載
- **コミット単位**: 機能・修正単位でコミット
- **ブランチ**: 大きな変更時は feature ブランチを作成

### 推奨ワークフロー
```bash
# 作業開始前
git status
git pull origin main

# 作業中（適宜コミット）
git add .
git commit -m "機能追加: 新しいカスタムフィールドの実装"

# 作業完了後
git push origin main
```

---

## 緊急時対応

### バックアップからの復旧
1. **データベース復旧**
   - 最新のデータベースバックアップを確認
   - WordPress管理画面からインポート実行

2. **ファイル復旧**
   - テーマファイルのバックアップを確認
   - FTP/Git経由でファイル復元

3. **動作確認**
   - サイト表示の確認
   - 管理画面機能の確認
   - カスタムフィールドの動作確認

### 連絡体制
- 重大な問題発生時は関係者に即座に連絡
- 復旧作業の進捗を定期的に報告
- 原因調査結果と再発防止策を文書化

---

## 更新履歴

### 2025年7月3日
- 初版作成
- 標準作業フロー定義
- 文書更新ルール策定
- 保守・運用手順策定