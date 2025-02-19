<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admission Confirmation</title>
    <style type="text/css">
      /* CLIENT-SPECIFIC STYLES */
      body, table, td, a {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
      }
      table, td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }
      img {
        -ms-interpolation-mode: bicubic;
        border: 0;
        display: block;
        outline: none;
        text-decoration: none;
      }
      table {
        border-collapse: collapse !important;
      }
      body {
        margin: 0;
        padding: 0;
        width: 100% !important;
      }
      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
      }
      /* Responsive Styles */
      @media screen and (max-width: 600px) {
        .email-container {
          width: 100% !important;
        }
      }
    </style>
  </head>
  <body style="background-color: #f7f7f7; margin: 0; padding: 0;">
    <!-- Preheader (hidden preview text) -->
    <div style="display: none; font-size: 1px; color: #f7f7f7; line-height: 1px; font-family: sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
      Admission Confirmation from Mazenod College
    </div>

    <!-- Start Email Container -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align="center" bgcolor="#f7f7f7">
          <table class="email-container" border="0" cellpadding="0" cellspacing="0" width="600" style="max-width:600px;">
            <!-- Logo Section -->
            <tr>
              <td align="center" valign="top" style="padding: 40px 10px 10px 10px;">
                <a href="https://mazenodcollege.lk/" target="_blank">
                  <img src="https://mazenodcollege.lk/wp-content/uploads/2023/02/Mazenod-College-High-res-2.png" width="200" style="display: block; border: 0px;" alt="Mazenod College Logo" />
                </a>
              </td>
            </tr>
            <!-- Main Content -->
            <tr>
              <td align="left" bgcolor="#ffffff" style="padding: 30px; font-family: 'Roboto', sans-serif; font-size: 16px; line-height: 24px; color: #333333;">
                <h2 style="margin: 0 0 20px 0; font-size: 24px; font-weight: 700; color: #333333;">Dear {{ $admission->name }},</h2>
                <p style="margin: 0 0 20px 0;">
                  Thank you for submitting your admission details to <strong>Mazenod College</strong>. We have received your information and our admissions team will review your submission shortly.
                </p>
                <p style="margin: 0 0 20px 0;">
                  If you have any questions, please feel free to contact our admissions office.
                </p>
                <p style="margin: 0 0 20px 0;">
                  We look forward to welcoming you to our community.
                </p>
                <p style="margin: 0;">
                  Best regards,<br />
                  <strong>Mazenod College</strong>
                </p>
              </td>
            </tr>
            <!-- Footer -->
            <tr>
              <td align="center" bgcolor="#f7f7f7" style="padding: 20px 30px; font-family: 'Roboto', sans-serif; font-size: 14px; line-height: 18px; color: #999999;">
                <p style="margin: 0;">
                  &copy; {{ date('Y') }} Mazenod College. All rights reserved.<br />
                  <a href="https://mazenodcollege.lk/" target="_blank" style="color: #999999; text-decoration: underline;">Visit our website</a>
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
