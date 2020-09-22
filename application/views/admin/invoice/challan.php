<html>
    <body>
        <table width="100%" style="font-family: serif;font-size: 75px;">
            <tr>
                <td width="90%" style="padding: 20px 50px;padding-left: 0px;padding-right: 150px;float: left;">
                    <table width="100%" style="font-family: serif;font-size: 75px;">
                        <tr>
                            <td style="padding: 30px;text-align: center"><?= $challan_title; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" style="border: 0.1mm solid #888888;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td width="50%" style="border-right: 0.1mm solid #888888;font-size: 75px;padding: 30px;text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $bank_logo; ?>" width="100%">
                                            <div style="border: 0.1mm solid #888888;">A Govt. of India Owned Bank</div>
                                        </td>
                                        <td width="50%" style="text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $school_logo; ?>" width="40%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;font-size: 75px;padding: 30px;">
                                            <div><?= $bank_title; ?></div>
                                        </td>
                                        <td style="border: 0.1mm solid #888888;border-left: 0px;font-size: 75px;padding: 30px;">
                                            <div><?= $school_title; ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="320">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Year</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Branch</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Roll No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Student Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Father's Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">DD No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Name of Bank</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Date</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Amount</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Student</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Mobile No.</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-right: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;border-top: 0px;" width="79%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;"><?= $year; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_branch; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $roll_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $student_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $father_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $date; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $amount; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td style="font-size: 75px;padding: 30px;text-align: center;">
                                            <div style="font-size: 75px;padding: 30px;font-weight: bold;">For Office Use only</div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="300">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Date of DD Deposit</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Bank Official</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-bottom: 0.1mm solid #888888;border-right: 0.1mm solid #888888;border-top: 0px;" width="80%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;">
                                    <tr>
                                        <td style="padding: 30px;line-height: 130px;"><?= nl2br($notes); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                
                <td width="90%" style="padding: 20px 50px;padding-left: 75px;padding-right: 75px;">
                    <table width="100%" style="font-family: serif;font-size: 75px;">
                        <tr>
                            <td style="padding: 30px;text-align: center"><?= $challan_title; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" style="border: 0.1mm solid #888888;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td width="50%" style="border-right: 0.1mm solid #888888;font-size: 75px;padding: 30px;text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $bank_logo; ?>" width="100%">
                                            <div style="border: 0.1mm solid #888888;">A Govt. of India Owned Bank</div>
                                        </td>
                                        <td width="50%" style="text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $school_logo; ?>" width="40%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;font-size: 75px;padding: 30px;">
                                            <div><?= $bank_title; ?></div>
                                        </td>
                                        <td style="border: 0.1mm solid #888888;border-left: 0px;font-size: 75px;padding: 30px;">
                                            <div><?= $school_title; ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="320">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Year</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Branch</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Roll No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Student Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Father's Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">DD No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Name of Bank</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Date</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Amount</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Student</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Mobile No.</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-right: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;border-top: 0px;" width="79%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;"><?= $year; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_branch; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $roll_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $student_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $father_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $date; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $amount; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td style="font-size: 75px;padding: 30px;text-align: center;">
                                            <div style="font-size: 75px;padding: 30px;font-weight: bold;">For Office Use only</div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="300">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Date of DD Deposit</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Bank Official</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-bottom: 0.1mm solid #888888;border-right: 0.1mm solid #888888;border-top: 0px;" width="80%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;">
                                    <tr>
                                        <td style="padding: 30px;line-height: 130px;"><?= nl2br($notes); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                
                <td width="90%" style="padding: 20px 50px;padding-left: 150px;padding-right: 0px;float: right;">
                    <table width="100%" style="font-family: serif;font-size: 75px;">
                        <tr>
                            <td style="padding: 30px;text-align: center"><?= $challan_title; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" style="border: 0.1mm solid #888888;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td width="50%" style="border-right: 0.1mm solid #888888;font-size: 75px;padding: 30px;text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $bank_logo; ?>" width="100%">
                                            <div style="border: 0.1mm solid #888888;">A Govt. of India Owned Bank</div>
                                        </td>
                                        <td width="50%" style="text-align: center;">
                                            <img src="<?= base_url() . CHALLAN . $school_logo; ?>" width="40%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;font-size: 75px;padding: 30px;">
                                            <div><?= $bank_title; ?></div>
                                        </td>
                                        <td style="border: 0.1mm solid #888888;border-left: 0px;font-size: 75px;padding: 30px;">
                                            <div><?= $school_title; ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="320">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Year</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Branch</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Roll No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Student Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Father's Name</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">DD No.</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Name of Bank</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Date</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Amount</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Student</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Mobile No.</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-right: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;border-top: 0px;" width="79%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;"><?= $year; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_branch; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $roll_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $student_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $father_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $bank_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $date; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;"><?= $amount; ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="10">
                                    <tr>
                                        <td style="font-size: 75px;padding: 30px;text-align: center;">
                                            <div style="font-size: 75px;padding: 30px;font-weight: bold;">For Office Use only</div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="font-family: serif;font-size: 75px;" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="border: 0.1mm solid #888888;border-top: 0px;" width="300">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">Date of DD Deposit</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">Sign of Bank Official</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border-bottom: 0.1mm solid #888888;border-right: 0.1mm solid #888888;border-top: 0px;" width="80%">
                                            <table style="font-size: 75px;" width="100%" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;border-top: 0.1mm solid #888888;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 30px;">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>

                                <table width="100%" style="border: 0.1mm solid #888888;border-top: 0px;font-family: serif;font-size: 75px;">
                                    <tr>
                                        <td style="padding: 30px;line-height: 130px;"><?= nl2br($notes); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>