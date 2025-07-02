function typingEffect(el, textSteps) {
    const target = document.querySelector(el);
    target.textContent = "";

    let fullText = "";
    let delay = 0;

    textSteps.forEach(step => {
        const { hiragana, kanji, convert } = step;
        if (convert) {
            // ひらがなを1文字ずつ追加
            [...hiragana].forEach((char, index) => {
                setTimeout(() => {
                    fullText += char;
                    target.textContent = fullText;
                }, delay + 200 * index);
            });

            // 変換して漢字に差し替える
            delay += 200 * hiragana.length;
            setTimeout(() => {
                fullText = fullText.slice(0, -hiragana.length) + kanji;
                target.textContent = fullText;
            }, delay);
        } else {
            // 通常文字列を1文字ずつ追加
            [...kanji].forEach((char, index) => {
                setTimeout(() => {
                    fullText += char;
                    target.textContent = fullText;
                }, delay + 200 * index);
            });
            delay += 200 * kanji.length;
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    typingEffect(".typing_animation", [
        { hiragana: "へんしゅう", kanji: "編集", convert: true },
        { hiragana: "のちからで", kanji: "の力で", convert: true },
        { hiragana: "「つたえる", kanji: "「伝える」", convert: true },
        { hiragana: "をおてつだいします", kanji: "をお手伝いします。", convert: true }
    ]);
});
