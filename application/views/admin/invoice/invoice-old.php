<html>
    <head>
        <style>
            body {font-family: sans-serif;
                  font-size: 10pt;
            }
            p {	margin: 0pt; }
            table.items {
                border: 0.1mm solid #000000;
            }
            td { vertical-align: top; }
            .items td {
                border-left: 0.1mm solid #000000;
                border-right: 0.1mm solid #000000;
            }
            table thead td { background-color: #EEEEEE;
                             text-align: center;
                             border: 0.1mm solid #000000;
                             font-variant: small-caps;
            }
            .items td.blanktotal {
                background-color: #EEEEEE;
                border: 0.1mm solid #000000;
                background-color: #FFFFFF;
                border: 0mm none #000000;
                border-top: 0.1mm solid #000000;
                border-right: 0.1mm solid #000000;
            }
            .items td.totals {
                text-align: right;
                border: 0.1mm solid #000000;
            }
            .items td.cost {
                text-align: "." center;
            }
        </style>
    </head>
    <body>

        <table width="100%" style="font-family: serif;font-size: 11px;">
            <tr>
                <td width="50%"><img src="<?=base_url('assets/frontend/img/logo.png');?>" width="70"><br/><span>GST Invoice</span></td>
                <td width="50%" style="text-align: right;"><br/>Shikshapay <br />3rd Floor, Maa Grace, 12, 7th Cross Road,<br/>Koramangala 1A Block, Bangalore<br/>Karnataka - 560034</td>
            </tr>
        </table>

        <br/>
        <table width="50%" style="border: 0.1mm solid #888888;font-family: serif;font-size: 12px;" cellspacing="0" cellpadding="10">
            <tr>
                <td style="border-right: 0.1mm solid #888888;">
                    Invoice Number<br />Date of Issue<br />State<br />Issuer GSTIN</td>
                <td>
                    058778399/000004<br />December 31, 2018<br />Karnataka<br />29AADCI1852LIZA</td>
            </tr></table>
        <br /><br />

        <table width="100%" style="font-family: serif;font-size: 12px;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: 0.1mm solid #888888;" width="33.33%">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" style="border-top: 0.1mm solid #888888;border-left: 0.1mm solid #888888;padding: 10px;background-color: #EEEEEE;">Customer Details</td>
                        </tr>
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;padding: 10px;">Name</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">Anurag Kumar</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">GSTIN</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">None</td>
                        </tr>
                    </table>
                </td>
                <td style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;" width="33.33%">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;border-right: 0.1mm solid #888888;padding: 10px;background-color: #EEEEEE;">Billing Address</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;border-top: 0.1mm solid #888888;">K2-46/A, Ring Road, Near Hill Top School Ground, Telco, Jasmshedpur, Surat, 395004, India</td>
                        </tr>
                    </table>
                </td>
                <td style="border: 0.1mm solid #888888;" width="33.33%">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;padding: 10px;background-color: #EEEEEE;">Shipping Address</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;border-top: 0.1mm solid #888888;">K2-46/A, Ring Road, Near Hill Top School Ground, Telco, Jasmshedpur, Surat, 395004, India</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br /><br />

        <table width="100%" style="font-family: serif;font-size: 11px;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: 0.1mm solid #888888;">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" style="padding: 10px;">Invoice Particulars</td>
                        </tr>
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;padding: 10px;">Item</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">SAC Code</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">Value</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2" style="padding: 10px;">SGST</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;border-right: 0.1mm solid #888888;">Rate</td>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;">Value</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2" style="padding: 10px;">CGST</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;border-right: 0.1mm solid #888888;">Rate</td>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;">Value</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td colspan="2" style="padding: 10px;">IGST</td>
                                    </tr>
                                    <tr>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;border-right: 0.1mm solid #888888;">Rate</td>
                                        <td width="50%" style="padding: 10px;border-top: 0.1mm solid #888888;">Value</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">Total Value</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;width: 200px;">Shikshapay Commission for the month of December, 2018</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">998319</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹0.76</td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="47%" style="border-right: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;"><?php echo $sgst ?>%</td>
                                        <td width="53%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">-</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="47%" style="border-right: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;"><?php echo $cgst ?>%</td>
                                        <td width="53%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">-</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="50%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">18%</td>
                                        <td width="50%" style="border-left: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">₹0.15</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹0.91</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;padding: 10px;text-align: right;">Total</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">₹0.76</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">0</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">0</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">₹0.15</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;">Taxable value of services</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹0.76</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">Amount of tax charged in respect of services (Central tax, State tax, Integrated tax, Union territory tax or cess)</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">₹0.15</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;">Total Amount Payable inclusive of GST tax (SGST, UGST, CGST, IGST)</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹0.91</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br /><br />

        <div style="font-family: serif;font-size: 11px;">
            <div>Total Amount Chargeable in words: Rupees Zero and Ninety One Paise Only</div>
            <br />
            <div style="font-weight: bold;">Declaration</div>
            <br /><br />

            <div>1) We declare that this invoice shows actual price of the goods and/or services described and that all particulars are true and correct.</div>
            <br />
            <div>2) Errors and Omissions in this invoices shall be subject to the jurisdiction of the Karnataka High Court.</div>
            <br />
            <div>3) All values are rounded to 2 decimal places at the payment level.</div>
        </div>
        <br />

        <div style="font-family: serif;font-size: 12px;">
            <div style="text-align: right;font-weight: bold;">For Shikshapay</div>
            <br /><br /><br />
            <div style="text-align: right;font-weight: bold;">Signature of an authorized representative<br/>of the service provider</div>
        </div>
    </body>
</html>