# Browser-based Terminal Portal

> Secure, single-sign-on access to Debian & Rocky Linux terminals from any browser.  
> **Tech stack:** Keycloak (OIDC) · NGINX (reverse-proxy) · ttyd · Docker Compose · Microsoft Azure · PHP · HTML & CSS

## 🎬 2-minute demo  
[▶️ Watch the demo video](https://drive.google.com/file/d/1Wc20sAk7dM6zSI39HkvGyoRySJRW2qsR/view?usp=sharing)

## 📄 PDF documentation  
[projekt-azure.pdf](docs/projekt-azure.pdf)

---

## 🚀 Quick Start / Szybki start

Poniżej znajdziesz kompletną instrukcję krok-po-kroku w wersji **angielskiej** i **polskiej**, gotową do wklejenia do Twojego `README.md`.

---

### 1. Clone repository / Sklonuj repozytorium

```bash
git clone https://github.com/twoj-uzytkownik/terminal-web-app.git
cd terminal-web-app
```

---

### 2. Create `.env` / Utwórz plik `.env`

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

### 4. Prepare folders / Przygotuj foldery

```bash
mkdir -p data/postgres
mkdir -p certs/${KC_HOSTNAME}/
```

> `${KC_HOSTNAME}` = wartość z `.env` (np. `keycloak.local`)  
> Folder `certs/` i `data/` nie są commitowane do repo.

---

### 5. Generate TLS certs (optional)  
### 5. Wygeneruj certyfikaty TLS (opcjonalnie)

```bash
sudo apt update
sudo apt install certbot
sudo certbot certonly --standalone -d ${KC_HOSTNAME}

cp /etc/letsencrypt/live/${KC_HOSTNAME}/fullchain.pem certs/${KC_HOSTNAME}/
cp /etc/letsencrypt/live/${KC_HOSTNAME}/privkey.pem   certs/${KC_HOSTNAME}/
```

---

### 6. Run the stack / Uruchom cały system

```bash
docker compose up -d
```

---

### 7. Access the portal / Otwórz portal w przeglądarce

- https://${KC_HOSTNAME}  
- Login: `${KEYCLOAK_ADMIN_USERNAME}`  
- Password: `${KEYCLOAK_ADMIN_PASSWORD}`

---

### 8. Logs (optional) / Logi (opcjonalnie)

```bash
docker compose logs -f postgres_db
docker compose logs -f keycloak
docker compose logs -f nginx
```

---

## 📁 Project structure / Struktura projektu

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

## 🛑 `.gitignore` sample / Przykład `.gitignore`

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

**That's it! / To wszystko!**  
Teraz każdy, kto sklonuje repo, będzie miał jasne instrukcje jak skonfigurować, wgrać certyfikaty i uruchomić cały stack lokalnie.  
Więcej szczegółów zaawansowanych znajdziesz w pliku PDF: [`docs/projekt-azure.pdf`](docs/projekt-azure.pdf)
```
