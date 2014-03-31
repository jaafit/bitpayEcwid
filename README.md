<strong>©2011-2014 BITPAY, INC.</strong>

Permission is hereby granted to any person obtaining a copy of this software and associated documentation for use and/or modification in association with the bitpay.com service.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Bitcoin plugin for Ecwid using the bitpay.com service.



Instructions
------------
In config.php:
- Set $storeURL to the URL of your store's homepage.
- Set $storeID to your ecwid store ID found in the bottom-right of the Ecwid control panel.
- Set $bitpayURL to the URL of the bitpay/ folder which you extracted from this plugin.
- Set $apiKey to the key you created at bitpay.com in the "My Account > API Access Keys" section.
- Adjust $speed if desired.
	
In your Ecwid control panel:
- Click System Settings > Payment, then click Authorize.  Rename this to "Bitpay" or whatever you'd prefer.  
- Change Payment Processor to Credit Card: Authorize.net SIM
- Click Account Details
- API Login ID: choose something random here and copy it to config.php's $login variable.
- Transaction Key: choose something random
- MD5 Hash value: choose something random here and copy it to config.php's $hashValue variable.
- Transaction Type: Authorize and Capture.
- Click Advanced Settings.
- Type in the url to bitpay/redirect2bitpay.php on your server.
- Click Save
- Click Save 
- Click Design > CSS Themes
- Either click "New CSS Theme" or edit your own theme.
- Add this to the text area of your custom theme:
<pre>
		/* bitpay checkout image */
		img.defaultCCImage {
			padding: 25px 263px 0px 0px; 
			background: url('https://en.bitcoin.it/w/images/en/2/29/BC_Logo_.png'); 
			background-size:auto; 
			background-repeat:no-repeat;
			width:0px; 
			height: 0px;
		}
</pre>
- Click Save


Troubleshooting
---------------
The official BitPay API documentation should always be your first reference for development: https://bitpay.com/downloads/bitpayApi.pdf

- Verify that your "notificationURL" for the invoice is "https://" (not "http://")
- Ensure a valid SSL certificate is installed on your server. Also ensure your root CA cert is updated. If your CA cert is not current, you will see curl SSL verification errors.
- Verify that your callback handler at the "notificationURL" is properly receiving POSTs. You can verify this by POSTing your own messages to the server from a tool like Chrome Postman.
- Verify that the POST data received is properly parsed and that the logic that updates the order status on the merchants web server is correct.
- Verify that the merchants web server is not blocking POSTs from servers it may not recognize. Double check this on the firewall as well, if one is being used.
- Use the logging functionality to log errors during development. If you contact BitPay support, they will ask to see the log file to help diagnose any problems.
- Check the version of this plugin against the official repository to ensure you are using the latest version. Your issue might have been addressed in a newer version of the library.
- If all else fails, send an email describing your issue in detail to support@bitpay.com


Version
-------
- Bitpay plugin version 1.0
- Tested against Ecwid version 13.0.1629
- Added new HTTP header for version tracking
