<?php

function registrationTemplate($name, $company, $email, $username) {
    return <<<HTML
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Registration Confirmation</title>
            <style>
                body {
                    margin: 30px auto;
                    max-width: 500px;
                    border: 1px solid #eee;
                    border-radius: 8px;
                }
            </style>
        </head>
        <body>
            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                <tr>
                    <td style="padding: 20px; text-align: center; background-color: #f0f0f0;">
                        <img src="https://www.ncu.edu.jm/img/ncu-logo2_inverted.af46fed3.png" alt="{$name}" style="max-width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px;">
                        <p style="margin: 0;">Hi {$name},</p>
                        <p style="margin: 0;">Thank you for registering on {$company}!</p>
                        <p style="margin: 0;">We've created an account for you with the following details:</p>
                        <ul>
                            <li><strong>Email:</strong> {$email}</li>
                            <li><strong>Username:</strong> {$username} (Optional)</li>
                        </ul>
                        <p style="margin: 0;">To start using your account, click the button below:</p>
                        <table style="width: 100%; margin: 8px 0">
                            <tr>
                                <td style="padding: 10px; text-align: center;">
                                    <a href="https://ncu-inauth.com/dashboard" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Dashboard</a>
                                </td>
                            </tr>
                        </table>
                        <p style="margin: 0;">If you have any questions, please don't hesitate to contact us.</p>
                        <p style="margin: 0;">Sincerely,</p>
                        <p style="margin: 0;">The {$company} Team</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; text-align: center; border-top: 1px solid #ccc;">
                        <small>
                            &copy; Orbit Ecommerce. All rights reserved.
                        </small>
                    </td>
                </tr>
            </table>
        </body>
    </html>
    HTML;
}


function contactUsTemplate($name, $company, $email, $subject) {
    return <<<HTML
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Registration Confirmation</title>
            <style>
                body {
                    margin: 30px auto;
                    max-width: 500px;
                    border: 1px solid #eee;
                    border-radius: 8px;
                }
            </style>
        </head>
        <body>
            <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
                <tr>
                    <td style="padding: 20px; text-align: center; background-color: #f0f0f0;">
                        <img src="https://www.ncu.edu.jm/img/ncu-logo2_inverted.af46fed3.png" alt="{$name}" style="max-width: 150px;">
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px;">
                        <p style="margin: 0;">Hi {$name},</p>
                        <p style="margin: 0;">Thank you for for reaching out to {$company}!</p>
                        <p style="margin: 0;">We've have received your response and will get to you shortly:</p>
                        <ul>
                            <li><strong>Email:</strong> {$email}</li>
                            <li><strong>Subject:</strong> {$subject} (Optional)</li>
                        </ul>
                        <p style="margin: 0;">To start using your account, click the button below:</p>
                        <table style="width: 100%; margin: 8px 0">
                            <tr>
                                <td style="padding: 10px; text-align: center;">
                                    <a href="https://ncu-inauth.com/dashboard" style="background-color: #007bff; color: white; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Dashboard</a>
                                </td>
                            </tr>
                        </table>
                        <p style="margin: 0;">If you have any questions, please don't hesitate to contact us.</p>
                        <p style="margin: 0;">Sincerely,</p>
                        <p style="margin: 0;">The {$company} Team</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px; text-align: center; border-top: 1px solid #ccc;">
                        <small>
                            &copy; Orbit Ecommerce. All rights reserved.
                        </small>
                    </td>
                </tr>
            </table>
        </body>
    </html>
    HTML;
}