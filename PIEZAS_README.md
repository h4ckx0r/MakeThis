# Sistema de Solicitud de Piezas 3D

## Descripción General

Sistema completo de solicitud de piezas 3D para MakeThis, permitiendo a los usuarios:
1. Subir su propio modelo 3D con configuración de impresión
2. Encargar un diseño personalizado con descripciones y referencias
3. Buscar y filtrar piezas en el catálogo
4. Visualizar un resumen antes de confirmar

## Rutas Disponibles

### Navegación Pública
- `GET /piezas/solicitar` - Página de selección entre pieza propia o personalizada
- `GET /piezas/catalogo` - Catálogo con filtros de búsqueda y tags
- `GET /piezas/propia` - Formulario para subir modelo 3D propio
- `GET /piezas/personalizada` - Formulario para encargar diseño

### Procesos
- `POST /piezas/preview` - Validar datos y mostrar resumen (público)
- `POST /piezas/store` - Crear solicitud (requiere autenticación)

## Flujo de Usuario

### 1. Seleccionar Tipo
```
GET /piezas/solicitar
→ Elegir entre:
  - Tu Modelo 3D
  - Diseño Personalizado
  - Catálogo
```

### 2. Formulario (Pieza Propia)
```
GET /piezas/propia
↓
- Subir archivo 3D (OBJ, STL, 3MF) via drag & drop
- Seleccionar material (PLA, ABS, PETG, TPU, Nylon)
- Seleccionar color
- Opción: configuración recomendada
- Si no: configurar altura capa, relleno, patrón
- Añadir indicaciones especiales
- POST /piezas/preview
```

### 3. Formulario (Pieza Personalizada)
```
GET /piezas/personalizada
↓
- Subir imágenes de referencia via drag & drop
- Seleccionar material preferido
- Seleccionar color preferido
- Opciones:
  - Incluir modelo 3D (para futuras impresiones)
  - Incluir pieza en la entrega
- Describir la idea detalladamente
- POST /piezas/preview
```

### 4. Vista Previa
```
GET /piezas/preview (tras POST a /piezas/preview)
↓
Mostrar:
- Tipo de pieza
- Material
- Color
- Indicaciones/descripción (si existen)
↓
- Botón: "Volver a editar" (history.back)
- Botón: "Solicitar Pieza" (POST /piezas/store)
```

### 5. Confirmación
```
POST /piezas/store
↓
Si NO autenticado:
  → Redirigir a /login con mensaje
Si autenticado:
  → Crear SolicitudPieza en BD
  → Limpiar sesión
  → Redirigir a /solicitudes-cliente con confirmación
```

### 6. Catálogo (Alternativa)
```
GET /piezas/catalogo
↓
- Búsqueda por nombre (en tiempo real)
- Filtros por tags (multiselección)
- Grid 4 columnas (responsive)
- Paginación de 8 items
```

## Base de Datos

### Tabla: piezas
```sql
id, nombre, descripcion, imagen, visible_catalogo, created_at, updated_at
```

### Tabla: tags
```sql
id, nombre (único), created_at, updated_at
```

### Tabla: pieza_tag (pivot)
```sql
pieza_id (FK), tag_id (FK), PRIMARY KEY (pieza_id, tag_id)
```

### Tabla: solicitudes_piezas
```sql
id
user_id (FK) - Usuario que solicita
pieza_id (FK, nullable) - Si es de catálogo
tipo (ENUM: 'propia' | 'personalizada')
material - Material seleccionado
color - Color seleccionado
indicaciones - Instrucciones especiales
estado (ENUM: pendiente | en_proceso | completada | rechazada)

# Campos específicos pieza propia:
archivo_3d - Ruta del archivo subido
config_recomendada - Boolean
altura_capa - Decimal(8,2)
porcentaje_relleno - Integer
patron_relleno - String

# Campos específicos pieza personalizada:
imagenes - JSON array de rutas
incluye_modelo_3d - Boolean
incluye_pieza - Boolean

created_at, updated_at
```

## Modelos

### Pieza
```php
->fillable: nombre, descripcion, imagen, visible_catalogo
->casts: visible_catalogo → boolean
->tags() BelongsToMany
```

### Tag
```php
->fillable: nombre
->piezas() BelongsToMany
```

### SolicitudPieza
```php
->fillable: (todos los campos)
->casts: config_recomendada, incluye_modelo_3d, incluye_pieza → boolean
         imagenes → array
->user() BelongsTo
->pieza() BelongsTo (nullable)
```

