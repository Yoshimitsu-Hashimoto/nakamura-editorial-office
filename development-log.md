# なかむら編集室 WordPress テーマ開発記録

## プロジェクト概要
静的サイト（`static/nakamurasan-site/`）をWordPressテーマに変換する作業。

## 完了した主要作業

### 1. テーマ基本構造の作成
- **style.css**: テーマヘッダーとCSS統合
- **index.php**: 静的HTMLをPHP化、カスタムフィールド対応
- **functions.php**: 全機能を統合したメイン関数ファイル

### 2. カスタムフィールド設計
Advanced Custom Fields (ACF) を使用して、ページ表示順に番号付きで整理：

#### フィールド構成
1. **ヒーロー**: `hero_catchphrase`
2. **ミッション**: `mission_content` (WYSIWYGエディタ)
3. **サービス**: `service_1_title`, `service_1_description` (1-5)
4. **著書**: `book_1_title`, `book_1_publisher`, `book_1_date`, `book_1_link`, `book_1_image` (1-5)
5. **メディア掲載**: `media_1_title`, `media_1_link` (1-6)
6. **講演・登壇**: `speaking_1_type`, `speaking_1_title`, `speaking_1_organizer`, `speaking_1_image` (1-18)
7. **著名人インタビュー**: `famous_1_title`, `famous_1_link`, `famous_1_image` (1-10)
8. **企業インタビュー**: `company_interview_1_title`, `company_interview_1_link` (1-6)
9. **人物インタビュー**: `personal_1_title`, `personal_1_subtitle`, `personal_1_link`, `personal_1_image` (1-10)
10. **ブックライティング**: `bookwriting_1_title`, `bookwriting_1_link`, `bookwriting_1_image` (1-10)
11. **Webメディア**: `webmedia_01_title`, `webmedia_01_link`, `webmedia_note`
12. **メッセージ**: `message_content`, `profile_content`, `portfolio_link`, `community_link`
13. **会社概要**: `company_name`, `company_representative`, `company_established`, `company_address`, `company_email`, `company_business_01-03`

### 3. アセット統合
- **CSS**: header.css, footer.css, contact.css, script.css
- **JavaScript**: header.js, typing.js, effect.js, parallax.js, book.js, interview-famous.js
- **外部ライブラリ**: GSAP, Swiper, Google Fonts
- **画像**: assets/images/ ディレクトリに整理

### 4. SEO対応
- メタタグ設定（description, keywords, OG tags, Twitter Card）
- 構造化データ（JSON-LD）
- セキュリティ強化（バージョン情報非表示、REST API無効化、XML-RPC無効化）

### 5. テストデータ管理システム

#### 当初の実装（ボタン方式）
- 管理画面にメタボックス追加
- 手動でテストデータ読み込みボタン
- **問題**: フォーム送信が正常に動作しない

#### 最終実装（自動読み込み方式）
```php
function nakamura_auto_load_test_data() {
    // test-data.jsonが存在する場合、ページ編集時に自動読み込み
    // 重複読み込み防止フラグ: _nakamura_test_data_loaded
    // 既存データの上書き保護
}
```

#### 機能
- **自動読み込み**: test-data.json存在時に編集画面で自動実行
- **重複防止**: 一度読み込んだら再実行しない
- **上書き保護**: 既存データは保持
- **状態表示**: 管理画面で進行状況表示
- **リセット機能**: 必要に応じて全データクリア
- **詳細ログ**: デバッグ情報表示

### 6. 主要な技術的課題と解決

#### 問題1: テストデータボタンが動作しない
**原因**: メタボックス内でのフォーム送信問題
**解決**: 自動読み込み方式に変更

#### 問題2: フィールド名の不一致
**原因**: 
- functions.php: `service_1_title` (アンダースコア1つ)
- test-data.json: `service_01_title` (アンダースコア2つ)

**解決**: test-data.jsonのフィールド名を統一
```json
// 修正前
"service_01_title": "...",
"book_01_title": "...",

// 修正後  
"service_1_title": "...",
"book_1_title": "...",
```

#### 問題3: 部分的なデータ読み込み
**症状**: hero_catchphrase は読み込まれるが、service系が空
**診断**: 詳細デバッグログを追加して各フィールドの処理状況を追跡
**解決**: フィールド名統一により解決

### 7. デバッグ機能の実装

#### 状態表示機能
```php
function nakamura_test_data_callback($post) {
    // test-data.json存在確認
    // ACF利用可能性チェック
    // カスタムフィールド登録状況
    // サンプルフィールド値チェック
    // 詳細ログ表示
}
```

#### ログ機能
- フィールド別の処理結果
- 成功/失敗/スキップの詳細
- ACF update_field の結果
- フォールバック処理の結果

### 8. システム変更：JSONからデフォルト値へ

#### 変更の背景
**ユーザー要望**: 「テストデータがよみこめない。jsonのよみこみやめて、デフォルト値でセットしちゃってください」

