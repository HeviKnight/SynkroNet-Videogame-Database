# SynkroNET

Plataforma web de videojuegos desarrollada con PHP, JavaScript y CSS, preparada para ejecutarse en entorno local con XAMPP y para publicarse en GitHub.

Repositorio oficial: https://github.com/HeviKnight/SynkroNet-Videogame-Database

## Resumen

- Frontend modular con componentes reutilizables
- Estructura orientada a páginas PHP
- Recursos estáticos organizados en carpetas dedicadas
- Lista para colaboración y versionado en Git

## Tecnologias utilizadas

- PHP
- JavaScript (vanilla)
- CSS3
- Bootstrap 5.3 (CDN)
- Bootstrap Icons 1.11 (CDN)
- Google Fonts (Jura y Orbitron)

## Estructura del proyecto

```text
SynkroNET/
├── index.php
├── componentes/
│   ├── footer.php
│   └── sidebar.php
├── css/
│   └── styles.css
├── js/
│   ├── script.js
│   ├── sidebar.js
│   └── templates.js
├── paginas/
│   └── videojuegos.php
├── public/
│   └── robots.txt
├── src/
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

## Ejecucion alternativa (sin XAMPP)

Para pruebas rápidas de frontend:

```bash
npm install
npm run dev
```

URL por defecto:

```text
http://localhost:8080
```

## Publicacion en GitHub

1. Clona el repositorio:

```bash
git clone https://github.com/HeviKnight/SynkroNet-Videogame-Database.git
cd SynkroNet-Videogame-Database
```

2. Flujo diario de trabajo:

```bash
git add .
git commit -m "feat: descripcion breve"
git push
```

## Convenciones recomendadas

- No subir secretos ni credenciales al repositorio
- Mantener cambios pequeños y commits descriptivos
- Crear ramas por funcionalidad
- Revisar diff antes de publicar

## Scripts disponibles

- npm run dev: inicia servidor local estático en puerto 8080
- npm run serve: alias de dev

## Estado del proyecto

En desarrollo activo.

## Licencia

Este proyecto está bajo licencia MIT.

Consulta el archivo LICENSE para más información.

