var otpRequestWaitMillis, previousPan, previousOTPRequestMillis, otpRemainingSeconds, keyPadInputId,
    globalRemainingSeconds, terminalDiscountStatus, panDtoList, encRefId, focusedField, shuffledArray,
    selectedPanIndex = -1, previousSelectedPanIndex = -1, ctrlDown = !1, ctrlKey = 17, cmdKey = 91,
    disableCountDown = !1, successfullyDone = !1, cursorPosition = 0, availableBankLogos = (selectedPanIndex = -1, {
        610433: "mellat",
        589905: "melli",
        170019: "melli",
        603799: "melli",
        603769: "saderat",
        639217: "keshavarzi",
        603770: "keshavarzi",
        589210: "sepah",
        627353: "tejarat",
        628023: "maskan",
        207177: "tose_saderat",
        627648: "tose_saderat",
        627961: "sanat_madan",
        627760: "postbank",
        621986: "saman",
        627412: "eghtesad_novin",
        639347: "pasargad",
        502229: "pasargad",
        639607: "sarmaye",
        627488: "karafarin",
        639194: "parsian",
        622106: "parsian",
        639346: "sina",
        589463: "refah",
        628157: "etebari_tose",
        504706: "shahr",
        502806: "shahr",
        502908: "tose_teavon",
        502938: "dey",
        606373: "gharzolhasane_mehr",
        639370: "etebari_mehr",
        627381: "ansar",
        636214: "ayandeh",
        636949: "hekmat_iranian",
        505785: "iran_zamin",
        505416: "gardeshgari",
        636795: "markazi",
        504172: "resalat",
        505801: "kosar",
        505809: "khavarmianeh",
        507677: "noor",
        606256: "melal",
        639599: "ghavamin"
    });

function validatePaymentInputs(e) {
    var n = !0;
    return validatePan() || (n = !1), e && !validateInput("inputpin", /\d{4,12}/) && (n = !1), validateInput("inputcvv2", /\d{3,4}/) || (n = !1), validateDate() || (n = !1), validateInput("inputcapcha", /\d{5}/) || (n = !1), validateInput("inputemail", /^(\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+)?$/) || (n = !1), document.getElementById("inputpayerid") && !validateInput("inputpayerid", /\d{1,30}/) && (n = !1), n ? hideMessage() : showMessage(i18n.invalidInput), n
}

function validateAllInputs() {
    var e = !0;
    return validatePan() || (e = !1), validateInput("inputpin", /\d{4,12}/) || (e = !1), validateInput("inputcvv2", /\d{3,4}/) || (e = !1), validateDate() || (e = !1), validateInput("inputcapcha", /\d{5}/) || (e = !1), validateInput("inputemail", /^(\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+)?$/) || (e = !1), document.getElementById("inputpayerid") && !validateInput("inputpayerid", /\d{1,30}/) && (e = !1), e ? hideMessage() : showMessage(i18n.invalidInput), e
}

function removeInvalidClassFromPan() {
    $(".cardnumberbox").parent().parent().removeClass("invalid")
}

function validatePan() {
    var e = checkPattern("cardnumber", /\d{4}\s?\d{4}\s?\d{4}\s?\d{4}/) || selectedPanIndex > -1 && checkPattern("cardnumber", /\d{4}\s?\d{2}(×){2}\s?(×){4}\s?\d{4}/);
    return e ? removeInvalidClassFromPan() : $(".cardnumberbox").parent().parent().addClass("invalid"), e
}

function sale() {
    var e = {
        card_number: selectedPanIndex >= 0 ? null : document.getElementById("cardnumber").value.replace(/ /g, ""),
        selectedPanIndex: selectedPanIndex,
        password: document.getElementById("inputpin").value,
        cvv2: document.getElementById("inputcvv2").value,
        month: document.getElementById("inputmonth") ? document.getElementById("inputmonth").value : null,
        year: document.getElementById("inputyear") ? document.getElementById("inputyear").value : null,
        captcha: document.getElementById("inputcapcha").value,
        email: document.getElementById("inputemail").value,
        savePan: !!document.getElementById("savePanCheckbox") && document.getElementById("savePanCheckbox").checked,
        invoice_key: invoice_key
    };
    showSubmitSpinner(), TurnON_OverlayLoading(), $.post(HTTP_SERVER + "/invoice/request/submit", e, function (e, n) {
        console.log(e), data2 = JSON.parse(e), processSaleResponse(data2)
    })
}

