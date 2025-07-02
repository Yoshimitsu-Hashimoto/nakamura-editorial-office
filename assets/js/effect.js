    document.addEventListener('DOMContentLoaded', function () {
        gsap.registerPlugin(ScrollTrigger);

        gsap.utils.toArray(".UpEffect").forEach((el, i) => {
            gsap.fromTo(
                el,
                {
                    y: 100,
                    autoAlpha: 0,
                },
                {
                    y: 0,
                    autoAlpha: 1,
                    delay: i * 0.2, // 要素ごとに0.2秒ずつ遅延
                    duration: 0.3, // アニメーションの時間
                    scrollTrigger: {
                        trigger: el,
                        toggleActions: "play none none reverse",
                        start: "top 80%",
                        once: true, // 一度だけ実行
                    },
                }
            );
        });
    });
