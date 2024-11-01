=== VerifiedVisitors ===
Contributors: verifiedvisitors
Tags: Bots, security, firewall, bot mitigation, Account Takeover, protection, bot management, API endpoint protection, credit card gateway protection, payment gateway protection, ATO
Requires at least: 4.9
Tested up to: 6.4
Stable tag: 1.1.2
Requires PHP: 7.2
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

VerifiedVisitors is a powerful AI/ML bot mitigation plugin to support the Wordpress community. It’s an easy to configure platform to defeat bad bots.


== Description ==

VerifiedVisitors is a bank grade AI/ML bot mitigation platform built from the ground up to support the Wordpress community.

**How does it work?**

By deploying our agent, VerifiedVisitors helps to protect your web estate from unwanted and malicious bot traffic using the plugin init hook to verify visitors and block unwanted or potentially malicious traffic.
Our intelligent detectors examine thousands of diverse security signals, separate out the legitimate bots and users from the malicious ones by learning from your traffic.
Our customers receive security protection from malicious bot activity such as account takeover, credit card attacks, and content scraping, and we can help save you valuable energy resources on web hosting, bandwidth, and CPU.
All the bot detection and mitigation happens at the earliest part of the visitors journey - the plugin takes minutes to install. Setup is simple, typically our customers are up and running in minutes, not days.
With VerifiedVisitors you will be able to manage all the bots visiting your site, set your bot access list, and automate mitigation through the VerifiedVisitors dashboard.
If you use AWS CloudFront or Cloudflare you can install VerifiedVisitors at the edge of network by starting your journey at https://app.verifiedvisitors.com/register

**What does it cost?**

All new accounts automatically get access to our Standard Tier FREE for up to 30 days so you can experience the product for yourselves! We charge on a monthly subscription basis, based on total web request volume for your account, with overages available for all tiers except our Basic tier for ad-hoc burst usage.
We have a low cost basic tier for accounts with less than 1M web requests per month for $99 per month.
For accounts with higher volumes, upgrades are available via the VerifiedVisitors portal starting from as little as $199 per month.
Billing is available in both $USD and £GBP.

**External/Third Party services**

As part of delivering the identification of bots, VerifiedVisitors uses our own fingerprinting service which is external to the WordPress plugin.
Our terms and privacy policies can be found here: https://www.verifiedvisitors.com/terms-of-service and https://www.verifiedvisitors.com/cookie-privacy-policy.

The VerifiedVisitors Wordpress plugin may present a CAPTCHA page to visitors when a CAPTCHA rule is triggered, which relies on [hCAPTCHA](https://www.hcaptcha.com/).
Their terms and privacy policies can be found here: https://www.hcaptcha.com/terms and https://www.hcaptcha.com/privacy.


== Installation ==

This plugin requires an active VerifiedVisitors subscription to function.

1. Sign up to [VerifiedVisitors](https://app.verifiedvisitors.com/register)
2. Generate an access token from within your VerifiedVisitors profile settings page and paste it into the plugin settings page in WordPress
3. Add your site in the VerifiedVisitors portal, then configure your Bot Allowlist and automated traffic rules


== Frequently Asked Questions ==

= How does it work? =

VerifiedVisitors deploys an agent to allow our Product to protect your web estate from unwanted and malicious bot traffic.
Using the Wordpress plugin init hook we verify web visitors and block unwanted or potentially malicious traffic.
Our intelligent detectors examine thousands of diverse security signals, separate out the legitimate bots and users from the malicious ones by learning from your traffic.

= How do you charge? =

VerifiedVisitors charges a monthly subscription based on your overall web volumes.
Starting as low as $10/£10 per month for our basic tier, upgrades for larger volumes and additional functions can be actioned directly from our management portal.
Billing can be setup in either $USD or £GBP.

= I already have an access list? Why do I need yours? =

If you regularly maintain your own access list, you will already know that tracking agents by the agent string or IP address isn't effective or reliable as both can change without notice.
We proactively check each and every bot agent, ensuring it is valid, and perform multi-factor authentication to verify each bot, **24/7**, updating our live definitions constantly so you don't have to.
Additionally trying to manage unwanted automated traffic requires hours of reactive analysis, and by the time you block the ASN, IP or UA the attacker has re-tooled and you’re back to square one.
With VerifiedVisitors we automatically detect and can mitigate other automated traffic immediately saving you the time and headache.

= Why can't I do this from robots.txt? =

Although well-behaved industry standard bots do respect robots.txt (or tell you when they won't), the cybercriminals certainly don't.
As soon as you identify a bot agent and IP and disallow it, the bot will simply ignore your entry, or come back again with a new agent string and IP address.
The robots.txt entry is going to be out-of-date as soon as it's written and this quickly becomes unmanageable.
They may also use your robots.txt file as a guide to sensitive paths on your site. Our new Virtual CISO allows you to enforce your robots.txt file in real-time.

= How are you different to other bot management solutions? =

VerifiedVisitors focuses on finding and protecting the good bots you do want, not the thankless and never ending task of trying to identify the bad guys.
Once we’ve done this for you our automated blocking rules can reduce or mitigate all your other bot traffic with confidence.

= Can we apply your VerifiedVisitors list to our API endpoint? =

Yes, you can apply our list to any endpoint that accepts HTTP connections, such as API's, search systems or mobile endpoints.
We successfully defended an API based business against unwanted visitors taking system resources and degrading their services.
Read more about this in [our blog](https://www.verifiedvisitors.com/blog).

= Can VerifiedVisitors protect our Credit Card gateway from Bot attacks? =

Yes, we can automatically defend against carding bot attacks on your payment gateway.

= I have custom crawlers, can I add those to my access list? =

We recognize that you may have created a bespoke bot for your business, or use tooling that creates a 'unique' bot for you.
VerifiedVisitors supports this, in our portal you can add your own custom bot definition to your VerifiedWatchList.
If it's a commercial bot you believe we should know about and support you can contact us on support@verifiedvisitors.com and let us know.

= What are your Terms of Service and Privacy Policies? =

Our Terms of service can be found here: https://www.verifiedvisitors.com/terms-of-service whilst our Privacy Policy can be found here: https://www.verifiedvisitors.com/cookie-privacy-policy.

= Where can I find out more? =

You can visit our website at https://www.verifiedvisitors.com where we have an overview of our product, our blog FAQs which we hope will help you.


== Changelog ==

= 1.1.2 =
* Update README.md *

= 1.1.1 =
* Test with WordPress 6.4

= 1.1.0 =
* Collect additional request headers for improved visitor categorisation
* Validate API key in plugin settings page
* General improvements

= 1.0 =
* Initial release.
