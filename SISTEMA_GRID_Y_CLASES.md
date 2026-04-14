# 🎮 Sistema de Grid y Clases - SynkroNET

## 📐 Arquitectura del Sistema de Columnas

### ¿Cómo funciona el layout actual?

**Desktop (>768px):**
```
┌─────────────────────────────────────────────────────────┐
│                        NAVEGADOR                         │
├──────────────┬──────────────────────────────────────────┤
│              │                                           │
│  SIDEBAR     │          MAIN-CONTENT                    │
│  (224px o    │                                           │
│   64px)      │          (12 COLUMNAS BOOTSTRAP)          │
│              │                                           │
│              │  ┌──────────────────────────────────────┐ │
│              │  │ #home (Principal content)           │ │
│              │  │ - .row con .col-lg-X                │ │
│              │  │ - .row con .col-md-X                │ │
│              │  │ - .row con .col-sm-X                │ │
│              │  │ - .row con .col-12                  │ │
│              │  └──────────────────────────────────────┘ │
│              │                                           │
└──────────────┴──────────────────────────────────────────┘
```

**Mobile (≤768px):**
```
┌──────────────────────────────────────────────────────────┐
│  HEADER FIJO (60px) - SynkroNET + Botón Hamburguesa     │
├──────────────────────────────────────────────────────────┤
│                     MAIN-CONTENT                         │
│          (Sidebar off-canvas flotante)                   │
│                                                          │
│  ┌────────────────────────────────────────────────────┐  │
│  │ #home (Full width, responsive)                    │  │
│  │ - Bootstrap 12 columnas                           │  │
│  │ - Padding: 0 12px                                 │  │
│  └────────────────────────────────────────────────────┘  │
│                                                          │
│  ┌─────────────────────────────────── overlay ────────┐  │
│  │ SIDEBAR (off-canvas, semi-transparente dark)      │  │
│  │ Visible cuando el usuario abre el menú            │  │
│  └────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────┘
```

### Gestión del Espacio

| Componente | Desktop | Mobile | Responsivo | Descripción |
|-----------|---------|--------|-----------|-------------|
| **Header Móvil** | Oculto | 60px fijo | `@media (max-width: 768px)` | Barra color primary con logo |
| **Botón Hamburguesa** | Oculto | Visible | `@media (max-width: 768px)` | En header superior |
| **Sidebar** | 224px/64px fijo | Off-canvas | Transform: translateX | Navegación lateral/flotante |
| **Main-content** | `calc(100% - sidebar-width)` | 100% | Transform/margin | Se desplaza con sidebar desktop |
| **#home** | padding: 24px 24px | padding: 12px 12px | Grid flexible | Área de contenido principal |
| **Overlay** | Oculto | Visible | `@media (max-width: 768px)` | Oscurece fondo cuando sidebar abierto |
| **Bootstrap Cols** | 12 columnas | 12 columnas | Dinámico | Distribución flexible del contenido |

### ✅ Respuesta Directa: ¿Las 12 columnas se gestionan dentro del main?

**SÍ**, exactamente así:

**Desktop:**
```
Sidebar (224px/64px) [FIXED LEFT] 
            ↓
Main-content margin-left = sidebar-width
            ↓
    #home (padding: 24px)
            ↓
Bootstrap Row (.row) → 12 Columnas
       ├─ .col-lg-2  (escritorio)
       ├─ .col-md-3  (tablet)
       ├─ .col-sm-6  (móvil horizontal)
       └─ .col-12    (móvil vertical)
```

**Mobile:**
```
Header Móvil (color primary, 60px) [FIXED TOP]
            ↓
Main-content (margin-left: 0, full width)
            ↓
    #home (padding: 12px, padding-top: 60px)
            ↓
Bootstrap Row (.row, full width, responsive)
       └─ .col-12, .col-sm-6 cols (móvil)
            ↓
Sidebar Off-Canvas (flotante, translateX(-100%))
            ↓
Overlay (rgba 0.6, display: none por defecto)
```

El sidebar **en desktop es un elemento paralelo fijo**, en mobile se convierte en **off-canvas flotante**.

---

## 🎨 Clases Disponibles para Construir

### 1️⃣ LAYOUT Y ESTRUCTURA

#### Layout Principal
```html
<!-- Contenedor principal con responsive margin -->
<section class="main-content">
    <main id="home">
        <!-- Contenido aquí -->
    </main>
</section>

<!-- Clases modificadoras -->
<section class="main-content sidebar-collapsed">
    <!-- Cuando sidebar está colapsado -->
</section>
```