function processSaleResponse(e) {
    TurnOFF_OverlayLoading(), showWitcherMessage(e.WitcherMessage, e.WitcherMessage_Green), 1 == e.status ? showMessage(e.msg, !0) : showMessage(e.msg), 1 == e.refresh && setTimeout(function () {
        1 == e.status ? window.location.href = e.response_return_url : location.reload()
    }, 100)
}

function refreshCaptcha() {
    var e, n = $("#refreshCaptcha_button");
    n.attr("disabled", !0), n.css("background-image", "none"), n.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'), $.post(HTTP_SERVER + "/invoice/request/captcha", {invoice_key: invoice_key}, function (t, a) {
        console.log(t), n.attr("disabled", !1), n.removeAttr("style"), n.html(""), r = JSON.parse(t), 1 == r.status && (e = r.msg, $("#inputcapcha").val(""), document.getElementById("captcha-img").src = HTTP_SERVER + "/witcherAssets/captchaImages/" + e + ".png?" + Math.random())
    })
}

function showWitcherMessage(e, n = !1) {
    if (null != e) {
        var t = $("#WitcherMessage");
        t.html(e), n && t.addClass("info-message"), t.addClass("show"), setTimeout("hideWitcherMessage()", 1e4)
    }
}

function hideWitcherMessage() {
    $("#WitcherMessage").removeClass("show")
}

function showMessage(e, n) {
    $(".card-errorbox").html(e), n && $(".card-errorbox").addClass("info-message"), $(".card-errorbox").addClass("show"), setTimeout("hideMessage()", 1e4)
}

function hideMessage() {
    $(".card-errorbox").removeClass("show")
}

function handleSaleError(e, n, t) {
    hideSubmitSpinner(), hideCheckDiscountSpinner(), 0 === e.status ? showMessage(i18n.networkError) : 404 === e.status ? showMessage(i18n.systemInternalError) : 500 == e.status ? showMessage(i18n.systemInternalError) : "parsererror" === n ? showMessage(i18n.systemInternalError) : "timeout" === n ? showMessage(i18n.networkError) : "abort" === n ? showMessage(i18n.networkError) : "ajaxError" == e.type ? showMessage(i18n.networkError) : showMessage(i18n.systemInternalError)
}

function validateAndSale(e) {
    validateAllInputs() && sale()
}

function removeInvalidClassFromInput(e) {
    $("#" + e).parent().parent().removeClass("invalid")
}

function validateInput(e, n) {
    return checkPattern(e, n) ? (removeInvalidClassFromInput(e), !0) : ($("#" + e).parent().parent().addClass("invalid"), !1)
}

function validateDate() {
    var e = !0;
    if ($("#inputmonth:visible").length > 0) {
        checkPattern("inputmonth", /\d{2}/) || (e = !1);
        var n = document.getElementById("inputmonth").value;
        (n < 1 || n > 12) && (e = !1)
    }
    return $("#inputyear:visible").length > 0 && !checkPattern("inputyear", /\d{2}/) && (e = !1), e ? removeInvalidClassFromInput("inputmonth") : $("#inputmonth").parent().parent().addClass("invalid"), e
}

function focusNextField(e, n, t) {
    if (isNumericKeyDownOrUp(getEventKeyCode(t)) && e.value.length >= e.maxLength) for (var a = n.split("|"), i = 0; i < a.length; i++) {
        var s = a[i];
        if ($("#" + s + ":visible").length > 0) {
            var o = document.getElementById(s);
            o.focus(), o.setSelectionRange(0, o.value.length);
            break
        }
    }
}

