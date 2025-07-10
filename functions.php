<?php
/**
 * Nakamura Editorial Office Theme Functions
 * なかむら編集室テーマの機能ファイル
 */

// セキュリティ: 直接アクセスを防ぐ
if (!defined('ABSPATH')) {
    exit;
}

/**
 * テーマのセットアップ
 */
function nakamura_theme_setup() {
    // テーマサポートを追加
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
    ));
    
    // メニューサポート
    register_nav_menus(array(
        'primary' => 'プライマリーメニュー',
    ));
}
add_action('after_setup_theme', 'nakamura_theme_setup');

/**
 * スタイルとスクリプトの読み込み
 */
function nakamura_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'nakamura-google-fonts',
        'https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap',
        array(),
        '1.0.0'
    );
    
    // メインスタイル（assets/css/style.css）
    wp_enqueue_style(
        'nakamura-main-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array('nakamura-google-fonts'),
        '1.0.0'
    );
    
    // 追加CSS
    wp_enqueue_style(
        'nakamura-header',
        get_template_directory_uri() . '/assets/css/header.css',
        array('nakamura-main-style'),
        '1.0.0'
    );
    
    wp_enqueue_style(
        'nakamura-footer',
        get_template_directory_uri() . '/assets/css/footer.css',
        array('nakamura-main-style'),
        '1.0.0'
    );
    
    wp_enqueue_style(
        'nakamura-contact',
        get_template_directory_uri() . '/assets/css/contact.css',
        array('nakamura-main-style'),
        '1.0.0'
    );
    
    wp_enqueue_style(
        'nakamura-script',
        get_template_directory_uri() . '/assets/css/script.css',
        array('nakamura-main-style'),
        '1.0.0'
    );
    
    // GSAP (外部CDN)
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js',
        array(),
        '3.13.0',
        true
    );
    
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
        array('gsap'),
        '3.13.0',
        true
    );
    
    wp_enqueue_script(
        'gsap-scrollsmoother',
        'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollSmoother.min.js',
        array('gsap'),
        '3.13.0',
        true
    );
    
    // Swiper
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );
    
    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );
    
    // カスタムJS
    wp_enqueue_script(
        'nakamura-header',
        get_template_directory_uri() . '/assets/js/header.js',
        array('jquery'),
        '1.0.0',
        true
    );
    
    wp_enqueue_script(
        'nakamura-typing',
        get_template_directory_uri() . '/assets/js/typing.js',
        array('jquery'),
        '1.0.0',
        true
    );
    
    wp_enqueue_script(
        'nakamura-effect',
        get_template_directory_uri() . '/assets/js/effect.js',
        array('gsap'),
        '1.0.0',
        true
    );
    
    wp_enqueue_script(
        'nakamura-parallax',
        get_template_directory_uri() . '/assets/js/parallax.js',
        array('gsap'),
        '1.0.0',
        true
    );
    
    wp_enqueue_script(
        'nakamura-book',
        get_template_directory_uri() . '/assets/js/book.js',
        array('swiper'),
        '1.0.0',
        true
    );
    
    wp_enqueue_script(
        'nakamura-interview-famous',
        get_template_directory_uri() . '/assets/js/interview-famous.js',
        array('swiper'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'nakamura_enqueue_assets');

/**
 * カスタムフィールドの登録
 */
function nakamura_register_custom_fields() {
    if (function_exists('acf_add_local_field_group')) {
        
        // 全フィールドをページ表示順に統合
        $all_fields = array();
        
        // 📱 トップページセクション
        $all_fields[] = array(
            'key' => 'tab_top_page',
            'label' => 'トップページ',
            'type' => 'tab',
        );
        
        $all_fields[] = array(
            'key' => 'message_top_page',
            'label' => '',
            'type' => 'message',
            'message' => 'サイトの最上部に表示されるコンテンツを設定します。',
        );
        
        // 1. ヒーローセクション
        $all_fields[] = array(
            'key' => 'field_hero_catchphrase',
            'label' => 'ヒーロー - キャッチフレーズ',
            'name' => 'hero_catchphrase',
            'type' => 'text',
            'default_value' => '編集の力で"伝える"をお手伝いします。',
        );
        
        // 2. ミッションセクション
        $all_fields[] = array(
            'key' => 'field_mission_content',
            'label' => 'ミッション - 内容',
            'name' => 'mission_content',
            'type' => 'wysiwyg',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'default_value' => '<p>今はコンテンツが溢れる時代。法人も個人も関係なく、多くの人がたくさんの記事を書き、動画を投稿し、SNSを運用しています。</p><p>一時期「現代人が1日に触れる情報量は江戸時代の１年分、平安時代の一生分」という投稿がSNSで話題になりました。</p><p>明確な根拠ないので真偽は不明ですが、頷く人も多いのではないでしょうか。それほど現代は情報に溢れているからです。</p><p>そんな時代において、自社、あるいは個人の「伝えたいこと」を「伝えたい人」に届けるのは非常に難しいと言えるでしょう。</p><p>何か伝えたいことがあっても、果たしてそれをどの媒体でどのように伝えるのか。ブログがいいのかSNSがいいのか、あるいは音声や動画、メルマガの方がいいのか？</p><p>一昔前はメールやチラシなど、選択肢が少なかったからこそ迷いは生じませんでした。しかし、コンテンツが溢れる現代においては、これらの判断が非常に難しいのです。</p><p>そんな状況だからこそ、弊社にお手伝いさせてください。</p><p><strong>「誰に」「何を」「どうやって」届けるか、編集の力をつかってサポート致します。</strong></p>',
        );
        
        // 🔧 サービスセクション
        $all_fields[] = array(
            'key' => 'tab_services',
            'label' => 'サービス',
            'type' => 'tab',
        );
        
        $all_fields[] = array(
            'key' => 'message_services',
            'label' => '',
            'type' => 'message',
            'message' => '提供している5つのサービスを設定します。サービス名と説明文を入力してください。',
        );
        
        // 3. サービスセクション (5個固定)
        $services = array(
            1 => array(
                'title' => 'Webメディアの記事ライティング',
                'description' => 'Webメディア全般のライティングを承ります。マーケティング・不動産・金融をメインにしつつも、あらゆるジャンルのライティングが可能です。'
            ),
            2 => array(
                'title' => '書籍の編集・ライティング',
                'description' => '書籍の企画から執筆、編集まで一貫してサポートします。著者の想いを読者に的確に伝える文章作りを得意としています。'
            ),
            3 => array(
                'title' => '法人向け文章講座',
                'description' => '企業様向けの文章力向上講座を提供しています。社内ライティングスキルの底上げから、マーケティング文章の作成方法まで幅広く対応します。'
            ),
            4 => array(
                'title' => 'Webメディアコンサルティング',
                'description' => 'Webメディアの戦略立案から運営まで総合的にコンサルティングします。コンテンツ企画、SEO対策、読者獲得まで一貫してサポートします。'
            ),
            5 => array(
                'title' => 'セールスライティング',
                'description' => 'LP（ランディングページ）やメルマガなど、売上に直結するセールスライティングを提供します。顧客の心に響く文章で成果を最大化します。'
            )
        );
        
        for ($i = 1; $i <= 5; $i++) {
            $service_data = isset($services[$i]) ? $services[$i] : array('title' => "サンプルサービス{$i}", 'description' => "サンプルサービス{$i}の説明文です。");
            
            $all_fields[] = array(
                'key' => "field_service_{$i}_title",
                'label' => "サービス{$i} - タイトル",
                'name' => "service_{$i}_title",
                'type' => 'text',
                'default_value' => $service_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_service_{$i}_description",
                'label' => "サービス{$i} - 説明",
                'name' => "service_{$i}_description",
                'type' => 'textarea',
                'default_value' => $service_data['description'],
            );
        }
        
        // 📚 登壇・出版セクション
        $all_fields[] = array(
            'key' => 'tab_publications',
            'label' => '登壇・出版',
            'type' => 'tab',
        );
        
        $all_fields[] = array(
            'key' => 'message_publications',
            'label' => '',
            'type' => 'message',
            'message' => '著書、メディア掲載、講演・登壇の実績を管理します。',
        );
        
        // 著書セクション説明
        $all_fields[] = array(
            'key' => 'message_books',
            'label' => '著書一覧',
            'type' => 'message',
            'message' => '出版した書籍の情報を設定します。タイトル、出版社、発売日、購入リンク、表紙画像を入力してください。',
        );
        
        // 4. 著書セクション (5個固定) - 全体グループ化
        $books = array(
            1 => array(
                'title' => '『書くことを仕事にして自分らしく稼ぐ13の方法 ライターとして生きていく』',
                'publisher' => 'KADOKAWA',
                'date' => '2025年02月26日',
                'link' => 'https://www.amazon.co.jp/',
            ),
            2 => array(
                'title' => '編集者の仕事術',
                'publisher' => '出版社名',
                'date' => '2024年12月15日',
                'link' => 'https://www.amazon.co.jp/',
            ),
        );
        
        // 著書全体のグループフィールド
        $book_sub_fields = array();
        
        for ($i = 1; $i <= 5; $i++) {
            $book_data = isset($books[$i]) ? $books[$i] : array('title' => '', 'publisher' => '', 'date' => '', 'link' => '');
            
            $book_sub_fields[] = array(
                'key' => "field_book_{$i}_title",
                'label' => "著書{$i} - タイトル",
                'name' => "book_{$i}_title",
                'type' => 'text',
                'default_value' => $book_data['title'],
                'wrapper' => array(
                    'width' => '30',
                ),
            );
            $book_sub_fields[] = array(
                'key' => "field_book_{$i}_publisher",
                'label' => "著書{$i} - 出版社",
                'name' => "book_{$i}_publisher",
                'type' => 'text',
                'default_value' => $book_data['publisher'],
                'wrapper' => array(
                    'width' => '15',
                ),
            );
            $book_sub_fields[] = array(
                'key' => "field_book_{$i}_date",
                'label' => "著書{$i} - 発売日",
                'name' => "book_{$i}_date",
                'type' => 'text',
                'default_value' => $book_data['date'],
                'wrapper' => array(
                    'width' => '15',
                ),
            );
            $book_sub_fields[] = array(
                'key' => "field_book_{$i}_link",
                'label' => "著書{$i} - 購入リンク",
                'name' => "book_{$i}_link",
                'type' => 'url',
                'default_value' => $book_data['link'],
                'wrapper' => array(
                    'width' => '25',
                ),
            );
            $book_sub_fields[] = array(
                'key' => "field_book_{$i}_image",
                'label' => "著書{$i} - 表紙画像",
                'name' => "book_{$i}_image",
                'type' => 'image',
                'wrapper' => array(
                    'width' => '15',
                ),
            );
        }
        
        // 著書全体のグループ
        $all_fields[] = array(
            'key' => 'group_books_all',
            'label' => '著書情報',
            'type' => 'group',
            'layout' => 'block',
            'sub_fields' => $book_sub_fields,
        );
        
        // メディア掲載セクション説明
        $all_fields[] = array(
            'key' => 'message_media',
            'label' => 'メディア掲載',
            'type' => 'message',
            'message' => 'メディアや書籍での掲載実績を設定します。掲載タイトルと該当ページのリンクを入力してください。',
        );
        
        // 5. メディア掲載 (6個固定)
        $media_items = array(
            1 => array(
                'title' => '『未経験でも、はじめの一歩が踏み出せる!Web系フリーランス働き方超大全』（著者：デイトラ）',
                'link' => 'https://example.com/media1'
            ),
            2 => array(
                'title' => '再現性あるスキルだけ教える"超現実主義"なWebライターラボ（新R25インタビュー）',
                'link' => 'https://example.com/media2'
            ),
            3 => array(
                'title' => 'LPOはライターの市場価値を上げるのにおすすめのスキル（Ptengineインタビュー）',
                'link' => 'https://example.com/media3'
            ),
        );
        
        for ($i = 1; $i <= 6; $i++) {
            $media_data = isset($media_items[$i]) ? $media_items[$i] : array('title' => '', 'link' => '');
            
            $all_fields[] = array(
                'key' => "field_media_{$i}_title",
                'label' => "メディア{$i} - タイトル",
                'name' => "media_{$i}_title",
                'type' => 'text',
                'default_value' => $media_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_media_{$i}_link",
                'label' => "メディア{$i} - リンク",
                'name' => "media_{$i}_link",
                'type' => 'url',
                'default_value' => $media_data['link'],
            );
        }
        
        // 講演・登壇セクション説明
        $all_fields[] = array(
            'key' => 'message_speaking',
            'label' => '講演・登壇',
            'type' => 'message',
            'message' => '講演・登壇の実績を設定します。種別（対談/セミナー/イベント）、タイトル、主催者、画像を入力してください。',
        );
        
        // 6. 講演・登壇 (18個固定)
        $speaking_events = array(
            1 => array(
                'type' => '対談',
                'title' => '2024年のWebライター業界とコミュニティが目指すもの',
                'organizer' => 'ライター研究所'
            ),
            2 => array(
                'type' => 'セミナー',
                'title' => '稼げるWebライターへ！文字単価を倍にする方法とは？',
                'organizer' => 'クラウドワークス'
            ),
            3 => array(
                'type' => 'イベント',
                'title' => '「ここだけの話！」ライターがライティング以外で稼ぐための34の秘訣',
                'organizer' => 'CORECOLOR'
            ),
        );
        
        for ($i = 1; $i <= 18; $i++) {
            $speaking_data = isset($speaking_events[$i]) ? $speaking_events[$i] : array('type' => '', 'title' => '', 'organizer' => '');
            
            $all_fields[] = array(
                'key' => "field_speaking_{$i}_type",
                'label' => "講演{$i} - 種別",
                'name' => "speaking_{$i}_type",
                'type' => 'select',
                'choices' => array(
                    '対談' => '対談',
                    'セミナー' => 'セミナー',
                    'イベント' => 'イベント',
                ),
                'default_value' => $speaking_data['type'],
            );
            $all_fields[] = array(
                'key' => "field_speaking_{$i}_title",
                'label' => "講演{$i} - タイトル",
                'name' => "speaking_{$i}_title",
                'type' => 'text',
                'default_value' => $speaking_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_speaking_{$i}_organizer",
                'label' => "講演{$i} - 主催者",
                'name' => "speaking_{$i}_organizer",
                'type' => 'text',
                'default_value' => $speaking_data['organizer'],
            );
            $all_fields[] = array(
                'key' => "field_speaking_{$i}_image",
                'label' => "講演{$i} - 画像",
                'name' => "speaking_{$i}_image",
                'type' => 'image',
            );
        }
        
        // 🎯 実績セクション
        $all_fields[] = array(
            'key' => 'tab_works',
            'label' => '制作実績',
            'type' => 'tab',
        );
        
        $all_fields[] = array(
            'key' => 'message_works',
            'label' => '',
            'type' => 'message',
            'message' => '各種インタビュー記事やブックライティングなどの制作実績を管理します。',
        );
        
        // 著名人インタビューセクション説明
        $all_fields[] = array(
            'key' => 'message_famous_interviews',
            'label' => '著名人インタビュー',
            'type' => 'message',
            'message' => '著名人へのインタビュー記事の実績を設定します。',
        );
        
        // 7. 著名人インタビュー (10個固定)
        $famous_interviews = array(
            1 => array(
                'title' => 'サンプル著名人インタビュー 1',
                'link' => 'https://example.com/famous1'
            ),
            2 => array(
                'title' => 'サンプル著名人インタビュー 2', 
                'link' => 'https://example.com/famous2'
            ),
            3 => array(
                'title' => 'サンプル著名人インタビュー 3',
                'link' => 'https://example.com/famous3'
            ),
        );
        
        for ($i = 1; $i <= 10; $i++) {
            $famous_data = isset($famous_interviews[$i]) ? $famous_interviews[$i] : array('title' => '', 'link' => '');
            
            $all_fields[] = array(
                'key' => "field_famous_{$i}_title",
                'label' => "7-{$i}. 著名人インタビュー{$i} タイトル",
                'name' => "famous_{$i}_title",
                'type' => 'text',
                'default_value' => $famous_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_famous_{$i}_link",
                'label' => "7-{$i}. 著名人インタビュー{$i} リンク",
                'name' => "famous_{$i}_link",
                'type' => 'url',
                'default_value' => $famous_data['link'],
            );
            $all_fields[] = array(
                'key' => "field_famous_{$i}_image",
                'label' => "7-{$i}. 著名人インタビュー{$i} 画像",
                'name' => "famous_{$i}_image",
                'type' => 'image',
            );
        }
        
        // 8. 企業インタビュー (6個固定)
        $company_interviews = array(
            1 => array(
                'title' => 'サンプル企業インタビュー 1',
                'link' => 'https://example.com/company1'
            ),
            2 => array(
                'title' => 'サンプル企業インタビュー 2',
                'link' => 'https://example.com/company2'
            ),
            3 => array(
                'title' => 'サンプル企業インタビュー 3',
                'link' => 'https://example.com/company3'
            ),
        );
        
        for ($i = 1; $i <= 6; $i++) {
            $company_data = isset($company_interviews[$i]) ? $company_interviews[$i] : array('title' => '', 'link' => '');
            
            $all_fields[] = array(
                'key' => "field_company_interview_{$i}_title",
                'label' => "8-{$i}. 企業インタビュー{$i} タイトル",
                'name' => "company_interview_{$i}_title",
                'type' => 'text',
                'default_value' => $company_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_company_interview_{$i}_link",
                'label' => "8-{$i}. 企業インタビュー{$i} リンク",
                'name' => "company_interview_{$i}_link",
                'type' => 'url',
                'default_value' => $company_data['link'],
            );
        }
        
        // 9. 人物インタビュー (10個固定)
        $personal_interviews = array(
            1 => array(
                'title' => 'サンプル人物インタビュー 1',
                'subtitle' => 'インタビューのサブタイトル1です。',
                'link' => 'https://example.com/personal1'
            ),
            2 => array(
                'title' => 'サンプル人物インタビュー 2',
                'subtitle' => 'インタビューのサブタイトル2です。',
                'link' => 'https://example.com/personal2'
            ),
            3 => array(
                'title' => 'サンプル人物インタビュー 3',
                'subtitle' => 'インタビューのサブタイトル3です。',
                'link' => 'https://example.com/personal3'
            ),
        );
        
        for ($i = 1; $i <= 10; $i++) {
            $personal_data = isset($personal_interviews[$i]) ? $personal_interviews[$i] : array('title' => '', 'subtitle' => '', 'link' => '');
            
            $all_fields[] = array(
                'key' => "field_personal_{$i}_title",
                'label' => "9-{$i}. 人物インタビュー{$i} タイトル",
                'name' => "personal_{$i}_title",
                'type' => 'text',
                'default_value' => $personal_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_personal_{$i}_subtitle",
                'label' => "9-{$i}. 人物インタビュー{$i} サブタイトル",
                'name' => "personal_{$i}_subtitle",
                'type' => 'textarea',
                'default_value' => $personal_data['subtitle'],
            );
            $all_fields[] = array(
                'key' => "field_personal_{$i}_link",
                'label' => "9-{$i}. 人物インタビュー{$i} リンク",
                'name' => "personal_{$i}_link",
                'type' => 'url',
                'default_value' => $personal_data['link'],
            );
            $all_fields[] = array(
                'key' => "field_personal_{$i}_image",
                'label' => "9-{$i}. 人物インタビュー{$i} 画像",
                'name' => "personal_{$i}_image",
                'type' => 'image',
            );
        }
        
        // 10. ブックライティング (10個固定)
        $bookwriting_items = array(
            1 => array(
                'title' => '収入の9割はマネースクリプトで決まる（メンタリストDaiGo / KADOKAWA）',
                'link' => 'https://www.amazon.co.jp/'
            ),
            2 => array(
                'title' => '心理学で学ぶ人を動かす文章術（KADOKAWA）',
                'link' => 'https://www.amazon.co.jp/'
            ),
            3 => array(
                'title' => '超効率的な文章の書き方（ダイヤモンド社）',
                'link' => 'https://www.amazon.co.jp/'
            ),
            4 => array(
                'title' => 'ビジネス文書の極意（日本経済新聞出版）',
                'link' => 'https://www.amazon.co.jp/'
            ),
            5 => array(
                'title' => 'Web文章の教科書（技術評論社）',
                'link' => 'https://www.amazon.co.jp/'
            ),
            6 => array(
                'title' => 'コピーライティングの真実（翔泳社）',
                'link' => 'https://www.amazon.co.jp/'
            ),
        );
        
        for ($i = 1; $i <= 10; $i++) {
            $bookwriting_data = isset($bookwriting_items[$i]) ? $bookwriting_items[$i] : array('title' => '', 'link' => '');
            
            $all_fields[] = array(
                'key' => "field_bookwriting_{$i}_title",
                'label' => "10-{$i}. ブックライティング{$i} タイトル",
                'name' => "bookwriting_{$i}_title",
                'type' => 'text',
                'default_value' => $bookwriting_data['title'],
            );
            $all_fields[] = array(
                'key' => "field_bookwriting_{$i}_link",
                'label' => "10-{$i}. ブックライティング{$i} リンク",
                'name' => "bookwriting_{$i}_link",
                'type' => 'url',
                'default_value' => $bookwriting_data['link'],
            );
            $all_fields[] = array(
                'key' => "field_bookwriting_{$i}_image",
                'label' => "10-{$i}. ブックライティング{$i} 画像",
                'name' => "bookwriting_{$i}_image",
                'type' => 'image',
            );
        }
        
        // Webメディア執筆セクション説明
        $all_fields[] = array(
            'key' => 'message_webmedia',
            'label' => 'Webメディア執筆',
            'type' => 'message',
            'message' => 'Webメディアでの執筆実績を設定します。メディア名・役割と該当ページのリンクを入力してください。',
        );
        
        // 11. Webメディア執筆
        $all_fields[] = array(
            'key' => 'field_webmedia_01_title',
            'label' => 'Webメディア1 - タイトル',
            'name' => 'webmedia_01_title',
            'type' => 'text',
            'default_value' => '幻冬舎ゴールドオンラインさま 連載担当',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_01_link',
            'label' => 'Webメディア1 - リンク',
            'name' => 'webmedia_01_link',
            'type' => 'url',
            'default_value' => 'https://gentosha-go.com/',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_02_title',
            'label' => 'Webメディア2 - タイトル',
            'name' => 'webmedia_02_title',
            'type' => 'text',
            'default_value' => '金融メディア『HEDGE GUIDE』さま　記事執筆',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_02_link',
            'label' => 'Webメディア2 - リンク',
            'name' => 'webmedia_02_link',
            'type' => 'url',
            'default_value' => 'https://hedge.guide/',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_03_title',
            'label' => 'Webメディア3 - タイトル',
            'name' => 'webmedia_03_title',
            'type' => 'text',
            'default_value' => '相続会議（朝日新聞社）さま　記事執筆',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_03_link',
            'label' => 'Webメディア3 - リンク',
            'name' => 'webmedia_03_link',
            'type' => 'url',
            'default_value' => 'https://souzoku.asahi.com/',
        );
        $all_fields[] = array(
            'key' => 'field_webmedia_note',
            'label' => '追記テキスト',
            'name' => 'webmedia_note',
            'type' => 'text',
            'default_value' => '他、合計4,300記事以上を執筆',
        );
        
        // 🏢 会社情報セクション
        $all_fields[] = array(
            'key' => 'tab_company',
            'label' => '会社情報',
            'type' => 'tab',
        );
        
        $all_fields[] = array(
            'key' => 'message_company',
            'label' => '',
            'type' => 'message',
            'message' => '代表メッセージ、プロフィール、会社概要などの基本情報を管理します。',
        );
        
        // メッセージセクション説明
        $all_fields[] = array(
            'key' => 'message_greeting',
            'label' => '代表メッセージ',
            'type' => 'message',
            'message' => '代表からのご挨拶とプロフィール情報を設定します。',
        );
        
        // 12. メッセージセクション
        $all_fields[] = array(
            'key' => 'field_message_content',
            'label' => '代表メッセージ - 内容',
            'name' => 'message_content',
            'type' => 'wysiwyg',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'default_value' => '<p>弊社のサイトをご覧いただき、誠にありがとうございます。代表取締役の中村昌弘です。</p><p>私は2016年にライターとして独立してから、数多くのお客様とお仕事させて頂きました。独立当初は、SEOメディアへの記事執筆がメインでしたが、ありがたいことに段々と仕事の幅が広がってきました。</p><p>LPやメルマガをはじめとするセールスライティング、Webメディアのコンサルティング、法人向けの文章講義、そして書籍の執筆・編集業務。そのすべてに「文章」が関わっており、その文章を「取材」「執筆」「編集」することが私の主な仕事です。</p><p>私一人ではなく、数多くのクリエイターと力を合わせ、ご満足いただく成果物をつくりあげていきます。</p><p>執筆や編集という分野はまだまだ無限の可能性を秘めています。時代の変化を楽しみつつ、そして時代に合わせた、その時々に合った執筆・編集をしていき、お客様にご満足頂く。その気持ちを大切に一歩一歩前へ進んでいきます。</p>',
        );
        $all_fields[] = array(
            'key' => 'field_profile_content',
            'label' => '代表プロフィール - 内容',
            'name' => 'profile_content',
            'type' => 'wysiwyg',
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 1,
            'default_value' => '<div class="message-profile-name">代表取締役 中村昌弘</div><div class="message-profile-text">1985年生まれ埼玉県出身。立教大学を卒業後、マンションディベロッパーへ入社。</div><div class="message-profile-text">その後は人事コンサル系の会社へ転職し、2016年2月に独立。</div><div class="message-profile-text">独立と同時にWebライターをはじめる。</div><div class="message-profile-text">2022年に株式会社なかむら編集室を設立。</div>',
        );
        $all_fields[] = array(
            'key' => 'field_portfolio_link',
            'label' => 'ポートフォリオ - リンク',
            'name' => 'portfolio_link',
            'type' => 'url',
            'default_value' => 'https://nakamura-editing.co.jp/writer/',
        );
        $all_fields[] = array(
            'key' => 'field_community_link',
            'label' => 'コミュニティ - リンク',
            'name' => 'community_link',
            'type' => 'url',
            'default_value' => 'https://webwriterlab-line.com/',
        );
        
        // 会社概要セクション説明
        $all_fields[] = array(
            'key' => 'message_company_info',
            'label' => '会社概要',
            'type' => 'message',
            'message' => '会社の基本情報を設定します。会社名、代表者、所在地、事業内容などを入力してください。',
        );
        
        // 13. 会社概要
        $all_fields[] = array(
            'key' => 'field_company_name',
            'label' => '会社名',
            'name' => 'company_name',
            'type' => 'text',
            'default_value' => 'なかむら編集室',
        );
        $all_fields[] = array(
            'key' => 'field_company_representative',
            'label' => '代表者名',
            'name' => 'company_representative',
            'type' => 'text',
            'default_value' => '中村 昌弘',
        );
        $all_fields[] = array(
            'key' => 'field_company_established',
            'label' => '設立日',
            'name' => 'company_established',
            'type' => 'text',
            'default_value' => '2022年6月6日',
        );
        $all_fields[] = array(
            'key' => 'field_company_address',
            'label' => '所在地',
            'name' => 'company_address',
            'type' => 'text',
            'default_value' => '東京都新宿区西新宿三丁目3番13号　西新宿水間ビル6階',
        );
        $all_fields[] = array(
            'key' => 'field_company_email',
            'label' => 'メールアドレス',
            'name' => 'company_email',
            'type' => 'email',
            'default_value' => 'freelance.nakamura@gmail.com',
        );
        $all_fields[] = array(
            'key' => 'field_company_business_01',
            'label' => '事業内容1',
            'name' => 'company_business_01',
            'type' => 'text',
            'default_value' => 'Webメディアの企画・制作・運営・コンサルティング業務',
        );
        $all_fields[] = array(
            'key' => 'field_company_business_02',
            'label' => '事業内容2',
            'name' => 'company_business_02',
            'type' => 'text',
            'default_value' => '書籍の企画・編集業務',
        );
        $all_fields[] = array(
            'key' => 'field_company_business_03',
            'label' => '事業内容3',
            'name' => 'company_business_03',
            'type' => 'text',
            'default_value' => '法人向け講座の提供',
        );
        
        // 統合フィールドグループ
        acf_add_local_field_group(array(
            'key' => 'group_nakamura_all',
            'title' => 'なかむら編集室 - サイトコンテンツ管理',
            'fields' => $all_fields,
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'default',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'nakamura_register_custom_fields');

/**
 * ACFフィールドのデフォルト値を統合管理
 * 通常フィールドとグループフィールド両方に対応
 */
function nakamura_set_acf_default_values($value, $post_id, $field) {
    // 通常フィールドの処理
    if (empty($value) && isset($field['default_value']) && !empty($field['default_value'])) {
        return $field['default_value'];
    }
    
    // グループフィールド内のサブフィールド処理
    if ($field['type'] == 'group' && isset($field['sub_fields']) && is_array($value)) {
        foreach ($field['sub_fields'] as $sub_field) {
            $sub_field_name = $sub_field['name'];
            if ((!isset($value[$sub_field_name]) || empty($value[$sub_field_name])) 
                && isset($sub_field['default_value']) && !empty($sub_field['default_value'])) {
                $value[$sub_field_name] = $sub_field['default_value'];
            }
        }
    }
    
    return $value;
}
add_filter('acf/load_value', 'nakamura_set_acf_default_values', 10, 3);

/**
 * フィールド表示時のデフォルト値確保
 */
function nakamura_prepare_field_defaults($field) {
    if (isset($field['default_value']) && !empty($field['default_value'])) {
        if (!isset($field['value']) || $field['value'] === '' || $field['value'] === null) {
            $field['value'] = $field['default_value'];
        }
    }
    return $field;
}
add_filter('acf/prepare_field', 'nakamura_prepare_field_defaults');


/**
 * SEO対応のメタタグ出力
 */
function nakamura_seo_meta_tags() {
    if (is_front_page()) {
        echo '<meta name="description" content="なかむら編集室は編集の力で「伝える」をお手伝いする会社です。Webメディアの記事ライティング、書籍の編集・ライティング、法人向け講座を提供しています。">' . "\n";
        echo '<meta name="keywords" content="なかむら編集室,編集,ライティング,Webメディア,書籍,コンサルティング">' . "\n";
        echo '<meta property="og:title" content="なかむら編集室 - 編集の力で「伝える」をお手伝いします">' . "\n";
        echo '<meta property="og:description" content="なかむら編集室は編集の力で「伝える」をお手伝いする会社です。Webメディアの記事ライティング、書籍の編集・ライティング、法人向け講座を提供しています。">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . home_url() . '">' . "\n";
        echo '<meta property="og:site_name" content="なかむら編集室">' . "\n";
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="なかむら編集室 - 編集の力で「伝える」をお手伝いします">' . "\n";
        echo '<meta name="twitter:description" content="なかむら編集室は編集の力で「伝える」をお手伝いする会社です。">' . "\n";
        
        // 構造化データ (JSON-LD)
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'なかむら編集室',
            'url' => home_url(),
            'description' => 'なかむら編集室は編集の力で「伝える」をお手伝いする会社です。',
            'founder' => array(
                '@type' => 'Person',
                'name' => '中村昌弘'
            ),
            'address' => array(
                '@type' => 'PostalAddress',
                'addressLocality' => '東京都新宿区',
                'addressCountry' => 'JP'
            )
        );
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'nakamura_seo_meta_tags');

/**
 * 管理画面での画像サイズ制限を無効化
 */
add_filter('big_image_size_threshold', '__return_false');

/**
 * セキュリティ強化
 */
// WordPressバージョン情報を隠す
remove_action('wp_head', 'wp_generator');

// JSONP無効化のみ（セキュリティ向上、プラグイン互換性維持）
add_filter('rest_jsonp_enabled', '__return_false');

// XML-RPC無効化
add_filter('xmlrpc_enabled', '__return_false');

/**
 * カスタムフィールドリセット機能
 */
// メタボックスを追加
function nakamura_add_reset_metabox() {
    add_meta_box(
        'nakamura_reset_fields',
        '🔄 カスタムフィールドリセット',
        'nakamura_reset_fields_callback',
        'page',
        'side',
        'low'
    );
}
add_action('add_meta_boxes', 'nakamura_add_reset_metabox');

// メタボックスの内容
function nakamura_reset_fields_callback($post) {
    // nonce フィールド
    wp_nonce_field('nakamura_reset_fields_action', 'nakamura_reset_fields_nonce');
    
    echo '<div style="text-align: center; padding: 10px;">';
    echo '<p style="margin-bottom: 15px; color: #666;">このページのカスタムフィールド値を<br>全て削除してデフォルト値に戻します。</p>';
    echo '<button type="button" id="nakamura-reset-btn" class="button button-secondary" style="width: 100%; padding: 8px;">🔄 フィールドをリセット</button>';
    echo '<p style="margin-top: 10px; font-size: 11px; color: #d63638;">※この操作は元に戻せません</p>';
    echo '</div>';
    
    // JavaScript
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#nakamura-reset-btn').click(function() {
            if (confirm('本当にカスタムフィールドをリセットしますか？\n\n現在の全ての設定値が削除され、デフォルト値に戻ります。\nこの操作は元に戻せません。')) {
                var data = {
                    'action': 'nakamura_reset_custom_fields',
                    'post_id': <?php echo $post->ID; ?>,
                    'nonce': $('#nakamura_reset_fields_nonce').val()
                };
                
                $(this).prop('disabled', true).text('リセット中...');
                
                $.post(ajaxurl, data, function(response) {
                    if (response.success) {
                        alert('カスタムフィールドをリセットしました。\nページをリロードします。');
                        location.reload();
                    } else {
                        alert('エラーが発生しました: ' + response.data);
                        $('#nakamura-reset-btn').prop('disabled', false).text('🔄 フィールドをリセット');
                    }
                });
            }
        });
    });
    </script>
    <?php
}

