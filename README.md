# Guía para el Uso de la API de Posts en Laravel

Este documento proporciona una explicación detallada sobre cómo utilizar la API de posts creada con Laravel. La API permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre los posts.

## 1. Introducción

La API de posts está diseñada para facilitar la gestión de contenido en una aplicación. Permite a los desarrolladores interactuar con los datos de los posts a través de solicitudes HTTP.

## 2. Endpoints de la API

A continuación se describen los endpoints disponibles en la API:

### 2.1 Listar Posts

- **Método**: GET
- **URL**: `/api/posts`
- **Descripción**: Recupera una lista de todos los posts.

### 2.2 Crear un Post

- **Método**: POST
- **URL**: `/api/posts`
- **Descripción**: Crea un nuevo post.
- **Cuerpo de la Solicitud** (JSON):
  ```json
  {
      "title": "Título del Post",
      "content": "Contenido del Post"
  }

### 2.3 Mostrar un Post

- **Método**: GET
- **URL**: `/api/posts/{id}`
- **Descripción**: Recupera un post específico por su ID.

### 2.4 Actualizar un Post
- **Método**: PUT
- **URL**: `/api/posts/{id}`
- **Descripción**: Actualiza un post existente.
- **Cuerpo de la Solicitud** (JSON)
  ```json
  {
      "title": "Nuevo Título",
      "content": "Nuevo Contenido"
  }

### 2.5 Eliminar un Post
- **Método**: DELETE
- **URL**: `/api/posts/{id}`
- **Descripción**: Elimina un post específico por su ID.

### 3. Ejemplo de Uso

### 3.1 Listar Todos los Posts
### Realiza una solicitud GET a http://localhost:8000/api/posts. Esto devolverá un JSON con todos los posts disponibles.

### 3.2 Crear un Nuevo Post
Envía una solicitud POST a http://localhost:8000/api/posts con el siguiente cuerpo:
  ```json
  {
      "title": "Mi Primer Post",
      "content": "Este es el contenido de mi primer post."
  }

### 3.3 Actualizar un Post
Para actualizar un post, realiza una solicitud PUT a http://localhost:8000/api/posts/1 (donde 1 es el ID del post) con el siguiente cuerpo:

```json
  {
      "title": "Título Actualizado",
      "content": "Contenido actualizado del post."
  }

### 3.4 Eliminar un Post
     Para eliminar un post, realiza una solicitud DELETE a http://localhost:8000/api/posts/1.

### 4. Consideraciones Finales
Manejo de Errores: La API devolverá códigos de estado HTTP apropiados para indicar el éxito o el fracaso de las operaciones. Asegúrate de manejar estos códigos en tu aplicación cliente.