function hideKeyPadOnTab(e) {
    9 === getEventKeyCode(e) && hideKeyPad()
}

function checkPattern(e, n) {
    return n.test(document.getElementById(e).value)
}

function setPanCursorPosition(e) {
    var n = document.getElementById("cardnumber"), t = getEventKeyCode(e);
    if (cursorPosition = n.selectionStart, 8 === t) {
        if (0 !== cursorPosition) {
            var a = n.value.substring(n.selectionStart, n.selectionEnd);
            / /.test(a) ? 5 !== cursorPosition && 10 !== cursorPosition && 15 !== cursorPosition || cursorPosition-- : (6 !== cursorPosition && 11 !== cursorPosition && 16 !== cursorPosition || cursorPosition--, cursorPosition--), cursorPosition = cursorPosition < 0 ? 0 : cursorPosition
        }
    } else 46 === t ? 4 !== cursorPosition && 9 !== cursorPosition && 14 !== cursorPosition || cursorPosition++ : isNumericKeyDownOrUp(t) && (3 !== cursorPosition && 8 !== cursorPosition && 13 !== cursorPosition && 4 !== cursorPosition && 9 !== cursorPosition && 14 !== cursorPosition || cursorPosition++, cursorPosition++)
}

function formatPanOnKeyDown(e) {
    if (shouldIgnore(getEventKeyCode(e))) return !0;
    var n = document.getElementById("cardnumber"), t = concatNumericChars(n.value, 16);
    n.value = getFormattedPan(t)
}

function shouldIgnore(e) {
    return !(!e || isNumericKeyDownOrUp(e) || ctrlDown && 86 === e)
}

function formatPanOnKeyUp(e) {
    var n = getEventKeyCode(e);
    if (shouldIgnore(n)) return !0;
    var t = document.getElementById("cardnumber"), a = concatNumericChars(t.value, 16);
    t.value = getFormattedPan(a), !n || isNumericKeyDownOrUp(n)
}

function getFormattedPan(e) {
    for (var n, t = "", a = /\d{1,4}/g; null != (n = a.exec(e));) 0 !== t.length && (t += " "), t += n[0];
    return t
}

function concatNumericChars(e, n) {
    for (var t, a = "", i = /\d{1,16}/g; null != (t = i.exec(e)) && a.length < n;) a += t[0];
    return a.length > n && (a = a.substring(0, n)), a
}

function extractNumbers(e, n) {
    var t = e.value;
    t = concatNumericChars(t, n), e.value = t
}

function preventInvalidKeys(e) {
    var n = getEventKeyCode(e);
    return -1 !== [16, 17, 91, 0, 13, 8, 9, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46].indexOf(n) || !!isNumericKeyDownOrUp(n) || !!ctrlDown || n >= 112 && n <= 123 || (window.event ? window.event.returnValue = !1 : e.preventDefault(), !1)
}

function isNumericKeyDownOrUp(e) {
    return e > 47 && e < 58 || e > 95 && e < 106
}

function getEventKeyCode(e) {
    return window.event ? e.keyCode : e.which
}

function cancelPay() {
    return window.location.href = HTTP_SERVER + "/invoice/payy/cancel"
}

function countDownRemainingTime(e) {
    if (!disableCountDown) {
        if (e <= 0) stopCountDown(), successfullyDone || (document.getElementById("ResCode").value = "415", document.forms.returnForm.submit()); else {
            var n = Math.floor(e / 60), t = e % 60;
            $("#remaining-time b").text((n + "").padStart(2, "0") + ":" + (t + "").padStart(2, "0"))
        }
        globalRemainingSeconds = e - 1, setTimeout("countDownRemainingTime(globalRemainingSeconds)", 1e3)
    }
}

function stopCountDown() {
    disableCountDown = !0, $("#remaining-time b").text("--:--")
}