**Propiedades:**
- `.main-content`: margin-left auto, responsive width
- `.main-content.sidebar-collapsed`: margin-left se reduce a 64px
- `#home`: flex container, padding 32px 48px, overflow hidden

---

### 2️⃣ BOTONES (Componentes Reutilizables)

#### Tipos de Botones

```html
<!-- Botón primario (turquesa) -->
<button class="btn btn-primary">Acción Principal</button>

<!-- Botón outline (solo borde) -->
<button class="btn btn-outline-primary">Secundario</button>

<!-- Botón pequeño -->
<button class="btn btn-sm btn-primary">Compacto</button>

<!-- Botón externo (esquina superior izquierda) -->
<button class="btn-external"><i class="bi bi-box-arrow-up-right"></i></button>

<!-- Botón primario externo (esquina inferior derecha) -->
<button class="btn-external-primary"><i class="bi bi-heart"></i></button>

<!-- Botón "Ver más" (overlay semi-transparente) -->
<button class="btn btn-see-more">Ver más juegos</button>
```

**Propiedades base (.btn):**
- Padding: 8px 16px
- Border-radius: 8px
- Font-weight: 600, Font-size: 13px
- Transition: all 0.3s ease-in-out
- Display: inline-flex (para iconos alineados)

**Variantes:**
- `btn-primary`: Turquesa con hover oscuro
- `btn-outline-primary`: Borde turquesa, fondo transparente
- `btn-sm`: Más compacto (6px 12px)
- `btn-external`: Overlay blanco (32x32px)
- `btn-external-primary`: Turquesa primario (32x32px)
- `btn-see-more`: Overlay semi-transparente

---

### 3️⃣ BADGES Y TAGS

#### Badges de Etiquetas
```html
<!-- Dentro de contenedor -->
<div class="tags-container">
    <span class="tag-badge">RPG</span>
    <span class="tag-badge">Multijugador</span>
    <span class="tag-badge">Indie</span>
</div>

<!-- Versión pequeña -->
<div class="tags-small">
    <span class="tag-badge">Etiqueta</span>
</div>
```

#### Badges de Plataforma
```html
<div class="platforms">
    <span class="platform-badge">PC</span>
    <span class="platform-badge">PS5</span>
    <span class="platform-badge">Xbox</span>
    <span class="platform-badge">Switch</span>
</div>
```

#### Badges de Puntuación
```html
<div class="score-badge score-high">92</div>    <!-- Verde -->
<div class="score-badge score-mid">85</div>     <!-- Naranja -->
<div class="score-badge score-low">78</div>     <!-- Rojo -->
```

