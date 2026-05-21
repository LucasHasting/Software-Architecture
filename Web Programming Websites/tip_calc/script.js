/* tip-calc JS */

function compute() {
    let cost = window.document.tip.cost.value;
    let quality = 0.0;

    if(window.document.tip.quality[0].checked)
        quality = 0.15;
    else if(window.document.tip.quality[1].checked)
        quality = 0.18;
    else if(window.document.tip.quality[2].checked)
        quality = 0.22;

    let tip = cost * (1 + quality);
    tip = tip.toFixed(2);

    window.document.tip.amount.value = tip;
}
