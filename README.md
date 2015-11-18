# Notice

This is a Community-supported project.

If you are interested in becoming a maintainer of this project, please contact us at integrations@bitpay.com. Developers at BitPay will attempt to work along the new maintainers to ensure the project remains viable for the foreseeable future.

# Description

Bitcoin payment plugin for Ecwid using the bitpay.com service.


## Quick Start Guide

* Last Version Tested: 13.0.1629

To get up and running with our plugin quickly, see the GUIDE here: https://github.com/bitpay/ecwid-plugin/blob/master/GUIDE.md


## Troubleshooting

The official BitPay API documentation should always be your first reference for development: https://bitpay.com/downloads/bitpayApi.pdf

- Verify that your "notificationURL" for the invoice is "https://" (not "http://")
- Ensure a valid SSL certificate is installed on your server. Also ensure your root CA cert is updated. If your CA cert is not current, you will see curl SSL verification errors.
- Verify that your callback handler at the "notificationURL" is properly receiving POSTs. You can verify this by POSTing your own messages to the server from a tool like Chrome Postman.
- Verify that the POST data received is properly parsed and that the logic that updates the order status on the merchants web server is correct.
- Verify that the merchants web server is not blocking POSTs from servers it may not recognize. Double check this on the firewall as well, if one is being used.
- Use the logging functionality to log errors during development. If you contact BitPay support, they will ask to see the log file to help diagnose any problems.
- Check the version of this plugin against the official repository to ensure you are using the latest version. Your issue might have been addressed in a newer version of the library.
- If all else fails, send an email describing your issue in detail to support@bitpay.com


## Version History

- Bitpay plugin version 1.0
- Tested against Ecwid version 13.0.1629
- Added new HTTP header for version tracking


## License

©2011-2015 BITPAY, INC.

The MIT License (MIT)

Permission is hereby granted to any person obtaining a copy of this software and associated documentation for use and/or modification in association with the bitpay.com service.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

