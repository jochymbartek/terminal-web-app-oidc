# Browser-based Terminal Portal

> Secure, single-sign-on access to Debian & Rocky Linux terminals from any browser.  
> **Tech stack:** Keycloak (OIDC) · NGINX (reverse-proxy) · ttyd · Docker Compose · Microsoft Azure · PHP · HTML & CSS

## 🎬 2-minute demo  
[▶️ Watch the demo video](https://drive.google.com/file/d/1Wc20sAk7dM6zSI39HkvGyoRySJRW2qsR/view?usp=sharing)

## 📄 PDF documentation  
[projekt-azure.pdf](docs/projekt-azure.pdf)

---

## 🚀 Quick Start 

Below you will find complete step-by-step instructions in **English** and **Polish**, ready to paste into your `README.md`.

---

### 1. Clone repository

```bash
git clone https://github.com/jochymbartek/terminal-web-app-oidc.git
cd terminal-web-app
```

---

### 2. Create `.env` 

```bash
cp .env.example .env
nano .env
```

---

### 3. Example `.env.example`

```env
# Database
POSTGRES_USER=keycloak
POSTGRES_PASSWORD=2U63pQTzPq9fAd83K

# Keycloak / OIDC
KC_HOSTNAME=keycloak.local
KEYCLOAK_ADMIN_USERNAME=admin
KEYCLOAK_ADMIN_PASSWORD=A4m7V8rBzHk9wXc1
```

---

### 4. Prepare folders 

```bash
mkdir -p data/postgres
mkdir -p certs/${KC_HOSTNAME}/
```

> `${KC_HOSTNAME}` = value from `.env` (example `keycloak.local`)  
> Directories `certs/` i `data/` are not committed to the repository.

---

### 5. Generate TLS certs (optional)  

```bash
sudo apt update
sudo apt install certbot
sudo certbot certonly --standalone -d ${KC_HOSTNAME}

cp /etc/letsencrypt/live/${KC_HOSTNAME}/fullchain.pem certs/${KC_HOSTNAME}/
cp /etc/letsencrypt/live/${KC_HOSTNAME}/privkey.pem   certs/${KC_HOSTNAME}/
```

---

### 6. Run the stack 
```bash
docker compose up -d
```

---

### 7. Access the portal 

- https://${KC_HOSTNAME}  
- Login: `${KEYCLOAK_ADMIN_USERNAME}`  
- Password: `${KEYCLOAK_ADMIN_PASSWORD}`

---

### 8. Logs (optional) 

```bash
docker compose logs -f postgres_db
docker compose logs -f keycloak
docker compose logs -f nginx
```

---

## 📁 Project structure 
```
terminal-web-app/
├── app/                   # PHP & HTML (login/logout)
├── certs/                 # TLS certs (ignored)
│   └── ${KC_HOSTNAME}/
│       ├── fullchain.pem
│       └── privkey.pem
├── data/                  # Postgres data (ignored)
│   └── postgres/
├── docs/                  # demo_720p.mp4, projekt-azure.pdf
├── nginx/                 # NGINX configs
├── .env                   # local env vars (ignored)
├── .env.example           # example env
├── .gitignore             # ignores certs/, data/, .env
├── docker-compose.yaml
└── README.md
```

---

## 🛑 `.gitignore` sample 

```gitignore
# sensitive / runtime data
certs/
data/
.env

# optional
logs/
node_modules/
```

---

**That's it! **  
Now, anyone who clones the repo will have clear instructions on how to configure, upload certificates, and run the entire stack locally.
For more advanced details, see the PDF file: [`docs/projekt-azure.pdf`](docs/projekt-azure.pdf)
```
