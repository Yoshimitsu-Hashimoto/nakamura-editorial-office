<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title><?php bloginfo('name'); ?> - 編集の力で"伝える"をお手伝いします</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <button class="menu-button-sp">
            <span>Menu</span>
        </button>
        <nav class="menu">
            <div class="logo-section">
                <div class="logo" style="align-items: flex-start;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/99-footer-logo.png" alt="ロゴ" class="logo-img">
                    <span class="logo-text">なかむら編集室</span>
                </div>
            </div>
            <ul class="menu-list">
                <li class="menu-item"><a href="#" class="menu-link">TOP</a></li>
                <li class="menu-item"><a href="#mission" class="menu-link">MISSION</a></li>
                <li class="menu-item"><a href="#service" class="menu-link">SERVICE</a></li>
                <li class="menu-item"><a href="#talks" class="menu-link">Talks & Publications</a></li>
                <li class="menu-item"><a href="#works" class="menu-link">WORKS</a></li>
                <li class="menu-item"><a href="#contact" class="menu-link">CONTACT</a></li>
            </ul>
        </nav>
    </header>

    <section id="hero">
        <div class="hero-container">
            <div class="catchphrase-section">
                <?php 
                $hero_catchphrase = get_field('hero_catchphrase');
                if ($hero_catchphrase): 
                ?>
                    <h1 class="typing_animation" data-text="<?php echo esc_attr($hero_catchphrase); ?>"></h1>
                <?php else: ?>
                    <h1 class="typing_animation" data-text="編集の力で&quot;伝える&quot;をお手伝いします。"></h1>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section id="mission">
        <div class="mission-container">
            <h2 class="h2title UpEffect">
                <span class="subtitle">ミッション</span>
                <span class="titlemain">MISSION</span>
            </h2>
            <div class="mission-content UpEffect">
                <?php 
                $mission_content = get_field('mission_content');
                if ($mission_content): 
                    echo $mission_content;
                else: 
                ?>
                    <p class="mission-text">
                        今はコンテンツが溢れる時代。法人も個人も関係なく、<br class="pcbr">多くの人がたくさんの記事を書き、動画を投稿し、SNSを運用しています。
                    </p>
                    <p class="mission-text">
                        一時期「現代人が1日に触れる情報量は江戸時代の１年分、平安時代の一生分」<br class="pcbr">という投稿がSNSで話題になりました。
                    </p>
                    <p class="mission-text">
                        明確な根拠ないので真偽は不明ですが、頷く人も多いのではないでしょうか。<br class="pcbr">それほど現代は情報に溢れているからです。
                    </p>
                    <p class="mission-text">
                        そんな時代において、自社、あるいは個人の<br class="pcbr">「伝えたいこと」を「伝えたい人」に届けるのは非常に難しいと言えるでしょう。
                    </p>
                    <p class="mission-text">
                        何か伝えたいことがあっても、果たしてそれをどの媒体でどのように伝えるのか。<br class="pcbr">
                        ブログがいいのかSNSがいいのか、あるいは音声や動画、メルマガの方がいいのか？
                    </p>
                    <p class="mission-text">
                        一昔前はメールやチラシなど、選択肢が少なかったからこそ迷いは生じませんでした。<br class="pcbr">
                        しかし、コンテンツが溢れる現代においては、これらの判断が非常に難しいのです。
                    </p>
                    <p class="mission-text">
                        そんな状況だからこそ、弊社にお手伝いさせてください。
                    </p>
                    <p class="mission-emphasis">
                        「誰に」「何を」「どうやって」届けるか、編集の力をつかってサポート致します。
                    </p>
                <?php endif; ?>
            </div>
            <div class="mission-image UpEffect">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mission.svg" alt="mission" class="mission-img">
            </div>
        </div>
    </section>

    <section id="service" class="animation">
        <div class="service-container">
            <h2 class="h2title UpEffect">
                <span class="subtitle">事業内容</span>
                <span class="titlemain">SERVICE</span>
            </h2>
            
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <?php 
                $service_title = get_field("service_{$i}_title");
                $service_description = get_field("service_{$i}_description");
                if ($service_title || $service_description):
                ?>
                <div class="service-item UpEffect">
                    <div class="service-content">
                        <div class="service-title-row">
                            <div class="service-number"><?php echo sprintf('%02d', $i); ?></div>
                            <h3 class="service-name"><?php echo $service_title ?: 'Webメディアの記事ライティング'; ?></h3>
                        </div>
                        <p class="service-description">
                            <?php echo $service_description ?: 'Webメディア全般のライティングを承ります。マーケティング・不動産・金融をメインにしつつも、あらゆるジャンルのライティングが可能です。'; ?>
                        </p>
                    </div>
                    <div class="service-image">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/service<?php echo $i; ?>.svg" alt="<?php echo $service_title ?: 'サービス' . $i; ?>">
                    </div>
                </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </section>

    <section id="talks">
        <div class="talks-container">
            <h2 class="h2title UpEffect">
                <span class="subtitle">登壇・出版</span>
                <span class="titlemain">Talks & Publications</span>
            </h2>
            
            <!-- 著書 -->
            <div class="mybook-content">
                <div class="titleArea UpEffect">
                    <h3 class="h3title">著　書</h3>
                </div>
                <?php 
                $books_group = get_field('group_books_all');
                for ($i = 1; $i <= 5; $i++): 
                    $book_title = $books_group ? $books_group["book_{$i}_title"] : '';
                    $book_publisher = $books_group ? $books_group["book_{$i}_publisher"] : '';
                    $book_date = $books_group ? $books_group["book_{$i}_date"] : '';
                    $book_link = $books_group ? $books_group["book_{$i}_link"] : '';
                    $book_image = $books_group ? $books_group["book_{$i}_image"] : '';
                    if ($book_title):
                ?>
                    <div class="mybook-item UpEffect">
                        <div class="mybook-book-container">
                            <?php if ($book_image): ?>
                                <img src="<?php echo esc_url($book_image['url']); ?>" alt="<?php echo esc_attr($book_title); ?>" class="mybook-book-image">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/05-works-work01.jpg" alt="<?php echo esc_attr($book_title); ?>" class="mybook-book-image">
                            <?php endif; ?>
                        </div>
                        <div class="mybook-book-info">
                            <h4 class="mybook-book-title"><?php echo esc_html($book_title); ?></h4>
                            <p class="mybook-book-details">
                                <?php if ($book_publisher): ?>出版社：<?php echo esc_html($book_publisher); ?><br><?php endif; ?>
                                <?php if ($book_date): ?>発売日：<?php echo esc_html($book_date); ?><?php endif; ?>
                            </p>
                            <?php if ($book_link): ?>
                                <a href="<?php echo esc_url($book_link); ?>" class="linkbtn" target="_blank">詳細を見る &gt;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            
            <!-- 書籍・メディア掲載 -->
            <div class="media-container cardDesign UpEffect">
                <div class="cardDesign__shadow"></div>
                <div class="media-divider">
                    <div class="titleArea">
                        <h3 class="h3title">書籍・メディア掲載</h3>
                    </div>
                    <div class="media-images">
                        <div class="media-image-container">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/daytra-icon.png" alt="デイトラロゴ" class="media-image">
                        </div>
                        <div class="media-image-container">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/daytra-icon.png" alt="デイトラロゴ" class="media-image">
                        </div>
                        <div class="media-image-container">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/daytra-icon.png" alt="デイトラロゴ" class="media-image">
                        </div>
                    </div>
                    <ul class="media-list">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <?php 
                            $media_title = get_field("media_{$i}_title");
                            $media_link = get_field("media_{$i}_link");
                            if ($media_title):
                            ?>
                            <li class="media-item">
                                <a href="<?php echo $media_link ? esc_url($media_link) : '#'; ?>" target="_blank" class="media-link">
                                    <?php echo esc_html($media_title); ?>
                                </a>
                            </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            
            <!-- 講演/登壇 -->
            <div class="speaking-container">
                <h3 class="h3title UpEffect">講演・登壇</h3>
                <div class="speaking-content UpEffect">
                    <?php for ($i = 1; $i <= 18; $i++): ?>
                        <?php 
                        $speaking_type = get_field("speaking_{$i}_type");
                        $speaking_title = get_field("speaking_{$i}_title");
                        $speaking_organizer = get_field("speaking_{$i}_organizer");
                        $speaking_image = get_field("speaking_{$i}_image");
                        if ($speaking_title):
                        ?>
                        <div class="speaking-card">
                            <h4 class="speaking-title"><?php echo $speaking_type ?: '対談'; ?></h4>
                            <?php if ($speaking_image): ?>
                                <img src="<?php echo esc_url($speaking_image['url']); ?>" alt="講演・登壇画像<?php echo $i; ?>" class="speaking-main-image">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/07-toudan-image03.png" alt="講演・登壇画像<?php echo $i; ?>" class="speaking-main-image">
                            <?php endif; ?>
                            <p><?php echo esc_html($speaking_title); ?>
                                <?php if ($speaking_organizer): ?>
                                    <br>（<?php echo esc_html($speaking_organizer); ?>）
                                <?php endif; ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 実績 -->
    <section id="works">
        <div class="works-container">
            <h2 class="h2title UpEffect">
                <span class="subtitle">実績</span>
                <span class="titlemain">WORKS</span>
            </h2>

            <!-- 著名人インタビュー -->
            <div id="interview-famous" class="UpEffect">
                <h3 class="h3title">
                    著名人インタビュー<br><span>（マンションプラス）</span>
                </h3>
                <div class="interview-content">
                    <div class="swiper interview-swiper">
                        <div class="swiper-wrapper">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <?php 
                                $famous_title = get_field("famous_{$i}_title");
                                $famous_link = get_field("famous_{$i}_link");
                                $famous_image = get_field("famous_{$i}_image");
                                if ($famous_title):
                                ?>
                                <div class="swiper-slide">
                                    <div class="interview-block-<?php echo ($i % 2 == 1) ? 'left' : 'right'; ?>">
                                        <div class="interview-image">
                                            <?php if ($famous_image): ?>
                                                <img src="<?php echo esc_url($famous_image['url']); ?>" alt="<?php echo esc_attr($famous_title); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/08-tyomeijin-image.png" alt="<?php echo esc_attr($famous_title); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="interview-text-<?php echo ($i % 2 == 1) ? 'left' : 'right'; ?>">
                                            <p><?php echo esc_html($famous_title); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <!-- 矢印 -->
                    <div class="interview-pagination">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>

            <!-- 企業インタビュー -->
            <div id="interview-company" class="cardDesign UpEffect">
                <div class="cardDesign__shadow"></div>
                <h3 class="h3title">
                    企業インタビュー<br><span>（ダイヤモンドCS）</span>
                </h3>
                <div class="interview-company-box">
                    <div class="interview-company-text-area">
                        <ul class="interview-company-list">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <?php 
                                $company_interview_title = get_field("company_interview_{$i}_title");
                                $company_interview_link = get_field("company_interview_{$i}_link");
                                if ($company_interview_title):
                                ?>
                                <li>
                                    <a href="<?php echo $company_interview_link ? esc_url($company_interview_link) : '#'; ?>" class="interview-company-link" target="_blank">
                                        <?php echo esc_html($company_interview_title); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 人物インタビュー -->
            <div id="interview-personal">
                <h3 class="h3title UpEffect">
                    人物インタビュー
                </h3>
                <div class="interview-personal-container">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <?php 
                        $personal_title = get_field("personal_{$i}_title");
                        $personal_subtitle = get_field("personal_{$i}_subtitle");
                        $personal_link = get_field("personal_{$i}_link");
                        $personal_image = get_field("personal_{$i}_image");
                        if ($personal_title):
                        ?>
                        <div class="interview-personal-block UpEffect">
                            <div class="interview-personal-text">
                                <h4 class="interview-personal-title">
                                    <?php echo esc_html($personal_title); ?>
                                </h4>
                                <?php if ($personal_subtitle): ?>
                                    <p class="interview-personal-subtitle">
                                        <?php echo esc_html($personal_subtitle); ?>
                                    </p>
                                <?php endif; ?>
                                <?php if ($personal_link): ?>
                                    <p class="interview-personal-link">
                                        <a href="<?php echo esc_url($personal_link); ?>" target="_blank">president.jp</a>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="interview-personal-image">
                                <?php if ($personal_image): ?>
                                    <img src="<?php echo esc_url($personal_image['url']); ?>" alt="インタビュー画像<?php echo $i; ?>">
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/jinbutsuinterview-img01.jpg" alt="インタビュー画像<?php echo $i; ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- 書籍のブックライティングや編集協力 -->
            <div id="book-writing" class="UpEffect">
                <h3 class="h3title">書籍のブックライティングや編集協力</h3>
                <!-- 本のスライド -->
                <div class="bookshelf-container">
                    <div class="swiper bookshelf-swiper">
                        <div class="swiper-wrapper">
                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <?php 
                                $bookwriting_title = get_field("bookwriting_{$i}_title");
                                $bookwriting_link = get_field("bookwriting_{$i}_link");
                                $bookwriting_image = get_field("bookwriting_{$i}_image");
                                if ($bookwriting_title):
                                ?>
                                <div class="swiper-slide">
                                    <div class="bookwriting-item">
                                        <a href="<?php echo $bookwriting_link ? esc_url($bookwriting_link) : '#'; ?>" class="bookwriting-image-link" target="_blank">
                                            <?php if ($bookwriting_image): ?>
                                                <img src="<?php echo esc_url($bookwriting_image['url']); ?>" alt="書籍画像" class="bookwriting-image">
                                            <?php else: ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bookwriting-image.png" alt="書籍画像" class="bookwriting-image">
                                            <?php endif; ?>
                                        </a>
                                        <a href="<?php echo $bookwriting_link ? esc_url($bookwriting_link) : '#'; ?>" class="bookwriting-title" target="_blank">
                                            <?php echo esc_html($bookwriting_title); ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <!-- 矢印 -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>

            <!-- Webメディアの執筆・企画・構成 -->
            <div id="web-writing">
                <h3 class="h3title UpEffect">Webメディアの執筆・企画・構成</h3>
                <div class="interview-company-text-area UpEffect">
                    <ul class="interview-company-list">
                        <?php 
                        $webmedia_01_title = get_field('webmedia_01_title');
                        $webmedia_01_link = get_field('webmedia_01_link');
                        $webmedia_02_title = get_field('webmedia_02_title');
                        $webmedia_02_link = get_field('webmedia_02_link');
                        $webmedia_03_title = get_field('webmedia_03_title');
                        $webmedia_03_link = get_field('webmedia_03_link');
                        $webmedia_note = get_field('webmedia_note');
                        ?>
                        <?php if ($webmedia_01_title): ?>
                            <li><a href="<?php echo $webmedia_01_link ? esc_url($webmedia_01_link) : '#'; ?>" class="interview-company-link" target="_blank"><?php echo esc_html($webmedia_01_title); ?></a></li>
                        <?php endif; ?>
                        <?php if ($webmedia_02_title): ?>
                            <li><a href="<?php echo $webmedia_02_link ? esc_url($webmedia_02_link) : '#'; ?>" class="interview-company-link" target="_blank"><?php echo esc_html($webmedia_02_title); ?></a></li>
                        <?php endif; ?>
                        <?php if ($webmedia_03_title): ?>
                            <li><a href="<?php echo $webmedia_03_link ? esc_url($webmedia_03_link) : '#'; ?>" class="interview-company-link" target="_blank"><?php echo esc_html($webmedia_03_title); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <p class="web-writing-text"><?php echo $webmedia_note ?: '他、合計4,300記事以上を執筆'; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- ご挨拶 -->
    <section id="message">
        <div class="message-container cardDesign">
            <div class="cardDesign__shadow"></div>
            <div class="message-wrapper">
                <h2 class="h2title">
                    <span class="subtitle">ご挨拶</span>
                    <span class="titlemain">Message</span>
                </h2>
                <div class="message-erea">
                    <div class="message-text-area">
                        <?php 
                        $message_content = get_field('message_content');
                        if ($message_content): 
                            echo $message_content;
                        else: 
                        ?>
                            弊社のサイトをご覧いただき、誠にありがとうございます。代表取締役の中村昌弘です。<br><br>
                            私は2016年にライターとして独立してから、数多くのお客様とお仕事させて頂きました。独立当初は、SEOメディアへの記事執筆がメインでしたが、ありがたいことに段々と仕事の幅が広がってきました。<br><br>
                            LPやメルマガをはじめとするセールスライティング、Webメディアのコンサルティング、法人向けの文章講義、そして書籍の執筆・編集業務。そのすべてに「文章」が関わっており、その文章を「取材」「執筆」「編集」することが私の主な仕事です。<br><br>
                            私一人ではなく、数多くのクリエイターと力を合わせ、ご満足いただく成果物をつくりあげていきます。<br><br>
                            執筆や編集という分野はまだまだ無限の可能性を秘めています。時代の変化を楽しみつつ、そして時代に合わせた、その時々に合った執筆・編集をしていき、お客様にご満足頂く。その気持ちを大切に一歩一歩前へ進んでいきます。
                        <?php endif; ?>
                    </div>
                    <div class="message-profile">
                        <div class="box">
                            <?php 
                            $profile_content = get_field('profile_content');
                            if ($profile_content): 
                                echo $profile_content;
                            else: 
                            ?>
                                <div class="message-profile-name">代表取締役 中村昌弘</div>
                                <div class="message-profile-text">
                                    1985年生まれ埼玉県出身。立教大学を卒業後、マンションディベロッパーへ入社。
                                </div>
                                <div class="message-profile-text">
                                    その後は人事コンサル系の会社へ転職し、2016年2月に独立。
                                </div>
                                <div class="message-profile-text">
                                    独立と同時にWebライターをはじめる。
                                </div>
                                <div class="message-profile-text">
                                    2022年に株式会社なかむら編集室を設立。
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="box">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/09-message-icon.jpg" alt="中村さんアイコン" class="message-photo">
                        </div>
                    </div>
                </div>
                <div class="message-links">
                    <div class="links-portfolio">
                        <?php 
                        $portfolio_link = get_field('portfolio_link');
                        $portfolio_url = $portfolio_link ?: 'https://nakamura-editing.co.jp/writer/';
                        ?>
                        <a href="<?php echo esc_url($portfolio_url); ?>" class="linkbtn" target="_blank">運営しているメディア &gt;</a>
                    </div>
                    <div class="links-media">
                        <?php 
                        $community_link = get_field('community_link');
                        $community_url = $community_link ?: 'https://webwriterlab-line.com/';
                        ?>
                        <a href="<?php echo esc_url($community_url); ?>" class="linkbtn" target="_blank">運営しているコミュニティ &gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 会社概要 -->
    <section id="company">
        <div class="company-container">
            <h2 class="h2title">
                <span class="subtitle">会社概要</span>
                <span class="titlemain">company</span>
            </h2>
            <div class="company-content">
                <table class="company-table">
                    <tr>
                        <th>会社名</th>
                        <td><?php echo get_field('company_name') ?: 'なかむら編集室'; ?></td>
                    </tr>
                    <tr>
                        <th>代表者</th>
                        <td><?php echo get_field('company_representative') ?: '中村 昌弘'; ?></td>
                    </tr>
                    <tr>
                        <th>設立</th>
                        <td><?php echo get_field('company_established') ?: '2022年6月6日'; ?></td>
                    </tr>
                    <tr>
                        <th>所在地</th>
                        <td><?php echo get_field('company_address') ?: '東京都新宿区西新宿三丁目3番13号　西新宿水間ビル6階'; ?></td>
                    </tr>
                    <tr>
                        <th>Mail</th>
                        <td><?php echo get_field('company_email') ?: 'freelance.nakamura@gmail.com'; ?></td>
                    </tr>
                    <tr>
                        <th>事業内容</th>
                        <td>
                            <ul>
                                <li><?php echo get_field('company_business_01') ?: 'Webメディアの企画・制作・運営・コンサルティング業務'; ?></li>
                                <li><?php echo get_field('company_business_02') ?: '書籍の企画・編集業務'; ?></li>
                                <li><?php echo get_field('company_business_03') ?: '法人向け講座の提供'; ?></li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- お問い合わせ -->
    <section id="contact">
        <div class="contact-container">
            <h2 class="h2title">
                <span class="subtitle">お問い合わせ</span>
                <span class="titlemain">contact</span>
            </h2>
            <div class="contact-bgform">
                <?php 
                // Contact Form 7のショートコードを使用
                // フォームIDは実際の設定に合わせて変更してください
                if (function_exists('do_shortcode')) {
                    echo do_shortcode('[contact-form-7 id="1" title="お問い合わせ"]');
                } else {
                    // Contact Form 7が無効な場合のフォールバック
                ?>
                    <div class="cf_section">
                        <div class="inner">
                            <div class="item detail"><span class="description">お名前</span><span class="required_label">必須</span></div>
                            <div class="item value"><input type="text" name="your-name" placeholder="お名前を入力してください"></div>
                        </div>
                        <div class="inner">
                            <div class="item detail"><span class="description">電話番号</span><span class="required_label">必須</span></div>
                            <div class="item value"><input type="tel" name="your-tel" placeholder="電話番号を入力してください"></div>
                        </div>
                        <div class="inner">
                            <div class="item detail"><span class="description">メールアドレス</span><span class="required_label">必須</span></div>
                            <div class="item value"><input type="email" name="your-email" placeholder="メールアドレスを入力してください"></div>
                        </div>
                        <div class="inner message">
                            <div class="item detail"><span class="description">メッセージ</span></div>
                            <div class="item value"><textarea name="message" placeholder="メッセージを入力してください"></textarea></div>
                        </div>
                        <div class="inner cf_privacy">
                            ※「営業メールの送付」や「弊社に許可なくメールマガジンへ登録する行為」はご遠慮ください。<br>
                            <a href="/privacy-policy/">プライバシーポリシー</a>に同意する
                        </div>
                        <div class="send_btn"><button type="submit">入力内容の確認</button></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-top">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/99-footer-logo.png" alt="なかむら編集室ロゴ" class="footer-logo">
                <span class="footer-title">なかむら編集室</span>
            </div>
            <div class="footer-bottom">
                <nav class="footer-links">
                    <a href="/privacy-policy" class="footer-link footer-link-underline">プライバシーポリシー</a>
                    <a href="/terms-of-service" class="footer-link">利用規約</a>
                    <a href="/specified-commercial-transaction" class="footer-link">特定商取引法に基づく表記の記載</a>
                </nav>
            </div>
            <div class="footer-copyright">©株式会社なかむら編集室</div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>

</html>