**Propiedades:**
- `tag-badge`: Fondo turquesa claro (10%), texto turquesa
- `platform-badge`: Fondo gris claro, texto muted
- `score-badge`: 36x36px, redondeado, colores semánticos
  - `.score-high`: Verde (#11BA25)
  - `.score-mid`: Naranja (#F36D1A)
  - `.score-low`: Rojo (#ef4444)

---

### 4️⃣ SECCIONES DE CONTENIDO

#### Estructura de Section
```html
<section class="content-section" id="games-section" style="--section-color: #06b6d4">
    <div class="section-header">
        <!-- Tabs y título -->
    </div>
    <div class="section-content">
        <!-- Grid de contenido -->
    </div>
    <div class="section-footer">
        <!-- Indicadores y botones -->
    </div>
</section>
```

**Clases:**
- `.content-section`: Contenedor principal (padding: 24px, border-radius: 16px)
  - Acepta `--section-color` para cambiar color de fondo
- `.section-header`: Flex column con gap 16px
- `.section-tabs`: Flex row con botones de tab
- `.section-title`: Texto grande, bold, uppercase (18px)
- `.section-content`: Contenedor flexible
- `.section-footer`: Flex row con border-top
- `.section-dots`: Indicadores de carousel (flex center)

#### Botones de Tabs
```html
<div class="section-tabs">
    <button class="tab-button active">Popular</button>
    <button class="tab-button">Newest</button>
    <button class="tab-button">Upcoming</button>
</div>
```

**Propiedades:**
- Fondo blanco semi-transparente (0.2)
- Hover/Active: Fondo blanco completo, texto del color de la sección

#### Indicadores (Dots)
```html
<div class="section-dots">
    <button class="dot active"></button>
    <button class="dot"></button>
    <button class="dot"></button>
</div>
```

**Propiedades:**
- 8x8px, border-radius 50%
- Hover: escala 1.2, opacidad aumentada
- Active: blanco, escala 1.3

---

### 5️⃣ HERO SECTION

#### Estructura
```html
<section id="hero-section">
    <div class="hero-content">
        <div class="row g-4">
            <!-- Imagen: col-lg-5 -->
            <div class="col-lg-5 col-md-6 col-12">
                <img src="..." alt="..." class="hero-game-image w-100 h-100">
            </div>
            
            <!-- Texto: col-lg-7 -->
            <div class="col-lg-7 col-md-6 col-12">
                <div class="hero-text-content h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h1 class="hero-title">Título</h1>
                        <p class="hero-description">Descripción...</p>
                        
                        <div class="tags-container mb-4">
                            <span class="tag-badge">Tag</span>
                        </div>
                    </div>
                    
                    <div class="hero-buttons mt-auto">
                        <button class="btn btn-primary">Principal</button>
                        <button class="btn btn-outline-primary">Secundario</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

**Clases Hero:**
- `#hero-section`: border-radius 16px, overflow hidden, min-height 400px
- `.hero-content`: Pseudo-elemento ::before con blur background 8px
- `.hero-game-image`: object-fit cover, aspect-ratio 4/3
- `.hero-text-content`: color inversa, flex column, justify content between
- `.hero-title`: 32px bold, color inversa
- `.hero-description`: 15px, opacity 0.95, line-height 1.6

---

### 6️⃣ GRILLAS DE TARJETAS

#### Estructura General
```html
<div class="row g-4">
    <div class="col-lg-2 col-md-3 col-sm-6 col-12">
        <div class="game-card">
            <!-- Contenido de carta -->
        </div>
    </div>
</div>
```

**Responsividad:**
- **Desktop (lg)**: 6 columnas por fila (col-lg-2)
- **Tablet (md)**: 4 columnas por fila (col-md-3)
- **Mobile hor (sm)**: 2 columnas por fila (col-sm-6)
- **Mobile ver**: 1 columna (col-12)

#### Tarjeta de Juego
```html
<div class="game-card">
    <div class="game-card-image">
        <img src="..." alt="...">
        <div class="score-badge score-high">92</div>
        <button class="btn-external"><i class="bi bi-box-arrow-up-right"></i></button>
    </div>
    <div class="game-card-body">
        <h3>Nombre del Juego</h3>
        <div class="tags-small">
            <span class="tag-badge">Género</span>
        </div>
        <div class="platforms">
            <span class="platform-badge">PC</span>
        </div>
    </div>
</div>
```

**Propiedades `.game-card`:**
- Border-radius: 12px, overflow hidden
- Background: surface (gris claro)
- Border: 1px border-color
- Cursor: pointer
- Hover: 
  - Transform: translateY(-2px)
  - Box-shadow: sharp
  - Border-color: turquesa
  - Imagen escala 1.05
  - Botón externo opacidad 1

#### Tarjeta de Desarrollador
```html
<div class="dev-card">
    <img src="..." alt="..." class="dev-card-image">
    <div class="dev-card-body">
        <h4>Nombre Dev</h4>
        <p class="dev-role">Rol/especialidad</p>
        <div class="dev-links">
            <a href="#" class="btn btn-sm btn-external-primary">
                <i class="bi bi-github"></i>
            </a>
        </div>
    </div>
</div>
```

---

### 7️⃣ SIDEBAR (Componente Include)

#### Clases Sidebar
```html
<section id="sidebar">
    <div class="sidebar-header">
        <!-- Logo/header -->
    </div>
    
    <div class="sidebar-nav">
        <nav>
            <a class="sidebar-item active">
                <i class="bi bi-home"></i>
                <span>Inicio</span>
            </a>
        </nav>
    </div>
    
    <div class="sidebar-search">
        <!-- Search -->
    </div>
    
    <div class="sidebar-footer">
        <!-- Configuración/perfil -->
    </div>
</section>
```

**Clases:**
- `#sidebar`: position fixed, width 224px, display flex flex-column
- `.sidebar.collapsed`: width 64px
  - Los spans se ocultan
  - Los iconos se centran
- `.sidebar-item`: Elementos clickeables
- `.sidebar-item.active`: Estilo activo

---

## 🎯 Patrones de Uso Comunes

### Patrón 1: Grid Responsivo de Tarjetas
```html
<div class="row g-4">
    <div class="col-lg-2 col-md-3 col-sm-6 col-12">
        <div class="game-card">...</div>
    </div>
    <!-- Repetir para cada tarjeta -->
</div>
```

### Patrón 2: Sección Coloreada
```html
<section class="content-section" style="--section-color: #FF6B6B">
    <div class="section-header">
        <div class="section-tabs">
            <button class="tab-button active">Tab 1</button>
        </div>
        <h2 class="section-title">Mi Sección</h2>
    </div>
    
    <div class="section-content">
        <!-- Contenido -->
    </div>
    
    <div class="section-footer">
        <div class="section-dots">
            <button class="dot active"></button>
        </div>
    </div>
</section>
```

### Patrón 3: Botón con Ícono
```html
<button class="btn btn-primary">
    <i class="bi bi-play-fill"></i>
    Ver Trailer
</button>

<!-- Outline -->
<button class="btn btn-outline-primary">
    Ver Más <i class="bi bi-arrow-right"></i>
</button>
```

### Patrón 4: Badges en Cascada
```html
<div class="tags-container">
    <span class="tag-badge">RPG</span>
    <span class="tag-badge">Adventure</span>
</div>

<div class="platforms">
    <span class="platform-badge">PC</span>
    <span class="platform-badge">PS5</span>
</div>
```

---

## 📱 Breakpoints Responsive y Mobile First

Bootstrap en el proyecto utiliza estos breakpoints:

| Clase | Viewport | Ancho | Descripción |
|-------|----------|-------|-------------|
| `.col-12` | Todas | 100% | Una columna completa |
| `.col-sm-*` | Móvil horizontal | ≥576px | Principios de grid |
| `.col-md-*` | Tablet | ≥768px | Tablet apaisado |
| `.col-lg-*` | Desktop | ≥992px | Pantalla grande |
| `.col-xl-*` | Desktop grande | ≥1200px | Pantalla muy grande |

### Niveles de Responsive Implementados

#### 1. **Desktop (≥992px)** 
- Sidebar fijo 224px (expandido) o 64px (colapsado)
- Main-content con margin-left dinámico
- Botón collapse visible
- Botón hamburguesa oculto
- Header móvil oculto
- Overlay oculto

#### 2. **Tablet (≥768px y <992px)**
- Sidebar sigue siendo desktop
- Responsive grid: col-md-*, col-lg-*
- Mismo layout que desktop

#### 3. **Mobile/Tablet small (≤768px)**
- **Header móvil fijo**: 60px altura, color primary, con logo "SynkroNET" centrado
- **Botón hamburguesa**: En header, sin fondo (transparente), izquierda arriba
- **Sidebar**: Off-canvas (translateX(-100%)), aparece cuando se abre
- **Overlay**: Se muestra (rgba 0, 0, 0, 0.6) cuando sidebar activo
- **Main-content**: margin-left: 0, width: 100%
- **#home**: padding-top 60px para dejar espacio al header
- **Grid**: col-sm-6, col-md-6, col-12
- **Buttons**: Tamaño reducido, padding compacto

#### 4. **Mobile pequeño (≤480px)**
- Similares a mobile ≤768px pero:
  - Botón hamburgesa: 36x36px (más pequeño)
  - Sidebar: 90vw max-width 280px (más estrecho)
  - Tipografía: Reducida un 10%
  - Gaps: Reducidos (g-2 en lugar de g-4)

**Recomendación para grids:**
```html
<!-- 6 items en desktop, 4 en tablet, 2 en móvil -->
<div class="col-lg-2 col-md-3 col-sm-6 col-12"></div>

<!-- 4 items en desktop, 2 en tablet, 1 en móvil -->
<div class="col-lg-3 col-md-6 col-12"></div>

<!-- 3 items en desktop, 2 en tablet, 1 en móvil -->
<div class="col-lg-4 col-md-6 col-12"></div>
```

---

## 🎯 Componentes Responsive Nuevos

### 1. Header Móvil (`mobile-nav-header`)
- **Disponible solo en**: `@media (max-width: 768px)`
- **Altura**: 60px
- **Posición**: Fixed top
- **Background**: Color primary (#00CDDB)
- **Contenido**: Logo "SynkroNET" centrado (vía ::after)
- **Bordes**: Bottom 2px white

```html
<!-- HTML: agregado en index.php y páginas -->
<div class="mobile-nav-header"></div>

<!-- CSS genera el contenido con ::after -->
.mobile-nav-header::after {
    content: 'SynkroNET';
    color: white;
    font-size: 1.25rem;
    font-weight: 800;
}
```

### 2. Botón Hamburguesa Mejorado
- **Desktop**: Oculto (`display: none`)
- **Mobile**: 44x44px, posición fixed en header
- **Estilo**: Transparente, sin borde, con hover semi-transparente
- **Z-index**: 1002 (encima del header)

```html
<button id="toggle-sidebar" class="btn-toggle-sidebar" title="Abrir menú">
    <i class="bi bi-list"></i>
</button>

<!-- Mobile CSS -->
.btn-toggle-sidebar {
    background-color: transparent;
    color: white;
    border: none;
    width: 44px;
    height: 44px;
    top: 10px;
    left: 12px;
    
    &:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
}
```

### 3. Overlay Oscuro (`sidebar-overlay`)
- **Disponible solo en**: Mobile (≤768px)
- **Color**: rgba(0, 0, 0, 0.6)
- **Z-index**: 999 (debajo del sidebar)
- **Uso**: Al hacer click, cierra el sidebar
- **Transición**: Opacity 0.3s

```html
<!-- HTML: agregado en sidebar.php -->
<div id="sidebar-overlay" class="sidebar-overlay"></div>

<!-- CSS: mostrar/ocultar con clase active -->
.sidebar-overlay.active {
    display: block;
    opacity: 1;
}
```

### 4. Sidebar Responsivo
- **Desktop**: Fixed left, width 224px/64px (según collapse)
- **Mobile**: 
  - Off-canvas (translateX(-100%))
  - Ancho: 224px
  - Se abre cuando botón toggle clickeado
  - Se cierra al seleccionar un item o hacer click en overlay

```css
@media (max-width: 768px) {
    #sidebar {
        position: fixed;
        transform: translateX(-100%);  /* Oculto por defecto */
        transition: transform 0.3s;
    }
    
    #sidebar.active {
        transform: translateX(0);  /* Visible cuando activo */
    }
}
```

---

## 🎨 Variables CSS Disponibles

```css
/* Colores Principales */
--primary: #00CDDB (Turquesa)
--primary-hover: #43ecf8 (Turquesa claro)
--primary-active: #118e97 (Turquesa oscuro)

--secondary: #A4F0F5 (Sky)

/* Estados */
--state-success: #11BA25 (Verde)
--state-warning: #F36D1A (Naranja)
--state-danger: #ef4444 (Rojo)

/* Backgrounds */
--bg-base: #F9FFFF (Off-white)
--bg-surface: #E5E5E5 (Gris claro)
--bg-surface-hover: #C4C4C4 (Gris más oscuro)

/* Texto */
--text-main: #373E4E (Ink)
--text-muted: #707070 (Gray-600)
--text-inverse: #F9FFFF (White)

/* Transiciones */
--transition: 0.3s ease-in-out

/* Sombras */
--shadow-sharp: 0 8px 24px rgba(0, 0, 0, 0.3)
```

---

## 💡 Tips de Construction

1. **Usa `g-4`** en `.row` para espaciado consistente entre items (1rem gap)
2. **Anida `.col` dentro de `.row`** - Bootstrap lo requiere
3. **Usa clases Bootstrap** (`w-100`, `h-100`, `d-flex`, `mb-4`) para layouts flexibles
4. **Define `--section-color`** inline en sections coloreadas para customización
5. **Aprovecha `flex-column`, `justify-content-between`, `align-items-center`** de Bootstrap
6. **Responsive first**: Siempre especifica `col-12` (móvil) → `col-sm-*` → `col-md-*` → `col-lg-*`

---

## 🔧 Troubleshooting

| Problema | Solución |
|----------|----------|
| Tarjetas muy anchas | Ajusta `col-lg-X` a número menor (ej: lg-2 → lg-3) |
| Tarjetas muy estrechas | Aumenta `col-md-X` (ej: md-3 → md-4) |
| Sidebar no se desplaza | Verifica que main-content tiene `.main-content.sidebar-collapsed` |
| Botones no centrados | Asegúrate de usar `.btn` (display: inline-flex con align-items) |
| Padding no se ve | `#home` tiene `overflow: hidden` para clip Bootstrap rows |
| Colores no cambian | Verifica `[data-bs-theme="dark"]` en el HTML root |

---

**Última actualización:** 2026-03-31 | **Versión:** 2.0 (Responsive) | **Cambios:** Mobile header, overlay oscuro, sidebar off-canvas | **Proyecto:** SynkroNET Gaming Portal
