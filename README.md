# Docker Labs — CP1

Repositório com os laboratórios 1 e 2 do Checkpoint 1 da disciplina de Docker.

---

## LAB 1 — Página Web Estática com NGINX

### Arquivos

**`lab1/Dockerfile`**
```dockerfile
FROM nginx:alpine

RUN rm -rf /usr/share/nginx/html/*

EXPOSE 80
```

### Passo a Passo

**1. Build da imagem:**
```bash
docker build -t lab1-nginx .
```

**2. Executar o container com bind mount:**
```bash
docker run -d --name lab1-container -p 8080:80 -v "F:\Nova pasta (4)\lab1\site:/usr/share/nginx/html" lab1-nginx
```

**3. Verificar o container em execução:**
```bash
docker ps
```

**4. Acessar no navegador:** http://localhost:8080

### Evidências

**Dockerfile:**

<img width="1920" height="1030" alt="docker file lab1" src="https://github.com/user-attachments/assets/6c0e1377-a244-4abd-8d37-262906681791" />

**Build da imagem:**

<img width="1132" height="566" alt="docker build lab 1" src="https://github.com/user-attachments/assets/2a790470-4465-43a5-b1ac-12225ab0f834" />

**Docker Run:**

<img width="1047" height="94" alt="docker run lab 1" src="https://github.com/user-attachments/assets/ecffbf02-67ae-4fe8-9669-a288616bb651" />

**Container em execução (`docker ps`):**

<img width="1133" height="125" alt="docker ps" src="https://github.com/user-attachments/assets/adac610f-5693-4631-9a7c-45dd1e05b8bb" />

**Site estático funcionando no navegador:**

<img width="1920" height="1033" alt="site estatico lab 1" src="https://github.com/user-attachments/assets/a3202b19-e35a-4f3b-8f9e-e3c49b106dc7" />

---

## LAB 2 — Aplicação PHP + MySQL

### Arquivos

**`lab2/Dockerfile`**
```dockerfile
FROM php:8.1-apache

RUN docker-php-ext-install mysqli

COPY app/ /var/www/html/

EXPOSE 80
```

### Passo a Passo

**1. Criar a network Docker:**
```bash
docker network create lab2-network
```

**2. Subir o container MySQL com volume:**
```bash
docker run -d \
  --name mysql-container \
  --network lab2-network \
  -e MYSQL_ROOT_PASSWORD=rootpass \
  -e MYSQL_DATABASE=lab2db \
  -e MYSQL_USER=lab2user \
  -e MYSQL_PASSWORD=lab2pass \
  -v lab2-mysql-data:/var/lib/mysql \
  mysql:8.0
```

**3. Build da imagem PHP:**
```bash
docker build -t lab2-php .
```

**4. Subir o container PHP:**
```bash
docker run -d \
  --name lab2-container \
  --network lab2-network \
  -p 8081:80 \
  lab2-php
```

**5. Verificar containers e volume em execução:**
```bash
docker ps
docker volume ls
```

**6. Acessar no navegador:** http://localhost:8081

### Evidências

**Dockerfile:**

<img width="1920" height="1027" alt="docker file lab 2" src="https://github.com/user-attachments/assets/27326fa1-e8b6-4737-a2ca-89c26abc6794" />

**Docker Run (MySQL e PHP):**

<img width="620" height="460" alt="docker run lab 2" src="https://github.com/user-attachments/assets/009cbc0d-7861-4bf5-9103-563700a2761a" />

**Containers em execução (`docker ps`):**

<img width="1133" height="125" alt="docker ps" src="https://github.com/user-attachments/assets/47b1dcb1-3eba-4ebb-bda9-21154a308afe" />

**Volume criado (`docker volume ls`):**

<img width="579" height="235" alt="docker volume lab 2" src="https://github.com/user-attachments/assets/fcf3fb99-e297-4340-93ef-2cb3edcdd678" />

**Aplicação funcionando com produtos cadastrados:**

<img width="1915" height="985" alt="aplicação com banco lab 2" src="https://github.com/user-attachments/assets/b075c122-88c2-4a78-81ad-4fa4521d0f09" />

---