function fillField(e, n) {
    if (focusedField) {
        n.preventDefault(), n.stopPropagation(), focusedField.focus();
        var t, a = e.value, i = focusedField.selectionStart, s = focusedField.selectionEnd;
        (t = i === focusedField.value.length ? focusedField.value + a : focusedField.value.substring(0, i) + a + focusedField.value.substring(s, focusedField.value.length)).length <= focusedField.maxLength && (focusedField.value = t), focusedField.value.length === focusedField.maxLength && keypadTab()
    }
    return !1
}

function keypadTab() {
    hideKeyPad();
    var e = "inputpin" === focusedField.id ? "inputcvv2" : "inputmonth", n = document.getElementById(e);
    n.focus(), n.setSelectionRange(0, n.value.length)
}

function keyPadBackspace(e) {
    if (focusedField) {
        e.preventDefault(), e.stopPropagation();
        var n = focusedField.selectionStart, t = focusedField.selectionEnd;
        n === focusedField.value.length ? focusedField.value = focusedField.value.substring(0, focusedField.value.length - 1) : focusedField.value = n === t ? focusedField.value.substring(0, n - 1) + focusedField.value.substring(t, focusedField.value.length) : focusedField.value.substring(0, n) + focusedField.value.substring(t, focusedField.value.length)
    }
    return !1
}

function setFocusedField(e) {
    focusedField = e
}