## Componentes

### Blade Components
- `x-piezas.card` - Tarjeta de pieza con imagen y tags
- `x-piezas.tag` - Badge de tag (#nombre)

### Livewire Components
- `piezas.file-uploader` - Upload con drag & drop
  - Props: tipo ('3d' | 'imagen')
  - Acepta: .obj,.stl,.3mf o image/*

## Testing

### Seeder de Prueba
```bash
php artisan db:seed --class=PiezasSeeder
```
Crea:
- 8 tags: mecanico, decorativo, funcional, juguete, herramienta, soporte, conectores, organización
- 10 piezas de ejemplo con relaciones tags

### Test Manual: Flujo Completo
1. Navegar a `/piezas/solicitar`
2. Click en "Tu Modelo 3D"
3. Subir archivo de prueba (o simular)
4. Llenar formulario
5. Ver preview
6. Click "Solicitar Pieza"
7. Será redirigido a login si no está autenticado
8. Tras autenticarse, crear solicitud
9. Verificar en BD: `SELECT * FROM solicitudes_piezas;`

## Configuración

### Variables de Entorno
```env
DB_CONNECTION=sqlite  # Cambio para desarrollo local
FILESYSTEM_DISK=local # Para almacenar archivos
```

### Storage
Los archivos subidos se guardan en `storage/app/` (Livewire WithFileUploads)

### Validación
- Archivos 3D: OBJ, STL, 3MF (validar en cliente y server)
- Imágenes: JPEG, PNG, GIF, WebP (max 10MB por imagen)
- Campos requeridos: tipo, material, color
- Campos opcionales: indicaciones, archivo_3d, imagenes

## Personalización

### Agregar Nuevo Material
1. Actualizar select en propia.blade.php y personalizada.blade.php
2. (Opcional) Crear tabla `materials` en BD para mejor mantenimiento

### Agregar Nuevos Patrones de Relleno
1. Actualizar select en propia.blade.php
2. Actualizar validación en PiezaController si es necesario

### Cambiar Límites de Paginación
En `PiezaController::catalogo()`:
```php
$piezas = $query->paginate(8); // Cambiar 8 por otro número
```

## Notas de Desarrollo

- La sesión `preview` se guarda al hacer POST a `/piezas/preview`
- Se limpia al hacer POST a `/piezas/store`
- Si expira (default 120 min), usuario debe rellenar formulario de nuevo
- Filtros del catálogo usan query parameters, no AJAX
- Drag & drop funciona con Alpine.js + Livewire
- Componentes Blade reutilizables están en `resources/views/components/piezas/`

## Estructura de Archivos

```
app/
  ├─ Http/Controllers/PiezaController.php
  ├─ Livewire/Piezas/
  │  ├─ FileUploader.php
  │  └─ CatalogoFilter.php
  └─ Models/
     ├─ Pieza.php
     ├─ Tag.php
     └─ SolicitudPieza.php

database/
  ├─ migrations/
  │  ├─ 2026_02_08_205238_create_piezas_table.php
  │  ├─ 2026_02_08_205240_create_tags_table.php
  │  ├─ 2026_02_08_205240_create_pieza_tag_table.php
  │  └─ 2026_02_08_205240_create_solicitudes_piezas_table.php
  └─ seeders/PiezasSeeder.php

resources/views/
  ├─ components/piezas/
  │  ├─ card.blade.php
  │  └─ tag.blade.php
  ├─ livewire/piezas/
  │  ├─ file-uploader.blade.php
  │  └─ catalogo-filter.blade.php
  └─ piezas/
     ├─ solicitar.blade.php
     ├─ catalogo.blade.php
     ├─ propia.blade.php
     ├─ personalizada.blade.php
     └─ preview.blade.php

routes/web.php (actualizado con nuevas rutas)
```

## Stack Técnico

- **Backend**: Laravel 11, Blade Templates
- **Frontend**: TailwindCSS v4, DaisyUI v5.5.14, Alpine.js
- **Interactividad**: Livewire 3 (WithFileUploads)
- **BD**: SQLite (desarrollo), PostgreSQL (producción)
- **Forms**: HTML tradicionales + Livewire para uploads

## Próximas Mejoras

1. Agregar vista de gestión de solicitudes para admin
2. Implementar cambio de estado de solicitudes
3. Agregar notificaciones por email
4. Sistema de comentarios/feedback en solicitudes
5. Previsualizador 3D en tiempo real (three.js)
6. Cálculo de presupuestos automático
7. Integración con sistema de pagos
