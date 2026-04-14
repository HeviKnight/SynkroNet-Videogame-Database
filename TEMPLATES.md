# SynkroNET - Templates Module Documentación

## 📋 Descripción General

El módulo `templates.js` proporciona un sistema de plantillas dinámicas que permite renderizar componentes (cards) a partir de datos JSON desde una API PHP.

El objetivo es **separar la lógica de renderizado del HTML hardcodeado**, que hace que sea fácil actualizar el contenido desde una base de datos sin cambiar el HTML.

---

## 🎯 Características

✅ Plantillas para todos los tipos de cards (juegos, noticias, desarrolladores, lanzamientos)  
✅ Funciones de renderizado dinámico  
✅ Integración con API PHP  
✅ Protección contra XSS con escape de HTML  
✅ Event listeners automáticos  
✅ Búsqueda dinámica  
✅ **Totalmente responsivo** (Desktop, Tablet, Mobile)  

---

## 📁 Estructura

```
proyecto/
├── js/
│   ├── templates.js       ← Módulo de plantillas
│   ├── script.js          ← Script principal
│   └── sidebar.js         ← Gestión del sidebar (responsive)
├── api/
│   ├── games.php          ← Endpoint de juegos
│   ├── developers.php     ← Endpoint de desarrolladores
│   ├── news.php           ← Endpoint de noticias
│   ├── releases.php       ← Endpoint de lanzamientos
│   └── search.php         ← Endpoint de búsqueda
├── componentes/
│   ├── sidebar.php        ← Incluye sidebar + overlay
│   └── footer.php         ← Footer responsivo
└── css/
    └── styles.css         ← Todo el CSS (incluyendo responsive @media queries)
```

---

## 🚀 Uso Básico

### 1. Cargar Juegos

```javascript
// Cargar todos los juegos
loadGames();

// Cargar con categoría
loadGames('RPG');

// Cargar en un contenedor específico
loadGames(null, 'mi-contenedor');
```

### 2. Cargar Desarrolladores

```javascript
// Cargar los últimos 5 desarrolladores
loadDevelopers(5);

// Cargar en contenedor personalizado
loadDevelopers(10, 'devs-container');
```

### 3. Cargar Noticias

```javascript
// Cargar últimas 3 noticias
loadNews(3);

// Cargar todas las noticias
loadNews(100);
```

### 4. Cargar Lanzamientos

```javascript
// Cargar próximos lanzamientos
loadReleases();

// Cargar 10 lanzamientos
loadReleases(10);
```

### 5. Búsqueda

```javascript
// Buscar "Minecraft"
searchGames('Minecraft');

// Buscar en contenedor personalizado
searchGames('RPG', 'results-container');
```

### 6. Cargar Todo

```javascript
// Carga todas las secciones simultáneamente
loadAllContent();
```

---

## � Consideraciones Responsivas

### Grid Responsivo Automático
Las tarjetas se adaptan automáticamente usando clases Bootstrap:

```html
<!-- Generado por templates.js -->
<div class="row g-4">
    <div class="col-lg-2 col-md-3 col-sm-6 col-12">
        <!-- Tarjeta game -->
    </div>
</div>
```

**Resultado:**
- **Desktop** (≥1200px): 6 tarjetas por fila
- **Tablet** (769px-1199px): 4 tarjetas por fila
- **Mobile** (576px-768px): 2 tarjetas por fila
- **Mobile pequeño** (<576px): 1 tarjeta por fila

### Estilos Responsivos Aplicados Automáticamente
El módulo templates.js usa las clases CSS que se adaptan automáticamente en:
- `@media (max-width: 768px)`: Botón hamburguesa visible, sidebar off-canvas, header móvil fijo
- `@media (max-width: 480px)`: Tamaños más pequeños, padding reducido, sidebar más estrecho

### Comportamiento en Mobile
- El header móvil (60px) contiene el logo "SynkroNET"
- El sidebar se transforma en off-canvas flotante
- El contenido se reajusta con padding-top 60px
- Las tarjetas ocupan 100% en móviles pequeños

---

## �📊 Formato de Datos Esperado

### Games API (`/api/games.php`)

```json
{
  "success": true,
  "count": 6,
  "games": [
    {
      "id": 1,
      "title": "Dark Kingdoms: Rise of the Fallen",
      "image": "https://...",
      "score": 92,
      "tags": ["RPG", "Cooperativo"],
      "platforms": ["PC", "PS5", "Xbox"]
    }
  ]
}
```

