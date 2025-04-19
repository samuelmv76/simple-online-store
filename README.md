# 🛒 Tienda Online Simple

## 📥 Instalación

### ✅ Requisitos

- PHP 8.1
- Laravel
- MySQL
- Composer
- NPM

### 📦 Descarga

Puedes descargar el proyecto como archivo `.zip` o clonarlo desde el repositorio:

```bash
git clone https://github.com/samuelmv76/
```

### 📚 Instalación de dependencias

Instala las dependencias de PHP:

```bash
composer install
```

Instala las dependencias de Node.js:

```bash
npm install
```

### ⚙️ Configuración del entorno

Renombra el archivo `.env.example` como `.env`:

```bash
mv .env.example .env
```

Luego configura tus credenciales de base de datos en el archivo `.env`:

```
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=simple-online-store  
DB_USERNAME=root  
DB_PASSWORD=
```

### 🔐 Generar clave del proyecto

```bash
php artisan key:generate
```

### 🧱 Ejecutar migraciones y seeders

```bash
php artisan migrate:refresh --seed
```

### Ejecutar estos 2 comandos para provar la Aplicación

### 🚀 Ejecutar el servidor de desarrollo

```bash
php artisan serve
```

### ⚡ Ejecutar el servidor de Vite para React

```bash
npm run dev
```

### ----------------------------------------------------

### 🏗️ Generar versión de producción de React

```bash
npm run build
```