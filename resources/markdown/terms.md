# Terms of Service

Edit this file to define the terms of service for your application.

# Projecte VideosApp - Autor: Alexander Beltran

## SPRINT 1

### Què s'ha de fer al 1r Sprint?

#### Creació del projecte:
- Crear un nou projecte anomenat **VideosApp + Nom** (per exemple: *VideosAppAlexander*).
- Configurar el projecte amb les següents opcions de Jetstream:
    - `livewire`
    - `phpunit`
    - `teams`
    - `sqlite`

#### Tasques del SPRINT 1:
1. **Test de Helpers:**
    - Crear un test que comprovi:
        - La creació d'un usuari per defecte.
        - La creació d'un professor per defecte.
        - Els camps requerits: `name`, `email`, i `password` (amb encriptació).
        - Associació dels usuaris a un *team*.
2. **Helpers a la carpeta app:**
    - Desenvolupar *helpers* personalitzats a `app/helpers`.
3. **Configuració d'usuaris per defecte:**
    - Afegir credencials dels usuaris al fitxer `.env`.
    - Configurar un fitxer a `config` per gestionar les credencials predeterminades.

---

## SPRINT 2

### Què s'ha de fer al 2n Sprint?

#### Correccions del SPRINT 1:
- Corregir errors identificats durant el primer sprint.
- Al fitxer `phpunit`, descomentar:
    - `db_connection`
    - `db_database`
- Configurar tests per utilitzar una base de dades temporal.

#### Noves funcionalitats:
1. **Migració de vídeos:**
    - Crear la taula de vídeos amb els camps següents:
        - `id`, `title`, `description`, `url`, `published_at`, `previous`, `next`, `series_id`.
    - Afegir URL d'exemple (*links* de YouTube).
2. **Controlador VideosController:**
    - Desenvolupar funcions:
        - `testedBy`
        - `show`
3. **Model de vídeos:**
    - Configurar el camp `published_at` com a data.
    - Implementar funcions de formatació amb Carbon:
        - `getFormattedPublishedAtAttribute`: retorna una data com "13 de gener de 2025".
        - `getFormattedForHumansPublishedAtAttribute`: retorna "fa 2 hores".
        - `getPublishedAtTimestampAttribute`: retorna el valor *Unix timestamp*.
4. **Helpers de vídeos per defecte:**
    - Crear helpers per generar vídeos predeterminats.
5. **DatabaseSeeder:**
    - Afegir usuaris i vídeos predeterminats al *seeder*.
6. **Layout VideosAppLayout:**
    - Crear un layout a:
        - `app/View/components`
        - `resources/views/layouts`
7. **Rutes i vistes:**
    - Crear la ruta i vista per a la funció `show` de vídeos.
8. **Organització de tests:**
    - Moure `HelpersTest` a `tests/Unit`.
    - Afegir tests per comprovar:
        - Creació de vídeos predeterminats.
        - Formatació de dates al model.
        - Visualització de vídeos amb `VideosTest` a:
            - `tests/Unit`
            - `tests/Feature/Videos`
9. **Guia del projecte:**
    - Escriure una guia sobre el projecte i les tasques fetes als dos sprints a `resources/markdown/terms`.
10. **Larastan:**
    - Instal·lar i configurar Larastan.
    - Corregir els errors detectats durant l'anàlisi del codi.

## SPRINT 3

### Què s'ha fet al 3r Sprint?

#### Correccions del SPRINT 2:
- Corregir els errors identificats durant el segon sprint.