// AJAX処理でリセット実行
function nakamura_handle_reset_custom_fields() {
    // nonce 確認
    if (!wp_verify_nonce($_POST['nonce'], 'nakamura_reset_fields_action')) {
        wp_die('セキュリティチェックに失敗しました。');
    }
    
    // 権限確認
    if (!current_user_can('edit_pages')) {
        wp_die('権限がありません。');
    }
    
    $post_id = intval($_POST['post_id']);
    
    if (!$post_id) {
        wp_send_json_error('無効な投稿IDです。');
    }
    
    // ACFフィールドを全て取得
    $fields = get_fields($post_id);
    
    if ($fields) {
        // 各フィールドを削除
        foreach ($fields as $field_name => $value) {
            delete_field($field_name, $post_id);
        }
    }
    
    // より徹底的なACF関連メタの削除
    global $wpdb;
    $wpdb->query($wpdb->prepare(
        "DELETE FROM {$wpdb->postmeta} 
         WHERE post_id = %d 
         AND (meta_key LIKE 'field_%' OR meta_key LIKE '_field_%'
              OR meta_key LIKE 'hero_%' OR meta_key LIKE '_hero_%'
              OR meta_key LIKE 'mission_%' OR meta_key LIKE '_mission_%' 
              OR meta_key LIKE 'service_%' OR meta_key LIKE '_service_%'
              OR meta_key LIKE 'book_%' OR meta_key LIKE '_book_%'
              OR meta_key LIKE 'media_%' OR meta_key LIKE '_media_%'
              OR meta_key LIKE 'speaking_%' OR meta_key LIKE '_speaking_%'
              OR meta_key LIKE 'famous_%' OR meta_key LIKE '_famous_%'
              OR meta_key LIKE 'company_%' OR meta_key LIKE '_company_%'
              OR meta_key LIKE 'personal_%' OR meta_key LIKE '_personal_%'
              OR meta_key LIKE 'bookwriting_%' OR meta_key LIKE '_bookwriting_%'
              OR meta_key LIKE 'webmedia_%' OR meta_key LIKE '_webmedia_%'
              OR meta_key LIKE 'message_%' OR meta_key LIKE '_message_%'
              OR meta_key LIKE 'profile_%' OR meta_key LIKE '_profile_%'
              OR meta_key LIKE 'portfolio_%' OR meta_key LIKE '_portfolio_%'
              OR meta_key LIKE 'community_%' OR meta_key LIKE '_community_%'
              OR meta_key LIKE 'group_books_all%' OR meta_key LIKE '_group_books_all%')",
        $post_id
    ));
    
    // ACFキャッシュのクリア
    if (function_exists('acf_get_store')) {
        $store = acf_get_store('values');
        if ($store) {
            $store->remove($post_id);
        }
    }
    
    // WordPressオブジェクトキャッシュもクリア
    wp_cache_delete($post_id, 'post_meta');
    
    wp_send_json_success('カスタムフィールドをリセットしました。');
}
add_action('wp_ajax_nakamura_reset_custom_fields', 'nakamura_handle_reset_custom_fields');