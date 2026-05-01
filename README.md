# XSStrike Report — XSS Vulnerability Detection & Analysis

> A hands-on security lab investigating Cross-Site Scripting (XSS) attacks — how they work, how they're detected with automated tools, and how to defend against them.

---

## 🌐 Live Report

**[View the full report →](https://boudaoud20.github.io/xss-attack-lab)**

---

## 📋 Overview

This project is a complete web security lab that demonstrates three types of XSS attacks on a custom-built PHP web application. It covers:

- Building a vulnerable PHP/MySQL web application
- Manually exploiting Stored, DOM-Based, and Reflected XSS
- Using the **XSStrike** automated scanner to detect vulnerabilities
- Patching all vulnerabilities and verifying the fixes

---

## 🗂️ Repository Structure

```
├── index.html          # Full report — GitHub Pages site
├── README.md           # This file
└── xss-lab/
    ├── config.php      # Database connection
    ├── index.php       # Main page (entry point)
    ├── login.php       # Simple login (sets cookie)
    ├── dashboard.php   # Displays session cookie
    ├── search.php      # Reflected XSS lab
    ├── comments.php    # Stored XSS lab
    ├── dom.php         # DOM XSS lab
    └── style.css       # UI styling
```

---

## ⚡ XSS Attack Types

### 🗄️ Stored XSS
The attacker submits a malicious script that gets saved in the database. Every user who loads the affected page triggers the script automatically.

**Payload used:**
```html
<script> alert("stored xss") </script>
```

**Root cause:** User input was stored and echoed without sanitization.

---

### ⚡ DOM-Based XSS
The attack occurs entirely in the browser by manipulating the DOM through the URL fragment. The server is never involved.

**Payload used:**
```
dom.php#<h1 style=color:red>Site is down now, try later</h1>
```

**Root cause:** `location.hash` was passed directly into `innerHTML`.

---

### 🔄 Reflected XSS
Malicious input is submitted via a GET parameter, immediately reflected in the server response, and executed in the browser.

**Payload used:**
```
search.php?q=<img src=x onerror="alert('XSS')">
```

**Root cause:** The `q` parameter was echoed into the HTML response without encoding.

---

## 🛠️ XSStrike Tool

[XSStrike](https://github.com/s0md3v/XSStrike) is an advanced XSS detection tool that crawls websites, finds all inputs and forms, and generates intelligent context-aware payloads.

### Installation

```bash
git clone https://github.com/s0md3v/XSStrike
cd XSStrike
pip install -r requirements.txt --break-system-packages
```

### Detection Results

| Attack Type   | XSStrike Result | Notes |
|---------------|-----------------|-------|
| Reflected XSS | ✅ Detected      | Parameter `q` confirmed injectable. 3,072 payloads generated, Confidence: 10 |
| Stored XSS    | ❌ Missed        | POST + multi-step flow not automated by XSStrike |
| DOM-Based XSS | ⚠️ Partial       | Risky pattern flagged; URL fragment invisible to server-side scanner |

---

## 🛡️ Security Fixes Applied

### Reflected & Stored XSS — `htmlspecialchars()`
```php
// Before (vulnerable)
echo "<p>" . $row['content'] . "</p>";

// After (secure)
echo "<p>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</p>";
```

### DOM-Based XSS — `textContent` instead of `innerHTML`
```javascript
// Before (vulnerable)
document.getElementById("output").innerHTML = decodeURIComponent(input);

// After (secure)
document.getElementById("output").textContent = decodeURIComponent(input);
```

### Cookie Security — `HttpOnly` & `SameSite`
```php
setcookie("session", "admin_session", [
    'expires'  => time() + 3600,
    'httponly' => true,     // JS cannot access this cookie
    'samesite' => 'Strict'  // blocks cross-site requests
]);
```

---

## 📊 Final Results

| Attack Type   | Before Fix       | After Fix   |
|---------------|------------------|-------------|
| Reflected XSS | ✅ Exploitable   | 🔒 Blocked  |
| Stored XSS    | ✅ Exploitable   | 🔒 Blocked  |
| DOM-Based XSS | ✅ Exploitable   | 🔒 Blocked  |

---

## 🔑 Key Takeaways

- **XSStrike is highly effective for Reflected XSS** but has limitations with Stored and DOM-Based attacks due to multi-step flows and client-side-only execution.
- **Automated scanners are not enough** — manual testing is essential to confirm vulnerabilities that tools cannot fully automate.
- **False positives are real** — after patching, XSStrike still flagged the Reflected XSS endpoint. Manual verification confirmed no actual execution occurred.
- **Defense is simple** — `htmlspecialchars()`, `textContent`, and secure cookie attributes eliminate all three attack vectors.

---

## 🚀 Deploying the Report (GitHub Pages)

1. Push this repository to GitHub
2. Go to **Settings → Pages**
3. Set source to **main branch / root**
4. Your report will be live at:
   ```
   https://yourusername.github.io/your-repo-name
   ```

---

## 🧰 Tech Stack

| Layer      | Technology          |
|------------|---------------------|
| Backend    | PHP 8               |
| Database   | MySQL               |
| Frontend   | HTML, CSS           |
| Scanner    | XSStrike (Python)   |
| Hosting    | GitHub Pages        |

---

## ⚠️ Disclaimer

This project is built **strictly for educational purposes**. The vulnerable application is intended to run in a local, isolated environment only. Do not deploy the vulnerable version on any public or production server.
