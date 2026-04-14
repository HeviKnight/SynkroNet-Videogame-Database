# SynkroNET

Plataforma web de videojuegos desarrollada con PHP, JavaScript y CSS, preparada para ejecutarse en entorno local con XAMPP y para publicarse en GitHub.

## Resumen

- Frontend modular con componentes reutilizables
- Estructura orientada a páginas PHP
- Recursos estáticos organizados en carpetas dedicadas
- Lista para colaboración y versionado en Git

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
git clone https://github.com/TU-USUARIO/SynkroNET.git
```

2. Inicia Apache desde el panel de XAMPP.

3. Abre el proyecto en el navegador:

```text
http://localhost/SynkroNET
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

1. Inicializa Git (si todavía no existe):

```bash
git init
git add .
git commit -m "chore: initial project setup"
```

2. Crea un repositorio vacío en GitHub y conecta remoto:

```bash
git branch -M main
git remote add origin https://github.com/TU-USUARIO/SynkroNET.git
git push -u origin main
```

3. A partir de ese punto, flujo diario:

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

MIT

