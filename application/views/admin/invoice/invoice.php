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
                <td width="50%"><img src="<?php echo base_url() . INVOICE . $setting_data->logo; ?>" width="70"><br/><span>GST Invoice</span></td>
                <td width="50%" style="text-align: right;"><br/><?php echo nl2br($setting_data->address); ?></td>
            </tr>
        </table>

        <br/>
        <table width="50%" style="border: 0.1mm solid #888888;font-family: serif;font-size: 12px;" cellspacing="0" cellpadding="10">
            <tr>
                <td style="border-right: 0.1mm solid #888888;">
                    Invoice Number<br />Date of Issue<br />State<br />Issuer GSTIN</td>
                <td>
                    <?php echo $setting_data->invoice_number; ?><br /><?php echo $setting_data->date_of_issue; ?><br /><?php echo $setting_data->state; ?><br /><?php echo $setting_data->issuer_gstin; ?></td>
            </tr></table>
        <br /><br />

        <table width="100%" style="font-family: serif;font-size: 12px;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border: 0.1mm solid #888888;" width="50%">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td colspan="2" style="border-top: 0.1mm solid #888888;border-left: 0.1mm solid #888888;padding: 10px;background-color: #EEEEEE;">Customer Details</td>
                        </tr>
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;padding: 10px;">Name</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;"><?php echo $setting_data->customer_name; ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">GSTIN</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;"><?php echo $setting_data->gstin; ?></td>
                        </tr>
                    </table>
                </td>
                <td style="border: 0.1mm solid #888888;" width="50%">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="border-top: 0.1mm solid #888888;padding: 10px;background-color: #EEEEEE;">Billing Address</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;border-top: 0.1mm solid #888888;"><?php echo $setting_data->blling_address; ?></td>
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
                            <td style="padding: 10px;width: 200px;"><?php echo $setting_data->item_title; ?></td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;"><?php echo $setting_data->sac_code; ?></td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹<?php echo $setting_data->value; ?></td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="47%" style="border-right: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;"><?php echo $setting_data->sgst ?>%</td>
                                        <td width="53%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">-</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="47%" style="border-right: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;"><?php echo $setting_data->cgst ?>%</td>
                                        <td width="53%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">-</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="50%" style="padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;"><?php echo $setting_data->igst_rate; ?>%</td>
                                        <td width="50%" style="border-left: 0.1mm solid #888888;padding-top: 10px;padding-left: 10px;padding-bottom: 28px;padding-right: 10px;">₹<?php echo $setting_data->igst_value; ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹<?php echo $setting_data->total_value; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 0.1mm solid #888888;border-bottom: 0.1mm solid #888888;padding: 10px;text-align: right;">Total</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">₹<?php echo $setting_data->value; ?></td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">0</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">0</td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;text-align: right;">₹<?php echo $setting_data->igst_value; ?></td>
                            <td style="border: 0.1mm solid #888888;padding: 10px;border-right: 0px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;">Taxable value of services</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹<?php echo $setting_data->taxable_value; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">Amount of tax charged in respect of services (Central tax, State tax, Integrated tax, Union territory tax or cess)</td>
                            <td style="border: 0.1mm solid #888888;border-right: 0px;padding: 10px;">₹<?php echo $setting_data->charge_amount; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding: 10px;">Total Amount Payable inclusive of GST tax (SGST, UGST, CGST, IGST)</td>
                            <td style="border-left: 0.1mm solid #888888;padding: 10px;">₹<?php echo $setting_data->payable_amount; ?></td>
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