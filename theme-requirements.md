# なかむら編集室 WordPressテーマ化 要件定義書

## プロジェクト概要
- **元サイト**: static/nakamurasan-site/index.html
- **目的**: 静的サイトをWordPressテーマ化し、管理画面から編集可能にする
- **テーマ名**: Nakamura Editorial Office
- **バージョン**: 1.0.0

## テーマ基本設定
- **構成**: index.php一つにすべてのセクションを記述（テンプレート分割なし）
- **トップページ**: 固定ページに設定
- **カスタムフィールド**: トップ固定ページに紐付け
- **プラグイン依存**: Advanced Custom Fields

## ディレクトリ構成
```
/nakamura-editorial-office/
├── style.css (テーマ情報 + メインCSS)
├── index.php (メインテンプレート)
├── functions.php (機能・アセット・カスタムフィールド)
├── theme-requirements.md (この要件書)
├── assets/
│   ├── css/
│   │   ├── header.css
│   │   ├── footer.css
│   │   ├── contact.css
│   │   └── script.css
│   ├── js/
│   │   ├── header.js
│   │   ├── typing.js
│   │   ├── effect.js
│   │   ├── parallax.js
│   │   ├── book.js
│   │   └── interview-famous.js
│   └── images/
│       ├── (static/nakamurasan-site/images/ の全ファイル移動)
│       └── (static/nakamurasan-site/Designimage/ の全ファイル移動)
```

## カスタムフィールド設計

### ヒーローセクション
- `hero_catchphrase` (テキスト) - キャッチフレーズ

### ミッションセクション
- `mission_content` (リッチエディター) - ミッション全文

### サービスセクション（5個固定）
- `service_01_title` / `service_01_description`
- `service_02_title` / `service_02_description`
- `service_03_title` / `service_03_description`
- `service_04_title` / `service_04_description`
- `service_05_title` / `service_05_description`

### 著書セクション（5個固定）
- `book_01_title` / `book_01_publisher` / `book_01_date` / `book_01_link` / `book_01_image`
- `book_02_title` / `book_02_publisher` / `book_02_date` / `book_02_link` / `book_02_image`
- `book_03_title` / `book_03_publisher` / `book_03_date` / `book_03_link` / `book_03_image`
- `book_04_title` / `book_04_publisher` / `book_04_date` / `book_04_link` / `book_04_image`
- `book_05_title` / `book_05_publisher` / `book_05_date` / `book_05_link` / `book_05_image`

### メディア掲載（6個固定）
- `media_01_title` / `media_01_link`
- `media_02_title` / `media_02_link`
- `media_03_title` / `media_03_link`
- `media_04_title` / `media_04_link`
- `media_05_title` / `media_05_link`
- `media_06_title` / `media_06_link`

### 講演・登壇（18個固定）
- `speaking_01_type` / `speaking_01_title` / `speaking_01_organizer` / `speaking_01_image`
- `speaking_02_type` / `speaking_02_title` / `speaking_02_organizer` / `speaking_02_image`
- ... `speaking_18` まで続く

### 著名人インタビュー（10個固定）
- `famous_01_title` / `famous_01_link` / `famous_01_image`
- `famous_02_title` / `famous_02_link` / `famous_02_image`
- ... `famous_10` まで続く

### 企業インタビュー（6個固定）
- `company_interview_01_title` / `company_interview_01_link`
- `company_interview_02_title` / `company_interview_02_link`
- ... `company_interview_06` まで続く

### 人物インタビュー（10個固定）
- `personal_01_title` / `personal_01_subtitle` / `personal_01_link` / `personal_01_image`
- `personal_02_title` / `personal_02_subtitle` / `personal_02_link` / `personal_02_image`
- ... `personal_10` まで続く

### ブックライティング（10個固定）
- `bookwriting_01_title` / `bookwriting_01_link` / `bookwriting_01_image`
- `bookwriting_02_title` / `bookwriting_02_link` / `bookwriting_02_image`
- ... `bookwriting_10` まで続く

### Webメディア執筆
- `webmedia_01_title` / `webmedia_01_link`
- `webmedia_02_title` / `webmedia_02_link`
- `webmedia_03_title` / `webmedia_03_link`
- `webmedia_note` - 「他、合計4,300記事以上を執筆」テキスト

### メッセージセクション
- `message_content` (リッチエディター) - 代表メッセージ全文
- `profile_content` (リッチエディター) - プロフィール情報
- `portfolio_link` - ポートフォリオリンク
- `community_link` - コミュニティリンク

### 会社概要
- `company_name` - 会社名
- `company_representative` - 代表者名
- `company_established` - 設立日
- `company_address` - 所在地
- `company_email` - メールアドレス
- `company_business_01` - 事業内容1
- `company_business_02` - 事業内容2
- `company_business_03` - 事業内容3

## 技術要件

### CSS/JavaScript継承
- **完全移植**: 静的サイトのCSS/JSを漏れなく継承
- **レスポンシブ**: .spbr、.pcbr等の既存対応を維持
- **アニメーション**: タイピング、パララックス、スライダー等すべて維持
- **外部ライブラリ**: GSAP、Swiper等の読み込み継続

### SEO対策
- **メタタグ**: カスタムフィールド化せず直接埋め込み
- **構造化データ**: JSON-LD形式で実装
- **OGP設定**: 適切なOGタグ設定
- **パフォーマンス**: 画像最適化、CSS/JS最適化

### Contact Form 7対応
- 既存のフォーム部分をContact Form 7のショートコードに置換
- フォームスタイルは既存CSSを維持

### WordPress標準対応
- `wp_head()` / `wp_footer()` 実装
- `wp_enqueue_style()` / `wp_enqueue_script()` でアセット読み込み
- 適切なセキュリティ対策

## 実装順序
1. 要件MDファイル作成 ✓
2. ディレクトリ構造作成・アセット移動 ✓
3. style.css作成（テーマ情報 + CSS統合） ✓
4. functions.php作成（アセット読み込み + カスタムフィールド登録） ✓
5. index.php作成（HTML→PHP変換） ✓
6. SEO・メタタグ実装 ✓
7. 動作確認・デバッグ ✓
8. **システム変更**: JSONテストデータ→デフォルト値方式 ✓
9. 最終最適化

## 注意事項
- 繰り返しフィールドは使用せず、すべて固定数で実装
- カスタムフィールドのグループ化は不要
- 静的サイトの機能・デザインを100%継承すること
- 管理画面からの編集性を重視した設計とすること

## 実装済み変更点（2025年7月2日）

### データ管理方式の変更
**変更前**: JSONファイル（test-data.json）による外部データ管理
**変更後**: ACFデフォルト値による内蔵データ管理

#### 変更理由
- ユーザー要望: 「テストデータがよみこめない。jsonのよみこみやめて、デフォルト値でセットしちゃってください」
- 外部ファイル依存による不安定性の解消
- 管理画面での直接編集の利便性向上

#### 技術的実装
```php
// デフォルト値の設定例
$all_fields[] = array(
    'key' => 'field_hero_catchphrase',
    'default_value' => '編集の力で"伝える"をお手伝いします。',
);

// 配列アクセスの安全化
$service_data = isset($services[$i]) ? $services[$i] : array('title' => "サンプルサービス{$i}");

// ACFフィルターによる確実な適用
add_filter('acf/load_value', 'nakamura_set_acf_default_values', 10, 3);
```

#### メリット
1. **安定性**: 外部ファイル依存の解消
2. **保守性**: コード内でのデータ管理
3. **利便性**: 管理画面での即座の編集可能
4. **一貫性**: 新規ページ作成時の自動デフォルト値設定