### Developers API (`/api/developers.php`)

```json
{
  "success": true,
  "count": 5,
  "developers": [
    {
      "id": 1,
      "name": "Mojang Studios",
      "role": "Desarrollador Principal",
      "image": "https://..."
    }
  ]
}
```

### News API (`/api/news.php`)

```json
{
  "success": true,
  "count": 3,
  "news": [
    {
      "id": 1,
      "title": "Título de la noticia",
      "image": "https://...",
      "author": "Juan Pérez",
      "readTime": "5 min",
      "tags": ["Indie", "GameAwards"]
    }
  ]
}
```

### Releases API (`/api/releases.php`)

```json
{
  "success": true,
  "count": 4,
  "releases": [
    {
      "id": 1,
      "title": "Dark Kingdoms",
      "image": "https://...",
      "date": "2025-12-09",
      "days": 20,
      "hours": 5,
      "minutes": 35
    }
  ]
}
```

### Search API (`/api/search.php`)

```json
{
  "success": true,
  "query": "minecraft",
  "count": 1,
  "results": [
    {
      "id": 2,
      "title": "Minecraft",
      "image": "https://...",
      "score": 95,
      "tags": ["Sandbox"],
      "platforms": ["PC", "Console"]
    }
  ]
}
```

---

## 🎨 Renderizado Manual

Si necesitas renderizar un elemento sin cargar de la API:

```javascript
// Crear una tarjeta de juego manualmente
const game = {
    id: 1,
    title: "Mi Juego",
    image: "https://...",
    score: 85,
    tags: ["Aventura"],
    platforms: ["PC"]
};

const html = createGameCard(game);
document.getElementById('games-grid').innerHTML += html;
```

---

## 🔗 Integración con HTML

El HTML debe tener contenedores con IDs específicos:

```html
<!-- Para juegos -->
<div id="games-grid" class="games-grid"></div>

<!-- Para desarrolladores -->
<div id="developers-grid" class="developers-grid"></div>

<!-- Para noticias -->
<div id="news-grid" class="news-grid"></div>

<!-- Para lanzamientos -->
<div id="releases-grid" class="releases-grid"></div>
```

---

## 🔌 Activar Carga Dinámica

En `js/script.js`, descomenta la línea:

```javascript
// Carga todo dinámicamente
loadAllContent();

// O carga por secciones
loadGames();
loadDevelopers();
loadNews();
loadReleases();
```

---

## ⚠️ Consideraciones de Seguridad

- Todas las strings se escapan con `escapeHTML()` para prevenir XSS
- Los datos deben venir siempre de fuentes confiables
- Se recomienda validar en PHP antes de retornar JSON

---

## 🐛 Debugging

### Ver logs en consola

```javascript
// Los logs de las funciones de carga aparecerán en la consola del navegador
// Abre DevTools (F12) > Console para ver las llamadas a la API
```

### Verificar estructura de datos

```javascript
// Cuando cargues datos, verifica la estructura en consola
fetch('/api/games.php')
    .then(res => res.json())
    .then(data => console.log(data));
```

---

## 📝 Ejemplo Completo

```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div id="games-grid"></div>

    <script src="js/templates.js"></script>
    <script src="js/script.js"></script>
    <script>
        // Cargar juegos cuando la página cargue
        document.addEventListener('DOMContentLoaded', () => {
            loadGames();
        });
    </script>
</body>
</html>
```

---

## 🔄 Flujo de Datos

```
Usuario interactúa → JavaScript → API PHP → Base de Datos
                        ↓
                   templates.js
                        ↓
                   Renderiza HTML
                        ↓
                   Actualiza DOM
```

---

## 📚 Fórmulas de Endpoint

| Función | Endpoint | Parámetros |
|---------|----------|-----------|
| `loadGames()` | `/api/games.php` | `?category=RPG` |
| `loadDevelopers()` | `/api/developers.php` | `?limit=5` |
| `loadNews()` | `/api/news.php` | `?limit=10` |
| `loadReleases()` | `/api/releases.php` | `?limit=4` |
| `searchGames()` | `/api/search.php` | `?q=minecraft` |

---

## 📞 Soporte

Para problemas:
1. Verifica que los endpoints PHP existan
2. Abre DevTools (F12) y mira la consola
3. Verifica que el JSON esté bien formado
4. Asegúrate que los IDs de contenedores coincidan

---

**Última actualización:** 2026-03-31 | **Cambios:** Responsive design completo (mobile header, overlay, sidebar off-canvas)
