document.addEventListener('DOMContentLoaded', function () {
gsap.registerPlugin(ScrollTrigger);

// 表示パララックス
  //   const items = document.querySelectorAll(".service-item");
  //   items.forEach((item, index) => {
  //     gsap.from(item, {
  //       opacity: 0,
  //       y: 50,
  //       duration: 0.6,
  //       delay: index * 0.2,
  //       ease: "power2.out",
  //       scrollTrigger: {
  //         trigger: item,
  //         start: "top 80%",
  //         toggleActions: "play none none none",

  //       }
  //     });
  //   });
  // });

  // 傾くアニメーション
//   gsap.to(".cardDesign__shadow", {
//     scrollTrigger: {
//       trigger: ".cardDesign",
//       start: "top 80%",

//       // yoyo: true,
//       // toggleActions: "play none none none",
//     },
//     rotate: 0,
//     duration: 1, // 0.8秒かけて回転
//     ease: "power1.out",
//     // repeat: -1,
//     // repeatDelay: 3,
//     // yoyo: true
//   });
// });
