# Glossary Deployment Setup

Automatic deployment is configured via GitHub Actions. When you push changes to glossary files, they'll automatically deploy to yoganearme.info/glossary/

## One-Time Setup: Add Your Hostinger Credentials

1. **Get your Hostinger FTP credentials:**
   - Log in to Hostinger → hPanel
   - Go to Files → FTP Accounts
   - Note your: Server, Username, Password

2. **Add secrets to GitHub:**
   - Go to your repo: https://github.com/bentpics63/yoga_near_me
   - Settings → Secrets and variables → Actions → New repository secret
   - Add these three secrets:

   | Secret Name | Value |
   |-------------|-------|
   | `FTP_SERVER` | Your Hostinger FTP server (e.g., `ftp.yoganearme.info` or the IP) |
   | `FTP_USERNAME` | Your FTP username |
   | `FTP_PASSWORD` | Your FTP password |

3. **Test the deployment:**
   - Go to Actions tab in GitHub
   - Click "Deploy Glossary Pages"
   - Click "Run workflow" → "Run workflow"

## How It Works

- **Trigger:** Any push to `main` that changes files in `content/glossary/`
- **Source:** `content/glossary/glossary terms-hub/LOCKED 1.1.26/`
- **Destination:** `yoganearme.info/glossary/`
- **Result:** `yoganearme.info/glossary/ahimsa-defined.html` etc.

## Manual Trigger

You can also manually trigger deployment:
1. Go to Actions → Deploy Glossary Pages
2. Click "Run workflow"

## Troubleshooting

**Deployment fails?**
- Check FTP credentials are correct
- Ensure `/public_html/glossary/` directory exists on server
- Check Hostinger firewall allows FTP connections

**Files not showing?**
- Clear any caching (Hostinger, CloudFlare, browser)
- Check the server-dir path matches your Hostinger setup