#### 実装した変更（2025年7月2日）
1. **test-data.json削除**: 外部ファイル依存を廃止
2. **テストデータ関数群削除**: 約300行のコード削除
   - `nakamura_load_test_data()`
   - `nakamura_auto_load_test_data()`
   - `nakamura_add_test_data_status_box()`
   - `nakamura_test_data_callback()`
   - `nakamura_handle_reset_test_data()`
   - `nakamura_handle_test_data()`
   - `nakamura_show_test_data_messages()`

3. **デフォルト値システム実装**:
   ```php
   $all_fields[] = array(
       'key' => 'field_hero_catchphrase',
       'default_value' => '編集の力で"伝える"をお手伝いします。',
   );
   ```

#### ACFデフォルト値の問題と解決

##### 問題1: デフォルト値が表示されない
**原因**: 
- 配列インデックスエラー（`$services[$i]`が存在しない）
- 既存カスタムフィールドデータとの競合
- ACF設定更新が反映されない

**解決策**:
```php
// 1. 配列アクセスの安全化
$service_data = isset($services[$i]) ? $services[$i] : array('title' => "サンプルサービス{$i}", 'description' => "サンプルサービス{$i}の説明文です。");

// 2. ACF load_valueフィルターで強制設定
function nakamura_set_acf_default_values($value, $post_id, $field) {
    if (empty($value) && isset($field['default_value']) && !empty($field['default_value'])) {
        return $field['default_value'];
    }
    return $value;
}
add_filter('acf/load_value', 'nakamura_set_acf_default_values', 10, 3);
```

##### 完了したデフォルト値設定
- **ヒーロー**: キャッチフレーズ
- **ミッション**: 完全なHTML内容
- **サービス**: 5つの実サービス内容
- **著書**: 2冊の実書籍情報
- **メディア掲載**: 3件の実メディア情報
- **講演・登壇**: 3件のサンプルイベント
- **Webメディア**: 3つの実メディア（幻冬舎ゴールドオンライン等）
- **メッセージ**: 代表メッセージとプロフィール
- **会社概要**: 完全な会社情報

### 9. 本番運用への準備

#### 削除完了（2025年7月2日）
1. **ファイル**: 
   - ~~`test-data.json`~~ ✓削除済み

2. **関数**: ✓すべて削除済み
   - ~~`nakamura_auto_load_test_data()`~~
   - ~~`nakamura_add_test_data_status_box()`~~
   - ~~`nakamura_test_data_callback()`~~
   - ~~`nakamura_handle_reset_test_data()`~~
   - ~~`nakamura_load_test_data()`~~

#### 保持対象
- カスタムフィールド登録 (`nakamura_register_custom_fields()`)
- アセット読み込み (`nakamura_enqueue_assets()`)
- SEO機能 (`nakamura_seo_meta_tags()`)
- セキュリティ機能

## ファイル構成

```
nakamura-editorial-office/
├── style.css                 # テーマヘッダー + 統合CSS
├── index.php                 # メインテンプレート
├── functions.php            # 全機能統合（デフォルト値内蔵）
├── development-log.md      # 開発記録
├── theme-requirements.md   # 要件定義書
├── assets/
│   ├── css/                # 分割CSSファイル
│   ├── js/                 # JavaScript
│   └── images/             # 画像ファイル
└── static/                 # 元の静的サイト（参考用）
```

**変更点**: test-data.json削除、functions.phpにデフォルト値を内蔵化

## 技術スタック
- **WordPress**: 6.x
- **PHP**: 8.x
- **Advanced Custom Fields**: 6.4.2
- **外部ライブラリ**: GSAP 3.13.0, Swiper 11.0.0
- **フォント**: Google Fonts (Noto Sans, Josefin Sans)

## 今後のメンテナンス

### 定期チェック項目
1. WordPress/プラグインの更新
2. セキュリティ設定の確認
3. パフォーマンス最適化
4. バックアップ状況

### カスタマイズ時の注意
- カスタムフィールド追加時は `nakamura_register_custom_fields()` を更新
- 新しいアセット追加時は `nakamura_enqueue_assets()` を更新
- SEO設定変更時は `nakamura_seo_meta_tags()` を確認

## 開発者メモ

### WordPress カスタムフィールドのベストプラクティス
1. **フィールド名の統一**: アンダースコアの数を統一
2. **データ検証**: `empty()` チェックとフォールバック値
3. **エスケープ**: `esc_html()`, `esc_url()`, `esc_attr()` を適切に使用
4. **権限チェック**: `current_user_can()` で適切な権限確認

### デバッグのコツ
1. **Transient API**: 一時的なデバッグデータ保存に活用
2. **段階的ログ**: 処理の各段階でログ出力
3. **視覚的表示**: 管理画面での色分けされたデバッグ情報

---

**作成日**: 2025年7月2日  
**最終更新**: 2025年7月2日（デフォルト値システム実装完了）  
**開発者**: Claude Code  
**プロジェクト**: なかむら編集室 WordPress テーマ