#### Noves funcionalitats:
1. **Gestió de permisos i rols:**
    - Instal·lar el paquet [`spatie/laravel-permission`](https://spatie.be/docs/laravel-permission/v6/installation-laravel) per gestionar permisos i rols.

2. **Migració i model d'usuaris:**
    - Crear una migració per afegir el camp `super_admin` a la taula d'usuaris.
    - Afegir al model d'usuaris les funcions:
        - `testedBy()`
        - `isSuperAdmin()`

3. **Millores als helpers:**
    - Afegir el rol `superadmin` al professor a la funció `create_default_professor()`.
    - Crear la funció `add_personal_team()` per separar la creació del team dels usuaris.
    - Definir helpers per crear usuaris per defecte:
        - `create_regular_user()` amb valors (`regular`, `regular@videosapp.com`, `123456789`)
        - `create_video_manager_user()` amb valors (`Video Manager`, `videosmanager@videosapp.com`, `123456789`)
        - `create_superadmin_user()` amb valors (`Super Admin`, `superadmin@videosapp.com`, `123456789`)
        - `define_gates()` per definir portes d'accés.
        - `create_permissions()` per crear permisos específics.

4. **Polítiques d'autorització i portes d'accés:**
    - A `AppServiceProvider`, registrar les polítiques d'autorització i definir les portes d'accés.

5. **DatabaseSeeder:**
    - Afegir permisos i usuaris per defecte:
        - `superadmin`
        - `regular user`
        - `video manager`

6. **Publicació de stubs:**
    - Publicar i personalitzar els stubs de Laravel.
        - [Exemple](https://laravel-news.com/customizing-stubs-in-laravel)

7. **Tests:**
    - **`VideosManageControllerTest`** a `tests/Feature/Videos`:
        - Comprovar la gestió de vídeos amb diferents permisos:
            - `user_with_permissions_can_manage_videos()`
            - `regular_users_cannot_manage_videos()`
            - `guest_users_cannot_manage_videos()`
            - `superadmins_can_manage_videos()`
            - `loginAsVideoManager()`
            - `loginAsSuperAdmin()`
            - `loginAsRegularUser()`
    - **`UserTest`** a `tests/Unit`:
        - Comprovar la funció `isSuperAdmin()`

8. **Guia del projecte:**
    - Actualitzar `resources/markdown/terms` amb els canvis del SPRINT 3.

9. **Larastan:**
    - Comprovar amb Larastan tots els fitxers creats o modificats per assegurar la qualitat del codi.


## SPRINT 4

### Què s'ha fet al 4t Sprint?

#### Correccions del SPRINT 3:
- Es van corregir els errors trobats en el tercer sprint, com l'accés incorrecte a la ruta `/videosmanage` per usuaris amb permisos adequats. Els tests s'han actualitzat per garantir que els usuaris amb permisos puguin accedir-hi correctament.

#### Noves funcionalitats:
1. **Controlador VideosManageController:**
    - He creat el controlador **VideosManageController** amb les funcions següents:
        - `testedBy()`
        - `index()`
        - `store()`
        - `show()`
        - `edit()`
        - `update()`
        - `delete()`
        - `destroy()`
    - Aquest controlador gestiona la creació, edició, actualització i eliminació de vídeos per usuaris amb els permisos adequats.

2. **Controlador VideosController:**
    - He afegit la funció `index()` per mostrar tots els vídeos públicament a la pàgina principal.

3. **Migració i Seeder:**
    - He afegit tres vídeos predeterminats al **DatabaseSeeder** per poder utilitzar-los en els tests i en les vistes.

4. **Vistes per al CRUD de vídeos:**
    - He creat les següents vistes dins de la carpeta `resources/views/videos/manage`:
        - `index.blade.php`: Taula per mostrar tots els vídeos.
        - `create.blade.php`: Formulari per afegir vídeos (amb l'atribut `data-qa` per facilitar els tests).
        - `edit.blade.php`: Formulari per editar vídeos existents.
        - `delete.blade.php`: Confirmació per eliminar vídeos.
    - He afegit també la vista `index.blade.php` a la ruta pública `resources/views/videos/index.blade.php`, que mostra tots els vídeos i permet accedir als detalls (funció `show()`).

5. **Tests de Vídeos i Permisos:**
    - He modificat el test `user_with_permissions_can_manage_videos()` per garantir que hi hagi tres vídeos creats.
    - A **VideoTest**, he creat les següents funcions:
        - `user_without_permissions_can_see_default_videos_page`
        - `user_with_permissions_can_see_default_videos_page`
        - `not_logged_users_can_see_default_videos_page`
    - A **VideosManageControllerTest**, he creat diverses funcions per comprovar que els usuaris amb permisos puguin gestionar vídeos i que els usuaris sense permisos no puguin accedir a les funcionalitats de gestió.

6. **Rutes i Middleware:**
    - He creat les rutes per al CRUD de vídeos amb el middleware corresponent.
    - Les rutes per al CRUD només apareixen per usuaris logejats, mentre que la ruta per veure tots els vídeos és pública.

## SPRINT 5

### Què s'ha fet al 5è Sprint?

#### Correccions del SPRINT 4:
- Es van corregir els errors trobats durant el quart sprint, incloent-hi els errors de rutes i accessos incorrectes. Els tests s'han actualitzat per garantir que els usuaris amb permisos puguin accedir-hi correctament.

#### Noves funcionalitats:

1. **Afegir el camp `user_id` a la taula de vídeos:**
    - He afegit el camp `user_id` a la taula de vídeos per emmagatzemar qui ha creat el vídeo. Això es reflecteix en el model, controlador i helpers.
    - He modificat la migració i l'seeder per incloure aquest camp.

2. **Controlador `UsersManageController`:**
    - He creat el controlador `UsersManageController` amb les funcions següents:
        - `index()`: Per veure la llista d'usuaris.
        - `store()`: Per crear un nou usuari.
        - `edit()`: Per editar un usuari.
        - `update()`: Per actualitzar un usuari.
        - `destroy()`: Per eliminar un usuari.

3. **Controlador `UsersController`:**
    - He afegit les funcions `index()` i `show()` al `UsersController` per veure tots els usuaris i mostrar el detall d'un usuari.

4. **Vistes per al CRUD d'usuaris:**
    - He creat les següents vistes per gestionar els usuaris, dins de la carpeta `resources/views/users/manage`:
        - **`index.blade.php`**: Taula per mostrar tots els usuaris.
        - **`create.blade.php`**: Formulari per afegir usuaris (amb l'atribut `data-qa` per facilitar els tests).
        - **`edit.blade.php`**: Formulari per editar usuaris existents.
        - **`delete.blade.php`**: Confirmació per eliminar usuaris.

5. **Vistes `create.blade.php` i `edit.blade.php`:**
    - He creat les vistes per afegir i editar usuaris, amb un formulari que fa servir el mètode `POST` i `PUT`, respectivament.

6. **Testos de Controlador i Permisos:**
    - He creat els testos per garantir que només els usuaris amb permisos adequats poden accedir als CRUD d'usuaris.

7. **Rutes i Middleware:**
    - He creat les rutes per al CRUD d'usuaris amb el middleware corresponent. Els usuaris només podran accedir-hi si estan autenticats.

8. **Markdown per al Sprint:**
    - He afegit una descripció completa de les tasques realitzades al fitxer `resources/markdown/terms`.

9. **Comprovació amb Larastan:**
    - He realitzat una comprovació del codi amb Larastan per assegurar-me que no hi ha errors.

#### Tests Afegits:

1. **Testos per al controlador `UsersManageController`:**
    - He creat els següents tests:
        - `user_with_permissions_can_see_add_users`
        - `user_without_users_manage_create_cannot_see_add_users`
        - `user_with_permissions_can_store_users`
        - `user_without_permissions_cannot_store_users`
        - `user_with_permissions_can_destroy_users`
        - `user_without_permissions_cannot_destroy_users`
        - `user_with_permissions_can_see_edit_users`
        - `user_without_permissions_cannot_see_edit_users`
        - `user_with_permissions_can_update_users`
        - `user_without_permissions_cannot_update_users`
        - `user_with_permissions_can_manage_users`
        - `regular_users_cannot_manage_users`
        - `guest_users_cannot_manage_users`
        - `superadmins_can_manage_users`
