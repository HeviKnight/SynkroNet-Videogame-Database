# SynkroNET

Plataforma web de videojuegos desarrollada con PHP, JavaScript y CSS, preparada para ejecutarse en entorno local con XAMPP y para publicarse en GitHub.

Repositorio oficial: https://github.com/HeviKnight/SynkroNet-Videogame-Database

## Resumen

- Frontend modular con componentes reutilizables
- Estructura orientada a páginas PHP
- Catálogos de juegos vía RAWG API con caché inteligente
- Recursos estáticos organizados en carpetas dedicadas
- Lista para colaboración y versionado en Git

## Tecnologías utilizadas

- PHP 7.4+
- JavaScript (vanilla, ES6+)
- CSS3
- Bootstrap 5.3 (CDN)
- Bootstrap Icons 1.11 (CDN)
- Google Fonts (Jura y Orbitron)
- RAWG API (catálogos de juegos)

## Estructura del proyecto

```text
SynkroNET/
├── index.php
├── componentes/
│   ├── footer.php
│   ├── sidebar.php
│   └── games-section.php
├── css/
│   └── styles.css
├── js/
│   ├── script.js          (incluye externalGames)
│   ├── sidebar.js
│   └── templates.js
├── api/
│   ├── conection.php
│   └── getDbData.php      (deprecated)
├── paginas/
│   └── videojuegos.php
├── public/
│   └── robots.txt
├── README.md
└── package.json
```

## Requisitos

- XAMPP con Apache habilitado
- Git
- Navegador moderno
- Node.js (opcional, para servidor de apoyo con npm)

## Puesta en marcha local con XAMPP

1. Clona el repositorio dentro de htdocs:

```bash
cd C:/xampp/htdocs
git clone https://github.com/HeviKnight/SynkroNet-Videogame-Database.git
```

2. Inicia Apache desde el panel de XAMPP.

3. Abre el proyecto en el navegador:

```text
http://localhost/SynkroNet-Videogame-Database
```

**Nota:** Los juegos se cargan desde RAWG API directamente en JavaScript con caché en localStorage (7 días).

## Ejecución alternativa (sin XAMPP)

Para pruebas rápidas de frontend:

```bash
npm install
npm run dev
```

URL por defecto:

```text
http://localhost:8080
```

## Configuración de RAWG API

Para que los carruseles de juegos funcionen, necesitas una clave API de RAWG:

1. Regístrate en https://rawg.io/
2. Obtén tu API key en https://rawg.io/settings/api
3. En `api/config.php`, añade la siguiente línea:

```php
define('RAWG_API_KEY', 'tu_clave_aqui');
```

**Nota:** La API KEY se obtiene de forma segura desde el servidor (api/getApiKey.php), no está expuesta en el código JavaScript.

## Publicación en GitHub

```bash
git add .
git commit -m "feat: descripcion breve"
git push origin main
```

## Convenciones

- No subir credenciales ni API keys al repositorio
- Mantener commits pequeños y descriptivos
- Crear ramas por funcionalidad
- Revisar diff antes de publicar

## Scripts disponibles

- `npm run dev`: inicia servidor local estático en puerto 8080
- `npm run serve`: alias de dev

## Cómo funciona

1. **Carruseles de juegos**: JavaScript llama directamente a RAWG API
2. **Caché**: LocalStorage almacena datos 7 días para mejor rendimiento
3. **Sin BD requerida**: Funciona sin bases de datos configuradas
4. **Responsive**: Adaptado a todos los tamaños de pantalla

## Estado del proyecto

✓ Sistema de juegos funcional  
✓ Caché inteligente  
🔄 En desarrollo activo

## Licencia

MIT - Consulta `LICENSE` para detalles.

---

**Última actualización:** 25 de mayo de 2026  
**Documentación:** Consulta los comentarios en `js/script.js`