function shuffleKeyPad() {
    shuffledArray = shuffle([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
    for (var e = 0; e < shuffledArray.length; e++) {
        var n = "num" + e, t = document.getElementById(n);
        t.value = shuffledArray[e], t.innerHTML = shuffledArray[e]
    }
}

function showKeyPad(e, n) {
    var t = document.getElementById(e);
    return t.focus(), t.setSelectionRange(0, t.value.length), setFocusedField(t), shuffledArray || shuffleKeyPad(), $(".keypad-container").insertAfter("#" + e), $(".keypad-container").addClass("openkeypad"), n && (n.preventDefault(), n.stopPropagation()), !1
}

function hideKeyPad() {
    $(".keypad-container").removeClass("openkeypad")
}

function hideOthersKeypad(e) {
    e.id !== keyPadInputId && hideKeyPad()
}

function shuffle(e) {
    var n, t, a;
    for (a = e.length - 1; a > 0; a--) n = Math.floor(Math.random() * (a + 1)), t = e[a], e[a] = e[n], e[n] = t;
    return e
}

function waitAndSendSuccessResult(e) {
    e <= 0 ? document.getElementById("return-button").disabled || sendSuccessResult() : ($(".timer").text(i18n.redirectRemainingTime + e), globalRemainingSeconds = e - 1, setTimeout("waitAndSendSuccessResult(globalRemainingSeconds)", 1e3))
}

function sendSuccessResult() {
    document.getElementById("return-button").disabled || (document.getElementById("return-button").disabled = !0, $("#return-button").attr("disabled", "disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' + i18n.redirectingToMerchantSite), $(".timer").hide(), document.forms.returnForm.submit(), setTimeout("enableReturnButton()", 3e4))
}

function enableReturnButton() {
    $("#return-button").attr("disabled", "disabled").html(i18n.continueShopping), document.getElementById("return-button").disabled = !1
}

function hideKeyPadOnOutsideClick(e) {
    $(".keypad-container").parent()[0] !== e.target && 0 === $(e.target).parents(".keypad-parent").length && hideKeyPad()
}

function hideCardSuggestionListOnOutSideClick(e) {
    $(".cardnumberbox")[0] !== e.target && 0 === $(e.target).parents(".cardnumberbox").length && hideCardSuggestionList()
}

function showSubmitSpinner() {
    $(".btn-decline").hide(), $(".btn-submit-form").addClass("perches-requested"), $(".btn-perches").attr("disabled", "disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
}

function hideSubmitSpinner() {
    $(".btn-perches").attr("disabled", "").html(i18n.pay), $(".btn-submit-form").removeClass("perches-requested"), $(".btn-decline").show()
}

function showBankLogoSpinner() {
    $(".banklogo").append('<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>')
}

function hideBankLogoSpinner() {
    $(".banklogo").find(".spinner-border").remove()
}

function showCheckDiscountSpinner() {
    $(".banklogo").append('<span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>')
}

function hideCheckDiscountSpinner() {
    $(".banklogo").find(".spinner-border").remove()
}

function checkPanDiscount() {
    if (1 === terminalDiscountStatus) {
        var e = document.getElementById("cardnumber").value.replace(/ /g, "");
        if (selectedPanIndex >= 0 || 16 === e.length) {
            var n = (new Intl.NumberFormat).format(originalAmount);
            $(".price-number").text(n + " " + i18n.rial), prepare4DiscountServiceCall(), selectedPanIndex >= 0 ? $.post("discount.mellat", {
                W_REFID: encRefId,
                SELECTED_PAN_INDEX: selectedPanIndex
            }, processDiscountResponse) : $.post("discount.mellat", {
                W_REFID: encRefId,
                PAN: e
            }, processDiscountResponse)
        }
    }
}

function prepare4DiscountServiceCall() {
    showCheckDiscountSpinner(), $("payButton").attr("disabled", "disabled")
}

var processDiscountResponse = function (e) {
    if (hideCheckDiscountSpinner(), e) if ("SUCCESSFUL" === (e = JSON.parse(e)).status) {
        var n = new Intl.NumberFormat, t = n.format(e.discountAmount), a = n.format(e.amountAfterDiscount);
        if (0 !== e.discountAmount) {
            var i = i18n.discountMessage.replace("${amount}", t) + "<br>" + i18n.finalAmount + " " + a + " " + i18n.rial;
            e.description && (i += "<br>" + e.description), openDiscountDialog(i, e.amountAfterDiscount)
        } else e.description && openDiscountDialog(i = i18n.discountDescriptionMessage.replace("${description}", e.description) + "<br>", e.amountAfterDiscount);
        $("payButton").attr("disabled", "")
    } else "MAX_DISCOUNT_CALL_EXCEEDED" === e.status ? showMessage(i18n.maxDiscountCallExceeded) : showMessage(i18n.systemErrorInDiscountCheck); else showMessage(i18n.systemErrorInDiscountCheck)
};

function openDiscountDialog(e, n) {
    $(".modal-body p").html(e), $(".modal-footer .btn-primary").click(function () {
        setAmount(n), hideCheckDiscountSpinner(), hideDiscountDialog()
    }), $(".modal-footer .btn-secondary").click(function () {
        setAmount(originalAmount), hideCheckDiscountSpinner(), hideDiscountDialog();
        var e = document.getElementById("cardnumber");
        e.focus(), e.setSelectionRange(0, e.value.length)
    }), showDiscountDialog(), hideKeyPad(), $(".modal-footer .btn-primary").focus()
}

function setPan(e) {
    $("#cardnumber").val(e), removeInvalidClassFromPan()
}

function hideDiscountDialog() {
    $(".modal-backdrop").hide(), $(".modal").hide()
}

function showDiscountDialog() {
    $(".modal-backdrop").show(), $(".modal").show()
}

function setAmount(e) {
    var n = new Intl.NumberFormat;
    $(".price-number").text(n.format(e) + " " + i18n.rial)
}

function setCardSuggestionListHeight() {
    var e = .7 * $(".carddetail").height() + "px";
    $(".card-suggestionlist").css({"max-height": e})
}

function filterAndShowCardSuggestionList() {
    var e = [];
    if (panDtoList) for (var n = document.getElementById("cardnumber").value.replace(/ /g, ""), t = n.length < 7 ? n : n.substring(0, 6), a = 0; a < panDtoList.length; a++) {
        var i = panDtoList[a];
        i.index = a, 0 === i.maskedPan.lastIndexOf(t, 0) && e.push(i)
    }
    showCardSuggestionList(e)
}

function toggleAllPans() {
    if ($("#card-list-button.close-button").length > 0) hideCardSuggestionList(); else {
        for (var e = 0; e < panDtoList.length; e++) panDtoList[e].index = e;
        showCardSuggestionList(panDtoList);
        var n = document.getElementById("cardnumber");
        n.focus(), n.setSelectionRange(0, n.value.length)
    }
}

function showCardSuggestionList(e) {
    if (e.length > 0) {
        $(".card-suggestionlist").children("a:not(.editcard)").remove();
        for (var n = e.length - 1; n > -1; n--) {
            var t = e[n], a = t.maskedPan, i = a.substring(0, 6),
                s = '<a class="dropdown-item" href="#" tabindex="-1"  onclick="selectPan(' + t.index + ',event)"><span>' + (isBankLogoAvailable(i) ? '<img src="' + getBankLogoSrc(i) + '">' : "") + "</span>" + a + " " + t.bankName + "</a>";
            $(".card-suggestionlist").prepend(s)
        }
        $(".cardnumberbox").addClass("opensugestion"), $("#card-list-button").addClass("close-button")
    } else hideCardSuggestionList()
}

function setBankLogo() {
    $(".banklogo").children().remove();
    var e = document.getElementById("cardnumber").value.replace(/ /g, "");
    if (e.length >= 6) {
        var n = e.substring(0, 6);
        if (isBankLogoAvailable(n)) {
            var t = '<img src="' + getBankLogoSrc(n) + '">';
            $(".banklogo").append(t)
        }
    }
}

function hideCardSuggestionList() {
    $(".cardnumberbox").removeClass("opensugestion"), $("#card-list-button").removeClass("close-button")
}

function selectPan(e) {
    if (selectedPanIndex = -1, c < panDtoList.length) {
        var n = panDtoList[c], t = n.maskedPan, a = t.substring(0, 4);
        a += " " + t.substring(4, 6), a += "×× ×××× ", setPan(a += t.substring(t.length - 4, t.length)), selectedPanIndex = c, n.hasExpireDate && maskExpireDate(), n.email && $("#inputemail").val(n.email);
        var i = document.getElementById("inputpin");
        showKeypadJustInMobile("inputpin", e), i.focus(), i.setSelectionRange(0, i.value.length), $("#inputcvv2").val(""), hideCardSuggestionList(), setBankLogo(), handlePanChange()
    } else hideCardSuggestionList(), setBankLogo()
}

function maskExpireDate() {
    var e = $("#inputmonth").val("").hide().attr("class"), n = $("#inputyear").val("").hide().attr("class"),
        t = '<input type="password" style="background-color: #FFFFFF" class="' + e + '" tabindex="-1" value="**" onclick="unmaskExpireDate(true)" readonly/>';
    $("#inputmonth").next().remove(), $(t).insertAfter("#inputmonth");
    var a = '<input type="password" style="background-color: #FFFFFF" class="' + n + '" tabindex="-1" value="**" onclick="unmaskExpireDate(true)" readonly/>';
    $("#inputyear").next().remove(), $(a).insertAfter("#inputyear")
}

function unmaskExpireDate(e) {
    $("#inputmonth").next().remove(), $("#inputyear").next().remove(), e ? $("#inputmonth").show().focus() : $("#inputmonth").show(), $("#inputyear").show()
}

function handlePanChange() {
    var e = document.getElementById("cardnumber").value.replace(/ /g, "");
    isNewPan(e) && (previousSelectedPanIndex = selectedPanIndex, previousPan = e, terminalDiscountStatus > 0 && checkPanDiscount(e), showDynamicPinDialog())
}

function isBankLogoAvailable(e) {
    return e = parseInt(e), !!availableBankLogos[e]
}

function resetSelectedPan(e) {
    if (shouldIgnore(getEventKeyCode(e))) return !0;
    selectedPanIndex = -1, unmaskExpireDate(!1)
}

function getBankLogoSrc(e) {
    return "/witcherAssets/pgwchannel/img/bank-logo/" + availableBankLogos[e] + ".png"
}

function isNewPan(e) {
    var n = document.getElementById("cardnumber").value.replace(/ /g, "");
    return selectedPanIndex >= 0 && previousSelectedPanIndex !== selectedPanIndex || 16 === e.length && n !== e
}

function validateAndRequestOTP() {
    if (validatePaymentInputs(!1)) {
        var e = document.getElementById("cardnumber").value.replace(/ /g, "");
        isNewPan(e) ? (previousSelectedPanIndex = selectedPanIndex, previousPan = e, requestOTP()) : (new Date).getTime() - previousOTPRequestMillis < otpRequestWaitMillis ? showMessage(i18n.otpWaitMessage) : requestOTP()
    }
}

function requestOTP() {
    $("#otp-button").attr("disabled", !0), disableOtpButton(), disableCaptcha(), showBankLogoSpinner();
    selectedPanIndex >= 0 || document.getElementById("cardnumber").value.replace(/ /g, ""), document.getElementById("inputcapcha").value;
    var e = {
        card_number: selectedPanIndex >= 0 ? null : document.getElementById("cardnumber").value.replace(/ /g, ""),
        selectedPanIndex: selectedPanIndex,
        password: document.getElementById("inputpin").value,
        cvv2: document.getElementById("inputcvv2").value,
        month: document.getElementById("inputmonth") ? document.getElementById("inputmonth").value : null,
        year: document.getElementById("inputyear") ? document.getElementById("inputyear").value : null,
        captcha: document.getElementById("inputcapcha").value,
        email: document.getElementById("inputemail").value,
        savePan: !!document.getElementById("savePanCheckbox") && document.getElementById("savePanCheckbox").checked,
        invoice_key: invoice_key
    };
    $.post(HTTP_SERVER + "/invoice/request/otp_request", e, function (e, n) {
        console.log(e), data2 = JSON.parse(e), processOtpResponse(data2)
    })
}

function processOtpResponse(e) {
    var n = $("#otp-button");
    if (hideBankLogoSpinner(), e) {
        switch (e.status) {
            case 1:
                showMessage(e.msg, !0), previousOTPRequestMillis = (new Date).getTime(), countDownDynamicPinRemainingTime(120);
                break;
            case 0:
            case-1:
                showMessage(e.msg), enableOtpButton(), n.attr("disabled", !1)
        }
        showWitcherMessage(e.WitcherMessage, e.WitcherMessage_Green), 1 == e.refresh && setTimeout(function () {
            window.location.reload(1)
        }, 3e3), 1 == e.user_captcha_reset ? (enableCaptcha(), refreshCaptcha()) : (showMessage(e.msg, !0), previousOTPRequestMillis = (new Date).getTime(), countDownDynamicPinRemainingTime(120))
    } else n.attr("disabled", !1), showMessage(e.msg)
}

function disableOtpButton() {
    $("#otp-button").attr("disabled", "disabled")
}

function enableOtpButton() {
    $("#otp-button").removeAttr("disabled")
}

function disableCaptcha() {
    $("#captcha-button").attr("disabled", "disabled"), $("#inputcapcha").attr("disabled", "disabled")
}

function enableCaptcha() {
    $("#captcha-button").removeAttr("disabled"), $("#inputcapcha").removeAttr("disabled")
}

function countDownDynamicPinRemainingTime(e) {
    var n = $("#otp-button");
    if (e <= 0) n.text(i18n.otpRequest), n.attr("disabled", !1), enableOtpButton(), enableCaptcha(), refreshCaptcha(), showMessage(i18n.otpRetryMessage); else {
        var t = Math.floor(e / 60), a = e % 60;
        n.text((t + "").padStart(2, "0") + ":" + (a + "").padStart(2, "0")), n.attr("disabled", !0), otpRemainingSeconds = e - 1, setTimeout("countDownDynamicPinRemainingTime(otpRemainingSeconds)", 1e3)
    }
}